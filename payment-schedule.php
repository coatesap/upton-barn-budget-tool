<?
//die();
error_reporting(0);

// debugging
$wedding_date = (!isset($_POST['wedding-date-to-pass']) || empty($_POST['wedding-date-to-pass']) || $_POST['wedding-date-to-pass'] === 'NO DATE SELECTED') ? '15th April 2025' : $_POST['wedding-date-to-pass'];
$wedding_date_for_js = strtotime($wedding_date);
$wedding_date_for_js = date("m/d/Y", $wedding_date_for_js);
$total = (!isset($_POST['total-to-pass']) || empty($_POST['total-to-pass'])) ? '4550.00' : $_POST['total-to-pass'];
//$totalHireItems = (!isset($_POST['total-hire-items-to-pass']) || empty($_POST['total-hire-items-to-pass'])) ? '170.00' : $_POST['total-hire-items-to-pass'];

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Upton Barn Budget Planner</title>
<!-- Zoho Marketing Automation tracking code -->
<script src="https://cdn-eu.pagesense.io/js/20098495049/0b33dddfe8884eac897b25d69f073de4.js"></script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5BCNX535');</script>
<!-- End Google Tag Manager -->


<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="includes/styles.css" rel="stylesheet">



<style>

.container{
	width: unset;
    padding: 20px;
    background: #fff;
}

#right-col, #book-but{display:none}




@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
	#right-col{
	display:block;
	position: absolute;
		top:300px;
		right:0;
		width:40%;
	}
	#print-text .col-md-6{
		width:60%;
	}
	#right-col h2 button, #right-col-contents #pass_to_payment_schedule_form button{display:none}
}




#right-col-contents{margin-top:20px !important}
</style>

</head>

<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5BCNX535" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->




<div id="QuoteTool" class="container">


<div id="print-header">
<p style="text-align:center"><img src="//www.uptonbarn.com/quote-snapshot/images/print-logo.png" style="width:300px;margin-top:50px"></p>
<h1>Upton Barn Budget Snapshot</h1>
</div>


<div id="print-text">
<div class="col-md-6">
    <p>We thank you for taking the time to create your personalised Budget Plan. Please save this to bring along to any subsquent meetings at Upton Barn or with your chosen caterer.</p>
    <? // <p>This quote is valid for 30 days from <span id="print-date"></span>.</p> ?>
    <p>This budget tool is for illustrative purposes only.<br>
All prices are inclusive of VAT.  Please note our prices and products may change from time to time in line with supplier availability.</p>
    <p>We look forward to meeting with you at Upton Barn.</p>
    <p>To book a viewing please visit: http://www.uptonbarn.com/book-a-viewing/</p>
</div>
</div>

<!--<div id="debug" style="font-weight:bold;font-size:30px">£</div> -->

<div class="row" id="contents-container"> 

<div class="col-sm-12" id="left-col"> 
  <form role="form" action="" method="post" id="quote_form">
     <? include 'step5.php' ?>
  </form>

           

<sup><br><br>This budget tool is for indicative purposes only. All prices are inclusive of VAT. Please note our prices and products may change from time to time in line with supplier availability</sup>
  
</div>

<div class="col-sm-3" id="right-col">
	<?php
	if (isset($_POST['html_chunk'])) {
		$html_chunk = $_POST['html_chunk'];
		echo $html_chunk;
	}
	?>
</div>


<!-- end of row  -->
</div>




<div id="print-footer">
<p>UPTON BARN AND WALLED GARDEN<br>
Upton Farm, Cullompton, Devon, EX15 1RA<br>
info@uptonbarn.com - T: 01884 38302</p>


<div class="pagebreak"> </div>
<h3>Payment schedule</h3>
<p>Event date = <span class="wedding-date"></span><br>
<b>Total payable = £<span class="ps-full-total"></span></b><br>
</p>
			
<p style="margin-top:20px"><u>Deposit</u><br>
<b>Total payable - £500<br>
Date due – <span class="ps-deposit-due-date"></span></b></p>

<p style="margin-top:20px"><u>1st instalment</u><br>
50% of the remaining venue hire balance - £<span class="ps-first-total"></span><br>
<b>Total payable - £<span class="ps-first-total"></span><br>
Date due – <span class="ps-first-due-date"></span></b></p>

<p style="margin-top:20px"><u>2nd instalment</u><br>
Remaining Venue hire balance - £<span class="ps-venue-balance"></span><br>
<!--The Paddock – £<span class="ps-paddocks"></span>-->
<div style="border-top: 1px dashed #ccc;display:inline-block;padding-top:10px"><b>Total payable - £<span class="ps-second-total"></span></div><br>
Date due – <span class="ps-second-due-date"></span></b></p>

<p style="margin-top:20px"><u>Final balance</u><br>
Drinks - £<span class="ps-drinks"></span><br>
<!--Hire items - £<span class="ps-hire"></span><br>-->
Accommodation (sleeps up to 14) - £900
<div style="border-top: 1px dashed #ccc;display:inline-block;padding-top:10px"><b>Final balance payable - £<span class="ps-total-payable"></span></div><br>
Date due – <span class="ps-final-due-date"></span></b></p>


<p>
<b>Damage deposit payable - £1000<br>
Date due – <span class="ps-final-due-date"></span></b><br>
<span style="font-size:12px">*Refunded after wedding date so not included in payment schedule sum above</span>
</p>



<p style="margin-top:20px"><u>Food</u><br>
Food – £<span class="ps-food"></span> - <i>The payment schedule & terms relating to your food are subject to a separate agreement with your chosen caterer and will paid to them directly.</i></p>

   
</div>


<!-- end of container  -->
</div>

<div id="spacer"></div>


<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function () {
		
	// PAYMENT SCHEDULE
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0');
	var yyyy = today.getFullYear();
	today = dd + '/' + mm + '/' + yyyy;
			
	var deposit_due = mm + '/' + dd + '/' + yyyy; 
	deposit_due = new Date(deposit_due); 
	deposit_due.setDate(deposit_due.getDate() + 7) // 7 days after the quote generated date
	var dd = String(deposit_due.getDate()).padStart(2, '0');
	var mm = String(deposit_due.getMonth() + 1).padStart(2, '0');
	var yyyy = deposit_due.getFullYear();
	deposit_due = dd + '/' + mm + '/' + yyyy;
	
	
	var first_due = mm + '/' + dd + '/' + yyyy; 
	first_due = new Date(first_due); 
	first_due.setDate(first_due.getDate() + 112) // 16 weeks after deposit_due date
	var dd = String(first_due.getDate()).padStart(2, '0');
	var mm = String(first_due.getMonth() + 1).padStart(2, '0');
	var yyyy = first_due.getFullYear();
	first_due = dd + '/' + mm + '/' + yyyy;
	
		
	
	var wedding_date = new Date('<?=$wedding_date_for_js?>')
	wedding_date.setDate(wedding_date.getDate())
	var dd = String(wedding_date.getDate()).padStart(2, '0');
	var mm = String(wedding_date.getMonth() + 1).padStart(2, '0');
	var yyyy = wedding_date.getFullYear();
	wedding_date = dd + '/' + mm + '/' + yyyy;
	
	var second_due = new Date('<?=$wedding_date_for_js?>')
	second_due.setDate(second_due.getDate() - 56) // 8 weeks prior to the selected wedding date
	var dd = String(second_due.getDate()).padStart(2, '0');
	var mm = String(second_due.getMonth() + 1).padStart(2, '0');
	var yyyy = second_due.getFullYear();
	second_due = dd + '/' + mm + '/' + yyyy;
	
	var final_due = new Date('<?=$wedding_date_for_js?>')
	final_due.setDate(final_due.getDate() - 14) // 2 weeks prior to the selected wedding date
	var dd = String(final_due.getDate()).padStart(2, '0');
	var mm = String(final_due.getMonth() + 1).padStart(2, '0');
	var yyyy = final_due.getFullYear();
	final_due = dd + '/' + mm + '/' + yyyy;
	
	
	$(".wedding-date").text(wedding_date)
	$(".ps-full-total").text(<?=$total?>)
	$(".ps-deposit-due-date").text(deposit_due)
	$(".ps-first-due-date").text(first_due)
	$(".ps-second-due-date").text(second_due)
	$(".ps-final-due-date").text(final_due)

	// backup 22 Aug 2025
	//var firstpayable = parseFloat(($("#venue_price").text().replace('£', '') - 500) / 2).toFixed(2)
	// /backup 22 Aug 2025
	var venue = parseFloat($("#venue_price").text().replace('£', '')) || 0;
	var ceremony = parseFloat($("#ceremonyAmount").text().replace('£', '')) || 0;
	var getReady = parseFloat($("#totalGetReady").text().replace('£', '')) || 0;
	var firstpayable = (
	  ((venue - 500) / 2) + (ceremony / 2) + (getReady / 2)
	).toFixed(2);

	
	
	
	$(".ps-first-total").text(firstpayable)
	$(".ps-venue-balance").text(firstpayable)
	
	
	var paddocks = parseInt(($("#totalGetReady").text().replace('£', '')))
	//$(".ps-paddocks").text(paddocks)
	firstpayable = parseFloat(firstpayable)
	paddocks = parseFloat(paddocks)
	// backup 22 Aug 2025
	//var secondpayable = parseFloat(firstpayable + paddocks).toFixed(2)
	// /backup 22 Aug 2025
	var secondpayable = parseFloat(firstpayable).toFixed(2)
	
	$(".ps-second-total").text(secondpayable)
	
	var drinks = parseFloat($("#totalDrink").text().replace('£', '')).toFixed(2)
	$(".ps-drinks").text(drinks)
	
	//var hireitems = <?=$totalHireItems?>
	
	//$(".ps-hire").text(hireitems)
	
	
	//var damageDeposit = parseInt(1000.00)
	var scandi = parseInt(900.00)
	//var total = parseFloat(parseFloat(drinks) + parseFloat(hireitems) + parseFloat(damageDeposit) + parseFloat(scandi))
	//var total = parseFloat(parseFloat(drinks) + parseFloat(damageDeposit) + parseFloat(scandi))
	var total = parseFloat(parseFloat(drinks) + parseFloat(scandi))
	var totalpayable = parseFloat(total).toFixed(2)
	$(".ps-total-payable").text(totalpayable)
	
	var food = parseFloat($("#totalFood").text().replace('£', '')).toFixed(2)
	$(".ps-food").text(food)
	
	// /PAYMENT SCHEDULE

			
})
 
	

	

$(document).ready(function(e) {
		 var date = new Date();
		 $('#print-date').html(date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear())
		 
		 $('#print-quote-but').click(function(){
						 window.print();
            });		
	
});


</script>

</body>
</html>
