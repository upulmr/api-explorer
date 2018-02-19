<?php

namespace APIExplorer\Adapter\QuickBook;

use APIExplorer\Adapter\get;
use APIExplorer\Adapter\IAdapter;
use APIExplorer\Client\HTTPResponse;
use APIExplorer\Client\IClient;
use APIExplorer\Client\HTTPRequest;
use \League\OAuth2\Client\Provider\GenericProvider;
use \SQLite3;

class Adapter implements IAdapter
{

    const DEFAULT_API_VERSION = 'v3';

    /**
     * @var stdclass
     */
    public $config = null;

    /**
     * @var IClient
     */
    public $httpClient = null;

    /**
     * @return stdclass
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param stdclass $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return IClient
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param IClient $httpClient
     */
    public function setHttpClient(IClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return GenericProvider
     */
    public function getAuthProvider()
    {
        return new GenericProvider([
            'clientId'                => $this->getConfig()->clientId,
            'clientSecret'            => $this->getConfig()->clientSecret,
            'redirectUri'             => $this->getConfig()->redirectUri,
            'urlAuthorize'            => $this->getConfig()->urlAuthorize,
            'urlAccessToken'          => $this->getConfig()->urlAccessToken,
            'urlResourceOwnerDetails' => null,
            'scopes'                  => $this->getConfig()->scopes,
        ]);
    }

    /**
     * @param HTTPRequest $request
     * @param string      $httpMethod
     *
     * @return HTTPResponse
     */
    public function executeHTTPRequest(HTTPRequest $request, $httpMethod = 'get')
    {
        $formatRequest = $this->formatHTTPRequest($request);

        $response = $this->getHttpClient()->$httpMethod($formatRequest);

        return $this->formatHTTPResponse($response);
    }

    /**
     * @return string
     */
    public function getAuthorizationUrl()
    {
        return $this->getAuthProvider()->getAuthorizationUrl();
    }

    /**
     * @param       $type
     * @param array $params
     *
     * @return \League\OAuth2\Client\Token\AccessToken
     */
    public function getAccessToken($type, $params = array())
    {
        return $this->getAuthProvider()->getAccessToken($type, $params);
    }

    /**
     * @param HTTPRequest $request
     *
     * @return HTTPRequest
     */
    public function formatHTTPRequest(HTTPRequest $request)
    {
        $request->setApiVersion(self::DEFAULT_API_VERSION);
        $params = array();
        foreach ($request->getParams() as $data) {
            $params[':' . $data['name']] = $data['value'];
        }
        $formatEndPoint = strtr($request->getEndPoint(), $params);
        $request->setEndPoint($formatEndPoint);

        return $request;
    }

    /**
     * @param HTTPResponse $response
     *
     * @return HTTPResponse
     */
    public function formatHTTPResponse(HTTPResponse $response) {
        $body = $response->getResult();
        if(isset($body['Fault']) && isset($body['Fault']['Error'])){
            $response->setExtraData($body['Fault']);
        }
        return $response;
    }

    /**
     * @return array
     */
    public function getAllEndPoints(){
        $endPoints = array();
        $db = new SQLite3(__DIR__."/../../db/api");
        $result = $db->query('SELECT * FROM end_point');

        while($res = $result->fetchArray(SQLITE3_ASSOC)){
            array_push($endPoints, $res);
        }
        return $endPoints;
    }
}
