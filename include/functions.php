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
		<table border='1'><tr><th>A_ID</th><th>C_ID</th><th>Lim</th><th>Old_debt</th><th>Interest_rate</th><th>Fee</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["A_ID"]. "</td><td>". $row["C_ID"]. "</td><td>" . $row["Lim"].  "</td><td>" . $row["Old_debt"]. "</td><td>" . $row["Interest_rate"]."</td><td>" . $row["Fee"]. "</td></tr>";
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
		<table border='1'><tr><th>A_ID</th><th>C_ID</th><th>Transaction_ID</th><th>T_Date</th><th>Reciving_ID</th><th>Sending_ID</th><th>Explanation</th><th>Asset_ID</th>><th>Count</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["A_ID"]. "</td><td>". $row["C_ID"]. "</td><td>". $row["Transaction_ID"]. "</td><td>". $row["T_Date"]. "</td><td>" . $row["Reciving_ID"]. "</td><td>" . $row["Sending_ID"]."</td><td>" . $row["Explanation"]."</td><td>" . $row["Asset_ID"]."</td><td>" . $row["Count"]."</td></tr>";
		}
		echo "</table>";
	}
}

function give_loan($conn,$cid,$eid,$amount){
    $sql = "SELECT 11*credit_score+11*years_of_credit_hist+1.5*income FROM customer WHERE c_id='$cid'";
	$result = $conn->query($sql);
	$result->data_seek(0);
	$row = $result->fetch_row();
	$maxloan = $row[0];
	if($maxloan > $amount){
		$sql = "INSERT INTO Loan(emp_id, c_id, loan_amount) VALUES('$eid','$cid','$amount')";
		$result = $conn->query($sql);
    }
	else {
		echo "Can't give that much loan.";
	}
}


// Functions for the analyst part



// 1
//'Get the informations of customers who have made transactions more than 5 in a day.'
//1 gün içerisinde x ten fazla transaction yapan müşterileri getir:

function shw_high_freq_customers($conn){
    $sql = "SELECT T_Date, C_ID , C_NAME
	FROM Transactions T, Customers C, Accounts A
	WHERE T.Sending_ID = A.A_ID AND C.C_ID = A.C_ID 
	GROUP BY T_Date
	HAVING COUNT(*) > 5"; // 5 can be replaced by X

	$result = $conn->query($sql);

	if (mysqli_num_rows($result)!==0){
		echo "High frequency traders";
		echo "<br>
		<table border='1'><tr><th>Date</th>	<th>ID</th> <th>Name</th>	</tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["T_Date"]. "</td><td>". $row["C_ID"]."</td><td>". $row["C_NAME"]. "</td></tr>";

		echo "</table>";
	}
}


// 2. 'For each employee get the number of customers that have been contacted and average loan amount that has been given to this customers'
//Her bir loan veren employee için kaç müşteriyle iletişim kurduğunu ve average loan amountunu getir. VALİDASYON TAMAM

function shw_loaning_metrics($conn){
    $sql = "SELECT emp_id, COUNT(DISTINCT C_ID) AS Customers, AVG(loan_amount) AS AvgLoan
	FROM loan
	GROUP BY emp_id;";
	$result = $conn->query($sql);

	if (mysqli_num_rows($result)!==0){
		echo "Loaning Performance";
		echo "<br>
		<table border='1'><tr><th>ID</th>	<th>#Loan given</th> <th>AVG Loan Given</th>	</tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["emp_id"]. "</td><td>". $row["Customers"]."</td><td>". $row["loan_amount"]. "</td></tr>";

		echo "</table>";
	}
}



// 3.Show the customer names that holds asset X more than 20'
//Asset X elinde bulunduran ve y Amount’dan yüksek olan müşterilerin isimlerini göster.  VALİDASYON TAMAM



function shw_asset_metrics($conn){
    $sql = "SELECT C_name, A_code, amount 
	FROM customer, accountassets, accounts, assets
	WHERE amount > 50 and accountassets.A_ID = accounts.A_ID and accounts.C_ID=customer.C_ID and assets.asset_id = accountassets.asset_id
    ORDER BY amount desc"; // Asset_ID="inputassetid" and amount>A can be parametrized
	$result = $conn->query($sql);

	if (mysqli_num_rows($result)!==0){
		echo "More than 50 unit asset holders";
		echo "<br>
		<table border='1'><tr><th>Customer Name</th><th>Asset Code</th><th>Amount</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["C_name"]. "</td><td>". $row["A_code"]. "</td><td>".$row["amount"]. "</td></tr>";
		}
		echo "</table>";
	}
}


// 4.Show the first ten customers that have credit score more than X
//Kredi skoru K dan yüksek olan müşterilerden loan u en yüksek 10 adet kişiyi getir 
// K yerine 730 yazdım değiştirilebilir.




function shw_top_customers($conn){
    $sql = "Select c.C_name as CustomerName, c.credit_score
	from customer as c, insitutional_c as i 
	where c.credit_score > 730 AND c.C_ID = i.cust_id
	Order by c.credit_score desc
	Limit 10";
	$result = $conn->query($sql);

	if (mysqli_num_rows($result)!==0){
		echo "Top 10 Institutional Customer";
		echo "<br>
		<table border='1'><tr><th>Company Name</th><th>Credit Score</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["CustomerName"]. "</td><td>". $row["credit_score"]. "</td></tr>";
		}
		echo "</table>";
	}
}

// 5. Show the amounts of "Buy" orders in the last 15 days
//Total volume of dollar type regular transactions in last 5 years days



function shw_trans_volume($conn){
    
	$sql = "SELECT r_type,SUM(amount)/1000000 as total_volume from R_TRANSACTION as R, transactions as T WHERE
	T.transaction_id = R.transaction_id and  Currency = 'USD'  and t_date BETWEEN DATE_SUB(NOW(), INTERVAL 5*365 DAY) AND NOW() group by r_type;";
	
	$result = $conn->query($sql);

	if (mysqli_num_rows($result)!==0){
		echo "Total volume of dollar transactions in last 5 years in millions";
		echo "<br>
		<table border='1'><tr><th>Type of Transaction</th><th>Amount(millions)</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["r_type"]. "</td><td>". $row["total_volume"]. "</td></tr>";
		}
		echo "</table>";
	}
}


// 6. Show the id and names of the employees that has given loan to the customers who made transactions through dollar
//Name and ID of employees who gave loan for customers who made USD type transfer


function shw_usd_cust_loan_metrics($conn){
    $sql = "SELECT DISTINCT E.emp_id, salary, E.perfscore from Employee as E, Customer as C, Accounts as A,Loan, Checking_Account as CH, Transactions as T, R_transaction as R where Loan.c_id = C.c_id and E.emp_id = Loan.emp_id and
	C.c_id = A.c_id and A.a_id = CH.a_id and CH.a_id = T.sending_id and T.transaction_id = R.transaction_id and r_type = 'Transfer' and R.currency = 'USD'";

	$result = $conn->query($sql);


	if (mysqli_num_rows($result)!==0){
		echo "Information about employees who gave loan for customers who made USD type transfer";
		echo "<br>
		<table border='1'><tr><th>ID</th>	<th>Salary</th> <th>Performance score</th>	</tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["emp_id"]. "</td><td>". $row["salary"]."</td><td>". $row["perfscore"]. "</td></tr>";
		}
		echo "</table>";
	}
}