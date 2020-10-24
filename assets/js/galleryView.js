
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
		iterateRecordsGallery(data);
	})
});