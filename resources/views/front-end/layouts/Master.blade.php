<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="{{asset('front-end/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('front-end/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front-end/css/owl.theme.default.min.css')}}">


    <link rel="stylesheet" href="{{asset('front-end/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('front-end/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    
  </head>
  <body>
  
   @include('notify::messages')

  <div class="site-wrap">
 
 @include('front-end/layouts/partial/header')

 @if(Request::is('/'))

        <div class="site-blocks-cover" style="background-image: url({{asset('front-end/images/hero_1.jpg')}})" data-aos="fade">
      <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
          <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
            <h1 class="mb-2">Finding Your Perfect Shoes</h1>
            <div class="intro-text text-center text-md-left">
              <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla. </p>
              <p>
                <a href="#" class="btn btn-sm btn-primary">Shop Now</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    @yield('content')
  @else

    @yield('content')

    <div class="site-section site-section-sm site-blocks-1">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
            <div class="icon mr-4 align-self-start">
              <span class="icon-truck"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Free Shipping</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
            <div class="icon mr-4 align-self-start">
              <span class="icon-refresh2"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Free Returns</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
            <div class="icon mr-4 align-self-start">
              <span class="icon-help"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Customer Support</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

   @yield('content')

@endif

 @include('front-end/layouts/partial/footer')  
  </div>

  <script src="{{asset('front-end/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('front-end/js/jquery-ui.js')}}"></script>
  <script src="{{asset('front-end/js/popper.min.js')}}"></script>
  <script src="{{asset('front-end/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('front-end/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('front-end/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('front-end/js/aos.js')}}"></script>

  <script src="{{asset('front-end/js/main.js')}}"></script>
  <script type="text/javascript" src="/js/app.js"></script>

 @notifyJs
 
  </body>
</html>