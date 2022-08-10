<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>@yield('title')</title>
      <link rel="stylesheet" href="{{asset('assets/front/fonts/icomoon/style.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/jquery-ui.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/owl.theme.default.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/owl.theme.default.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/jquery.fancybox.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap-datepicker.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/fonts/flaticon/font/flaticon.css')}}">
      <link rel="stylesheet" href="{{asset('assets/front/css/aos.css')}}">
      <link href="{{asset('assets/front/css/jquery.mb.YTPlayer.min.css')}}" media="all" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>
      <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div class="site-wrap">
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    <div class="py-2 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-9 d-none d-lg-block">
            <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Have a questions?</a> 
            <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span> 10 20 123 456</a> 
            <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> info@mydomain.com</a> 
          </div>
          <div class="col-lg-3 text-right">
            <a href="{{ route('login') }}" class="small mr-3"><span class="icon-unlock-alt"></span> Log In</a>
            <a href="#" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-users"></span> Register</a>
          </div>
        </div>
      </div>
    </div>
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      <div class="container">
        <div class="d-flex align-items-center">
          <div class="site-logo">
            <a href="index.html" class="d-block">
              <img src="{{asset('assets/front/images/logo.jpg')}}" alt="Image" class="img-fluid">
            </a>
          </div>
          <div class="mr-auto">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="active">
                  <a href="index.html" class="nav-link text-left">Home</a>
                </li>
                <li class="has-children">
                  <a href="about.html" class="nav-link text-left">About Us</a>
                  <ul class="dropdown">
                    <li><a href="teachers.html">Our Teachers</a></li>
                    <li><a href="about.html">Our School</a></li>
                  </ul>
                </li>
                <li>
                  <a href="admissions.html" class="nav-link text-left">Admissions</a>
                </li>
                <li>
                  <a href="courses.html" class="nav-link text-left">Courses</a>
                </li>
                <li>
                    <a href="contact.html" class="nav-link text-left">Contact</a>
                  </li>
              </ul>                                                                                                                                                                                                                                                                                          </ul>
            </nav>

          </div>
          <div class="ml-auto">
            <div class="social-wrap">
              <a href="#"><span class="icon-facebook" ></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-linkedin"></span></a>

              <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                class="icon-menu h3"></span></a>
            </div>
          </div>
         
        </div>
      </div>

    </header>

    @yield('content')    
    