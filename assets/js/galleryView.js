
	function setURL() {
		
		window.location = "detailPage"
		
		

		return false;
	}
	
	
	function iterateRecords(results) {
	
	
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
	
				infos.push ({
					name: recordValue.attributes["Name"].split('(')[0].trim(),
					poster: imageLink,
					story: recordValue.attributes["Story"],
					year: recordValue.attributes["Year"],
					director: recordValue.attributes["Director"],
					stars: recordValue.attributes["Stars"],
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
						localStorage.setItem('info', JSON.stringify(each))
					}
				})
				setURL();
			})
	
	
	}

	function getMovie() {
		var info = JSON.parse(localStorage.getItem('info'))
		let output =`
        <div class="row">
          <div class="col-md-4">
            <img src="${info.poster}" class="thumbnail">
          </div>
          <div class="col-md-8">
            <h2>${info.name}</h2>
            <ul class="list-group">
              <li class="list-group-item"><strong>Released:</strong> ${info.year}</li>
              <li class="list-group-item"><strong>Rated:</strong> ${info.director}</li>
              <li class="list-group-item"><strong>IMDB Rating:</strong> ${info.stars}</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="well">
            <h3>Plot</h3>
            ${info.story}
            <hr>
            <a href="http://imdb.com/title/${info.imdbID}" target="_blank" class="btn btn-primary">View IMDB</a>
            <a href="index.html" class="btn btn-default">Go Back To Search</a>
          </div>
        </div>
      `;
		$('#movie').html(output)
	}



$(function() {
	const url = "https://services1.arcgis.com/o2uOINLfbzW2zEYE/arcgis/rest/services/Filming_Locations/FeatureServer/0/query?where=1%3D1&outFields=*&outSR=4326&f=json"
	$.get(url, function(data) {
		data = JSON.parse(data)
		console.log(data.features)
		iterateRecords(data);
	})


});