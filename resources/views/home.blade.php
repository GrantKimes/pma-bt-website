{{-- In route, called as view('home', ['name' => 'Grant'] ); 
	This is a blade comment, won't show up in html --}}

@extends('base')


@section('title', 'Home')
@section('home_tab', 'active')


@section('content')


<div class="container">
  <div id="homeCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#homeCarousel" data-slide-to="1"></li>
      <li data-target="#homeCarousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="images/Colored-background.jpg" alt="" class="img-responsive center-block">
        <div class="carousel-caption">
          <h4><i>Need some good pictures for this</i></h4>
        </div>
      </div>

      <div class="item">
        <img src="images/Fall-13.jpg" alt="" class="img-responsive center-block">
        <div class="carousel-caption">
          <p>Brothers of the Fall '13 pledge class</p>
        </div>

      </div>

      <div class="item">
        <img src="images/Pin-render.png" alt="" class="img-responsive center-block">
        <div class="carousel-caption">
          <p>Rendering of our pin</p>
        </div>
      </div>

    </div>

    <a class="left carousel-control" href="#homeCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#homeCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

  </div>
</div>


<!-- Main content -->
<div id="main-content" class="container">
<!--
	<div id="homeCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#homeCarousel" data-slide-to="1"></li>
      <li data-target="#homeCarousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="images/Colored-background.jpg" alt="" class="img-responsive center-block">
        <div class="carousel-caption">
          <p>Here is description text</p>
        </div>
      </div>

      <div class="item">
        <img src="images/Fall-13.jpg" alt="" class="img-responsive center-block">
      </div>

      <div class="item">
        <img src="images/Pin-render.png" alt="" class="img-responsive center-block">
      </div>

    </div>

    <a class="left carousel-control" href="#homeCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#homeCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
-->


  <hr>

  <div class="row featurette">
    <div class="col-md-7 col-md-push-5">
      <h2 class="featurette-heading title">80th Anniversary</h2>
      <p class="lead">
      	On March 5th 2017, we will be celebrating 80 years as a chapter on the University of Miami campus! 
      	There will be a Chapter Day ceremony, as well as our All American Concert featuring performances
      	from current brothers and visiting alumni.
      </p>
    </div>
    <div class="col-md-5 col-md-pull-7">
      <img src="images/80th-logo.png" class="featurette-image img-responsive center-block img-thumbnail" alt="80th anniversary logo">
    </div>
  </div>

  <hr>

  <div class="row featurette">
    <div class="col-md-7">
      <h2 class="featurette-heading">Spring Rush</h2>
      <p class="lead">
      	We have various rush events scheduled for the next few weeks for anyone interested
      	in joining Phi Mu Alpha.

      </p>

      <div class="col-md-6">
      	<h4>Informal BBQ <span class="text-muted">Friday Jan. 27</span></h4>
      	<p>Hecht-Stanford Bridge <span class="text-muted">6:00pm - 9:00pm</span></p>
      </div>
      <div class="col-md-6">
      	<h4>Listening Social <span class="text-muted">Tuesday Jan. 31</span></h4>
      	<p>5822 SW 60th St. <span class="text-muted">6:00pm - 10:00pm</span></p>
      </div>
      <div class="col-md-6">
      	<h4>Ultimate Frisbee <span class="text-muted">Thursday, Feb. 2</span></h4>
      	<p>IM Fields <span class="text-muted">5:00pm - 6:30pm</span></p>
      </div>
      <div class="col-md-6">
      	<h4>Formal Rush <span class="text-muted">Saturday, Feb. 4</span></h4>
      	<p>Shalala Student Center <span class="text-muted">6:30pm - 8:30pm</span></p>
      </div>

    </div>
    <div class="col-md-5">
      <img src="images/Rush-Spring-17.jpg" class="featurette-image img-responsive center-block img-thumbnail" alt="2017 rush">
    </div>
  </div>

</div>

@endsection
