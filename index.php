<?php
session_start();
?>

<html>
	<head>
		<title> xterprises - home </title>
		<link href="style/landing.css" rel="stylesheet" id="bootstrap-css">
		<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> 
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
	<body>
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="/">XTerprises</a>
	  <?php if(!empty($_SESSION['user_id'])): ?>
        <a class="btn btn-warning" href="signout">Sign Out</a>
	  <?php else: ?>
        <a class="btn btn-warning" href="login">Sign In</a>
	  <?php endif; ?>
    </div>
  </nav>

  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Welcome to XTerprises! We create the best technology for your robots.</h1>
        </div>
      </div>
    </div>
  </header>

  <section class="features-icons bg-light text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <h3>Easy to Control</h3>
            <p class="lead mb-0">Don't worry about strange controls. Here at XTerprises, we build software with easy to use controls!</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <h3>Near Zero Latency</h3>
            <p class="lead mb-0">We have servers all over the world with high bandwidth to make sure you never drop connection!</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-0 mb-lg-3">
            <h3>Super Secure</h3>
            <p class="lead mb-0">Security is our thing. We promise to provide super secure servers so no one can control your robot!</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php if(empty($_SESSION['user_id'])): ?>
  <section class="call-to-action text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h2 class="mb-4">Ready to try a robot for 30 days? Sign up today!</h2>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
          <form action="register">
            <div class="form-row">
              <div class="col-12 col-md-0">
                <button type="submit" class="btn btn-block btn-lg btn-warning">Sign up!</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <?php else: ?>
  <section class="call-to-action text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h2 class="mb-4">Sorry, our robot servers are down at the moment.</h2>
		  <h3 class="mb-4">Because of this, take our flag: FLAG{SAD_R0B0T}</h3>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <p class="text-muted small mb-4 mb-lg-0">&copy; xterprises 2019 (safe from ybots, who can't even see this page)</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
          <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-facebook fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-twitter-square fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-instagram fa-2x fa-fw"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
	</body>
</html>