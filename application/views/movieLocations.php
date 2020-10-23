<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/leaflet.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/mapView.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div id='map-details-container'>
	<div class='row'>
		<div class="col-9">
			<article id="map"></article>
		</div>
		<div class='col-2 ml-3'>
			<div id='details-section'></div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/leaflet.js"></script>
<script src="<?php echo base_url(); ?>assets/js/strip.pkgd.min.js"></script>
<!--<script src="--><?php //echo base_url(); ?><!--assets/js/mapview.js"></script>-->

<script>
	$(document).ready(function () {
		// $("#btn").bind("click", function (e) {
			var q = "<?php echo $movie ?>";

			var settings = {
				"async": true,
				"crossDomain": true,
				"url": "https://imdb8.p.rapidapi.com/title/auto-complete?q=" + q,
				"method": "GET",
				"headers": {
					"x-rapidapi-host": "imdb8.p.rapidapi.com",
					"x-rapidapi-key": "5bce2378d5msh854bdbec53dc614p1bb5b1jsnf4ae3379a4b0"
				}
			};

			$.ajax(settings).done(function (response) {
				console.log(response.d[0]["id"]);
				console.log(response.d[0]["i"]["imageUrl"]);
				localStorage.setItem("imgUrl",response.d[0]["i"]["imageUrl"]);
				getLocation(response.d[0]["id"]);
			});
			// e.preventDefault();
		// })
	})

	function getLocation(id) {
		var settings = {
			"async": true,
			"crossDomain": true,
			"url": "https://imdb8.p.rapidapi.com/title/get-filming-locations?tconst=" + id,
			"method": "GET",
			"headers": {
				"x-rapidapi-host": "imdb8.p.rapidapi.com",
				"x-rapidapi-key": "5bce2378d5msh854bdbec53dc614p1bb5b1jsnf4ae3379a4b0"
			},
			"error": function () {
				alert("yyy")
			}
		}

		$.ajax(settings).done(function (response) {
			console.log(response.locations[0]["location"]);
			getCoordinate(response.locations[0]["location"]);
		});
	}

	function getCoordinate(location) {
		$.ajax({
			url: "http://www.mapquestapi.com/geocoding/v1/address?key=tiY9icbaTJJXURWoi17CUTSmyP1aBB1U&location=" + location,
			dataType: "jsonp",
			cache: true,
			success: function(data) {
				console.log(data.results[0]["locations"]);
				iterationRecords(data.results[0]["locations"]);
			},
			error: function () {
				alert("hh");
			}
		});
	}

	function iterationRecords(data) {
		var lat0 = data[0]["latLng"]["lat"];
		var lng0 = data[0]["latLng"]["lng"];
		var myMap = L.map("map").setView([lat0, lng0], 4);

		L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoidXFpZHJ1Z28iLCJhIjoiY2tlcDdmbDV2MDc2ZjJ4bnk5bTgwcmkwbSJ9.aiKl3J-I-lVcj0iTllZlpg", {
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			maxZoom: 18,
			id: 'mapbox/streets-v11',
			tileSize: 512,
			zoomOffset: -1,
			accessToken: 'your.mapbox.access.token'
		}).addTo(myMap);

		var markers = []

		$.each(data, function (recordID, recordValue) {

			var lat = recordValue["latLng"]["lat"];
			var lng = recordValue["latLng"]["lng"];
			// plotSummary
			if (lat && lng) {
				// $("#display").append(
				//     $("<p>").text(lat),
				//     $("<p>").text(lng),
				// );

				var marker = L.marker([lat, lng]).addTo(myMap);
			}
			if (recordID == 4) {
				return false;
			}

			popupText =
				`<div class='card p-2'>
				<h3> ${recordValue["adminArea1"]}</h3>
				<h4>Location: ${recordValue["adminArea5"] + " " + recordValue["adminArea4"]+ " " + recordValue["adminArea3"]} </h4>
				<p class='card-text'></p>
				<a href="" target='_blank' class='pb-2'><image src=${localStorage.getItem("imgUrl")} class='img' /></a>

			</div>`


			marker.bindPopup(popupText, {keepInView: true}).openPopup();

			var singleMarker = {
				name: recordValue["adminArea5"] + " " + recordValue["adminArea4"]+ " " + recordValue["adminArea3"],
				marker: marker
			}
			// Store marker for showinmap
			markers.push(singleMarker);

			// Text view section
			$('#details-section').append(
				$("<div class='card'>").append(
					$("<div class='card-header'>").text(recordValue["adminArea1"]),
					$("<div class='card-body'>").append(
						$("<h5 class='card-title'>").text('Detail address'),
						$("<p class='card-text'>").text(recordValue["adminArea5"] + " " + recordValue["adminArea4"]+ " " + recordValue["adminArea3"]),
						$("<a class='btn btn-primary'>").text('Show In Map').css('color','white')
					)
				))
		});

		// Show In Map function
		$('.btn').on('click', function() {
			var text = $(this).prev().text()
			console.log(text)
			markers.forEach(each => {
				if (text === each.name) {
					each.marker.openPopup()
				}
			})
		})
	}

</script>
</body>
</html>
