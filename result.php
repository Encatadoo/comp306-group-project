<?php

require_once 'include/dbConnect.php';
require_once 'include/functions.php';


#########################SALEMAN STUFF############################
if (isset($_POST['show'])){
    $result = show_customers($conn);
}
if (isset($_POST['show_customer'])){
	$cid = $_POST["inputcid"];
	if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
    $result = show_customer($conn,$cid);
}
if (isset($_POST['show_customer_accounts'])){
	$cid = $_POST["inputcid"];
	if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
    $result = show_customer_accounts($conn,$cid);
}
if (isset($_POST['show_customer_suggestedcredit'])){
	$cid = $_POST["inputcid"];
	if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
    $result = show_customer_suggestedcredit($conn,$cid);
}
if (isset($_POST['show_customer_credit'])){
	$cid = $_POST["inputcid"];
	if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
    $result = show_customer_credit($conn,$cid);
}
if (isset($_POST['show_transactions'])){
	$aid = $_POST["inputaid"];
	$mnth = $_POST["inputmonth"];
    if(check_cid($aid) !== true){
        exit("Wrong aid value");
    }if(($mnth <1) or ($mnth >12)){
        exit("Wrong month value");
    }
    $result = show_transactions($conn,$aid,$mnth);
}

if (isset($_POST['give_loan'])){
	$cid = $_POST["inputcid"];
	$eid = $_POST["inputeid"];
	$amount = $_POST["inputamount"];
    if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
	if(check_cid($eid) !== true){
        exit("Wrong eid value");
    }
	if(check_cid($amount) !== true){
        exit("Wrong amount value");
    }
    $result = give_loan($conn,$cid,$eid,$amount);
}

// Analyst page methods


// 1
//'Get the informations of customers who have made transactions more than 5 in a day.'

1 gün içerisinde x ten fazla transaction yapan müşterileri getir:

SELECT T_Date, C_ID , C_NAME
FROM Transactions T, Customers C, Accounts A
WHERE T.Sending_ID = A.A_ID AND C.C_ID = A.C_ID 
GROUP BY T_Date
HAVING COUNT(*) > X

if (isset($_POST['transaction_advanced'])){
	$cid = $_POST["inputcid"];
	$eid = $_POST["inputeid"];
	$amount = $_POST["inputamount"];
    if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
	if(check_cid($eid) !== true){
        exit("Wrong eid value");
    }
	if(check_cid($amount) !== true){
        exit("Wrong amount value");
    }
    $result = shw_high_freq_customers($conn);
}


// 2. 'For each employee get the number of customers that have been contacted and average loan amount that has been given to this customers'

Her bir loan veren employee için kaç müşteriyle iletişim kurduğunu ve average loan amountunu getir. VALİDASYON TAMAM

SELECT emp_id, COUNT(DISTINCT C_ID) AS Customers, AVG(loan_amount) AS AvgLoan
FROM loan
GROUP BY emp_id;

if (isset($_POST['loan_advanced'])){
	$cid = $_POST["inputcid"];
	$eid = $_POST["inputeid"];
	$amount = $_POST["inputamount"];
    if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
	if(check_cid($eid) !== true){
        exit("Wrong eid value");
    }
	if(check_cid($amount) !== true){
        exit("Wrong amount value");
    }
    $result = shw_loaning_metrics($conn);
}


// 3.Show the customer names that holds asset X more than 20'



Asset X elinde bulunduran ve y Amount’dan yüksek olan müşterilerin isimlerini göster.  VALİDASYON TAMAM

SELECT C_name
FROM customer, accountassets, accounts
WHERE Asset_ID="inputassetid" and amount>"A" and accountassets.A_ID=accounts.A_ID and accounts.C_ID=customer.C_ID
ORDER BY amount ASC;

if (isset($_POST['asset_advanced'])){
	$cid = $_POST["inputcid"];
	$eid = $_POST["inputeid"];
	$amount = $_POST["inputamount"];
    if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
	if(check_cid($eid) !== true){
        exit("Wrong eid value");
    }
	if(check_cid($amount) !== true){
        exit("Wrong amount value");
    }
    $result = shw_asset_metrics($conn);
}

// 4.Show the first ten customers that have credit score more than X


Kredi skoru K dan yüksek olan müşterilerden loan u en yüksek 10 adet kişiyi getir EMRE K
Insitutional Customer K yerine 730 yazdım değiştirilebilir.

Select c.C_name as CustomerName, c.credit_score
from customer as c, insitutional_c as i 
where c.credit_score > 730 AND c.C_ID = i.cust_id
Order by c.credit_score desc
Limit 10;

if (isset($_POST['credit_advanced'])){
	$cid = $_POST["inputcid"];
	$eid = $_POST["inputeid"];
	$amount = $_POST["inputamount"];
    if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
	if(check_cid($eid) !== true){
        exit("Wrong eid value");
    }
	if(check_cid($amount) !== true){
        exit("Wrong amount value");
    }
    $result = shw_top_customers($conn);
}

// 5. Show the amounts of "Buy" orders in the last 15 days

Total volume of dollar type regular transactions in last 90 days

SELECT SUM(amount) from R_TRANSACTION as R and Transaction as T WHERE
T.transaction_id = R.transaction_id and  Currency = ‘USD’ and datediff(curdate(), t_date) < 91 group by r_type;

if (isset($_POST['inv_advanced'])){
	$cid = $_POST["inputcid"];
	$eid = $_POST["inputeid"];
	$amount = $_POST["inputamount"];
    if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
	if(check_cid($eid) !== true){
        exit("Wrong eid value");
    }
	if(check_cid($amount) !== true){
        exit("Wrong amount value");
    }
    $result = shw_trans_volume($conn);    
}


// 6. Show the id and names of the employees that has given loan to the customers who made transactions through dollar

Name and ID of employees who gave loan for customers who made USD type transfer
Select Distinct emp_id and name from Employee where
emp_id in (Select emp_id from Loan where c_id in 
(Select c_id from Customer as C, Account as A, Checking_Account as Check, Transaction as T, R_transaction as R where
C.c_id = A.c_id and A.a_id = Check.a_id and Check.a_id = T.sending_id and T.transaction_id = R.transaction_id where r_type = ‘Transfer’ and currency = ‘USD’));

if (isset($_POST['emp_advanced'])){
	$cid = $_POST["inputcid"];
	$eid = $_POST["inputeid"];
	$amount = $_POST["inputamount"];
    if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
	if(check_cid($eid) !== true){
        exit("Wrong eid value");
    }
	if(check_cid($amount) !== true){
        exit("Wrong amount value");
    }
    $result = shw_usd_cust_loan_metrics($conn);
}





