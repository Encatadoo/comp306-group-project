<html>
<head>
<link rel="stylesheet" href="modif.css">
</head>
<body>

    <!--Insert operation -->

    <h1 style = "font-size: 60px; text-decoration: underline">Customer</h1>
    <h2 style = "font-size: 30px; position: relative; top: -30px">Transfer</h2>

<div id = "customer_first_form">
    <form action='result.php' method='post'>
        <label>From_AID:         </label><input type='number' name='from_aid' />
        <label>To_AID:         </label><input type='number' name='to_aid' />
        <label>Amount:         </label><input type='number' name='transfer_amount' /></br>

        <input class= "modif", name="transfer", value='Transfer money' type='submit'/>
    </form>
    <hr>
</div>
    <h2 style = "font-size: 30px; position: relative; top: -30px">Investment</h2>
    <!--Remove operation -->
    <form id = "customer_second_form", action='result.php' method='post'>
        <label>Asset_ID:  </label><input type='number' name='asset_id' />
        <label>From_AID:  </label><input type='number' name='inv_from_id' /></br>
        <label>Amount:  </label><input type='number' name='asset_amount' />
        <label>To_ID:  </label><input type='number' name='inv_to_id' /></br>
        <input class="modif" name="asset_trans", value='Asset transaction' type='submit'/>
        <input class="modif" name="asset_info", value='Show asset information' type='submit'/></p>

    </form>
    <hr>
    <h2 style = "font-size: 30px; position: relative">ATM</h2>
    <!-- Manipulation operation -->
    <form id = "customer_third_form", action='result.php' method='post'>
    <label>AID:  </label><input type='number' name='aid' />
    <label>Amount:  </label><input type='number' name='deposit_amount' /></br>
    <input class = 'modif', name="deposition", value='Deposit' type='submit'/>
    <input class = 'modif', name="withdrawal", value='Withdraw' type='submit'/></p>
    </form>
    <hr>



</body>
</html>