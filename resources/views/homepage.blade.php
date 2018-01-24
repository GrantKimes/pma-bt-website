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
      <li data-target="#homeCarousel" data-slide-to="3"></li>
      <li data-target="#homeCarousel" data-slide-to="4"></li>
    </ol>

    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="images/home/carousel/Colored-background.jpg" alt="" class="img-responsive center-block">
        <div class="carousel-caption">
        </div>
      </div>

      <div class="item">
        <img src="images/home/carousel/Singing in Bede.jpg" alt="" class="img-responsive center-block">
        <div class="carousel-caption">
        </div>
      </div>

      <div class="item">
        <img src="images/home/carousel/With Frenk.jpg" alt="" class="img-responsive center-block">
        <div class="carousel-caption">
        </div>
      </div>

      <div class="item">
        <img src="images/home/carousel/Fall-13.jpg" alt="" class="img-responsive center-block">
        <div class="carousel-caption">
        </div>
      </div>

      <div class="item">
        <img src="images/home/carousel/Fall-16.jpg" alt="" class="img-responsive center-block">
        <div class="carousel-caption">
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


<div id="main-content" class="container">
  <hr>

  <div class="row featurette">
    <div class="col-md-7">
      <h2 class="featurette-heading title">Singing Valentines</h2>
      <p class="lead">
        Valentine's Day is coming up, and Phi Mu Alpha will be going around UM's campus to deliver our annual Singing Valentines! 
      </p>
      <p class="lead">
        They will be on sale <strong>Tuesday, Feb. 7 - Thursday, Feb. 9</strong>. Find more information <a href="{{ route('singingValentines') }}">here</a>.
      </p>
    </div>
    <div class="col-md-5">
      <img src="images/home/Lovell-in-Heart.jpg" class="featurette-image img-responsive center-block img-thumbnail" alt="Singing Valentines">
    </div>
  </div>


  <hr>

  <div class="row featurette">
    <div class="col-md-7 col-md-push-5">
      <h2 class="featurette-heading title">80th Anniversary Concert</h2>
      <p class="lead">
      	On <strong>March 5th</strong>, the Beta Tau chapter will be celebrating 80 years at the University of Miami! 
      </p>
      <p class="lead">
        We will be hosting our annual All American Concert featuring performances from returning alumni alongside current brothers. More information still to come.
      </p>
    </div>
    <div class="col-md-5 col-md-pull-7">
      <img src="images/home/80th-logo.png" class="featurette-image img-responsive center-block img-thumbnail" alt="80th anniversary logo">
    </div>
  </div>

  <hr>

  <div class="row featurette">
    <div class="col-md-7">
      <h2 class="featurette-heading title">Spring Rush</h2>
      <p class="lead">
      	Upcoming rush events open to any student at UM interested in learning more about Phi Mu Alpha:
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
      <img src="images/home/Rush-Spring-17.jpg" class="featurette-image img-responsive center-block img-thumbnail" alt="2017 rush">
    </div>
  </div>

</div>

@endsection
