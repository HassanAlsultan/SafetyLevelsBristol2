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
  
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
</head>
<body>
<?php

	function startsWith ($string, $startString)
	{
		$len = strlen($startString);
		return (substr($string, 0, $len) === $startString);
	}
	
	
	$ward = $_GET ['ward'];
	$found = false;
	$cc = 0;
	
	require_once 'PHPExcel/IOFactory.php';
	
	$excel_Path = 'data.xlsx';
	$objPHPExcel = PHPExcel_IOFactory::load($excel_Path);
	
	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "https://zoopla.p.rapidapi.com/properties/"
		."list?area=bristol&category=residential&order_by=age&ordering=descending&page_number=1&page_size=40",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"X-RapidAPI-Host: zoopla.p.rapidapi.com",
			"X-RapidAPI-Key: f3921a13e7msh98790ae20e1dd09p151211jsn2ba3a9692bf0"
		],
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} 
	else 
	{
		$obj = json_decode($response, true);
		
		$error_code = 0;
		
		if ( isset ( $obj['error_code'] ))
		{
			?>
			<div class="container">
				<h4>Sorry,, Incorrect Area Name ... Please, enter correct area name .. </h4>
			</div>
			<?php
			
		}
		else
		{
			
			$country = $obj['country'];
			$area_name = $obj['area_name'];
			
			
			$listing = $obj['listing'];
			
?>
	<div class="container">
	
	
	<br />
<?php 
		
				
		for ($i=0; $i < count ($listing) ; $i++)
		{
			$image_150_113_url = $listing[$i]['image_150_113_url'];
			$num_floors = $listing[$i]['num_floors'];
			$listing_status = $listing[$i]['listing_status'];
			$furnished_state = $listing[$i]['furnished_state'];
			$short_description = $listing[$i]['short_description'];
			$agent_name = $listing[$i]['agent_name'];
			
			$num_bedrooms = $listing[$i]['num_bedrooms'];
			$post_town = $listing[$i]['post_town']; 
			
			$street_name = $listing[$i]['street_name']; 
			$num_bathrooms = $listing[$i]['num_bathrooms']; 
			
			$price = $listing[$i]['price']; 
			$available_from_display = "";
			if ( isset ( $listing[$i]['available_from_display'] ) )
			{
				$available_from_display = $listing[$i]['available_from_display']; 
			}
			 
			$details_url = $listing[$i]['details_url'];  
			$displayable_address = $listing[$i]['displayable_address']; 
			
			$longitude = $listing[$i]['longitude']; 
			$latitude = $listing[$i]['latitude'];
			
			$All_Crimes_rate = 'No Data';
			$Safety_level = 'No Data';
			$crime_prediction_rate = 'No Data';
			
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) 
			{
				$worksheetTitle     = $worksheet->getTitle();
				$highestRow         = $worksheet->getHighestRow(); // e.g. 10
				$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
				$nrColumns = ord($highestColumn) - 64;	
				
				for ($row = 2; $row <= $highestRow; ++ $row) 
				{
						
					$cell_2 = $worksheet->getCellByColumnAndRow(2, $row);
					$ward_name = $cell_2->getValue();
					
					//echo ( "ward_name = " . $ward_name );
					
					$cell_6 = $worksheet->getCellByColumnAndRow(6, $row);
					$All_Crimes_rate_per_1000_ward_population  = $cell_6->getValue();
					//echo ( "  All_Crimes_rate_per_1000_ward_population = " . $All_Crimes_rate_per_1000_ward_population );
					
					
					$cell_14 = $worksheet->getCellByColumnAndRow(14, $row);
					$SafetyLevel = $cell_14->getValue();
					//echo ( "  SafetyLevel = " . $SafetyLevel  );
					
					
					$cell_15 = $worksheet->getCellByColumnAndRow(15, $row);
					$crime_prediction_rate_per_1000_ward_population  = $cell_15->getValue();
					//echo ( "  crime_prediction_rate_per_1000_ward_population = " . $crime_prediction_rate_per_1000_ward_population . "<br />");
					
					if ( $ward  == 'All' )
					{
						if(  strpos($displayable_address, $ward_name) )
						{						
							$All_Crimes_rate = $All_Crimes_rate_per_1000_ward_population;
							$Safety_level = $SafetyLevel;
							$crime_prediction_rate = $crime_prediction_rate_per_1000_ward_population;
						}
					}
					
							
					else 
					{
						if(   $ward  == $ward_name )
						{
							$All_Crimes_rate = $All_Crimes_rate_per_1000_ward_population;
							$Safety_level = $SafetyLevel;
							$crime_prediction_rate = $crime_prediction_rate_per_1000_ward_population;
							
							if(  strpos($displayable_address, $ward) )
							{						
								$found = true;
								$cc++;
								//echo (  $displayable_address . " " . $ward . " found = yy " );
							}						
						}
								
					}
				}
			}
					if ( $ward  == 'All' )
					{
						
					?>
					
			
		
					
 <div class="row">
 <div class="col-md-2"> </div>
		<div class="col-md-8">
		    <div class="card" style="width:500px">
			<img class="card-img-top" src="<?php echo ($image_150_113_url); ?>" alt="name" style="width:100%">
			<div class="card-body">
			
			
				<h4>Area Safety Level :: <?php echo ( $Safety_level ); ?></h4>
	
				<h4>Area Crimes Current Rate :: <?php echo number_format ( (float)$All_Crimes_rate, 2, '.', ''  ); ?>  
				per 1000 ward population</h4>
				
				<!--
				<h4>Area Crimes Prediction Rate :: <?php echo number_format ( (float)$crime_prediction_rate, 2, '.', ''  ); ?>  
				 per 1000 ward population </h4>
				-->
				
				<a href="https://opendata.bristol.gov.uk/explore/dataset/crime-recorded-by-police-by-selected-offence-groups-in-bristol-by-ward/information/?disjunctive.ward_name&fbclid=IwAR01a59YoeAHmfob0jlsnVIehHDVqd3OszCp_H-E-9Jvc1JN7ScfkbVfZi4" 
			  class="btn btn-danger" target="_blank">See More ...</a>
				
				
				<h4 class="card-title">Agent : <?php echo ($agent_name); ?>
					<br /> Status : <?php echo ($listing_status); ?>
					<br />
					   <?php echo ($available_from_display); ?> 
					</h4>
					
			  <p class="card-text">
				Floors No: <?php echo ($num_floors); ?> 
				<br />-- Furnished State: <?php echo ($furnished_state); ?> 
				
				<br />-- Bedrooms No.: <?php echo ($num_bedrooms); ?> 
				<br />-- Post town: <?php echo ($post_town); ?> 
				
				<br />-- Street : <?php echo ($street_name); ?> 
				<br />-- Address : <?php echo ($displayable_address); ?> 
				<br />-- Bathrooms No. : <?php echo ($num_bathrooms); ?> 
				<br />-- Price : <?php echo ($price); ?> per week 
				
				<br />
			  <?php echo ($short_description); ?></p>
			  <a href="map.php?lat=<?php echo ($latitude ); ?>&long=<?php echo ($longitude ); ?>" 
			  class="btn btn-primary" target="_blank">Show in map</a>
			  
			  <a href="<?php echo ($details_url ); ?>" 
			  class="btn btn-success" target="_blank">Details Page ...</a>
			  
			  
			</div>
		  </div>
			<br /><br />
		</div>
 
    <div class="col-md-2"> </div>
	
	</div>
		
		
<?php
		}
		else
		{
			if( $found == true )
						{
							
							
			?>

									
 <div class="row">
 <div class="col-md-2"> </div>
		<div class="col-md-8">
		    <div class="card" style="width:500px">
			<img class="card-img-top" src="<?php echo ($image_150_113_url); ?>" alt="name" style="width:100%">
			<div class="card-body">
			
			
				<h4>Area Safety Level :: <?php echo ( $Safety_level ); ?></h4>
	
				<h4>Area Crimes Current Rate :: <?php echo number_format ( (float)$All_Crimes_rate, 2, '.', ''  ); ?>  
				per 1000 ward population</h4>
				
				<!--
				<h4>Area Crimes Prediction Rate :: <?php echo number_format ( (float)$crime_prediction_rate, 2, '.', ''  ); ?>  
				 per 1000 ward population </h4>
				-->
				
				<a href="https://opendata.bristol.gov.uk/explore/dataset/crime-recorded-by-police-by-selected-offence-groups-in-bristol-by-ward/information/?disjunctive.ward_name&fbclid=IwAR01a59YoeAHmfob0jlsnVIehHDVqd3OszCp_H-E-9Jvc1JN7ScfkbVfZi4" 
			  class="btn btn-danger" target="_blank">See More ...</a>
				
				
				<h4 class="card-title">Agent : <?php echo ($agent_name); ?>
					<br /> Status : <?php echo ($listing_status); ?>
					<br />
					   <?php echo ($available_from_display); ?> 
					</h4>
					
			  <p class="card-text">
				Floors No: <?php echo ($num_floors); ?> 
				<br />-- Furnished State: <?php echo ($furnished_state); ?> 
				
				<br />-- Bedrooms No.: <?php echo ($num_bedrooms); ?> 
				<br />-- Post town: <?php echo ($post_town); ?> 
				
				<br />-- Street : <?php echo ($street_name); ?> 
				<br />-- Address : <?php echo ($displayable_address); ?> 
				<br />-- Bathrooms No. : <?php echo ($num_bathrooms); ?> 
				<br />-- Price : <?php echo ($price); ?> per week 
				
				<br />
			  <?php echo ($short_description); ?></p>
			  <a href="map.php?lat=<?php echo ($latitude ); ?>&long=<?php echo ($longitude ); ?>" 
			  class="btn btn-primary" target="_blank">Show in map</a>
			  
			  <a href="<?php echo ($details_url ); ?>" 
			  class="btn btn-success" target="_blank">Details Page ...</a>
			  
			  
			</div>
		  </div>
			<br /><br />
		</div>
 
    <div class="col-md-2"> </div>
	
	</div>

			<?php			
							
							
							
		}
		$found = false;	
			}
		}
		?>
		
		<br /><br /></div>
<?php
	}
	
	if ( $cc == 0 )
		{
			?>
			<div class="container">
				<h4>Sorry,, No Results Found.. </h4>
			</div>
			<?php
			
		}
	
	
	
	
	}
	
?>  
  

</body>
</html>
