<h1>Wilkommen in der Bibliothek ya kelp!<h1>
<style type="text/css">
.carousel-inner img {
    -webkit-filter: grayscale(90%);
    filter: grayscale(90%); /* make all photos black and white */ 
    width: 100%; /* Set width to 100% */
    margin: auto;
  }
  </style>

 <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="peru.jpg" alt="New York">
      <div class="carousel-caption">
        <h3>Peru</h3>
        <p>The atmosphere in New Peru is lorem ipsum.</p>
      </div>
    </div>

    <div class="item">
      <img src="van-gogh.jpg" alt="Chicago">
      <div class="carousel-caption">
        <h3>Van Gogh</h3>
        <p>Thank you - A night we won't forget.</p>
      </div>
    </div>

    <div class="item">
      <img src="la.jpg" alt="Los Angeles">
      <div class="carousel-caption">
        <h3>LA</h3>
        <p>Even though the traffic was a mess, we had the best time.</p>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> 



<div class="container-fluid bg-1 text-center">
  <h3>Who Am I?</h3>
  <img src="bird.jpg" class="img-circle" alt="Bird">
  <h3>I'm an adventurer</h3>
</div>

<div class="container-fluid bg-2 text-center">
  <h3>What Am I?</h3>
  <p>Lorem ipsum..</p>
</div>

<div class="container-fluid bg-3 text-center">
  <h3>Where To Find Me?</h3>
  <p>Lorem ipsum..</p>
</div>




<br>
 <div class="row text-center">
  <div class="col-sm-4">
    <div class="thumbnail">
      <img src="peru.jpg" alt="Paris">
      <p><strong>Peru</strong></p>
      <p>Rainbow Mountains</p>
      <button class="btn">Buy Tickets</button>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="thumbnail">
      <img src="cancun.jpg" alt="New York">
      <p><strong>Mexico</strong></p>
      <p>Cancun</p>
      <button class="btn">Buy Tickets</button>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="thumbnail">
      <img src="palawan.jpg" alt="San Francisco">
      <p><strong>Phillipinen</strong></p>
      <p>Palawan</p>
      <button class="btn">Buy Tickets</button>
    </div>
  </div>
</div> 


 <style>
/* Add a dark background color to the footer */
footer {
  background-color: #2d2d30;
  color: #f5f5f5;
  padding: 32px;
}

footer a {
  color: #f5f5f5;
}

footer a:hover {
  color: #777;
  text-decoration: none;
}
</style>

<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>Made By Daniel<a data-toggle="tooltip" title="Visit w3schools"></a></p>
</footer>

<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip();
})
</script> 


<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='index.php?menu=start']").on('click', function(event) {

  // Make sure this.hash has a value before overriding default behavior
  if (this.hash !== "") {

    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 900, function(){

      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
      });
    } // End if
  });
})
</script> 