insert into end_point values
(1,'Account','/company/:companyId/account/:entityId','companyId,entityId'),
(2,'Attachable','/company/:companyId/attachable/:entityId','companyId,entityId'),
(3,'Batch','/company/:companyId/batch','companyId'),
(4,'Bill','	/company/:companyId/bill/:entityId','companyId,entityId'),
(5,'BillPayment','/company/:companyId/billpayment/:entityId','companyId,entityId'),
(6,'Budget','/company/:companyId/query?query=:query','companyId,query'),
(7,'ChangeDataCapture','/company/:companyId/cdc?entities=:entities&changedSince=:changedSince','companyId,entities,changedSince'),
(8,'Class','/company/:companyId/class/:entityId','companyId,entityId'),
(9,'CompanyInfo','/company/:companyId/companyinfo/:companyId','companyId'),
(10,'CreditMemo','/company/:companyId/creditmemo/:entityId','companyId,entityId'),
(11,'Customer','/company/:companyId/customer/:entityId','companyId,entityId'),
(12,'Department','/company/:companyId/department/:entityId','companyId,entityId'),
(13,'Deposit','/company/:companyId/deposit/:entityId','companyId,entityId'),
(15,'Employee','/company/:companyId/employee/:entityId','companyId,entityId'),
(16,'Estimate','/company/:companyId/estimate/:entityId','companyId,entityId'),
(17,'Invoice','/company/:companyId/invoice/:entityId','companyId,entityId'),
(18,'Item','/company/:companyId/item/:entityId','companyId,entityId'),
(19,'JournalEntry','/company/:companyId/journalentry/:entityId','companyId,entityId'),
(20,'Payment','/company/:companyId/payment/:entityId','companyId,entityId'),
(21,'PaymentMethod','/company/:companyId/paymentmethod/:entityId','companyId,entityId'),
(22,'Preferences','/company/:companyId/preferences','companyId'),
(23,'Purchase','/company/:companyId/purchase/:entityId','companyId,entityId'),
(24,'PurchaseOrder','/company/:companyId/purchaseorder/:entityId','companyId,entityId'),
(25,'RefundReceipt','	/company/:companyId/refundreceipt/:entityId','companyId,entityId');