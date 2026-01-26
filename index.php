<?php

//die();
error_reporting(0);
//include "includes/dbconn.php";

if($_REQUEST['date']){
	$wedding_date_raw = $_REQUEST['date'];
	// Format ISO date (YYYY-MM-DD) to friendly format (e.g., "3rd March 2026")
	$wedding_date = date('jS F Y', strtotime($wedding_date_raw));
}else{
	$wedding_date = "NO DATE SELECTED";
	//$wedding_date = "2nd March 2026"; // monday
	$wedding_date = "3rd March 2026"; // tuesday (midweek)
	//$wedding_date = "7th March 2026"; // saturday
}
 

// discount for midweek (as a percentage)
// get day name
$wedding_day = $wedding_date;
$nameOfDay = date('D', strtotime($wedding_day));
/* 27-dec-2025
$midweek_discount = 0;
// $nameOfDay == "Mon" || 
 
if($nameOfDay == "Tue" || $nameOfDay == "Wed" || $nameOfDay == "Thu"){
	$midweek_discount = -10;
}
*/

// get wedding year to specify food price increases
$wedding_year = date('Y', strtotime($wedding_day));



if($_REQUEST['price']){
	$venue_price = $_REQUEST['price'];
}else{
	$venue_price = 3000.00;
}

//die($wedding_date );
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
/* dev purposes
#step-1{display:none !important}
#step-3, #display-drink-list, #drink, #drink-total{display:block !important}
 */


/* disable floating right panel
#right-col #right-col-contents{
  position: absolute;
  top: 0;
}
*/
.alert-success {
    color: #fff;
    background-color: #d8a78e;
    border-color: #d8a78e;
}
@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
	#right-col{
	position: absolute;
		top:300px;
		right:0;
	}
	#print-text .col-md-6{
		width:70%;
	}
}
#drink-total{font-weight: bold;}


.tooltip-inner {
    padding: 10px;
	min-width: 150px;
            max-width: 300px;
            white-space: normal;
}
.glyphicon-info-sign{
color: #9a785c;
    font-size: 20px;
}


#pass_to_payment_schedule_form button{
	font-size: 24px;margin: 10px;
}

#editDateModal iframe{
	width:550px;
	height:390px;
}

#paymentscheduleModal iframe{
	width:550px;
	height:400px;
}


#topNotification{
	display: none;
	position: fixed;
	top: 0;
	left: 0;
	right: 0;
	z-index: 1050;
	padding: 20px;
}


#topNotification .alert-message{
    font-size: 18px;
}


.alert-danger {
    color: #fff;
    background-color: #d50a06;
    border-color: #a94442;
}

/* mobile styles */
@media only screen and (max-width : 480px) {

	#right-col-contents #pass_to_payment_schedule_form button{
		font-size: unset;
		width: 100%;
    	margin: 0 0 10px 0;
	}
	#right-col-contents{margin-top:0 !important}
	#editDateModal iframe, #paymentscheduleModal iframe{width:100%}

}
#package-selected {
    white-space: pre-line;
}
</style>

</head>

<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5BCNX535" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="QuoteTool" class="container">

<div class="row" id="header">
<div class="col-md-12">
<div class="col-md-10 page-title">Build Your Budget</div>
<div class="col-md-2">
  <a href="/"><img src="//www.uptonbarn.com/quote-snapshot/images/Upton-Barn-and-Walled-Garden-Icon.png"></a>
  </div>
  </div>
</div>


<div id="print-header">
<p style="text-align:center"><img src="//www.uptonbarn.com/quote-snapshot/images/print-logo.png" style="width:50%;margin-top:50px"></p>
<h1>Upton Barn Snapshot</h1>
</div>


<div id="print-text">
<div class="col-md-6">
    <p>We thank you for taking the time to create your personalised Budget Plan. Please save this to bring along to any subsquent meetings at Upton Barn or with your chosen caterer.</p>
    <?php // <p>This quote is valid for 30 days from <span id="print-date"></span>.</p> ?>
    <p>This budget tool is for illustrative purposes only.<br>
All prices are inclusive of VAT.  Please note our prices and products may change from time to time in line with supplier availability.</p>
    <p>We look forward to meeting with you at Upton Barn.</p>
    <p>To book a viewing please visit: http://www.uptonbarn.com/book-a-viewing/</p>
</div>
</div>

<!--<div id="debug" style="font-weight:bold;font-size:30px">£</div> -->

<div class="row" id="contents-container"> 
<div class="col-sm-9" id="left-col">
<h1>Full Day Wedding</h1>
 <p>Create your bespoke budget for your Wedding at Upton Barn & Walled Garden.</p>
           <p>Check out everything included right <a href="https://www.uptonbarn.com/whatsincluded/" target="_blank">here</a>.</p>


  <form role="form" action="" method="post" id="quote_form">
  
  <div class="row setup-content">
        <div class="col-md-12">
		
		 <div class="form-group">
            <p><strong>Event date: <span class="event_date"><?=$wedding_date ?></span></strong></p>
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editDateModal">Edit Date</button></p>
          </div>
		
		
		
		
		<h2>The Paddock <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="The Paddock is a recent addition to Upton Barn and we just know you're going to fall head over heels for it. This spa-worthy space boasts the most beautiful views (the scenery really is something else here), as well as a relaxing and comfortable environment, styled with Scandi vibes and carefully considered details. The Paddock is available from 7am on your wedding morning until the start of your ceremony"></i></h2>
<p>Add this space for you and your wedding party to enjoy a quick pamper on the morning of your big day.</p>
 <div class="form-group">
            <select class="form-control" id="get-ready-option" name="get-ready-option">
            <option value="">Please select</option>
              <option value="yes" data-price="500">Yes please (£500)</option>
              <option value="no" data-price="0">No thank you</option>
            </select>
          </div>
		  
		  <h2>Ceremony</h2>
		<p>We can host both indoor or outdoor ceremonies for up to 156 people <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Indoor ceremonies are held in our traditional cob barn, The Cider Barn. The handcrafted Oak Arbour in our stunning Walled Garden is perfectly placed for your outdoor ceremony. If you wish to have a ceremony or blessing at Upton Barn & Walled Garden there is a set up fee of £150."></i></p>
		 <div class="form-group">
            <select class="form-control" id="ceremony">
              <option value="yes" data-price="150.00">Yes please (£150)</option>
              <option value="no" data-price="0">No thank you</option>
            </select>
          </div>
		  
		</div>
		</div>
		  
		  
		
  
   <?php include 'food.php' ?>
  
  
  
    <?php //include 'step1.php' ?>
     <?php // include 'step2.php' ?>
     <?php include 'step3.php' ?>
  </form>
 
<form role="form" action="payment-schedule.php" method="post" id="pass_to_payment_schedule_form">
  <input type="hidden" id="wedding-date-to-pass" name="wedding-date-to-pass" value="<?=$wedding_date?>">
   <input type="hidden" id="total-to-pass" name="total-to-pass" value="">

   <!--<input type="hidden" id="total-hire-items-to-pass" name="total-hire-items-to-pass" value="">-->
   <input type="hidden" id="html_chunk" name="html_chunk" value="">
   <div style="text-align:center">
  <button type="button" class="btn btn-primary btn-lg" id="validate-but" type="submit">View payment schedule & print</button> 
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#editDateModal">Edit date</button>
  </div>
</form> 

<sup><br><br>This budget tool is for indicative purposes only. All prices are inclusive of VAT. Please note our prices and products may change from time to time in line with supplier availability</sup>
  
</div>


<div class="col-sm-3" id="right-col">
<div id="right-col-contents">
      <div class="panel panel-default">
        <div class="panel-body">
          <h2>Budget snapshot <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editDateModal" style="float: right;font-family: 'Heebo', sans-serif;">Edit Date</button></h2>
          <div class="subheader">
          	<h3>Guests</h3>
            </div>
            <ul>
            <li>Daytime guests: <span id="adult-guests-total">50</span></li>
            <li>Evening guests: <span id="evening-guests-total">0</span></li>
            <li>Total guests: <span id="guests-total">50</span></li>
            </ul>
          <div class="subheader">
          	<h3>Event details</h3>
          </div>
          <ul>
          	<li>Event Date: <span class="event_date"><?=$wedding_date?></span></li>
			<li>Venue Hire: <span id="venue_price"></span></li>
			<li id="ceremony-list-item">Ceremony at Upton Barn: <span id="ceremonyAmount">£150</span></li>
			<li>Accommodation (sleeps 14): <span id="accommodation">£900</span></li>
            </ul>

			<?php /*
            <div id="food">
          <div class="subheader">
            <h3>Food package</h3>
           </div>
          <ul>
          	<li id="caterer-selected"></li>
            <li><div id="package-selected" style="display:inline"></div> <span id="totalFood">£0</span></li>
            <!--<li style="font-size:12px;line-height: 16px;margin-top: 10px; width: 203px;">--><li id="indicative-note" style="font-size:12px;line-height: 16px;margin-top: 10px; width: 100%">These prices are for indicative purposes. Final costs are subject to an agreement with your chosen caterer.</li>
            <?php if($midweek_discount != 0){echo "<li id='midweek-discount-message'><sup><strong>Midweek discount of 10% applied</strong></sup></li>";} ?>
            </ul>
            </div>
			*/ ?>
			
			
			<div id="food">
          <div class="subheader">
            <h3>Food package</h3>
           </div>
          <ul>
          	<li><strong id="caterer-selected"></strong></li>
			<li id="food-breakdown"></li>
			<li><strong>Total: <span id="totalFood">£0.00</span></strong></li>
            <li id="indicative-note" style="font-size:12px;line-height: 16px;margin-top: 10px; width: 100%">These prices are for indicative purposes. Final costs are subject to an agreement with your chosen caterer.</li>
            </ul>
            </div>
			
			
			
             <div id="drink">
            <div class="subheader">
          		<h3>Drink</h3>
                </div>
                <ul>
				<li id="welcome-drinks"><div style="display:inline">Reception drinks</div> <span id="welcome-drinks-total">£0</span></li>
				<li id="soft-drinks-total-item"><div style="display:inline">Soft drinks</div> <span id="soft-drinks-total">£0</span></li>
                    <li id="optional-extras-item"><div style="display:inline">Optional extras</div> <span id="optional-extras-total">£0</span></li>
                    <li id="wedding-breakfast-total-item"><div style="display:inline">Wedding breakfast</div> <span id="wedding-breakfast-total">£0</span></li>
                    <li id="toast-total-item"><div style="display:inline">Toast</div> <span id="toast-total">£0</span></li>
                    <li id="drink-total"><div style="display:inline;">Drink total:</div> <span id="totalDrink">£0</span></li>
                   <li style="font-size:12px;line-height: 16px;margin-top: 10px; width: 100%;">These prices are for indicative purposes. Products and prices may change in line with supplier availability.</li>
                </ul>
            </div>
            
            
            <div id="get-ready">
            <div class="subheader" style="margin-bottom:10px">
          		<h3>Get ready</h3></div> 
                <ul>
                    <li><div style="display:inline">The Paddock</div> <span id="totalGetReady">£0</span></li>
                  </ul>
                 
            </div>


            <div id="totals">
            	<p>Total: £<span id="total"></span> (inc. VAT)</p>
            </div>
        </div>      
    </div>
    
    <p><a id="book-but" class="btn btn-primary nextBtn btn-lg pull-right" href="http://www.uptonbarn.com/book-a-viewing/" target="_blank"><span></span>Book A Viewing</a></p>
	<p>&nbsp;</p><!--
	<p><a href="#">Nice graphical link to other wedding type budget tool here</a></p>
	<p><a href="#">Nice graphical link to other wedding type budget tool here</a></p>-->
    
   </div> 
</div>


<!-- end of row  -->
</div>



<div class="row" id="footer">
<div class="col-md-12">
<p><a href="/contact-us/" title="Contact us">Contact us</a> | <a href="/book-a-viewing/" title="Book a Viewing">Book a Viewing</a> <!--| <a href="/wedding-availability/">Wedding availability calendar</a>--></p>
	<p>Upton Barn &amp; Walled Garden, Upton Farm, Cullompton, Devon, EX15 1RA. </p>
<p>01884 38302</p>
  </div>
</div>

<!-- end of container  -->
</div>

<div id="spacer"></div>


<div id="editDateModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Try another wedding date</h4>
      </div>
      <div class="modal-body">
        <iframe src="/calendar_new/public/weddingCal.htm" frameborder="0" allowfullscreen scrolling="no" id="calIframe"></iframe>
      </div>
      <div class="modal-footer" style="text-align: center;">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="select-full-day-wedding" disabled>Confirm new date</button>
        <button type="button" class="btn btn-primary" id="select-twilight-wedding" disabled>Select Twilight Wedding</button>
        <button type="button" class="btn btn-primary" id="select-micro-wedding" disabled>Select Micro Wedding</button>
      </div>
    </div>
  </div>
</div>

<!-- Hidden forms for date selection modal -->
<form id="edit-date-full-day-form" action="index.php" method="post" style="display:none;">
    <input type="hidden" name="date" id="edit-date-full-day">
    <input type="hidden" name="price" id="edit-price-full-day">
</form>

<form id="edit-date-twilight-form" action="index.php" method="post" style="display:none;">
    <input type="hidden" name="date" id="edit-date-twilight">
    <input type="hidden" name="price" id="edit-price-twilight">
</form>

<form id="edit-date-micro-form" action="index.php" method="post" style="display:none;">
    <input type="hidden" name="date" id="edit-date-micro">
    <input type="hidden" name="price" id="edit-price-micro">
</form>



<div id="paymentscheduleModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment Schedule</h4>
      </div>
      <div class="modal-body">
        <iframe id="modal-iframe" name="modal-iframe" src="payment-schedule.php" frameborder="0" allowfullscreen scrolling="yes"></iframe>
      </div>
      <div class="modal-footer" style="text-align: center;">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="topNotification" class="alert alert-danger">
  <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <span id="topNotificationMessage"></span>-->
</div>


<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function () {

// Listen for calendar.dateSelected event from iframe via postMessage
var selectedCalendarDate = null;
var selectedFullDayPrice = null;
var selectedTwilightPrice = null;
var selectedMicroPrice = null;

window.addEventListener('message', function(e) {
	if (e.data && e.data.type === 'calendar.dateSelected') {
		selectedCalendarDate = e.data.date;
		selectedFullDayPrice = e.data.fullDayPrice || '';
		selectedTwilightPrice = e.data.twilightPrice || '';
		selectedMicroPrice = e.data.microPrice || '';

		// Enable/disable buttons based on availability
		$('#select-full-day-wedding').prop('disabled', !e.data.isFullDayAvailable);
		$('#select-twilight-wedding').prop('disabled', !e.data.isTwilightAvailable);
		$('#select-micro-wedding').prop('disabled', !e.data.isMicroAvailable);
	}
});

// Button click handlers - submit forms with POST data
$('#select-full-day-wedding').click(function() {
	if (selectedCalendarDate) {
		$('#edit-date-full-day').val(selectedCalendarDate);
		$('#edit-price-full-day').val(selectedFullDayPrice);
		$('#edit-date-full-day-form').submit();
	}
});

$('#select-twilight-wedding').click(function() {
	if (selectedCalendarDate) {
		$('#edit-date-twilight').val(selectedCalendarDate);
		$('#edit-price-twilight').val(selectedTwilightPrice);
		$('#edit-date-twilight-form').submit();
	}
});

$('#select-micro-wedding').click(function() {
	if (selectedCalendarDate) {
		$('#edit-date-micro').val(selectedCalendarDate);
		$('#edit-price-micro').val(selectedMicroPrice);
		$('#edit-date-micro-form').submit();
	}
});

var foodTotal 
var catererEveningGuestPrice
var eveningGuestPrice
var stayAddedToTotal = false
var step_3b_reached = false 
var drinkTotalOLD = 0
var accommodationPrice = 900
var ceremonyPrice = 150
   
   // get initial values
   var total_step_1 = <?=$venue_price?>

	$("#venue_price").text("£" + <?=$venue_price?>)
	// hardcode The Accommodation (£900) and Ceremony (£150) to be added to the Venue hire
	
	total_step_1 = parseFloat(parseFloat(total_step_1) + accommodationPrice + ceremonyPrice).toFixed(2)
	
	
	$("#total").text(total_step_1)

	
	// Step 1 js
	
	function updateFoodPrices(caterer, eveningGuestPrice){
			catererEveningGuestPrice = parseFloat(eveningGuestPrice * $( "#evening_guests option:selected" ).val())
			if($("#sample-menu-" + caterer + " option:selected").data("evening") == "no"){
				var foodTotal = $("#sample-menu-" + caterer + " option:selected").data("price") * $("#adult-guests-total").text()
			}else if($("#sample-menu-" + caterer + " option:selected").data("evening") == "yes"){
				var foodTotal = $("#sample-menu-" + caterer + " option:selected").data("price") * $("#adult-guests-total").text() + catererEveningGuestPrice
			}
			
			/* 27-dec-2025
			// apply midweek discount (if applicable)
			// if user has closed modal after selecting a new date
			if(typeof midweekDiscount !== "undefined"){
				var discount = parseFloat((foodTotal / 100) * (-midweekDiscount));
			}else{
				// if user has initially landed on the page
				var discount = parseFloat((foodTotal / 100) * <?php //=$midweek_discount?>)
			}
			// /apply midweek discount (if applicable)
			*/
			
			foodTotal = parseFloat(foodTotal + discount).toFixed(2)
			 $("#totalFood").text("£" + parseFloat(foodTotal).toFixed(2))	
	}
	

	
	$( "#adult_guests" ).change(function() {
		if($(this).val() != ""){
	  		$( "#adult-guests-total" ).text($(this).val())
			// update food prices
			if ($("#sample-menu-mulberry").is(":visible")) {
				updateFoodPrices("mulberry", 9)

			}
			if ($("#sample-menu-pickle").is(":visible")) {
				updateFoodPrices("pickle", 10.50)
			}
			// /update food prices
		}else{
			$( "#adult-guests-total" ).text("0")
		}
		$( "#guests-total" ).text(parseInt($(this).val()) + parseInt($("#evening_guests").val()))
	});

	
	$( "#evening_guests" ).change(function() {
	  	$( "#evening-guests-total" ).text($(this).val())
		$( "#guests-total" ).text(parseInt($(this).val()) + parseInt($("#adult_guests").val()))
		// update food prices
			if ($("#sample-menu-mulberry").is(":visible")) {
				updateFoodPrices("mulberry", 9)

			}
			if ($("#sample-menu-pickle").is(":visible")) {
				updateFoodPrices("pickle", 10.50)
			}
			// /update food prices
	});

	
	// check total no. of guests
	$( "#adult_guests,#evening_guests").on('change', function (e) {
		var guestsTotalAdults = parseInt($("#adult_guests").val())
		var guestsTotal = parseInt($("#adult_guests").val()) + parseInt($("#evening_guests").val())
		//alert(guestsTotal)
		if(guestsTotal > 200){
			$( "#noOfGuestsMsg" ).html("<p>Maximum number of daytime and evening guests cannot exceed 200.</p>");
		}else{
			$( "#noOfGuestsMsg" ).html("");	
		}
	})


	$( "#ceremony" ).change(function() {
		if($(this).val() == "yes"){
			$('#ceremonyAmount').text("£" + ceremonyPrice)
	  		$( "#ceremony-list-item" ).show()
			total_step_1 = parseFloat(parseFloat(total_step_1) + ceremonyPrice).toFixed(2)
			//$("#total").text(total_step_1)
		}else{
			$( "#ceremony-list-item" ).hide()
			$('#ceremonyAmount').text("£0")
			total_step_1 = parseFloat(parseFloat(total_step_1) - ceremonyPrice).toFixed(2)
			//$("#total").text(total_step_1)
		}
	});

	// END OF Step 1
	

	
	// Step 2 js
	var decorationTotal = 0
	$('#food').hide()
	//$( "#select_caterer" ).hide()
	$( "#select_menu_mulberry" ).hide()
	$( "#select_menu_pickle" ).hide()
	$( "#select_menu_fire" ).hide()
	$( "#food_nav_tabs" ).hide()
	$( "#food_tab_content" ).hide()
	$( "#canapes-and-reception-drinks-main-container" ).hide()


	$( "#select_food_package a" ).click(function() {
	
		$( "#canapes-and-reception-drinks-main-container" ).show()
		
		// reset selects to 'Please select'
		$('#sample-menu-mulberry').prop('selectedIndex', 0)
		$('#sample-menu-pickle').prop('selectedIndex', 0)

		// if food has already been added to total, find the value and remove it from Total
		/*
		var totalFoodExists = parseFloat($("#totalFood").text().replace('£', '')).toFixed(2)
		if (!isNaN(totalFoodExists)){
			calcStep2Updated = parseFloat(parseFloat($("#total").text()) - parseFloat(totalFoodExists)).toFixed(2)
			//$("#total").text(calcStep2Updated)
		}
		*/
		if($(this).data("package") == "Mulberry"){
			$("#menu_tabs").load("2-courses.htm");
			$("#menu_tabs_print_screen").load("2-courses.htm");
		}else if($(this).data("package") == "Pickle Shack"){
			$("#menu_tabs").load("pickle-page.htm");
			$("#menu_tabs_print_screen").load("pickle-page.htm");
		}
		
		// $("#totalFood").text("£n/a")
		$("#totalFood").text("£0")

		
		$('#food').show()

		if($(this).data("package") == "Mulberry"){
			$( "#select_menu_mulberry" ).show()
			$( "#select_menu_pickle" ).hide()
			$( "#select_menu_fire" ).hide()
		}else if($(this).data("package") == "Pickle Shack"){
			$( "#select_menu_mulberry" ).hide()
			$( "#select_menu_pickle" ).show()
			$( "#select_menu_fire" ).hide()
		}else if($(this).data("package") == "Fire Made"){
			$( "#select_menu_mulberry" ).hide()
			$( "#select_menu_pickle" ).hide()
			$( "#select_menu_fire" ).show()
		}




/* 27-dec-2025
		// this is the first of two functions that detect when modal is closed. This is done so that I can ammend the midweekDiscount variable accordingly to be used in the script below
		$('#editDateModal').on('hidden.bs.modal', function () {
			var iframe = $('iframe')[0];
			var form = $(iframe.contentWindow.document).find('#get-quote');
			var dateFromCalender = form.find('#date').val();
			
			if(dateFromCalender){
					var weddingDateDetectDiscount = new Date(dateFromCalender);
					var dayOfWeek = weddingDateDetectDiscount.getDay(); // 0 = Sunday, 1 = Monday, ..., 6 = Saturday
					if (dayOfWeek >= 2 && dayOfWeek <= 4) { // 2 = Tuesday, 3 = Wednesday, 4 = Thursday
						midweekDiscount = 10; // 10% discount
					}else {
						midweekDiscount = 0; // No discount
					}
			
		});
}*/


		
		 $("#sample-menu-mulberry").change(function(){
			var selectedMenu = $(this).children("option:selected").val();
			$("#menu_tabs").load(selectedMenu);
			
			updateFoodPrices("mulberry", 9)
			// Ive wrapped this into the updateFoodPrices() function
			/*
			eveningGuestPrice = 9
			catererEveningGuestPrice = parseFloat(eveningGuestPrice * $( "#evening_guests option:selected" ).val())
			
			if($("#sample-menu-mulberry option:selected").data("evening") == "no"){
				var foodTotal = $("#sample-menu-mulberry option:selected").data("price") * $("#adult-guests-total").text()
			}else if($("#sample-menu-mulberry option:selected").data("evening") == "yes"){
				var foodTotal = $("#sample-menu-mulberry option:selected").data("price") * $("#adult-guests-total").text() + catererEveningGuestPrice
			}
			
			// apply midweek discount (if applicable)
			// if user has closed modal after selecting a new date
			if(typeof midweekDiscount !== "undefined"){
				var discount = parseFloat((foodTotal / 100) * (-midweekDiscount));
			}else{
				// if user has initially landed on the page
				var discount = parseFloat((foodTotal / 100) * <?php //=$midweek_discount?>)
			}
			// /apply midweek discount (if applicable)

			
			foodTotal = parseFloat(foodTotal + discount).toFixed(2)
			 $("#totalFood").text("£" + parseFloat(foodTotal).toFixed(2))
			 */
			// /Ive wrapped this into the updateFoodPrices() function
			
			// detect if user has already added drinks to their quote
			/*
			var step2Drink = 0
			if(!$("#totalDrink").text().indexOf('£0') == 0) {
				step2Drink = parseFloat($("#totalDrink").text().replace('£', '')).toFixed(2)
			}
			
			// detect if user has already added Paddock
			var step2Paddock = 0
			if(!$("#totalGetReady").text().indexOf('£0') == 0) {
				step2Paddock = parseFloat($("#totalGetReady").text().replace('£', '')).toFixed(2)
				//alert(step2Paddock)
			}

			calcStep2 = parseFloat(parseFloat(total_step_1) + parseFloat(decorationTotal) + parseFloat(foodTotal) + parseFloat(step2Drink) + parseFloat(step2Paddock)).toFixed(2)
			 $("#total").text(calcStep2)
			 */
		});
		$("#sample-menu-pickle").change(function(){
			var selectedMenu = $(this).children("option:selected").val();
			$("#menu_tabs").load(selectedMenu);
			
			updateFoodPrices("pickle", 10.50)
			// Ive wrapped this into the updateFoodPrices() function
			/*
			eveningGuestPrice = 10.50
			catererEveningGuestPrice = parseFloat(eveningGuestPrice * $( "#evening_guests option:selected" ).val())
			
			
			if($("#sample-menu-pickle option:selected").data("evening") == "no"){
				var foodTotal = $("#sample-menu-pickle option:selected").data("price") * $("#adult-guests-total").text()
			}else if($("#sample-menu-pickle option:selected").data("evening") == "yes"){
				var foodTotal = $("#sample-menu-pickle option:selected").data("price") * $("#adult-guests-total").text() + catererEveningGuestPrice
			}
			
			// apply midweek discount (if applicable)
			// if user has closed modal after selecting a new date
			if(typeof midweekDiscount !== "undefined"){
				var discount = parseFloat((foodTotal / 100) * (-midweekDiscount));
			}else{
				// if user has initially landed on the page
				var discount = parseFloat((foodTotal / 100) * <?php //=$midweek_discount?>)
			}
			// /apply midweek discount (if applicable)
			
			
			foodTotal = parseFloat(foodTotal + discount).toFixed(2)
			 $("#totalFood").text("£" + parseFloat(foodTotal).toFixed(2))
			 */
			 // /Ive wrapped this into the updateFoodPrices() function
			
			// detect if user has already added drinks to their quote
			/*
			var step2Drink = 0
			if(!$("#totalDrink").text().indexOf('£0') == 0) {
				step2Drink = parseFloat($("#totalDrink").text().replace('£', '')).toFixed(2)
			}
			
			// detect if user has already added Paddock
			var step2Paddock = 0
			if(!$("#totalGetReady").text().indexOf('£0') == 0) {
				step2Paddock = parseFloat($("#totalGetReady").text().replace('£', '')).toFixed(2)
			}
			
			// detect if user has got to the Stay step

			calcStep2 = parseFloat(parseFloat(total_step_1) + parseFloat(decorationTotal) + parseFloat(foodTotal) + parseFloat(step2Drink) + parseFloat(step2Paddock)).toFixed(2)
			$("#total").text(calcStep2)	
			*/	 
		});

		 // display caterer and package
		 $("#caterer-selected").text($( "#caterer option:selected").text())
		  $("#package-selected").text($(this).data("package"))

	 });
	 
	 
	 $( "#sample-menu-mulberry" ).change(function() {
		  $("#caterer-selected").text("Mulberry")
		// $("#package-selected").text($( "#sample-menu-mulberry option:selected" ).text())
			$("#package-selected").text($("#sample-menu-mulberry option:selected").text().split(" - £")[0]);

			
			
			
			// Ive temporailiy disabled the below. This is to control the text in the snapshot
			/*
			if ($(this).val() === "2-courses.htm") {
				$("#package-selected").html("Canapes: £" + 200 + "\nCourses: £" + 200);
			}else if ($(this).val() === "canapes-2-courses.htm") {
				$("#package-selected").html("Canapes: £" + 200 + "\nCourses: £" + 200 + "\nEnveneing: £" + 200);
			}else if ($(this).val() === "2-courses-evening.htm") {
				$("#package-selected").html("Canapes: £" + 200 + "\nCoursesxxx: £" + 200);
			}else if ($(this).val() === "canapes-2-courses-evening.htm") {
				$("#package-selected").html("Canapes: £" + 200 + "\nCourses: £" + 20340);
			}else if ($(this).val() === "3-courses.htm") {
				$("#package-selected").html("Canapes: £" + 20430 + "\nCourses: £" + 200);
			}else if ($(this).val() === "canapes-3-courses.htm") {
				$("#package-selected").html("Canapes: £" + 200 + "\nCourses: £" + 200);
			}else if ($(this).val() === "3-courses-evening.htm") {
				$("#package-selected").html("Canapes: £" + 200 + "\nCourzzzzzzzses: £" + 200);
			}else if ($(this).val() === "canapes-3-courses-evening.htm") {
				$("#package-selected").html("Canapes: £" + 210 + "\nCourses111: £" + 200);
			}
			*/
			
			
			
			
	 });
	 $( "#sample-menu-pickle" ).change(function() {
		  $("#caterer-selected").text("Pickle Shack")
		 	$("#package-selected").text($( "#sample-menu-pickle option:selected" ).text())
	 });

	// END OF Step 2
	
	
	
	// Step 3 js
	var daytimeGuests = $("#adult_guests").val()
	$('#drink-total').hide()
	$('#drink').hide()
	$('#reception-results').hide()
	$('#reception-drinks-total-item').hide()
	$('#soft-drinks-total-item').hide()
	$('#wedding-breakfast-total-item').hide()
	$('#toast-total-item').hide()
	$( "#no-of-drinks-section" ).hide()
	$( "#drink-options-2-section" ).hide()
	$( "#drink-options-3-section" ).hide()
	$('#prosecco-section').css({ 'opacity' : 0.5 });
	$( "#pimp-prosecco" ).prop( "disabled", true );
	
	welcomeDrinksTotalAmount = 0
	optionExtrasTotalAmount = 0
	weddingBreakfastTotalAmount = 0
	toastTotalAmount = 0
	
	
	
	
	
	// Handle daytime guest number max depending on Stable Barn/Foundry selection
  var $guestSelect = $('#adult_guests');

  function setGuestLimit(max) {
    var current = parseInt($guestSelect.val(), 10);

    $guestSelect.empty();

    for (var i = 50; i <= max; i++) {
      $guestSelect.append('<option>' + i + '</option>');
    }

    // If previously selected value is now invalid, clamp it
    if (current && current <= max) {
      $guestSelect.val(current);
    }
  }

  // Listen for venue change
  $('input[name="venue"]').on('change', function () {

    if (this.value === 'foundry') {
      setGuestLimit(120);
    }

    if (this.value === 'stable-barn') {
      setGuestLimit(156);
    }

  });



	

// number of courses selection
$('#courses').on('change', function () {

  var $selectedOption = $(this).find('option:selected');
  var selectedText = $selectedOption.data('courses') || '';

  // If "Please select" (no data-courses)
  if (!selectedText) {
    $('#courses-title').text('');
    $('#canapes-section').hide();
    $('.caterer-row').hide();
    return;
  }

  // Set the course title
  $('#courses-title').text(selectedText + " *");

  // Show / hide canapes section
  if (selectedText.toLowerCase().indexOf('canapes') !== -1) {
    $('#canapes-section').show();
  } else {
    $('#canapes-section').hide();
  }

  // Show caterers when a valid selection is made
  $('.caterer-row').show();
});



	
	
	
	
	
// FOOD PRICES

const pricingMatrix = {
  figandsmoke: {
    "stable-barn": {
      "2 Courses + Evening Food": 60,
      "Canapes + 2 Courses + Evening Food": 70,
      "3 Courses + Evening Food": 3,
      "Canapes + 3 Courses + Evening Food": 77
    },
    "foundry": {
      "2 Courses + Evening Food": 58,
      "Canapes + 2 Courses + Evening Food": 68,
      "3 Courses + Evening Food": 65,
      "Canapes + 3 Courses + Evening Food": 75
    }
  },
  
    milkshed: {
    "stable-barn": {
      "2 Courses + Evening Food": 55,
      "Canapes + 2 Courses + Evening Food": 65,
      "3 Courses + Evening Food": 62,
      "Canapes + 3 Courses + Evening Food": 72
    },
    "foundry": {
      "2 Courses + Evening Food": 55,
      "Canapes + 2 Courses + Evening Food": 65,
      "3 Courses + Evening Food": 62,
      "Canapes + 3 Courses + Evening Food": 4
    }
  },

  firemade: {
    "foundry": {
      "50-79": {
        "2 Courses + Evening Food": 62,
        "Canapes + 2 Courses + Evening Food": 72,
        "3 Courses + Evening Food": 69,
        "Canapes + 3 Courses + Evening Food": 79
      },
      "80+": {
        "2 Courses + Evening Food": 58,
        "Canapes + 2 Courses + Evening Food": 68,
        "3 Courses + Evening Food": 65,
        "Canapes + 3 Courses + Evening Food": 75
      }
    }
  }


};

const drinksServicePricing = {
  figandsmoke: 11,
  milkshed: 13,

  firemade: {
    "50-79": 12,
    "80+": 14
  }
};



	

function getTotalGuests() {
  return (
    parseInt($('#adult_guests').val() || 0, 10) +
    parseInt($('#evening_guests').val() || 0, 10)
  );
}

function getFiremadeBand() {
  return getTotalGuests() >= 80 ? '80+' : '50-79';
}

function getSelectedBundle() {
  return $('#courses option:selected').data('courses') || '';
}

function getSelectedVenue() {
  return $('input[name="venue"]:checked').val();
}













// Populate the select with default cheapest prices (all venues)
function setDefaultBundlePrices() {
  $('#courses option[data-courses]').each(function() {
    const bundleName = $(this).data('courses');
    let cheapestPrice = Infinity;

    for (const caterer in pricingMatrix) {
      for (const venue in pricingMatrix[caterer]) {
        const venuePricing = pricingMatrix[caterer][venue];
        if (venuePricing[bundleName] !== undefined) {
          const price = venuePricing[bundleName];
          if (price < cheapestPrice) cheapestPrice = price;
        }
      }
    }

    if (cheapestPrice !== Infinity) {
      $(this).text(`${bundleName} - From £${cheapestPrice}`);
      $(this).prop('disabled', false);
    } else {
      $(this).prop('disabled', true);
    }
  });
}

function updateBundleSelectPrices(selectedVenue) {
  $('#courses option[data-courses]').each(function() {
    const bundleName = $(this).data('courses');
    let cheapestPrice = Infinity;

    for (const caterer in pricingMatrix) {
      if (!pricingMatrix[caterer][selectedVenue]) continue;

      const venuePricing = pricingMatrix[caterer][selectedVenue];
      if (venuePricing[bundleName] !== undefined) {
        const price = venuePricing[bundleName];
        if (price < cheapestPrice) cheapestPrice = price;
      }
    }

    if (cheapestPrice !== Infinity) {
      $(this).text(`${bundleName} - From £${cheapestPrice}`);
      $(this).prop('disabled', false);
    } else {
      $(this).prop('disabled', true);
    }
  });
}


// Initialize defaults
setDefaultBundlePrices();

// Bind to venue selection
$('input[name="venue"]').on('change', function() {
  const selectedVenue = $(this).val(); // "stable-barn" or "foundry"
  updateBundleSelectPrices(selectedVenue);

  // Show/hide Firemade panel if venue is foundry
  if (selectedVenue === 'foundry') {
    $('.caterer-panel[data-caterer="firemade"]').show();
  } else {
    $('.caterer-panel[data-caterer="firemade"]').hide();
  }
});





































function updateCatererPanels() {

  const venue  = getSelectedVenue();
  const bundle = getSelectedBundle();

  if (!venue || !bundle) {
    $('.caterer-row').hide();
    return;
  }

  $('.caterer-panel.selectable').each(function () {

    const caterer = $(this).data('caterer');
    let price = null;

    // 🔥 FIREMADE (FOUNDY ONLY + GUEST BAND)
    if (caterer === 'firemade') {

      if (venue !== 'foundry') {
        $(this).hide();
		$('#drinks-service-section .caterer-panel[data-caterer="firemade"]').hide();
        return;
      }else {
		  $('#drinks-service-section .caterer-panel[data-caterer="firemade"]').show();
		}

      const band = getFiremadeBand();
      price = pricingMatrix.firemade.foundry[band][bundle];

    } else {
      // NORMAL CATERERS
      price = pricingMatrix[caterer][venue][bundle];
    }

    if (typeof price === 'number') {
      $(this).find('.price').text(price.toFixed(2));
      $(this).show();
    } else {
      $(this).hide();
    }

  });

  $('.caterer-row').show();
}









 // Make the entire wedding caterer panel clickable
function selectCaterer(caterer) {
    // Highlight the selected wedding caterer panel
    $('.caterer-panel.selectable').each(function() {
      if ($(this).data('caterer') === caterer) {
        $(this).addClass('selected');
        $(this).find('input.caterer-radio').prop('checked', true);
      } else {
        $(this).removeClass('selected');
      }
    });

    // Highlight the corresponding drinks panel
    $('#drinks-service-section .caterer-panel').each(function() {
      if ($(this).data('caterer') === caterer) {
        $(this).addClass('selected');
      } else {
        $(this).removeClass('selected');
      }
    });
  }

  // Make entire caterer panel clickable
  $('.caterer-panel.selectable').click(function(e) {
    const caterer = $(this).data('caterer');
    selectCaterer(caterer);
  });

  // Also handle when radio is clicked directly
  $('.caterer-radio').change(function() {
    const caterer = $(this).val();
    selectCaterer(caterer);
  });
  
  
  
  
  
  
  
  
  
  
  
  










function updateDrinksService() {

  const drinkPrice = parseFloat(
    $('#welcome-drinks-select option:selected').data('price')
  );

  const bundle = getSelectedBundle();

  if (!drinkPrice || bundle.includes('Canapes')) {
    $('#drinks-service-section').hide();
    return;
  }

  $('#mulberry_drinks_service').text(
    drinksServicePricing.mulberry.toFixed(2)
  );

  $('#pickle_drinks_service').text(
    drinksServicePricing.pickleshack.toFixed(2)
  );

  $('#other_drinks_service').text(
    drinksServicePricing.other.toFixed(2)
  );

  // 🔥 FIREMADE BAND LOGIC
  const band = getFiremadeBand();
  $('#fire_drinks_service').text(
    drinksServicePricing.firemade[band].toFixed(2)
  );

  $('#drinks-service-section').show();
}


$('#adult_guests, #evening_guests').on('change', function () {
  updateCatererPanels();
  updateDrinksService();
});

$('#courses').on('change', function () {
  updateCatererPanels();
  updateDrinksService();
});

$('input[name="venue"]').on('change', function () {
  updateCatererPanels();
  updateDrinksService();
});

$('#welcome-drinks-select').on('change', function () {
  updateDrinksService();
});

























  function getFiremadeRange(adultGuests) {
    return adultGuests <= 79 ? "50-79" : "80+";
  }

function updateFoodSummary() {
  const selectedCatererPanel = $('.caterer-panel.selectable input.caterer-radio:checked').closest('.caterer-panel');
  const drinksSelected = $('#welcome-drinks-select').val();
  const adultGuests = parseInt($('#adult_guests').val()) || 0;
  const eveningGuests = parseInt($('#evening_guests').val()) || 0;
  const totalGuests = adultGuests + eveningGuests;

  if (!selectedCatererPanel.length) {
    $('#food').hide();
    return;
  }

  $('#food').show();

  const caterer = selectedCatererPanel.data('caterer');
  const catererName = selectedCatererPanel.find('input.caterer-radio').data('package');
  $('#caterer-selected').text(catererName);

  let breakdownHTML = '';
  let total = 0;

  // --- FOOD PRICE from selected panel ---
  const unitFoodPrice = parseFloat(selectedCatererPanel.find('.price').text()) || 0;
  const totalFoodPrice = unitFoodPrice * totalGuests;
  breakdownHTML += `<li>${$('#courses option:selected').data('courses')} <span>£${totalFoodPrice.toFixed(2)}</span></li>`;
  total += totalFoodPrice;

  // --- DRINKS PRICE ---
  const drinksPanel = $(`#drinks-service-section .caterer-panel[data-caterer="${caterer}"]`);
  if (drinksSelected && drinksSelected !== "0" && drinksPanel.length) {
    const unitDrinksPrice = parseFloat(drinksPanel.find('span').text()) || 0;
    const totalDrinksPrice = unitDrinksPrice * totalGuests;
    breakdownHTML += `<li>Drinks service: <span>£${totalDrinksPrice.toFixed(2)}</span></li>`;
    total += totalDrinksPrice;
  }

  $('#food-breakdown').html(breakdownHTML);
  $('#totalFood').text(`£${total.toFixed(2)}`);
  calculateCartTotal(); 
}


  // --- Caterer panel click ---
  $('.caterer-panel.selectable').click(function() {
    $('.caterer-panel.selectable').removeClass('selected');
    $(this).addClass('selected');
    $(this).find('input.caterer-radio').prop('checked', true);

    // Highlight corresponding drinks panel
    const caterer = $(this).data('caterer');
    $('#drinks-service-section .caterer-panel').removeClass('selected');
    $(`#drinks-service-section .caterer-panel[data-caterer="${caterer}"]`).addClass('selected');

    updateFoodSummary();
  });

  // --- Bundle selection change ---
  $('#courses').change(function() {
    updateFoodSummary();
  });

  // --- Drinks selection change ---
  $('#welcome-drinks-select').change(function() {
    updateFoodSummary();
  });

  // --- Guest count changes ---
  $('#adult_guests, #evening_guests').change(function() {
    updateFoodSummary();
  });

  // --- Venue change (show/hide Firemade panels) ---
  $('input[name="venue"]').change(function() {
    const venue = $(this).val();
    if (venue !== 'foundry') {
      $('.caterer-panel[data-caterer="firemade"]').hide();
      $('#drinks-service-section .caterer-panel[data-caterer="firemade"]').hide();
    } else {
      $('.caterer-panel[data-caterer="firemade"]').show();
      $('#drinks-service-section .caterer-panel[data-caterer="firemade"]').show();
    }

    updateFoodSummary();
  });

















	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
	
	
	
	$( "#adult_guests, #welcome-drinks-select" ).change(function() {
	
	// this is used so Drinks doesnt = NAN if Drinks havnt been specified yet
	var rawPrice = $('#welcome-drinks-select option:selected').data('price');
	var price = Number(rawPrice);
	if (!Number.isNaN(price)) {
			$('#drink').show()
		}

		
		$('#drink-total').show()
		$('#soft-drinks-total-item').show()
		if($(this).val()==""){
			$("li#welcome-drinks").hide()
		}else{
			$("li#welcome-drinks").show()
			if($(this).val() == 0){
				$('#welcome-drinks div').text('Reception drinks - not required');
			}else{
				$('#welcome-drinks div').text('Reception drinks');
			}
		}
		welcomeDrinks = parseFloat($('#adult_guests option:selected').val() * $('#welcome-drinks-select option:selected').data("price")).toFixed(2)
		$("#welcome-drinks-total").text("£" + welcomeDrinks);
		
		// Only show Soft Drinks on snapshot if theyve *havnt* selected "No Selection" for Reception Drinks
		if($(this).val()!="" && $(this).val()!="0"){
			// SOFT DRINKS needs to be set here becuase we cant get at guest amount unless we detect it at point of this select
			softDrinksAmount = parseFloat(($('#adult_guests option:selected').val() * 0.2) * 2).toFixed(2)
		}else{
			softDrinksAmount = 0.00
			$('#soft-drinks-total-item').hide()
		}
		
		$("#soft-drinks-total").text("£" + softDrinksAmount);
		
		if (!Number.isNaN(price)) {
			welcomeDrinksTotalAmount = parseFloat(parseFloat(welcomeDrinks) + parseFloat(softDrinksAmount)).toFixed(2)
		}
	});
	
	
	// OPTIONAL EXTRAS
	/*
	$( "#no-of-troughs" ).change(function() {
			$('#optional-extras-item').show()
			optionExtrasTotalAmount = parseFloat($("#no-of-troughs option:selected").data("price")).toFixed(2)
			$("#optional-extras-total").text("£" + optionExtrasTotalAmount);
	});
	*/
	
	
	// WEDDING BREAKFAST
	$( "#wedding-breakfast-select" ).change(function() {
		if($(this).val()==""){
			$("li#wedding-breakfast-total-item").hide()
		}else{
			$("li#wedding-breakfast-total-item").show()
			if($(this).val() == 0){
				$('#wedding-breakfast-total-item div').text('Wedding breakfast - not required');
			}else{
				$('#wedding-breakfast-total-item div').text('Wedding breakfast');
			}
		}
		if($(this).val()=="perbottle" || $(this).val()=="0"){
			perBottleAmount = parseFloat($('#adult_guests option:selected').val() * parseFloat($('#wedding-breakfast-select option:selected').data("price") / 2)).toFixed(2)
			$( "#wedding-breakfast-total" ).text("£" + perBottleAmount)
			weddingBreakfastTotalAmount = perBottleAmount
		}
		if($(this).val()=="drink-token"){
			drinkTokenAmount = parseFloat($('#adult_guests option:selected').val() * 6).toFixed(2)
			$( "#wedding-breakfast-total" ).text("£" + drinkTokenAmount)
			weddingBreakfastTotalAmount = drinkTokenAmount
		}
	});
	
	// TOAST
	$( "#toast-drinks-select" ).change(function() {
		if($(this).val()==""){
			$("li#toast-total-item").hide()
		}else{
			$("li#toast-total-item").show()
			if($(this).val() == 0){
				$('#toast-total-item div').text('Toast - not required');
			}else{
				$('#toast-total-item div').text('Toast');
			}
		}
		bottleNo = Math.ceil($('#adult_guests option:selected').val() / 6)
		bottleTotal = parseFloat(bottleNo * $('#toast-drinks-select option:selected').data("price")).toFixed(2)
		$("#toast-total").text("£" + bottleTotal);
		
		toastTotalAmount = bottleTotal
	});
	
	
	$('#adult_guests, #welcome-drinks-select, #wedding-breakfast-select, #toast-drinks-select').change(function() {
		drinkTotal = parseFloat(parseFloat(welcomeDrinksTotalAmount) + parseFloat(optionExtrasTotalAmount) + parseFloat(weddingBreakfastTotalAmount) + parseFloat(toastTotalAmount)).toFixed(2)
		$("#totalDrink").text("£" + drinkTotal);
		total_step_3Drinks = eval(parseFloat(currentTotal) + parseFloat(drinkTotal)) - parseFloat(drinkTotalOLD)
		$("#total").text(parseFloat(total_step_3Drinks).toFixed(2))
	  });

	
	$( "#select-no-corkage" ).change(function() {
		if($(this).children("option:selected").val() == "drink-list"){
			$('#drink').show()
			//$('#display-drink-list').show()
			$('#drink-total').show()
	}else{
			$('#drink').hide()
			//$('#display-drink-list').hide()
			$('#drink-total').hide()
			$( "#no-corkage-section" ).show()
			 var totalDrinkVal = $("#totalDrink").text();
       		 var totalDrinkVal = totalDrinkVal.substring(1, totalDrinkVal.length)
			var removeDrinkTotal = parseFloat(parseFloat($("#total").text() - parseFloat(totalDrinkVal)).toFixed(2))
			$('#total').text(removeDrinkTotal)
		}
	});

	/* reception drinks */
	$( "#drink-options-1" ).change(function() {
		if($(this).children("option:selected").val() != ""){
			$( "#no-of-drinks-section" ).show()
			$("#no-of-drinks").val('');
			$("#soft-drink-option").val('')
			$('#reception-results').hide()
			$( "#drink-options-2-section" ).show()
			$('#prosecco-section').css({ 'opacity' : 0.5 });
			$( "#pimp-prosecco" ).prop( "disabled", true );
			$("#pimp-prosecco").val('');
			//$('#optional-extras-results').hide()
			$('#soft-drinks-total-item').hide()
			var totalSoftDrinkVal = $("#soft-drinks-total").text();
       		var totalSoftDrinkVal = totalSoftDrinkVal.substring(1, totalSoftDrinkVal.length)
			var totalCurrentDrinkVal = $("#totalDrink").text();
			var totalCurrentDrinkVal = totalCurrentDrinkVal.substring(1, totalCurrentDrinkVal.length)
			var removeSoftDrinkTotal = parseFloat(parseFloat(totalCurrentDrinkVal) - parseFloat(totalSoftDrinkVal).toFixed(2))
			$("#totalDrink").text("£" + parseFloat(removeSoftDrinkTotal).toFixed(2));	
			$("#soft-drinks-total").text("£0")
			var removeCurrentDrinkTotal = parseFloat(parseFloat($("#total").text() - parseFloat(totalSoftDrinkVal)).toFixed(2))
			$('#total').text(removeCurrentDrinkTotal)
		}else if($(this).children("option:selected").val() == ""){
			$( "#no-of-drinks-section" ).hide()
			$('#reception-results').hide()
			$("#no-of-drinks").val('')
			$("#soft-drink-option").val('')
			$( "#drink-options-2-section" ).hide()
			$('#prosecco-section').css({ 'opacity' : 0.5 });
			$( "#pimp-prosecco" ).prop( "disabled", true );
			$("#pimp-prosecco").val('');
			//$('#optional-extras-results').hide()
			$('#soft-drinks-total-item').hide()
			var totalSoftDrinkVal = $("#soft-drinks-total").text();
       		var totalSoftDrinkVal = totalSoftDrinkVal.substring(1, totalSoftDrinkVal.length)
			var totalCurrentDrinkVal = $("#totalDrink").text();
			var totalCurrentDrinkVal = totalCurrentDrinkVal.substring(1, totalCurrentDrinkVal.length)
			var removeSoftDrinkTotal = parseFloat(parseFloat(totalCurrentDrinkVal) - parseFloat(totalSoftDrinkVal).toFixed(2))
			$("#totalDrink").text("£" + parseFloat(removeSoftDrinkTotal).toFixed(2));	
			$("#soft-drinks-total").text("£0")
			var removeCurrentDrinkTotal = parseFloat(parseFloat($("#total").text() - parseFloat(totalSoftDrinkVal)).toFixed(2))
			$('#total').text(removeCurrentDrinkTotal)
		}
	});
	$( "#drink-options-2" ).change(function() {
		if($(this).children("option:selected").val() != ""){
			$("#no-of-drinks").val('')
			$("#soft-drink-option").val('')
			$('#reception-results').hide()
			$( "#drink-options-3-section" ).show()
			$('#prosecco-section').css({ 'opacity' : 0.5 });
			$( "#pimp-prosecco" ).prop( "disabled", true );
			$("#pimp-prosecco").val('');
			//$('#optional-extras-results').hide()
			$('#soft-drinks-total-item').hide()
			var totalSoftDrinkVal = $("#soft-drinks-total").text();
       		var totalSoftDrinkVal = totalSoftDrinkVal.substring(1, totalSoftDrinkVal.length)
			var totalCurrentDrinkVal = $("#totalDrink").text();
			var totalCurrentDrinkVal = totalCurrentDrinkVal.substring(1, totalCurrentDrinkVal.length)
			var removeSoftDrinkTotal = parseFloat(parseFloat(totalCurrentDrinkVal) - parseFloat(totalSoftDrinkVal).toFixed(2))
			$("#totalDrink").text("£" + parseFloat(removeSoftDrinkTotal).toFixed(2));	
			$("#soft-drinks-total").text("£0")
			var removeCurrentDrinkTotal = parseFloat(parseFloat($("#total").text() - parseFloat(totalSoftDrinkVal)).toFixed(2))
			$('#total').text(removeCurrentDrinkTotal)
		}else if($(this).children("option:selected").val() == ""){
			$("#no-of-drinks").val('')
			$("#soft-drink-option").val('')
			$('#reception-results').hide()
			$( "#drink-options-3-section" ).hide()
			$('#prosecco-section').css({ 'opacity' : 0.5 });
			$( "#pimp-prosecco" ).prop( "disabled", true );
			$("#pimp-prosecco").val('');
			//$('#optional-extras-results').hide()
			$('#soft-drinks-total-item').hide()
			var totalSoftDrinkVal = $("#soft-drinks-total").text();
       		var totalSoftDrinkVal = totalSoftDrinkVal.substring(1, totalSoftDrinkVal.length)
			var totalCurrentDrinkVal = $("#totalDrink").text();
			var totalCurrentDrinkVal = totalCurrentDrinkVal.substring(1, totalCurrentDrinkVal.length)
			var removeSoftDrinkTotal = parseFloat(parseFloat(totalCurrentDrinkVal) - parseFloat(totalSoftDrinkVal).toFixed(2))
			$("#totalDrink").text("£" + parseFloat(removeSoftDrinkTotal).toFixed(2));	
			$("#soft-drinks-total").text("£0")
			var removeCurrentDrinkTotal = parseFloat(parseFloat($("#total").text() - parseFloat(totalSoftDrinkVal)).toFixed(2))
			$('#total').text(removeCurrentDrinkTotal)
		}
	});
	$( "#drink-options-3" ).change(function() {
		if($(this).children("option:selected").val() != ""){
			$("#no-of-drinks").val('')
			$("#soft-drink-option").val('')
			$('#reception-results').hide()
			$('#prosecco-section').css({ 'opacity' : 0.5 });
			$( "#pimp-prosecco" ).prop( "disabled", true );
			$("#pimp-prosecco").val('');
			//$('#optional-extras-results').hide()
			$('#soft-drinks-total-item').hide()
			var totalSoftDrinkVal = $("#soft-drinks-total").text();
       		var totalSoftDrinkVal = totalSoftDrinkVal.substring(1, totalSoftDrinkVal.length)
			var totalCurrentDrinkVal = $("#totalDrink").text();
			var totalCurrentDrinkVal = totalCurrentDrinkVal.substring(1, totalCurrentDrinkVal.length)
			var removeSoftDrinkTotal = parseFloat(parseFloat(totalCurrentDrinkVal) - parseFloat(totalSoftDrinkVal).toFixed(2))
			$("#totalDrink").text("£" + parseFloat(removeSoftDrinkTotal).toFixed(2));	
			$("#soft-drinks-total").text("£0")
			var removeCurrentDrinkTotal = parseFloat(parseFloat($("#total").text() - parseFloat(totalSoftDrinkVal)).toFixed(2))
			$('#total').text(removeCurrentDrinkTotal)
		}else if($(this).children("option:selected").val() == ""){
			$("#no-of-drinks").val('')
			$("#soft-drink-option").val('')
			$('#reception-results').hide()
			$('#prosecco-section').css({ 'opacity' : 0.5 });
			$( "#pimp-prosecco" ).prop( "disabled", true );
			$("#pimp-prosecco").val('');
			//$('#optional-extras-results').hide()
			$('#soft-drinks-total-item').hide()
			var totalSoftDrinkVal = $("#soft-drinks-total").text();
       		var totalSoftDrinkVal = totalSoftDrinkVal.substring(1, totalSoftDrinkVal.length)
			var totalCurrentDrinkVal = $("#totalDrink").text();
			var totalCurrentDrinkVal = totalCurrentDrinkVal.substring(1, totalCurrentDrinkVal.length)
			var removeSoftDrinkTotal = parseFloat(parseFloat(totalCurrentDrinkVal) - parseFloat(totalSoftDrinkVal).toFixed(2))
			$("#totalDrink").text("£" + parseFloat(removeSoftDrinkTotal).toFixed(2));	
			$("#soft-drinks-total").text("£0")
			var removeCurrentDrinkTotal = parseFloat(parseFloat($("#total").text() - parseFloat(totalSoftDrinkVal)).toFixed(2))
			$('#total').text(removeCurrentDrinkTotal)
		}
	});
	$( "#no-of-drinks" ).change(function() {

		if($(this).children("option:selected").val() != ""){
			$('#reception-results').text('')
			$('#prosecco-section').css({ 'opacity' : 1});
			$( "#pimp-prosecco" ).prop( "disabled", false);
			
			// perform calculations
			option1Cost = 0
			option2Cost = 0
			option3Cost = 0
			daytimeGuests = $("#adult_guests").val()
			if($("#drink-options-1").children("option:selected").val() != "" && $("#drink-options-2").children("option:selected").val() != "" && $("#drink-options-3").children("option:selected").val() == ""){
				daytimeGuestsValHalf = parseInt(daytimeGuests/2)
				option1Cost = parseFloat(daytimeGuestsValHalf * $('#drink-options-1 option:selected').data("price") * $('#no-of-drinks option:selected').data("amount")).toFixed(2)
				option2Cost = parseFloat(daytimeGuestsValHalf * $('#drink-options-2 option:selected').data("price") * $('#no-of-drinks option:selected').data("amount")).toFixed(2)
			}else if($("#drink-options-1").children("option:selected").val() != "" && $("#drink-options-2").children("option:selected").val() != "" && $("#drink-options-3").children("option:selected").val() != ""){
				daytimeGuestsValThird = parseInt(daytimeGuests/3)
				daytimeGuestsValThirdOption1 = Math.ceil(daytimeGuests/3)
				option1Cost = parseFloat(daytimeGuestsValThirdOption1 * $('#drink-options-1 option:selected').data("price") * $('#no-of-drinks option:selected').data("amount")).toFixed(2)
				option2Cost = parseFloat(daytimeGuestsValThird * $('#drink-options-2 option:selected').data("price") * $('#no-of-drinks option:selected').data("amount")).toFixed(2)
				option3Cost = parseFloat(daytimeGuestsValThird * $('#drink-options-3 option:selected').data("price") * $('#no-of-drinks option:selected').data("amount")).toFixed(2)
			}else if($("#drink-options-1").children("option:selected").val() != "" && $("#drink-options-2").children("option:selected").val() == "" && $("#drink-options-3").children("option:selected").val() == ""){
				daytimeGuestsVal = parseInt(daytimeGuests)
				option1Cost = parseFloat(daytimeGuestsVal * $('#drink-options-1 option:selected').data("price") * $('#no-of-drinks option:selected').data("amount")).toFixed(2)
			}
			receptionTotal = parseFloat(parseFloat(option1Cost) + parseFloat(option2Cost) + parseFloat(option3Cost)).toFixed(2)
			// /perform calculations
			
			var plural = ""
			if($('#no-of-drinks option:selected').data("amount") > 1){
				plural = "s"
			}

			$('#reception-results').append('<p><strong>Reception Drinks - ' +  $('#no-of-drinks option:selected').data("amount") + ' drink' + plural + ' per guest</strong><br>')

			if($("#drink-options-1").children("option:selected").val() != ""){
				$('#reception-results').append('1st drink option - ' + $('#drink-options-1 option:selected').val() + ' - £' + option1Cost + '<br>')
			}
			if($("#drink-options-2").children("option:selected").val() != ""){
				$('#reception-results').append('2nd drink option – ' + $('#drink-options-2 option:selected').val() + ' – £' + option2Cost + '<br>')
			}
			if($("#drink-options-3").children("option:selected").val() != ""){
				$('#reception-results').append('3rd drink option – ' + $('#drink-options-3 option:selected').val() + ' – £' + option3Cost + '<br>')
			}
			$('#reception-results').append('<strong>Total - £' + receptionTotal + '</strong></p>')
			$('#reception-results').append('<p><i>*This tool is for indicative purposes only. It will split your choice of wine equally if more than one choice has been selected. Only whole bottles of wine can be purchased, your calculation will take this into account and round half bottles up. A more accurate ratio of how you wish your drinks to be split will be agreed at the point of order.</i></p>')
			
			$('#reception-drinks-total-item').show()
			$("#reception-drinks-total").text("£" + receptionTotal)
			$('#reception-results').show()
			existingText = $('#reception-results').html()
		}else{
			$("#reception-drinks-total").text("£" + 0)
			$('#reception-results').hide()
			$('#prosecco-section').css({ 'opacity' : 0.5 });
			$( "#pimp-prosecco" ).prop( "disabled", true );
		}
	});
	
	$( "#soft-drink-option" ).change(function() {

		if($(this).children("option:selected").val() != ""){			
			$('#soft-drinks-total-item').show()
			var softTotal = parseFloat($('#soft-drink-option option:selected').data("price")).toFixed(2)
			$("#soft-drinks-total").text("£" + softTotal)			
			if($("#no-of-drinks").children("option:selected").val() != ""){
				totalReceptionIncSoft = parseFloat(parseFloat(receptionTotal) + parseFloat(softTotal)).toFixed(2)
				$('#reception-results').html(existingText + '<p>Soft drinks - £' + softTotal + '<br><strong>NEW TOTAL - £' + totalReceptionIncSoft + '</strong></p>')
			}else{
				$('#reception-results').html('<p>Soft drinks - £' + softTotal + '<br><strong>TOTAL - £' + softTotal + '</strong></p>')
				$('#reception-results').show()
			}
		}else if($(this).children("option:selected").val() == "" && $("#no-of-drinks").children("option:selected").val() != ""){
			$("#soft-drinks-total").text("£" + 0)
			$('#soft-drinks-total-item').hide()
			$('#reception-results').html(existingText)
		}else if($(this).children("option:selected").val() == "" && $("#no-of-drinks").children("option:selected").val() == ""){
			$("#soft-drinks-total").text("£" + 0)
			$("#totalDrink").text("£" + 0)
			$('#reception-results').hide()
		}
		
		
	
	});
	/* reception drinks */

	/* optional extras */
	extrasTotal = 0
	var proseccoCost = 0
	$('#optional-extras-item').hide()
	//$('#optional-extras-results').hide()

	$( "#no-of-flowers" ).change(function() {
		if($(this).children("option:selected").val() != ""){
			$('#optional-extras-item').show()
			
			/*
			if($("#no-of-troughs").val() != ""){
				troughResult = $("#no-of-troughs option:selected").val() + ' - £'+ parseFloat($("#no-of-troughs option:selected").data("price")) + '<br>'
				$('#trough-result').html(troughResult)
			}	*/
			
			if($("#pimp-prosecco option:selected").val() == ""){proseccoCost = 0}
			extrasTotal = parseFloat(parseFloat(proseccoCost)).toFixed(2)
			$("#optional-extras-total").text("£" + extrasTotal)
			$('#optional-extras-total-result').html('<strong>Total - £' + extrasTotal + '</strong>')

			//$('#optional-extras-results').show()
			
		}else if($("#no-of-flowers option:selected").val() == "" && $("#pimp-prosecco option:selected").val() != ""){	
			$('#trough-result').text($('#trough-result').text())
			$('#flowers-result').text('')
			$('#prosecco-result').text($('#prosecco-result').text())
			$('#optional-extras-total-result').text('')
			if($("#pimp-prosecco option:selected").val() == ""){proseccoCost = 0}
			extrasTotal = parseFloat(parseFloat(proseccoCost)).toFixed(2)
			$("#optional-extras-total").text("£" + extrasTotal)
			$('#optional-extras-total-result').html('<strong>Total - £' + extrasTotal + '</strong>')
		}
	});
	$( "#pimp-prosecco" ).change(function() {
		if($(this).children("option:selected").val() != ""){
			$('#optional-extras-item').show()

			// calculate prosecco
			daytimeGuests = $("#adult_guests").val()
			if($("#drink-options-1").children("option:selected").val() != "" && $("#drink-options-2").children("option:selected").val() != "" && $("#drink-options-3").children("option:selected").val() == ""){
				daytimeGuestsValHalf = parseInt(daytimeGuests/2)
				proseccoCost = parseFloat(daytimeGuestsValHalf * $('#pimp-prosecco option:selected').data("price") * $('#no-of-drinks option:selected').data("amount")).toFixed(2)
			}else if($("#drink-options-1").children("option:selected").val() != "" && $("#drink-options-2").children("option:selected").val() != "" && $("#drink-options-3").children("option:selected").val() != ""){
				daytimeGuestsValThird = parseFloat(daytimeGuests/3)
				proseccoCost = parseFloat(daytimeGuestsValThird * $('#pimp-prosecco option:selected').data("price") * $('#no-of-drinks option:selected').data("amount")).toFixed(2)
			}else if($("#drink-options-1").children("option:selected").val() != "" && $("#drink-options-2").children("option:selected").val() == "" && $("#drink-options-3").children("option:selected").val() == ""){
				daytimeGuestsVal = parseInt(daytimeGuests)
				proseccoCost = parseFloat(daytimeGuestsVal * $('#pimp-prosecco option:selected').data("price") * $('#no-of-drinks option:selected').data("amount")).toFixed(2)
			}
			// /calculate prosecco

			if($("#pimp-prosecco option:selected").val() == ""){proseccoCost = 0}
			extrasTotal = parseFloat(parseFloat(proseccoCost)).toFixed(2)
			$("#optional-extras-total").text("£" + extrasTotal)
			// show results
			
			$('#trough-result').text($('#trough-result').text())
			
			if($("#pimp-prosecco option:selected").val() == ""){proseccoCost = 0}
			extrasTotal = parseFloat(parseFloat(proseccoCost)).toFixed(2)
			$("#optional-extras-total").text("£" + extrasTotal)
			$('#optional-extras-total-result').html('<strong>Total - £' + extrasTotal + '</strong>')
			
			//$('#optional-extras-results').show()

			// /show results
			}else if($("#pimp-prosecco option:selected").val() == "" && $("#no-of-flowers option:selected").val() != ""){	
			$('#trough-result').text($('#trough-result').text())
			$('#prosecco-result').text('')
			$('#optional-extras-total-result').text('')
			extrasTotal = parseFloat(0).toFixed(2)
			$("#optional-extras-total").text("£" + extrasTotal)
			$('#optional-extras-total-result').html('<strong>Total - £' + extrasTotal + '</strong>')
		}
	});
	/* /optional extras */
	
	/* wedding breakfast */
	var breakfastTotal = 0
	var bottomless = 1.5
	$( "#no-of-wine-section" ).hide()
	$( "#wedding-breakfast-total-item" ).hide()
	$('#lager-section').css({ 'opacity' : 0.5 });
	$( "#wedding-breakfast-results" ).hide()
	$( "#toast-results" ).hide()
	$( "#white-wine-option" ).change(function() {
		if($(this).children("option:selected").val() != ""){
			$( "#no-of-wine-section" ).show()
			$("#no-of-drinks-wine").val('');
		}else if($(this).children("option:selected").val() == "" && $("#red-wine-option").children("option:selected").val() == "" && $("#rose-wine-option").children("option:selected").val() == ""){
			$( "#no-of-wine-section" ).hide()
			$("#no-of-drinks-wine").val('')
			$( "#wedding-breakfast-results" ).hide()
		}else{
			$( "#no-of-wine-section" ).show()
			$("#no-of-drinks-wine").val('')
			$( "#wedding-breakfast-results" ).hide()
		}
	});
	$( "#red-wine-option" ).change(function() {
		if($(this).children("option:selected").val() != ""){
			$( "#no-of-wine-section" ).show()
			$("#no-of-drinks-wine").val('');
		}else if($(this).children("option:selected").val() == "" && $("#white-wine-option").children("option:selected").val() == "" && $("#rose-wine-option").children("option:selected").val() == ""){
			$( "#no-of-wine-section" ).hide()
			$("#no-of-drinks-wine").val('')
			$( "#wedding-breakfast-results" ).hide()
		}else{
			$( "#no-of-wine-section" ).show()
			$("#no-of-drinks-wine").val('')
			$( "#wedding-breakfast-results" ).hide()
		}
	});
	$( "#rose-wine-option" ).change(function() {
		if($(this).children("option:selected").val() != ""){
			$( "#no-of-wine-section" ).show()
			$("#no-of-drinks-wine").val('');
		}else if($(this).children("option:selected").val() == "" && $("#red-wine-option").children("option:selected").val() == "" && $("#white-wine-option").children("option:selected").val() == ""){
			$( "#no-of-wine-section" ).hide()
			$("#no-of-drinks-wine").val('')
			$( "#wedding-breakfast-results" ).hide()
		}else{
			$( "#no-of-wine-section" ).show()
			$("#no-of-drinks-wine").val('')
			$( "#wedding-breakfast-results" ).hide()
		}
	});
	$( "#no-of-drinks-wine" ).change(function() {
		if($(this).children("option:selected").val() == "half"){
			$( "#wedding-breakfast-total-item" ).show()
			// perform calculation
			white = parseFloat(parseFloat($("#white-wine-option option:selected").data("price") / 2) * daytimeGuests).toFixed(2)
			red = parseFloat(parseFloat($("#red-wine-option option:selected").data("price") / 2) * daytimeGuests).toFixed(2)
			rose = parseFloat(parseFloat($("#rose-wine-option option:selected").data("price") / 2) * daytimeGuests).toFixed(2)
			
			///////////////////////////
			if(white != 0 && red == 0 && rose == 0){
				// divide by 0
				whiteTotal = white
				redTotal = red
				roseTotal = rose
			}else if(white != 0 && red != 0 && rose == 0){
				// divide by 2
				whiteTotal = parseFloat(parseFloat(white) / 2).toFixed(2)
				redTotal = parseFloat(parseFloat(red) / 2).toFixed(2)
				roseTotal = parseFloat(parseFloat(rose) / 2).toFixed(2)
			}else if(white != 0 && red != 0 && rose != 0){
				// divide by 3
				whiteTotal = parseFloat(parseFloat(white) / 3).toFixed(2)
				redTotal = parseFloat(parseFloat(red) / 3).toFixed(2)
				roseTotal = parseFloat(parseFloat(rose) / 3).toFixed(2)
			}else if(white == 0 && red != 0 && rose == 0){
				// divide by 0
				whiteTotal = white
				redTotal = red
				roseTotal = rose
			}else if(white == 0 && red != 0 && rose != 0){
				// divide by 2
				whiteTotal = parseFloat(parseFloat(white) / 2).toFixed(2)
				redTotal = parseFloat(parseFloat(red) / 2).toFixed(2)
				roseTotal = parseFloat(parseFloat(rose) / 2).toFixed(2)
			}else if(white == 0 && red == 0 && rose != 0){
				// divide by 0
				whiteTotal = white
				redTotal = red
				roseTotal = rose
			}else if(white != 0 && red != 0 && rose == 0){
				// divide by 2
				whiteTotal = parseFloat(parseFloat(white) / 2).toFixed(2)
				redTotal = parseFloat(parseFloat(red) / 2).toFixed(2)
				roseTotal = parseFloat(parseFloat(rose) / 2).toFixed(2)
			}
			///////////////////////////
			
			breakfastTotal = parseFloat(parseFloat(whiteTotal) + parseFloat(redTotal) + parseFloat(roseTotal)).toFixed(2)
			$("#wedding-breakfast-total").text("£" + breakfastTotal)
			$('#lager-section').css({ 'opacity' : 0.5 });
			//$( "#lager" ).prop( "disabled", true );
			$('#wedding-breakfast-results').text('')
			$('#wedding-breakfast-results').append('<p><strong>Wedding Breakfast - ' +  $('#no-of-drinks-wine option:selected').data("amount") + '</strong><br>')
			if($("#white-wine-option option:selected").val() != ""){
				$('#wedding-breakfast-results').append('White wine - ' + $("#white-wine-option option:selected").val() + ' - £' + whiteTotal + '<br>')
			}
			if($("#red-wine-option option:selected").val() != ""){
				$('#wedding-breakfast-results').append('Red wine - ' + $("#red-wine-option option:selected").val() + ' - £' + redTotal + '<br>')
			}
			if($("#rose-wine-option option:selected").val() != ""){
				$('#wedding-breakfast-results').append('Rose - ' + $("#rose-wine-option option:selected").val() + ' - £' + roseTotal + '<br>')
			}
			$('#wedding-breakfast-results').append('<strong>Total - £' + breakfastTotal + '</strong></p>')
			$('#wedding-breakfast-results').append('<p><i>*This tool is for indicative purposes only. It will split your choice of wine equally if more than one choice has been selected. Only whole bottles of wine can be purchased, your calculation will take this into account and round half bottles up. A more accurate ratio of how you wish your drinks to be split will be agreed at the point of order.</i></p>')
			$('#wedding-breakfast-results').show()
		}else if($(this).children("option:selected").val() == "bottomless"){
			$( "#wedding-breakfast-total-item" ).show()
			// perform calculation
			white = parseFloat((parseFloat($("#white-wine-option option:selected").data("price"))) * daytimeGuests).toFixed(2)
			red = parseFloat((parseFloat($("#red-wine-option option:selected").data("price"))) * daytimeGuests).toFixed(2)
			rose = parseFloat((parseFloat($("#rose-wine-option option:selected").data("price"))) * daytimeGuests).toFixed(2)
			///////////////////////////
			if(white != 0 && red == 0 && rose == 0){
				// divide by 0
				whiteTotal = white
				redTotal = red
				roseTotal = rose
				bottomless = 1.5
			}else if(white != 0 && red != 0 && rose == 0){
				// divide by 2
				whiteTotal = parseFloat(parseFloat(white) / 2).toFixed(2)
				redTotal = parseFloat(parseFloat(red) / 2).toFixed(2)
				roseTotal = parseFloat(parseFloat(rose) / 2).toFixed(2)
				bottomless = parseFloat(0.75).toFixed(2)
			}else if(white != 0 && red != 0 && rose != 0){
				// divide by 3
				whiteTotal = parseFloat(parseFloat(white) / 3).toFixed(2)
				redTotal = parseFloat(parseFloat(red) / 3).toFixed(2)
				roseTotal = parseFloat(parseFloat(rose) / 3).toFixed(2)
				bottomless = parseFloat(0.50).toFixed(2)
			}else if(white == 0 && red != 0 && rose == 0){
				// divide by 0
				whiteTotal = white
				redTotal = red
				roseTotal = rose
				bottomless = 1.5
			}else if(white == 0 && red != 0 && rose != 0){
				// divide by 2
				whiteTotal = parseFloat(parseFloat(white) / 2).toFixed(2)
				redTotal = parseFloat(parseFloat(red) / 2).toFixed(2)
				roseTotal = parseFloat(parseFloat(rose) / 2).toFixed(2)
				bottomless = parseFloat(0.75).toFixed(2)
			}else if(white == 0 && red == 0 && rose != 0){
				// divide by 0
				whiteTotal = white
				redTotal = red
				roseTotal = rose
				bottomless = 1.5
			}else if(white != 0 && red != 0 && rose == 0){
				// divide by 2
				whiteTotal = parseFloat(parseFloat(white) / 2).toFixed(2)
				redTotal = parseFloat(parseFloat(red) / 2).toFixed(2)
				roseTotal = parseFloat(parseFloat(rose) / 2).toFixed(2)
				bottomless = parseFloat(0.75).toFixed(2)
			}
			whiteTotal = parseFloat(parseFloat(white) * bottomless).toFixed(2)
			redTotal = parseFloat(parseFloat(red) * bottomless).toFixed(2)
			roseTotal = parseFloat(parseFloat(rose) * bottomless).toFixed(2)
			///////////////////////////
			breakfastTotal = parseFloat(parseFloat(whiteTotal) + parseFloat(redTotal) + parseFloat(roseTotal)).toFixed(2)
			$("#wedding-breakfast-total").text("£" + breakfastTotal)
			$('#lager-section').css({ 'opacity' : 1 });
			//$( "#lager" ).prop( "disabled", false );
			$('#wedding-breakfast-results').text('')
			$('#wedding-breakfast-results').append('<p><strong>Wedding Breakfast - ' +  $('#no-of-drinks-wine option:selected').data("amount") + '</strong><br>')
			$('#wedding-breakfast-results').append('White wine - ' + $("#white-wine-option option:selected").val() + ' - £' + whiteTotal + '<br>Red wine - ' + $("#red-wine-option option:selected").val() + ' - £' + redTotal + '<br>Rose - ' + $("#rose-wine-option option:selected").val() + ' - £' + roseTotal + '<br>')
			//lagerCost = parseFloat(parseFloat(lagerCost) * parseFloat(daytimeGuests)).toFixed(2)
			//breakfastTotal = parseFloat(parseFloat(breakfastTotal) + parseFloat(lagerCost)).toFixed(2)
			$('#wedding-breakfast-results').append('<strong>Draft lager and cider - automatically included</strong></p>')
			$('#wedding-breakfast-results').append('<strong>Total - £' + breakfastTotal + '</strong></p>')
			$('#wedding-breakfast-results').append('<p><i>*This tool is for indicative purposes only. It will split your choice of wine equally if more than one choice has been selected. Only whole bottles of wine can be purchased, your calculation will take this into account and round half bottles up. A more accurate ratio of how you wish your drinks to be split will be agreed at the point of order.</i></p>')
			$('#wedding-breakfast-results').show()
		}else{
			$( "#wedding-breakfast-total-item" ).hide()
			$('#lager-section').css({ 'opacity' : 0.5 });
			//$( "#lager" ).prop( "disabled", true );
			$('#wedding-breakfast-results').text('')
			$('#wedding-breakfast-results').hide()
		}
	});
	/* /wedding breakfast */
	/* toast */
	$( "#toast-drinks" ).change(function() {
			daytimeGuests = $("#adult_guests").val()
		if($(this).children("option:selected").val() != ""){
			$('#toast-total-item').show()
			// perform calculation
			var toastTotal = Math.ceil(parseFloat(daytimeGuests) / parseFloat($("#toast-drinks option:selected").data("price")))
			toastTotal = parseFloat(parseFloat(toastTotal) * parseFloat($("#toast-drinks option:selected").data("cost"))).toFixed(2)
			$("#toast-total").text("£" + toastTotal)
			$('#toast-results').text('')
			$('#toast-results').append('<p><strong>Toast - ' + daytimeGuests + ' guests</strong><br>')
			$('#toast-results').append($("#toast-drinks").val() + ' - £' + parseFloat($("#toast-drinks option:selected").data("cost")) + ' per bottle<br>')
			$('#toast-results').append('<strong>Total - £' + toastTotal + '</strong></p>')
			$( "#toast-results" ).show()
		}else{
			$('#toast-total-item').hide()
			$('#toast-results').text('')
			$( "#toast-results" ).hide()
		}
	});
	/* /toast */
	
	// END OF Step 3
	
	
	// Step 3b (Get ready)
	$('#get-ready').hide()
	//total_current_step_3b = $("#total").text()
	
	$( "#get-ready-option" ).change(function() {
			if($(this).children("option:selected").val() == "yes"){
				$('#get-ready').show()	
				totalGetReadyVal = parseFloat($("#get-ready-option option:selected").data("price")).toFixed(2);
				$("#totalGetReady").text("£" + totalGetReadyVal);
			}else{
				totalGetReadyVal = parseFloat(0);
				$("#totalGetReady").text("£" + totalGetReadyVal);
				$('#get-ready').hide()	
			}
			
			$("#total").text(parseFloat(parseFloat(currentTotal) + parseFloat(totalGetReadyVal)).toFixed(2))
	});
	// END OF Step 3b (Get ready)
	
	

	

	
	 $('[data-toggle="tooltip"]').tooltip({
		placement: 'right',
		trigger: 'hover',
		html: true
	});
	
	
	function calculateCartTotal() {
		// Calculate decoration total
		/*
		var decorationTotalFinal = 0;
		$('#decorations-list li span').each(function() {
			decorationTotalFinal += parseFloat($(this).text().substring(1, 4));
		});
		decorationTotalFinal = parseFloat(decorationTotalFinal).toFixed(2);
		*/

		// Calculate total
		var cartTotals = 
			parseFloat($('#venue_price').text().replace('£', '')) + 
			parseFloat($('#ceremonyAmount').text().replace('£', '')) + 
			parseFloat($('#accommodation').text().replace('£', '')) + 
			parseFloat($('#totalFood').text().replace('£', '')) + 
			parseFloat($('#totalDrink').text().replace('£', '')) + 
			parseFloat($('#totalGetReady').text().replace('£', ''))
			/*parseFloat($('#totalGetReady').text().replace('£', '')) + 
			parseFloat(decorationTotalFinal);*/
		$('#total').text(cartTotals.toFixed(2));
		console.log("Updated Total:", cartTotals);
		return cartTotals;
	}


	
	 $(document).on('change','#adult_guests, #evening_guests, #ceremony, #sample-menu-pickle, #sample-menu-mulberry, #welcome-drinks-select, #wedding-breakfast-select, #toast-drinks-select, #get-ready-option, input[type="checkbox"], input[type="radio"]', 
    function() {
		calculateCartTotal();  	
    }
  );
   $('#select_food_package li a').on('click', function() {
		calculateCartTotal();  
  });
  /* 27-dec-2025
  $('#editDateModal').on('hidden.bs.modal', function () {
    calculateCartTotal();
	});
*/

	
	
			// form validation	 

			  $('#validate-but').click(function (e) {
					// Prevent form submission until validation is complete
					e.preventDefault();

					// Flag to track if any validation fails
					let isValid = true;

				  // check total no. of guests
					var guestsTotalAdults = parseInt($("#adult_guests").val())
						var guestsTotal = parseInt($("#adult_guests").val()) + parseInt($("#evening_guests").val())
						if(guestsTotal > 200){
							alert("Maximum number of daytime and evening guests cannot exceed 200");
							isValid = false;
						}
						
					// Validate the select menus
					if ($('#select_menu_mulberry select').find(":selected").val() == "" && $('#select_menu_pickle select').find(":selected").val() == "" && $('#select_menu_fire select').find(":selected").val() == "") {
						//alert("Please select a Caterer and menu");
						showTopNotification("Please select a Caterer and menu");
						isValid = false;
					}
					if ($('#welcome-drinks-select').find(":selected").val() == "") {
						//alert("Please select a Reception drinks option");
						showTopNotification("Please select a Reception drinks option");
						isValid = false;
					}
					if ($('#wedding-breakfast-select').find(":selected").val() == "") {
						//alert("Please select a Wedding Breakfast option");
						showTopNotification("Please select a Wedding Breakfast option");
						isValid = false;
					}
					if ($('#toast-drinks-select').find(":selected").val() == "") {
						//alert("Please select a Toast drinks option");
						showTopNotification("Please select a Toast drinks option");
						isValid = false;
					}
					if ($('#get-ready-option').find(":selected").val() == "") {
						//alert("Please select whether you would like The Paddock");
						showTopNotification("Please select whether you would like The Paddock");
						isValid = false;
					}
					if ($('#wedding-breakfast-food-select').find(":selected").val() == "") {
						//alert("Please select whether you would like The Paddock");
						showTopNotification("Please select Wedding Breakfast");
						isValid = false;
					}
					if ($('#evening-food-select').find(":selected").val() == "") {
						//alert("Please select whether you would like The Paddock");
						showTopNotification("Please select Evening Food");
						isValid = false;
					}
					if ($('input[name="wedding_caterer"]:checked').length === 0) {
						showTopNotification("Please select a caterer");
						isValid = false;
					}

					if (isValid) {
						$("#pass_to_payment_schedule_form input[name='total-to-pass']").val($("#total").text());
	
						//$("#pass_to_payment_schedule_form input[name='total-hire-items-to-pass']").val(decorationTotal);
						$('#html_chunk').val($('#right-col').html());
						//$('#pass_to_payment_schedule_form').submit();
						$('#paymentscheduleModal').modal('show');

						 $('#paymentscheduleModal').modal('show');
							$("#pass_to_payment_schedule_form").attr("target", "modal-iframe").submit();
						
					}
				});

			// /form validation

		
	
});



$(window).scroll(function(){
	//alert($(window).scrollTop())
	if($(window).scrollTop() > 200){
		if (window.innerWidth > 480) {
			$("#right-col #right-col-contents").stop().animate({"marginTop": ($(window).scrollTop() - 200)}, "slow" );
			// try and always keep the book a viewing button in view
			var elem = document.querySelector('#right-col-contents');
			var bounding = elem.getBoundingClientRect();
			if (bounding.bottom > (window.innerHeight || document.documentElement.clientHeight)) {
				$("#right-col #right-col-contents").stop().animate({"marginTop": (0)}, "slow" );
			}	
		}else{
			$('#pass_to_payment_schedule_form').insertAfter('#right-col-contents .panel');
		}
	}else{
		$("#right-col #right-col-contents").stop().animate({"marginTop": ($(window).scrollTop())}, "slow" );
	}
});



$('#editDateModal').on('hidden.bs.modal', function () {
    var iframe = $('iframe')[0];
    var form = $(iframe.contentWindow.document).find('#get-quote');
	var dateFromCalender = form.find('#date').val();
    var priceFromCalender = form.find('#price').val();
	if(dateFromCalender){
		// user has selected date, so do stuff
		// Create a form dynamically to post the two variables and reload the page to reset everything
		var postForm = $('<form>', {
			method: 'POST',
			action: window.location.href // reload same page
		});

		// Add hidden fields
		postForm.append($('<input>', {
			type: 'hidden',
			name: 'date',
			value: dateFromCalender
		}));
		postForm.append($('<input>', {
			type: 'hidden',
			name: 'price',
			value: priceFromCalender
		}));

		// Append form to body and submit
		postForm.appendTo('body').submit();
	}
});

/* 27-dec-2025
$('#editDateModal').on('hidden.bs.modal', function () {
    var iframe = $('iframe')[0];
    var form = $(iframe.contentWindow.document).find('#get-quote');
	var dateFromCalender = form.find('#date').val();
    var priceFromCalender = form.find('#price').val();
	if(dateFromCalender){
		// user has selected date, so do stuff
		 $('.event_date').text(dateFromCalender);
		 $('#wedding-date-to-pass').val(dateFromCalender);
		 var currentVenuePrice = parseFloat($('#venue_price').text().replace('£', ''));
		 $('#venue_price').text('£' + priceFromCalender);

        // Calculate and update the total
        var currentCartTotal = parseFloat($('#total').text().replace('£', ''));
        var newCartTotal = (currentCartTotal - currentVenuePrice) + parseFloat(priceFromCalender);
        $('#total').text(newCartTotal.toFixed(2));

		// reset the caterer menu so user is forced to add it back in for calculating purposes
		$("#totalFood").text("£0")
		$("#food").hide()
		$('#sample-menu-mulberry').prop('selectedIndex', 0)
		$('#sample-menu-pickle').prop('selectedIndex', 0)
		$( "#select_menu_mulberry" ).hide()
		$( "#select_menu_pickle" ).hide()
		$( "#select_menu_fire" ).hide()
		$( ".menus-container" ).hide()
	 	// /update the data-price values in the food selects to cater for 2027 specific prices
		
		$('html, body').animate({
            scrollTop: $('#step-2').offset().top - 15
        }, 1000); 
	}
});
*/


function showTopNotification(message) {
    const notification = document.getElementById('topNotification');
    const newMessage = document.createElement('div');
    newMessage.className = 'alert-message';
    newMessage.textContent = message;
    notification.appendChild(newMessage);
    notification.style.display = 'block';
    /**/setTimeout(() => {
        $(notification).fadeOut(() => {
            newMessage.remove();
            if (notification.children.length === 0) {
                notification.style.display = 'none';
            }
        });
    }, 4000);
}





/*
// I can style the calendar for a specific date, but cant edit the text within the tooltip for some reason
$('#calIframe').on('load', function () {
    var iframeDocument = $('#calIframe').contents();

    var targetNode = iframeDocument.find('.calendar')[0]; 

    if (targetNode) {
        var observer = new MutationObserver(function () {
            iframeDocument.find('span.day[pass-date="5 February 2025"]').css({
                "background-color": "yellow",
                "color": "red",
                "font-weight": "bold"
            });

        });

        observer.observe(targetNode, { childList: true, subtree: true });
    }
});
*/









</script>
</body>
</html>
