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