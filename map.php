<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Map </title>
    
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	
	<?php
            
                $lat = $_GET['lat'];
                $lon = $_GET['long'];
                 
               
          ?>
		  
    
    
</head>
<body>
 <br />    <br /> 
<div class="container" style="margin-top:10px"> 
	
	
	
	
	<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Google Map </div>
                    <div class="panel-body">
	<!--
	<iframe 
	src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d27204.75417858289!2d<?php// echo ( $lon); ?>!3d<?php //echo ( $lat); ?>!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2s!4v1663614356484!5m2!1sar!2s"
	width="80%" height="800" style="border:0;" 
	allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	-->
	
	<iframe src="https://maps.google.com/maps?q=<?php echo ( $lat); ?>, <?php echo ( $lon); ?>&z=15&output=embed"
	width="80%" height="800" style="border:0; margin:auto;"  
	allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


                    </div>
            </div>
			
			
			
			
			
        </div>  
    </div>
	
	
	
	
</div>  

	
</body>
</html>