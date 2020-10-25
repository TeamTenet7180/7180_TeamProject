

// Tab
var tabButtons = document.querySelectorAll(".tab-container .button-container button")
var tabPanels = document.querySelectorAll(".tab-container .tab-panel")

function showPanel(index) {
	tabButtons.forEach(button => {
        button.style.backgroundColor="";
        button.style.color = "";
	});
	
    tabButtons[index].style.backgroundColor= '#007bff';
    tabButtons[index].style.color = "white";

    tabPanels.forEach(panel => {
        panel.style.display="none";
    })

    tabPanels[index].style.display = "block";
}


function getYear(year) {
	if(year) {
		return year.match(/[\d]{4}/); // This is regex: https://en.wikipedia.org/wiki/Regular_expression
	}
}



function iterateRecordsMap(results) {

	// Setup the map as per the Leaflet instructions:
	// https://leafletjs.com/examples/quick-start/

	var myMap = L.map("map").setView([-34.928497, 138.600739], 12);

	L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoidXFpZHJ1Z28iLCJhIjoiY2tlcDdmbDV2MDc2ZjJ4bnk5bTgwcmkwbSJ9.aiKl3J-I-lVcj0iTllZlpg", {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1,
		accessToken: 'your.mapbox.access.token'
	}).addTo(myMap);

	var popup = L.popup();

	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent("You clicked the map at " + e.latlng.toString())
			.openOn(myMap);
	}

	myMap.on('click', onMapClick);

	var markers = []
	
	// Iterate over each record and add a marker using the Latitude field (also containing longitude)
	$.each(results.features, function(recordID, recordValue) {

		// var recordLatitude = recordValue["Latitude"];
		var recordLatitude = recordValue.geometry;

		if(recordLatitude) {
			// var latLong = recordLatitude.split(",");
			var lat = recordLatitude["y"];
			var long =recordLatitude["x"];

			// Position the marker and add to map
			var marker = L.marker([lat, long]).addTo(myMap);
			
			// Image and IMDB links
			var imageLink = recordValue.attributes.WebLink2
			var imdbLink = recordValue.attributes.WebLink1


			// Associate a popup with the record's information
			popupText = 
			`<div class='card p-2'>
				<h3> ${recordValue.attributes["Name"]}</h3>
				<h4>Location: ${recordValue.attributes["Location"].substr(11, 30)} </h4>
				<p class='card-text'>${recordValue.attributes["Story"]}</p>
				<a href=${imdbLink} target='_blank' class='pb-2'><image src=${imageLink} class='img' /></a>
				<a target='_blank' href=${imdbLink} class='btn btn-primary btn-block'>For more information</a>	
			</div>`
		
			
			marker.bindPopup(popupText, {keepInView: true}).openPopup();

			// Object to be stored
			var singleMarker = {
				name: recordValue.attributes["Name"],
				marker: marker
			}
			// Store marker for showinmap
			markers.push(singleMarker);

			$('#details-section').append(
				$("<div class='card'>").append(
					$("<div class='card-header'>").text(recordValue.attributes["Name"]),
					$("<div class='card-body'>").append(
						$("<h5 class='card-title'>").text('Story Description'),
						$("<p class='card-text'>").text(recordValue.attributes["Story"]),
						$("<a class='btn btn-primary'>").text('Show In Map').css('color','white')
					)
			))


		}		
	});

	// Show In Map function
	$('.card .btn').on('click', function() {
		var text = $(this).parent().prev().text()
		console.log(text)
		markers.forEach(each => {
			if (text === each.name) {
				each.marker.openPopup()
			}
		})
	})
}
function setURL() {
		
	window.location = "detailPage"
	return false;
}


function iterateRecordsGallery(results) {


	let output;
	let store = []
	let infos = []
	// Iterate over each record and add a marker using the Latitude field (also containing longitude)
	$.each(results.features, function(recordID, recordValue) {


		var found = false;

		if(recordValue) {

			// Image and IMDB links
			var imageLink = recordValue.attributes.WebLink2
			var imdbLink = recordValue.attributes.WebLink1

			// Gallery View
			store.forEach(x => {
				if(x.name === recordValue.attributes["Name"].split('(')[0].trim()) {
					found = true;
					return
				}
			})

			if (found) {
				return 
			}

			store.push({name: recordValue.attributes["Name"].split('(')[0].trim()})

			var recordLatitude = recordValue.geometry;

			infos.push ({
				name: recordValue.attributes["Name"].split('(')[0].trim(),
				poster: imageLink,
				story: recordValue.attributes["Story"],
				year: recordValue.attributes["Year"],
				director: recordValue.attributes["Director"],
				stars: recordValue.attributes["Stars"],
				geo: [recordLatitude["y"], recordLatitude["x"]],
				location: recordValue.attributes["Location"],
				imdbLink
			})
			
			output += 
			`<div class="col-md-3 my-3">
				<div class='wrapper'>
					<div class="text-center">
						<img src=${imageLink}>
						<h5 class='py-3'>${recordValue.attributes["Name"]}</h5>
						<a href='#' class="btn btn-primary" href="#">Movie Details</a>
					</div>
				</div>
			</div>`

			$('#gallery-view').html(output)

		}		
	});

		// Show In Map function
		$('#gallery-view .btn').on('click', function() {
			var text = $(this).prev().text().trim()
			console.log(text);
			infos.forEach(each => {
				if (text === each.name) {
					console.log(each.poster)
					localStorage.setItem('info', JSON.stringify(each))
				}
			})
			setURL();
		})


}


$(function() {
	const url = "https://services1.arcgis.com/o2uOINLfbzW2zEYE/arcgis/rest/services/Filming_Locations/FeatureServer/0/query?where=1%3D1&outFields=*&outSR=4326&f=json"
	$.get(url, function(data) {
		data = JSON.parse(data)
		console.log(data.features)
		iterateRecordsMap(data);
		iterateRecordsGallery(data);
	})
});