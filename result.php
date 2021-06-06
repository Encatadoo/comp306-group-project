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

if (isset($_POST['transaction_advanced'])){
    $result = shw_high_freq_customers($conn);
}


// 2. 'For each employee get the number of customers that have been contacted and average loan amount that has been given to this customers'

if (isset($_POST['loan_advanced'])){
    $result = shw_loaning_metrics($conn);
}


// 3.Show the customer names that holds asset X more than 20'

if (isset($_POST['asset_advanced'])){
    $result = shw_asset_metrics($conn);
}

// 4.Show the first ten customers that have credit score more than X

if (isset($_POST['credit_advanced'])){
    $result = shw_top_customers($conn);
}

// 5. Total volume of dollar type regular transactions in last 90 days

if (isset($_POST['inv_advanced'])){
    $result = shw_trans_volume($conn);    
}


// 6. Show the id and names of the employees that has given loan to the customers who made transactions through dollar
if (isset($_POST['emp_advanced'])){
    $result = shw_usd_cust_loan_metrics($conn);
}





