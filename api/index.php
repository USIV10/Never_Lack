<?php 
   session_start(); 
   $isLoggedIn = isset($_SESSION['email']); // Check if the user is logged in
   $username = $isLoggedIn ? $_SESSION['username'] : null; // Assuming you store the username in the session
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Never Lack ENT.</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="/images/fevicon.png" type="image/gif" />
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="/https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="/images/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <div class="menu_sitbar di_mr01">
            <div class="logo">
               <a href="/index.php"><img src="/images/logo.png" alt="#"/></a>
            </div>
            <nav class="navigation navbar navbar-expand-md navbar-dark ">
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarsExample05">
                  <ul class="navbar-nav mr-auto">
                     <li class="nav-item active">
                        <a class="nav-link" href="/index.php">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/shop.php">Shop</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/contact.php">Contact Us</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/cart.php">Cart</a>
                     </li>
                  </ul>
               </div>
            </nav>
         </div>
         <div class="header_full_banne">
            <div class="header">
               <div class="container-fluid">
                  <div class="row d_flex">
                     <div class=" col-md-2 col-sm-3 col logo_section di_mr0">
                        <div class="full">
                           <div class="center-desk">
                              <div class="logo">
                                 <a href="/index.php"><img src="/images/logo.png" alt="#"/></a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8 col-sm-9 di_mr0">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                           <span class="navbar-toggler-icon"></span>
                           </button>
                           <div class="collapse navbar-collapse" id="navbarsExample04">
                              <ul class="navbar-nav mr-auto">
                                 <li class="nav-item active">
                                    <a class="nav-link" href="/index.php">Home</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="/shop.php">Shop</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="/about.php">About</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="contact.php">Contact Us</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="/cart.php">Cart</a>
                                 </li>
                              </ul>
                           </div>
                        </nav>
                     </div>
                     <div class=" col-md-8 d_none">
                        <ul class="conta_top">
                           <li><i class="fa fa-phone" aria-hidden="true"></i> Call   (+233) 244407461</li>
                           <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="Javascript:void(0)"> sayimawsaani@gmail.com</a></li>
                           <?php if ($isLoggedIn): ?>
                     <li class="nav-item">
                        <span class="nav-link">Welcome, <?= htmlspecialchars($username); ?></span>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/logout.php">Logout</a>
                     </li>
                  </ul>
               <?php else: ?>
                  <ul class="navbar-nav ml-auto">
                     <li class="nav-item">
                        <a class="nav-link" href="/register_login.php"></a>
                     </li>
               <?php endif; ?>
                     </div>
                     <div class="col-md-4">
                        <ul class="email text_align_right">
                           <li class="d_none"><a href="/register_login.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                           <li class="d_none"> <a href="Javascript:void(0)"><i class="fa fa-search" style="cursor: pointer;" aria-hidden="true"></i></a> </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end header inner -->
            <!-- end header -->
            <!-- top -->
            <div class="full_bg">
               <div class="slider_main">
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-md-12">
                           <!-- carousel code -->
                           <div id="carouselExampleIndicators" class="carousel slide">
                              <ol class="carousel-indicators">
                                 <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                 <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                 <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                              </ol>
                              <div class="carousel-inner">
                                 <!-- first slide -->
                                 <div class="carousel-item active">
                                    <div class="carousel-caption relative">
                                       <div class="row d_flex">
                                          <div  class="col-md-7">
                                             <div class="board">
                                                <h3>
                                                   You can Get 
                                                   Neat peanut and Peanut Butter Here
                                                </h3>
                                                <p>Handcrafted with love, roasted to perfection</p>
                                                <a class="read_more" href="/contact.php">Contact  </a>
                                             </div>
                                          </div>
                                          <div class="col-md-5">
                                             <div class="banner_img">
                                                <figure><img class="img_responsive" src="/images/banner_img.png" style="border-radius: 35px;"></figure>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- second slide -->
                                 <div class="carousel-item">
                                    <div class="carousel-caption relative">
                                       <div class="row d_flex">
                                          <div  class="col-md-7">
                                             <div class="board">
                                                <h3>
                                                  Elevate your snacking experience with our classy peanuts
                                                </h3>
                                                <p>Crunch your way to peanut paradise</p>
                                                <a class="read_more" href="/contact.php">Contact  </a>
                                             </div>
                                          </div>
                                          <div class="col-md-5">
                                             <div class="banner_img">
                                                <figure><img class="img_responsive" src="/images/banner_img.png" style="border-radius: 35px;"></figure>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- third slide-->
                                 <div class="carousel-item">
                                    <div class="carousel-caption relative">
                                       <div class="row d_flex">
                                          <div  class="col-md-7">
                                             <div class="board">
                                                <h3>
                                                   Crunchy bliss in every bite
                                                </h3>
                                                <p>Taste our delicious peanuts</p>
                                                <a class="read_more" href="/contact.php">Contact  </a>
                                             </div>
                                          </div>
                                          <div class="col-md-5">
                                             <div class="banner_img">
                                                <figure><img class="img_responsive" src="/images/banner_img.png" style="border-radius: 35px;"></figure>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- controls -->
                              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                              <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                              <span class="sr-only">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                              <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                              <span class="sr-only">Next</span>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end banner -->
      <!-- about -->
      <div class="about">
         <div class="container">
            <div class="row d_flex">
               <div class="col-md-6">
                  <div class="titlepage text_align_left">
                     <h2>About Us</h2>
                     <p></p>
                     <a class="read_more" href="/about.php">Read More</a>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="about_img text_align_center">
                     <figure><img class="img_responsive" src="/images/about.png" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end about -->
      <!-- quality -->
      <div class="quality">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage text_align_center">
                     <h2>Quality Peanut and Peanut Butter</h2>
                     <p>Rich and Tasty</p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                  <div class="quality-box ">
                     <figure><img src="images/quality1.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                  <div class="quality-box ">
                     <figure><img src="/images/quality2.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                  <div class="quality-box ">
                     <figure><img src="/images/quality3.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                  <div class="quality-box ">
                     <figure><img src="/images/quality4.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                  <div class="quality-box ">
                     <figure><img src="/images/quality5.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                  <div class="quality-box ">
                     <figure><img src="/images/quality6.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                  <div class="quality-box ">
                     <figure><img src="/images/quality7.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                  <div class="quality-box ">
                     <figure><img src="/images/quality8.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-sm-12">
                  <a class="read_more" href="Javascript:void(0)">See More</a>
               </div>
            </div>
         </div>
      </div>
      <!-- end quality -->
      
      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-3 col-sm-6">
                     <div class="infoma text_align_left">
                        <h3>About</h3>
                        <p class="ipsum">We're the peanut perfectionists,dedicated to crafting products that exceed your expectations and satisfy your cravings.</p>
                        <ul class="social_icon">
                           <li><a href="Javascript:void(0)"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                     <div class="infoma">
                        <h3>Address</h3>
                        <ul class="conta">
                           <li>Tamale, Ghana.
                           </li>
                           <li>(+233) 244407461 <br>(+233) 264444880</li>
                           <li> <a href="Javascript:void(0)"> sayimawusaani@gmail.com</a></li>
                           <li>Nationwide Delivery</li>
                        </ul>
                     </div>    
                  </div> 
                  
                  <div class="col-md-3 col-sm-6">
                     <div class="infoma">
                        <h3>Newsletter</h3>
                        <form class="form_subscri">
                           <div class="row">
                              <div class="col-md-12">
                                 <input class="newsl" placeholder="Your Name" type="text" name="Your Name">
                              </div>
                              <div class="col-md-12">
                                 <input class="newsl" placeholder="Email" type="text" name="Email">
                              </div>
                              <div class="col-md-12">
                                 <button class="subsci_btn">subscribe</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
                  
                  <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p>© 2024 All Rights Reserved.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="/js/jquery.min.js"></script>
      <script src="/js/bootstrap.bundle.min.js"></script>
      <script src="/js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="/js/custom.js"></script>
</body>
</html>
