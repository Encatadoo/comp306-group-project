<!--
    COMP306-

-->
<html>
<head><title>Salesman</title></head>
<body>
<h1>Salesman</h1>

	<form action='result.php' method='post'>
        <input name="show", value='Bütün müşterileri göster' type='submit'/></p>
    </form>
    <hr>
	
	<form action='result.php' method='post'>
        <label>CID:         </label><input type='number' name='inputcid' /><br/>
        <input name="show_customer", value='Müşteri bilgilerini göster' type='submit'/></p>
		<input name="show_customer_accounts", value='Müşteri hesaplarını göster' type='submit'/></p>
		<input name="show_customer_suggestedcredit", value='Tavsiye edilen kredi ve interest' type='submit'/></p>
		<input name="show_customer_credit", value='Verilebilecek kredi miktarı' type='submit'/></p>
    </form>
    <hr>
	
	<form action='result.php' method='post'>
		<label>AID:         </label><input type='number' name='inputaid' /><br/>
		<label>Month (1-12):         </label><input type='number' name='inputmonth' /><br/>
		<input name="show_transactions", value='Hesap özeti' type='submit'/></p>
    </form>
    <hr>


</body>
</html>