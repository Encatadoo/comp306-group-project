<html>
<head>
<link rel="stylesheet" href="modif.css">
</head>
<body>

    <!--Insert operation -->

    <h1 style = "font-size: 60px; text-decoration: underline">Sales</h1>
    <h2 style = "font-size: 30px; position: relative; top: -30px">Customers</h2>

<div id = "sales_first_form">
    <form action='result.php' method='post'>
        <label>C_ID:         </label><input type='number' name='inputcid' /><br/>
        <input class= "modif", name="show_customer", value='Get customer informations' type='submit'/>
        <input class= "modif", name="show_customer_accounts", value='Get account infomration of the customer' type='submit'/></br>
        <input id= "sales_credit", name="show_customer_suggestedcredit", value='Find the suggested credit amount and interest rate' type='submit'/></p>
        <input class= "modif", name="show_customer_credit", value='Get the amount of credit that will be given' type='submit'/></p>
    </form>
    <hr>
</div>
    <h2 style = "font-size: 30px; position: relative; top: -30px">Transcation</h2>
    <!--Remove operation -->
    <form id = "sales_second_form", action='result.php' method='post'>
        <label>A_ID:  </label><input type='number' name='inputaid' />
        <label>Month(1-12):  </label><input type='text' name='inputmonth' /></br>
        <input class="modif" name="show_transactions", value='Show the all transaction made in that month' type='submit'/></p>
    </form>
    <hr>

    <!-- Manipulation operation -->
    <form id = "sales_third_form", action='result.php' method='post'>
	<label>C_ID:         </label><input type='number' name='inputcid' /><br/>
    <label>E_ID:         </label><input type='number' name='inputeid' /><br/>
    <label>Amount:  </label><input type='number' name='inputamount' />
    <input style = "position: relative; left: 10px", name="give_loan", value='Give Loan' type='submit'/></p>
    </form>
    <hr>



</body>
</html>