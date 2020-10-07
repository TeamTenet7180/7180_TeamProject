<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url(); ?>assets/css/searchBar.css" href="searchBar.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />

    <script src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/parallax.js"></script>
    <title>Document</title>
  </head>
  <body>

    <div class="parallax-window" data-parallax="scroll" data-image-src="bg.jpg">
      <form class="wrap container">
        <p style="font-size: 80px; color: rgb(219, 219, 219); font-weight: 600">
          Search for Movie Location
        </p>
        <div class="search">
          <input
            type="text"
            class="searchTerm"
            placeholder="What are you looking for?"
          />
          <button type="submit" class="searchButton">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </form>
    </div>

  </body>
</html>
