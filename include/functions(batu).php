<?php


function check_cid($cid){
    return is_numeric($cid);
}

function show_customers($conn){
    $sql = "SELECT * FROM customer";
	$result = $conn->query($sql);
	echo "<br><table border='1'><tr><th>C_ID</th><th>C_name</th><th>income</th><th>years_of_credit_hist</th><th>credit_score</th></tr>";
	while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $row["C_ID"]. "</td><td>". $row["C_name"]. "</td><td>" . $row["income"].  "</td><td>" . $row["years_of_credit_hist"]. "</td><td>" . $row["credit_score"]."</td></tr>";
    }
	echo "</table>";
}

function show_customer($conn,$cid){
    $sql = "SELECT * FROM customer WHERE C_ID='$cid'";
	$result = $conn->query($sql);
	echo "<br>
    <table border='1'><tr><th>C_ID</th><th>C_name</th><th>income</th><th>years_of_credit_hist</th><th>credit_score</th></tr>";
	while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $row["C_ID"]. "</td><td>". $row["C_name"]. "</td><td>" . $row["income"].  "</td><td>" . $row["years_of_credit_hist"]. "</td><td>" . $row["credit_score"]."</td></tr>";
    }
	echo "</table>";
}

function show_customer_accounts($conn,$cid){
	$sql = "SELECT * FROM accounts NATURAL JOIN Checking_account WHERE C_ID='$cid'";
	$result = $conn->query($sql);
	if (mysqli_num_rows($result)!==0){
		echo "Checking accounts";
		echo "<br>
		<table border='1'><tr><th>A_ID</th><th>C_ID</th><th>Currency</th><th>Balance</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["A_ID"]. "</td><td>". $row["C_ID"]. "</td><td>" . $row["Currency"]. "</td><td>" . $row["Balance"]."</td></tr>";
		}
		echo "</table>";
	}
    $sql = "SELECT * FROM accounts NATURAL JOIN Credit_account WHERE C_ID='$cid'";
	$result = $conn->query($sql);
	if (mysqli_num_rows($result)!==0){
		echo "Credit accounts";
		echo "<br>
		<table border='1'><tr><th>A_ID</th><th>C_ID</th><th>Lim</th><th>Old_debt</th><th>Current_debt</th><th>Interest_rate</th><th>Fee</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["A_ID"]. "</td><td>". $row["C_ID"]. "</td><td>" . $row["Lim"].  "</td><td>" . $row["Old_debt"]. "</td><td>" . $row["Current_debt"]. "</td><td>" . $row["Interest_rate"]."</td><td>" . $row["Fee"]. "</td></tr>";
		}
		echo "</table>";
	}
	$sql = "SELECT * FROM accounts NATURAL JOIN Investment_account WHERE C_ID='$cid'";
	$result = $conn->query($sql);
	if (mysqli_num_rows($result)!==0){
		echo "Investment accounts";
		echo "<br>
		<table border='1'><tr><th>A_ID</th><th>C_ID</th><th>Balance</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["A_ID"]. "</td><td>". $row["C_ID"]. "</td><td>" . $row["Balance"].  "</td></tr>";
		}
		echo "</table>";
	}
	$sql = "SELECT * FROM accounts NATURAL JOIN Saving_account WHERE C_ID='$cid'";
	$result = $conn->query($sql);
	if (mysqli_num_rows($result)!==0){
		echo "Saving accounts";
		echo "<br>
		<table border='1'><tr><th>A_ID</th><th>C_ID</th><th>Interest_rate</th><th>Balance</th><th>Currency</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["A_ID"]. "</td><td>". $row["C_ID"]. "</td><td>" . $row["Interest_rate"].  "</td><td>" . $row["Balance"]. "</td><td>" . $row["Currency"]."</td></tr>";
		}
		echo "</table>";
	}
}

function show_customer_suggestedcredit($conn,$cid){
    $sql = "SELECT c_name, c_id, 7*credit_score+7*years_of_credit_hist+1.1*income as \"tavsiye kredi\", 0.05*credit_score/years_of_credit_hist as \"tavsiye rate\" FROM customer WHERE c_id='$cid'";
	$result = $conn->query($sql);
	echo "<br>
    <table border='1'><tr><th>C_name</th><th>C_ID</th><th>kredi</th><th>rate</th></tr>";
	while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $row["c_name"]. "</td><td>". $row["c_id"]. "</td><td>" . $row["tavsiye kredi"].  "</td><td>" . $row["tavsiye rate"]. "</td></tr>";
    }
	echo "</table>";
}

function show_customer_credit($conn,$cid){
    $sql = "SELECT c_name, c_id, 11*credit_score+11*years_of_credit_hist+1.5*income as \"kredi\" FROM customer WHERE c_id='$cid'";
	$result = $conn->query($sql);
	echo "<br>
    <table border='1'><tr><th>C_name</th><th>C_ID</th><th>kredi</th></tr>";
	while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $row["c_name"]. "</td><td>". $row["c_id"]. "</td><td>" . $row["kredi"].  "</td></tr>";
    }
	echo "</table>";
}

function show_transactions($conn,$aid,$mnth){
	$sql = "SELECT * FROM accounts, Transactions NATURAL JOIN R_transaction WHERE accounts.A_ID='$aid' and (accounts.A_ID=transactions.Reciving_ID or accounts.A_ID=transactions.Sending_ID) and Month(Transactions.T_Date)='$mnth'";
	$result = $conn->query($sql);
	if (mysqli_num_rows($result)!==0){
		echo "Regular Transactions";
		echo "<br>
		<table border='1'><tr><th>A_ID</th><th>C_ID</th><th>Transaction_ID</th><th>T_Date</th><th>Reciving_ID</th><th>Sending_ID</th><th>Explanation</th><th>R_Type</th>><th>Amount</th><th>Currency</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["A_ID"]. "</td><td>". $row["C_ID"]. "</td><td>". $row["Transaction_ID"]. "</td><td>". $row["T_Date"]. "</td><td>" . $row["Reciving_ID"]. "</td><td>" . $row["Sending_ID"]."</td><td>" . $row["Explanation"]."</td><td>" . $row["T_Type"]."</td><td>" . $row["Asset_ID"]."</td><td>" . $row["Count"]."</td></tr>";
		}
		echo "</table>";
	}
    $sql = "SELECT * FROM accounts, Transactions NATURAL JOIN T_transaction WHERE accounts.A_ID='$aid' and (accounts.A_ID=transactions.Reciving_ID or accounts.A_ID=transactions.Sending_ID) and Month(Transactions.T_Date)='$mnth'";
	$result = $conn->query($sql);
	if (mysqli_num_rows($result)!==0){
		echo "Tradable Transactions";
		echo "<br>
		<table border='1'><tr><th>A_ID</th><th>C_ID</th><th>Transaction_ID</th><th>T_Date</th><th>Reciving_ID</th><th>Sending_ID</th><th>Explanation</th><th>R_Type</th>><th>Amount</th><th>Currency</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["A_ID"]. "</td><td>". $row["C_ID"]. "</td><td>". $row["Transaction_ID"]. "</td><td>". $row["T_Date"]. "</td><td>" . $row["Reciving_ID"]. "</td><td>" . $row["Sending_ID"]."</td><td>" . $row["Explanation"]."</td><td>" . $row["T_Type"]."</td><td>" . $row["Asset_ID"]."</td><td>" . $row["Count"]."</td></tr>";
		}
		echo "</table>";
	}
}