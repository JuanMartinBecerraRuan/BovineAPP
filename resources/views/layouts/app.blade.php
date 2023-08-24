<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Bovine-APP</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link href="\css\bootstrap.min.css" rel="stylesheet">
  <link href="\css\mdb.min.css" rel="stylesheet">
  <link href="\css\style.min.css" rel="stylesheet">
  <style type="text/css">
    html,
    header,
    .carousel {
      height: 100%;
    }
    @media (min-width: 800px) and (max-width: 850px) {
      .navbar:not(.top-nav-collapse) {
        background: #1C2331 !important;
      }
    }
    body {
      background-color: #1C2331; /* This line sets the background color */
      font-family: Arial, sans-serif;
    }
    .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    } 
    body {
      background-color: #f1f1f1;
      font-family: Arial, sans-serif;
    }

    h2 {
      text-align: center;
      color: #ffffff;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 3px;
      box-sizing: border-box;
    }
    input[type="submit"] {
      width: 100%;
      background-color: #4caf50;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      font-size: 16px;
    }
    input[type="submit"]:hover {
      background-color: #45a049;
    }
    .message {
      text-align: center;
      margin-top: 10px;
      color: #888;
    }
    .message a {
      color: #4caf50;
      text-decoration: none;
    }
    .container2{
        background-color: #AAAA;
    }
  </style>
</head>
<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <div class="container">
      <a class="navbar-brand" href="" target="_self">
        <strong>BOVINE-APP</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="\" target="_self">Inicio
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="downland.html" target="_self">Descargas</a>
          </li>
        </ul>
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a href="/login" class="nav-link border border-light rounded"target="_self">
              <i></i>Iniciar Sesión
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-1z" data-slide-to="1"></li>
      <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <div class="view">
          <video class="video-intro" autoplay loop muted>
            <source src="{{asset('video/v1.mp4')}}" type="video/mp4">
          </video>
          <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>BOVINE-APP</strong>
              </h1>
              <div align="center"><img src="{{asset('imagenes/logo.png')}}" width="500" height="500"></div>
            </div>
          </div>
        </div>
      </div>>
      <div class="carousel-item">
        <div class="view">
          <video class="video-intro" autoplay loop muted>
            <source src="{{asset('video/v2.mp4')}}" type="video/mp4">
          </video>
          <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>BOVINE-APP</strong>
              </h1>
              <div align="center"><img src="{{asset('imagenes/logo.png')}}" width="500" height="500"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="view">
          <video class="video-intro" autoplay loop muted>
            <source src="{{asset('video/v4.mp4')}}" type="video/mp4">
          </video>
          <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>BOVINE-APP</strong>
              </h1>
              <div align="center"><img src="{{asset('imagenes/logo.png')}}" width="500" height="500"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <script type="text/javascript" src="{{asset('/js/jquery-3.4.1.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/popper.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/mdb.min.js')}}"></script>
  <script type="text/javascript">
    new WOW().init();
  </script>
</body>
@yield('content')
</html>