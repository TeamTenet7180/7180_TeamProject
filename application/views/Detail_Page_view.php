<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail-page-view</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="<?php echo base_url(); ?>assets/css/Detail_Page_view.css" rel="stylesheet">
</head>
<body>
  <div id="brief-info">
    <!-- <img src="img/Tenet Poster.jpg" alt="Poster" id="poster-img">
      <div id="layout-flex-box1">
        <div id="description">
          <h3 id="title" class="title">Tenet</h3>
          <div id="dividing-line"> </div>
            <p id="synopsis">
              This is a movie that nobody can understand but we can!!!!! Some other descriptions
              Some other descriptionsSome other descriptionsSome other descriptionsSome other description
              Some other descriptionsSome other descriptionsSome other descriptions
              Some other descriptionsSome other descriptionsSome other descriptionsSome other descriptions
            </p>
            <h4 id="tags">
              Crime | Action | Sc-Fi 
            </h4>
        </div>
        <div id="cast" class="main-section">
          <h3 id="cast-title" class="title">Cast</h3>
          <div id="dividing-line"> </div>
          <p>casting group's names go here!</p>
        </div>
      </div> -->
  </div>
  <div id="map" class="main-section">
    <h3 id="map-title" class="title">Map</h3>
    <div id="map-holder">
      <img src="<?php echo base_url('assets/images/fake-map.png');?>" alt="Map goes here">
    </div>
  </div>
  <div id="image-list" class="main-section">
    
<div id="images-holder">  
<h3 id="map-title" class="title">Related images</h3>  
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" id="carousel-images">
    <!-- <div class="carousel-item active">
      <img class="d-block w-100" src="img/image-in-list1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/image-in-list2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/image-in-list3.jpg" alt="Third slide">
    </div> -->
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>
  </div>
  </div>
    <script>
      //this is the object that contains all the carousel images
      var images = {
        tenet: ["assets/images/image-in-list1.jpg", "assets/images/image-in-list2.jpg", "assets/images/image-in-list3.jpg"]
      };
      //the inner html that goes to #carousel-images
      var text = 
      `<div class="carousel-item active">
      <img class="d-block w-100" src= <?php echo base_url(); ?>${images.tenet[0]} alt="slide No.1">
      </div>
      `
      for (let index = 1; index < images.tenet.length; index++) {
        const element = images.tenet[index];
        text += `<div class="carousel-item">
                  <img class="d-block w-100" src=<?php echo base_url(); ?>${element} alt="slide No.${index + 1}">
                 </div>`
      }
      document.getElementById("carousel-images").innerHTML = text; 

      //this is the object that contains all the poster images. 
      var posters = {
        tenet: ["assets/images/Tenet-Poster.jpg"]
      };
      //this is the object that contains all the movie titles. 
      var titles = {
        tenet: ["Tenet"]
      };
      //this is the object that contains all the synopsis for the given movie.
      var synopsis = {
        tenet: ["This is a movie that nobody can understand but we can!!!!!"]
      };
      //this is the object that contains all the genre tags for the given movie.
      var tags = {
        tenet: ["Crime | Action | Sc-Fi"]
      };
      //this is the object that contains all the cast group info.
      var cast = {
        tenet: ["Yebai, Hanwen, Hanyang, Xintong, Yawen"]
      };
      //the inner html that goes to #brief-info.
      var brief_info_text = `<img src= <?php echo base_url(); ?>${posters.tenet[0]}  alt="Poster" id="poster-img">
      <div id="layout-flex-box1">
        <div id="description">
          <h3 id="title" class="title">${titles.tenet[0]}</h3>
          <div id="dividing-line"> </div>
            <p id="synopsis">
              ${synopsis.tenet[0]}
            </p>
            <h4 id="tags">
              ${tags.tenet[0]}
            </h4>
        </div>
        <div id="cast" class="main-section">
          <h3 id="cast-title" class="title">Cast</h3>
          <div id="dividing-line"> </div>
          ${cast.tenet[0]}
        </div>
      </div>`;

      document.getElementById("brief-info").innerHTML = brief_info_text; 
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>