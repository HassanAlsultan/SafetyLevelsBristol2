<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="css/style.css">
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  
</head>
<body>

<div class="container">
	<h2> Safety Level of Areas</h2>
	<p>Search Properties in Bristol ...</p>
  <form action="search.php" method="get">
	  <div class="row">
		<div class="col-25">
		  <label for="area">Area</label>
		</div>
		<div class="col-50">
		  <!--
		  <input type="text" id="area" name="area" placeholder="..." required />
		  -->
			<select name="ward">
			
				<option value="All" >All</option>
				
				
				<option value="Ashley" >E05010885-Ashley</option>
				<option value="Avonmouth & Lawrence Weston" >E05010886-Avonmouth & Lawrence Weston</option>
				<option value="Bedminster" >E05010887-Bedminster</option>
				
				<option value="Bishopston & Ashley Down" >E05010888-Bishopston & Ashley Down</option>
				<option value="Bishopsworth" >E05010889-Bishopsworth</option>
				<option value="Brislington East" >E05010890-Brislington East</option>
				
				<option value="Brislington West" >E05010891-Brislington West</option>
				<option value="Central" >E05010892-Central</option>
				<option value="Clifton" >E05010893-Clifton</option>
				
				<option value="Cotham" >E05010895-Cotham</option>
				<option value="Easton" >E05010896-Easton</option>
				<option value="Eastville" >E05010897-Eastville</option>
				
				<option value="Filwood" >E05010898-Filwood</option>
				<option value="Hartcliffe & Withywood" >E05010900-Hartcliffe & Withywood</option>
				<option value="Henbury & Brentry" >E05010901-Henbury & Brentry</option>
				
				<option value="Hengrove & Whitchurch Park" >E05010902-Hengrove & Whitchurch Park</option>
				<option value="Horfield" >E05010904-Horfield</option>
				<option value="Knowle" >E05010906-Knowle</option>
				
				<option value="Redland" >E05010909-Redland</option>
				<option value="Southmead" >E05010913-Southmead</option>
				<option value="Southville" >E05010914-Southville</option>
				
				<option value="St George Troopers Hill" >E05010911-St George Troopers Hill</option>
				<option value="St George West" >E05010912-St George West</option>
				<option value="Stockwood" >E05010915-Stockwood</option>
				
				
				<option value="Windmill Hill" >E05010918-Windmill Hill</option>
			</select>
		  
		</div>
		
		
		
		
	  </div>
	  
	  
	  <br />
	  <div class="row">
		<div class="col-25">		 </div>
		<div class="col-50">	<input type="submit" value="Submit">	 </div>
		<div class="col-25">		 </div>
		
	  </div>
  </form>
</div>
<br />

</body>
</html>


