<style>
    .carousel-indicators {bottom: 60px;}
    .carousel-indicators li {width: 100px; }
    .carousel-indicators li img{border: 1px solid #fff;}
    #carousel-thumb{
        margin-top:110px !important;
    }
    .carousel-fade .carousel-item img{
        max-height: calc(100vh - 110px);
    }
</style>
<!-- TESTIMONIALS -->
<!--Carousel Wrapper-->
<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{asset('assets/img/Header1.jpg')}}" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{asset('assets/img/Header2.jpg')}}" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{asset('assets/img/Header3.jpg')}}" alt="Third slide">
        </div>
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    {{--
    <!--/.Controls-->
    <ol class="carousel-indicators">
        <li data-target="#carousel-thumb" data-slide-to="0" class="active">
            <img class="d-block w-100" src="{{asset('assets/img/Header1.jpg')}}" class="img-fluid">
        </li>
        <li data-target="#carousel-thumb" data-slide-to="1">
            <img class="d-block w-100" src="{{asset('assets/img/Header2.jpg')}}" class="img-fluid">
        </li>
        <li data-target="#carousel-thumb" data-slide-to="2">
            <img class="d-block w-100" src="{{asset('assets/img/Header3.jpg')}}" class="img-fluid">
        </li>
    </ol>--}}
</div> 

