<style>
#step-2 img {
width: 100%;
}
#step-2 hr {
border: 0;
border-top: 1px solid #d7d3cf;
}
#step-2 #select_menu_mulberry, #step-2 #select_menu_pickle, #step-2 #select_menu_fire {
background: #efeeeb;
overflow: auto;
padding-bottom: 20px;
padding-top: 0px;
}


.menus-container{margin-top:0;margin-bottom:20px}
.menus-container .btn{background: #9a785c !important;}
.menus-container a{
    background: #9a785c !important;
    color: #fff !important;
    font-size: 15px !important;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    opacity: 1.0 !important;
    transition: 1s ease;
    -webkit-transition: 1s ease;
    width: 100%;
}



</style>

<div class="row setup-content" id="step-2">
  <div class="col-md-12">
    <h2>Food and Drink</h2>
	<p>We work with four approved caterers, each offering a different style and price point. You'll choose one caterer to deliver all food and drinks for your wedding day and evening.</p>
	<h4>Sample menus</h4>
    <div class="row">
      <div class="col-md-3">
        <div class="menus-container">
		<a href="https://www.uptonbarn.com/wp-content/uploads/2021/07/Wedding-Menu-Mulberry-Catering-Co.pdf" target="_blank" class="btn">
		<p><img style="width: 100%;" src="https://www.uptonbarn.com/wp-content/uploads/2019/05/mulberry63579_LoRes-1024x682.jpg" scale="0"></p>
          <p>Mulberry Co.</p></a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="menus-container">
		<a href="https://www.uptonbarn.com/wp-content/uploads/2024/02/Pickle-Shack-Wedding-Food-Menu.pdf" target="_blank" class="btn">
		<p><img style="width: 100%;" src="https://www.uptonbarn.com/wp-content/uploads/2019/05/Pickle-Shack-Floral-Chocolate-and-Raspberry-Tart.jpg" scale="0"></p>
          <p>Pickle Shack</p></a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="menus-container"><a href="https://www.uptonbarn.com/wp-content/uploads/2021/07/Wedding-Menu-Mulberry-Catering-Co.pdf" target="_blank" class="btn">
		<p><img style="width: 100%;" src="https://www.uptonbarn.com/wp-content/uploads/2019/05/mulberry63579_LoRes-1024x682.jpg" scale="0"></p>
          <p>Firemade</p></a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="menus-container"> <a href="https://www.uptonbarn.com/wp-content/uploads/2024/02/Pickle-Shack-Wedding-Food-Menu.pdf" target="_blank" class="btn">
          <p><img style="width: 100%;" src="https://www.uptonbarn.com/wp-content/uploads/2019/05/Pickle-Shack-Floral-Chocolate-and-Raspberry-Tart.jpg" scale="0"></p>
          <p>Other</p>
          </a> </div>
      </div>
    </div>
	
	<!--<div class="row">
        <hr>
      </div>-->
	
	<h4>Drinks Reception</h4>
	<p><a class="btn btn-primary" href="https://www.uptonbarn.com/drinks#reception-drinks" target="_blank">Reception drinks list</a></p>
	
	 <div class="form-group">
            <label class="control-label">Average cost per Reception drink </label>
            <select class="form-control" id="welcome-drinks-select" name="welcome-drinks-select">
			<option value="">Please select</option>
              <option value="£4.00" data-price="4.00">£4.00</option>
              <option value="£4.50" data-price="4.50">£4.50</option>
              <option value="£5.50" data-price="5.50">£5.50</option>
			  <option value="0" data-price="0">Guests purchase drinks from the bar</option>
            </select>
          </div>

          <p>We have based this calculation on 1 drink per guest</p>
       
	<div class="form-group">
            <label class="control-label">Do you want canapés?</label>
            <select class="form-control" id="want-canapes-select" name="want-canapes-select">
			<option value="">Please select</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
          </div>
	
	
	
	
<style>


.caterer-panel {
    background: #f7f4ef;
    border: 2px solid transparent;
    padding: 18px;
    border-radius: 6px;
    margin-bottom: 15px;
    position: relative;
    transition: all 0.2s ease;
}



.caterer-panel.active {
    background: #e7dfd2;
    border-color: #b9aa8c;
}

.caterer-panel.selectable {
	cursor: pointer;
}

.caterer-radio {
    position: absolute;
    top: 40%;
    right: 12px;
    margin: 0;
	transform: scale(1.4); 
}

.caterer-panel.active {
    background: #e7dfd2;
    border-color: #b9aa8c;
}

.caterer-panel.disabled {
    opacity: 0.6;
	cursor: not-allowed;
}

.caterer-panel.disabled * {
    pointer-events: none;
}

.caterer-panel:not(.selectable), .caterer-panel.selectable.unavailable{
  cursor: not-allowed;
}


</style>

<?
// set prices based on wedding year
if($wedding_year == "2026"){
	$mulberry_drinks_service = "10.00";
	$pickle_drinks_service = "11.00";
	$fire_drinks_service = "12.00";
	$other_drinks_service = "13.00";

	$mulberry_canapes = "14.00";
	$pickle_canapes = "15.00";
	$fire_canapes = "16.00";
	$other_canapes = "17.00";

	$mulberry_2_courses_stable = "10.00";
	$mulberry_3_courses_stable = "20.00";
	$mulberry_2_courses_foundry = "11.00";
	$mulberry_3_courses_foundry = "21.00";

	$pickle_2_courses_stable = "30.00";
	$pickle_3_courses_stable = "40.00";
	$pickle_2_courses_foundry = "31.00";
	$pickle_3_courses_foundry = "41.00";

	$fire_2_courses_stable = "50.00";
	$fire_3_courses_stable = "60.00";
	$fire_2_courses_foundry = "51.00";
	$fire_3_courses_foundry = "61.00";

	$other_2_courses_stable = "70.00";
	$other_3_courses_stable = "80.00";
	$other_2_courses_foundry = "71.00";
	$other_3_courses_foundry = "81.00";

	$mulberry_evening_foundry = "1.00";
	$mulberry_evening_press = "2.00";

	$pickle_evening_foundry = "3.00";
	$pickle_evening_press = "4.00";

	$fire_evening_foundry = "5.00";
	$fire_evening_press = "6.00";

	$other_evening_foundry = "7.00";
	$other_evening_press = "8.00";
}elseif($wedding_year == "2027"){
	$mulberry_drinks_service = "10.10";
	$pickle_drinks_service = "11.10";
	$fire_drinks_service = "12.10";
	$other_drinks_service = "13.10";

	$mulberry_canapes = "14.10";
	$pickle_canapes = "15.10";
	$fire_canapes = "16.10";
	$other_canapes = "17.10";

	$mulberry_2_courses_stable = "10.10";
	$mulberry_3_courses_stable = "20.10";
	$mulberry_2_courses_foundry = "11.10";
	$mulberry_3_courses_foundry = "21.10";

	$pickle_2_courses_stable = "30.10";
	$pickle_3_courses_stable = "40.10";
	$pickle_2_courses_foundry = "31.10";
	$pickle_3_courses_foundry = "41.10";

	$fire_2_courses_stable = "50.10";
	$fire_3_courses_stable = "60.10";
	$fire_2_courses_foundry = "51.10";
	$fire_3_courses_foundry = "61.10";

	$other_2_courses_stable = "70.10";
	$other_3_courses_stable = "80.10";
	$other_2_courses_foundry = "71.10";
	$other_3_courses_foundry = "81.10";

	$mulberry_evening_foundry = "1.10";
	$mulberry_evening_press = "2.10";

	$pickle_evening_foundry = "3.10";
	$pickle_evening_press = "4.10";

	$fire_evening_foundry = "5.10";
	$fire_evening_press = "6.10";

	$other_evening_foundry = "7.10";
	$other_evening_press = "8.10";
}elseif($wedding_year == "2028"){
	$mulberry_drinks_service = "10.20";
	$pickle_drinks_service = "11.20";
	$fire_drinks_service = "12.20";
	$other_drinks_service = "13.20";

	$mulberry_canapes = "14.20";
	$pickle_canapes = "15.20";
	$fire_canapes = "16.20";
	$other_canapes = "17.20";

	$mulberry_2_courses_stable = "10.20";
	$mulberry_3_courses_stable = "20.20";
	$mulberry_2_courses_foundry = "11.20";
	$mulberry_3_courses_foundry = "21.20";

	$pickle_2_courses_stable = "30.20";
	$pickle_3_courses_stable = "40.20";
	$pickle_2_courses_foundry = "31.20";
	$pickle_3_courses_foundry = "41.20";

	$fire_2_courses_stable = "50.20";
	$fire_3_courses_stable = "60.20";
	$fire_2_courses_foundry = "51.20";
	$fire_3_courses_foundry = "61.20";

	$other_2_courses_stable = "70.20";
	$other_3_courses_stable = "80.20";
	$other_2_courses_foundry = "71.20";
	$other_3_courses_foundry = "81.20";

	$mulberry_evening_foundry = "1.20";
	$mulberry_evening_press = "2.20";

	$pickle_evening_foundry = "3.20";
	$pickle_evening_press = "4.20";

	$fire_evening_foundry = "5.20";
	$fire_evening_press = "6.20";

	$other_evening_foundry = "7.20";
	$other_evening_press = "8.20";
}
?>





<div class="catering-wrapper">

    <!-- Drinks Service -->
	<div id="drinks-service-section">
    <h4>Drinks Service</h4>
    <p>Canapés include complimentary drinks service; without canapés, service charge applies</p>
    <div class="row caterer-row">
        <div class="col-sm-3">
            <div class="caterer-panel" data-caterer="mulberry">
                <h4>Mulberry</h4>
                <p>From £<span id="mulberry_drinks_service"></span> per head.</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="caterer-panel" data-caterer="pickleshack">
                <h4>Pickleshack</h4>
                <p>From £<span id="pickle_drinks_service"></span> per head.</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="caterer-panel" data-caterer="firemade">
                <h4>Firemade</h4>
                <p>From £<span id="fire_drinks_service"></span> per head.</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="caterer-panel" data-caterer="other">
                <h4>Other</h4>
                <p>From £<span id="other_drinks_service"></span> per head.</p>
            </div>
        </div>
    </div>
    <hr>
	 </div>

    <!-- Canapes -->
	<div id="canapes-section">
    <h4>Canapés</h4>
    <p>Canapés will be delivered by your caterer <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="" data-original-title="The caterer that you have selected for your Wedding Breakfast will provide sole caterer"></i></p>
    <div class="row caterer-row">
        <div class="col-sm-3"><div class="caterer-panel" data-caterer="mulberry"><h4>Mulberry</h4><p>From £<span id="mulberry_canapes"></span> per head.</p></div></div>
        <div class="col-sm-3"><div class="caterer-panel" data-caterer="pickleshack"><h4>Pickleshack</h4><p>From £<span id="pickle_canapes"></span> per head.</p></div></div>
        <div class="col-sm-3"><div class="caterer-panel" data-caterer="firemade"><h4>Firemade</h4><p>From £<span id="fire_canapes"></span> per head.</p></div></div>
        <div class="col-sm-3"><div class="caterer-panel" data-caterer="other"><h4>Other</h4><p>From £<span id="other_canapes"></span> per head.</p></div></div>
    </div>

    <hr>
	</div>

    <!-- Wedding Breakfast -->
    <h4>Wedding Breakfast</h4>
<div class="row">
	<div class="form-group col-md-5">
            <label class="control-label">Choose your dining space courses and caterer below. <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="" data-original-title="The caterer that you have selected for your Wedding Breakfast will provide sole caterer"></i></label>
	<select class="form-control" id="wedding-breakfast-food-select" name="wedding-breakfast-food-select">
            <option value="">Please select</option>
            <option value="2-courses-stable-barn" data-wedding-breakfast="Wedding Breakfast<br>(2 Courses - Stable Barn)">2 Courses - Stable Barn</option>
<option value="3-courses-stable-barn" data-wedding-breakfast="Wedding Breakfast<br>(3 Courses - Stable Barn)">3 Courses - Stable Barn</option>
<option value="2-courses-the-foundry" data-wedding-breakfast="Wedding Breakfast<br>(2 Courses - The Foundry)">2 Courses - The Foundry</option>
<option value="3-courses-the-foundry" data-wedding-breakfast="Wedding Breakfast<br>(3 Courses - The Foundry)">3 Courses - The Foundry</option>
          </select>
	</div>
	</div>
	
	
    <div class="row caterer-row selectable">
        <div class="col-sm-3">
            <div class="caterer-panel selectable" data-caterer="mulberry">
                 <input type="radio" name="wedding_caterer" class="caterer-radio" value="mulberry" data-package="Mulberry">
                <h4>Mulberry</h4>
                 <p class="caterer-price">Please select an option above</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="caterer-panel selectable" data-caterer="pickleshack">
                <input type="radio" name="wedding_caterer" class="caterer-radio" value="pickleshack" data-package="Pickle Shack">
                <h4>Pickleshack</h4>
                 <p class="caterer-price">Please select an option above</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="caterer-panel selectable" data-caterer="firemade">
                <input type="radio" name="wedding_caterer" class="caterer-radio" value="firemade" data-package="Firemade">
                <h4>Firemade</h4>
                 <p class="caterer-price">Please select an option above</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="caterer-panel selectable" data-caterer="other">
                <input type="radio" name="wedding_caterer" class="caterer-radio" value="other" data-package="Other">
                <h4>Other</h4>
                 <p class="caterer-price">Please select an option above</p>
            </div>
        </div>
    </div>

    <hr>

    <!-- Evening Food -->
	
    <h4>Evening Food</h4>
	 <div class="row">
	<div class="form-group col-md-5">
            <label class="control-label">Choose your evening food from the following options. <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="" data-original-title="The caterer that you have selected for your Wedding Breakfast will provide sole caterer"></i></label>
	<select class="form-control" id="evening-food-select" name="evening-food-select">
            <option value="">Please select</option>
            <option value="the-foundry" data-evening-food="Evening Food (The Foundry)">The Foundry</option>
<option value="the-press" data-evening-food="Evening Food (The Press)">The Press</option>
          </select>
	</div>
	</div>
	
    <div class="row caterer-row">
        <div class="col-sm-3"><div class="caterer-panel" data-caterer="mulberry"><h4>Mulberry</h4><p class="evening-food-price"></p></div></div>
        <div class="col-sm-3"><div class="caterer-panel" data-caterer="pickleshack"><h4>Pickleshack</h4><p class="evening-food-price"></p></div></div>
        <div class="col-sm-3"><div class="caterer-panel" data-caterer="firemade"><h4>Firemade</h4><p class="evening-food-price"></p></div></div>
        <div class="col-sm-3"><div class="caterer-panel" data-caterer="other"><h4>Other</h4><p class="evening-food-price"></p></div></div>
    </div>

</div>

	
	
	
	
	

    
  </div>
</div>

