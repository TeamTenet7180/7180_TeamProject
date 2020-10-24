<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/leaflet.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/mapView.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body onload="showPanel(0)">
		
		<div class="tab-container">
			<div class="button-container">
				<button onclick="showPanel(0)">Map View</button>
				<button onclick="showPanel(1)">Gallery View</button>
			</div>

			
			<div id='map-details-container' class="tab-panel">
				<div class='row'>
					<div class="col-9">
						<article id="map"></article>				
					</div>
					<div class='col-2 ml-3'>
						<div id='details-section'></div>
					</div>
				</div>
			</div>
			
			<div class="container tab-panel">
				<div id='gallery-view' class="row">
				
				</div>
			</div>
		</div> 
	
		<!-- <div id='map-details-container'>
			<div class='row'>
				<div class="col-9">
					<article id="map"></article>				
				</div>
				<div class='col-2 ml-3'>
					<div id='details-section'></div>
				</div>
			</div>
		</div> -->

		<script src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/leaflet.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/mapview.js"></script>
	</body>
</html>
