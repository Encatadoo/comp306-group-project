<html>
<head>
<link rel="stylesheet" href="modif.css">
</head>
<body>

    <!--Insert operation -->

    <h1 style = "font-size: 60px; text-decoration: underline">Anlayst</h1>
    <h2 style = "font-size: 30px; position: relative">Advanced queries</h2>

<div id = "analyst_first_form">
    <form action='result.php' method='post'>
        <input class = "modif" name="transaction_advanced", value='Get the informations of customers 
who have made transactions more than 5 in a day.' type='submit'/></br>
        <input id= "modif2", name="loan_advanced", value='For each employee get the number of customers 
that have been contacted and average loan amount that has been given to this customers' type='submit'/></br>
        <input id= "modif3", name="asset_advanced", value='Show the customer names that holds asset X more than 20' type='submit'/></br>
        <input id= "modif4", name="credit_advanced", value='Show the first ten customers that have credit score more than X' type='submit'/></br>
        <input id= "modif5", name="inv_advanced", value='Show the amounts of "Buy" orders in the last 15 days.' type='submit'/></br>
        <input id= "modif6", name="emp_advanced", value='Show the id and names of the employees that has given loan to the 
customers who made transactions through dollar' type='submit'/></p>

    </form>
</div>


</body>
</html>