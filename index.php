<?php

    // Check if User Coming From A Request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // Assign Variables
        $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
        $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $tel  = filter_var($_POST['tel'], FILTER_SANITIZE_NUMBER_INT);

        $car = filter_var($_POST['car'], FILTER_SANITIZE_STRING);
        $ads = filter_var($_POST['ads'], FILTER_SANITIZE_STRING);
        $msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING);

        $homecity = filter_var($_POST['homecity'], FILTER_SANITIZE_STRING);
        $workcity = filter_var($_POST['workcity'], FILTER_SANITIZE_STRING);
        $averagemiles = filter_var($_POST['averagemiles'], FILTER_SANITIZE_NUMBER_FLOAT);
        
        // Creating Array of Errors
        $formErrors = array();
        if (strlen($fname) <= 3) {
            $formErrors[] = 'Username Must Be Larger Than <strong>3</strong> Characters';
        }
        
        // If No Errors Send The Email [ mail(To, Subject, Message, Headers, Parameters) ]
        
        $headers = 'From: ' . $email . '\r\n';
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $myEmail = 'info@advva.com';
        $subject = 'Contact Form';
        $message = "<html><body>";
        $message .= "<div>First Name: </div>" . strip_tags($_POST['fname']) ."</br>";
        $message .= "<div>Last Name: </div>" . strip_tags($_POST['lname']) ."</br>";
        $message .= "<div>Email: </div>" . strip_tags($_POST['email']) ."</br>";
        $message .= "<div>Phone Number: </div>" . strip_tags($_POST['tel']) ."</br>";
        $message .= "<div>Car Model: </div>" . strip_tags($_POST['car']) ."</br>";
        $message .= "<div>How did you hear about us: </div>" . strip_tags($_POST['ads']) ."</br>";
        $message .= "<div>Describe your driving routine: </div>" . strip_tags($_POST['msg']) ."</br>";
        $message .= "<div>Home City: </div>" . strip_tags($_POST['homecity']) ."</br>";
        $message .= "<div>Work City: </div>" . strip_tags($_POST['workcity']) ."</br>";
        $message .= "<div>Average miles driven each week: </div>" . strip_tags($_POST['averagemiles']) ."</br>";
        $message .= "</body></html>";
        
        if (empty($formErrors)) {
            
            mail($myEmail, $subject, $message, $headers);
            
            $fname = '';
            $lname = '';
            $email = '';
            $tel = '';

            $car = '';
            $ads = '';
            $msg = '';

            $homecity = '';
            $workcity = '';
            $averagemiles = '';
            
            $success = '<div class="alert alert-success alert-dismissible" role="alert">
                          
                          We Have Recieved Your Message
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Advva Drivers">
    <meta name="robots" content="max-image-preview:large">
    <meta itemprop="name" content="Advva Drivers">
    <meta itemprop="url" content="">

    <title>Advva Drivers</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    
</head>
<body>

        <header>
          <nav class="navbar navbar-expand-md fixed-top bg-light">
            <div class="container">
              <div class="col align-self-center text-start">
                <img src="/img/Logo.svg" height="60px" alt="Advva Drivers Logo">
              </div>
              <div class="col align-self-center text-end d-none d-md-inline">
                <a href=""><b>Become Partner</b></a>
                <img class="mx-3" src="/img/H-Line.svg" alt="Seperator Line">
                <a href=""><b class="text-secondary">Become Driver</b></a>
              </div>
              <div class="col align-self-center text-end d-md-none">
                <button class="navbar-toggle" id="toggle" type="button">
                  <svg viewBox="0 0 100 100" width="50">
                    <path class="line top" d="m 30,33 h 40 c 0,0 9.044436,-0.654587 9.044436,-8.508902 0,-7.854315 -8.024349,-11.958003 -14.89975,-10.85914 -6.875401,1.098863 -13.637059,4.171617 -13.637059,16.368042 v 40" />
                    <path class="line middle"d="m 30,50 h 40" />
                    <path class="line bottom" d="m 30,67 h 40 c 12.796276,0 15.357889,-11.717785 15.357889,-26.851538 0,-15.133752 -4.786586,-27.274118 -16.667516,-27.274118 -11.88093,0 -18.499247,6.994427 -18.435284,17.125656 l 0.252538,40" />
                  </svg>
                </button>
                <div class="navbar-new" id="toggle-nav">
                  <ul id="navlinks">
                    <li><a data-text="1" href="#">Become Partner</a></li>
                    <li><a data-text="2" href="#">Become Driver</a></li>
                    
                  </ul>
                </div>
                <div id="bg-circle"></div>
              </div>
            </div>
          </nav> 
        </header>
        
        
        <main>
          <!-- Go to top circle-->
          <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
              <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
            </svg>
          </div>
          <!-- The Slider Background video -->
          <video autoplay muted loop id="slidervideo" class="mt-5">
            <source src="/img/advva driver.mp4" type="video/mp4">
          </video>
          <!-- Slider Content -->
          <div class="section-1 container mt-5 vh-100 d-flex align-items-center justify-content-center" id="smooth-wrapper">
            <div class="row justify-content-center" id="smooth-content">
              <h1 class="text-center mt-5">MONTHLY INCOME</br>DRIVING WITH ADVVA</h1>
              <a class="button1 mt-5 py-2 px-5" href="#sign_up">Become a Driver</a>
            </div>
          </div>
          <!-- Form Section -->
          <div class="section-2 form-banner">
            <div class="container">
              <div class="row justify-content-center justify-content-md-between">
                <div class="section-13 col-md-6 col-12 py-5 mt-5 mt-md-0 pe-md-5 align-self-center text-center text-md-start">
                  <h3 class="text-uppercase">Making money has </br>never been this easy.</h3>
                  <h4 class="gray fw-normal pe-md-5 ps-md-0 px-4">ADVVA is the state-of-the-art and largest advertising firm in the United States and Canada.
                  </h4>
                </div>
                <div class="section-14 col-md-5 col-11 form-margin bg-light p-4 p-md-5 text-center" id="sign_up">
                  <div class="box1 py-4 text-center">
                    <h4>EARN $300 TO $2000</h4>
                    <h4 class="fw-normal m-0">each campaign</h4>
                  </div>
                  <h6 class="my-5">Become a driver in just 3 easy steps</h6>
                  <div id="steps" class="d-flex justify-content-between mb-4">
                    <span id="step-1" class="bar1 activate py-1"></span>
                    <span id="step-2" class="bar1 py-1"></span>
                    <span id="step-3" class="bar1 py-1"></span>
                  </div>
                      
                  <form id="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="carousel slide" data-bs-interval="false" data-bs-ride="carousel" method="POST">
                    <?php if (! empty($formErrors)) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true"></span>
                        </button>
                        <?php
                            foreach($formErrors as $error) {
                                echo $error . '<br/>';
                            }
                        ?>
                    </div>
                    <?php } ?>
                    <?php if (isset($success)) { echo $success; } ?>
                    <div class="carousel-inner">
                      <div id="form1" class="carousel-item active needs-validation" novalidate>
                        <input id="fname" name="fname" type="name" class="form-control my-3 p-3" placeholder="First Name" value="<?php if (isset($fname)) { echo $fname; } ?>" required>
                        <input id="lname" name="lname" type="name" class="form-control my-3 p-3" placeholder="Last Name" value="<?php if (isset($lname)) { echo $lname; } ?>" required>
                        <input id="email" name="email" type="email" class="form-control my-3 p-3" placeholder="Primary Email" value="<?php if (isset($email)) { echo $email; } ?>" required>
                        <input id="tel" name="tel" type="tel" class="form-control my-3 p-3" placeholder="Primary Cell Phone Number" value="<?php if (isset($tel)) { echo $tel; } ?>" required>
                        <button type="button" class="button2 mw-100 w-100 p-3 fw-bold" data-bs-target="#form" data-bs-slide-to="1">Next</button>
                      </div>
                      <div id="form2" class="carousel-item">
                        <input id="car" name="car" type="name" class="form-control my-3 p-3" placeholder="Car Brand/Model/Color" value="<?php if (isset($car)) { echo $car; } ?>" required>
                        <input id="ads" name="ads" type="name" class="form-control my-3 p-3" placeholder="How did you hear about us?" value="<?php if (isset($ads)) { echo $ads; } ?>" required>
                        <textarea name="msg" id="msg" class="form-control my-3 p-3" rows="5" placeholder="Describe your driving routine" required>
                          <?php if (isset($msg)) { echo $msg; } ?>
                        </textarea>
                        <div class="d-flex">
                          <button type="button" class="col btn2-silver p-3 fw-bold" data-bs-target="#form" data-bs-slide-to="0">Previous</button>
                          <button type="button" class="col button2 p-3 fw-bold" data-bs-target="#form" data-bs-slide-to="2">Next</button>
                        </div>
                        
                      </div>
                      <div id="form3" class="carousel-item">
                        <input id="homecity" name="homecity" type="name" class="form-control my-3 p-3" placeholder="Home City" value="<?php if (isset($homecity)) { echo $homecity; } ?>" required>
                        <input id="workcity" name="workcity" type="name" class="form-control my-3 p-3" placeholder="Work City" value="<?php if (isset($workcity)) { echo $workcity; } ?>" required>
                        <input id="averagemiles" name="averagemiles" type="number" class="form-control my-3 p-3" placeholder="Average miles driven each week" value="<?php if (isset($averagemiles)) { echo $averagemiles; } ?>" required>
                        <input id="checkbox" name="checkbox" type="checkbox" required>
                        <label for="checkbox">I allow Advva to contact me via email/phone</label>
                        <div class="d-flex mt-3">
                          <button type="button" class="col btn2-silver p-3 fw-bold" data-bs-target="#form" data-bs-slide-to="1">Previous</button>
                          <button type="submit" value="Send" class="col btn2-green p-3 fw-bold" data-bs-target="#form">Submit</button>
                        </div>
                      </div>
                    </div>
                  </form>
                    
                </div>
              </div>
            </div>
          </div>
          
          <!-- Mobile App Section -->
          <div class="section-3 container mt-121">
            <div class="section-15 row text-center ">
              <h2>Driver’s Mobile App</h2>
              <h4 class="fw-normal">Earn monthly income driving with Advva</h4>
            </div>
            <div class="row mt-5">
              <div class="col-12 col-md-4 section-16">
                <h4 class="fw-normal text-center">
                  <img class="me-1" src="/img/check.svg" alt="Check icon">
                  No membership fee
                </h4>
              </div>
              <div class="col-12 col-md-4 section-17">
                <h4 class="fw-normal text-center">
                  <img class="me-1" src="/img/check.svg" alt="Check icon">
                  Easy to operate
                </h4>
              </div>
              <div class="col-12 col-md-4 section-18">
                <h4 class="fw-normal text-center">
                  <img class="me-1" src="/img/check.svg" alt="Check icon">
                  Lots of ways to save money
                </h4>
              </div>
            </div>
          </div>
          <!-- Full width mobiles app picture-->
          <div class="section-4 section-19 text-center mbapp-pic mx-md-5 px-md-5">
            <img src="/img/Mobile-App.png" alt="Advva Mobile App">
          </div>
          <!-- How it works Section -->
          <div class="section-5 banner1 py-5">
            <div class="section-20 container py-5">
              <div class="row text-center my-5">
                <h2>How It Works</h2>
                <h4 class="fw-normal">Drop us a line. We’ll respond asap.</h4>
              </div>
              <div class="row">
                <div class="col-12 col-md-3 text-center mt-5 mt-md-0">
                  <img class="section-21" src="/img/Driverapplication.svg" alt="Driverapplication"></br>
                  <img class="my-4" src="/img/one.svg" alt="one">
                  <h6>DRIVER APPLICATION</h6>
                  <p class="px-5">Fill out this short and easy form</p>
                </div>
                <div class="col-12 col-md-3 text-center mt-5 mt-md-0">
                  <img class="section-22" src="/img/Mach.svg" alt="Match"></br>
                  <img class="my-4" src="/img/two.svg" alt="two">
                  <h6>MATCH</h6>
                  <p class="px-5">Advva matches you with a specific campaign</p>
                </div>
                <div class="col-12 col-md-3 text-center mt-5 mt-md-0">
                  <img class="section-23" src="/img/wrap.svg" alt="wrap"></br>
                  <img class="my-4" src="/img/three.svg" alt="three">
                  <h6>WRAP</h6>
                  <p class="px-5">Advva notify you and wrap your car for FREE</p>
                </div>
                <div class="col-12 col-md-3 text-center mt-5 mt-md-0">
                  <img class="section-24" src="/img/driveandlearn.svg" alt="drive and earn"></br>
                  <img class="my-4" src="/img/four.svg" alt="four">
                  <h6>DRIVE & EARN</h6>
                  <p class="px-5">Install the Advva APP, become a driver, and get monthly income by direct deposit</p>
                </div>
              </div>
              
            </div>
          </div>
          
          <!-- Gallery Section -->
          <div class="section-6 banner2 py-5">
            <div class="container overflow-hidden my-5">
              <section class="section-gallery gallery">
                <div class="row gallery-row"> 
                  <div class="gallery__image-container">
                    <img src="/img/car1.jpg" alt="" class="gallery__image">
                  </div>
                  <div class="gallery__image-container">
                    <img src="/img/car2.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div>
                  <div class="gallery__image-container">
                    <img src="/img/car3.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div>
                  <div class="gallery__image-container">
                    <img src="/img/car4.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div>
                </div>
                <div class="row gallery-row">
                  <div class="gallery__image-container">
                    <img src="/img/car5.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div>
                  <div class="gallery__image-container">
                    <img src="/img/lux3.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div>
                  <div class="gallery__image-container">
                    <img src="/img/lux.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div>
                  <div class="gallery__image-container">
                    <img src="/img/car1.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div>
                </div>
                <div class="row gallery-row">
                  <div class="gallery__image-container">
                    <img src="/img/car2.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div> 
                  <div class="gallery__image-container">
                    <img src="/img/car3.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div>
                  <div class="gallery__image-container">
                    <img src="/img/car4.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div>
                  <div class="gallery__image-container">
                    <img src="/img/car5.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div>
                </div>
                <div class="row gallery-row">
                  <div class="gallery__image-container">
                    <img src="/img/lux3.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div> 
                  <div class="gallery__image-container">
                    <img src="/img/lux.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div>
                  <div class="gallery__image-container">
                    <img src="/img/car1.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div>
                  <div class="gallery__image-container">
                    <img src="/img/car2.jpg" alt="Advva Gallery Pictures" class="gallery__image">
                  </div>
                </div>
              </section>
              
            </div>
          </div>
         
          <!-- Wrapping Process Section -->
          <div class="overflow-hidden">
            <div class="section-7 container my-5 pt-5 py-md-5">
              <div class="row section-25">
                <h2 class="color1 text-center">WRAPPING PROCESS</h2>
              </div>
              <div class="row mt-5 my-md-5 py-md-5">
                <div class="section-26 col-12 col-md-6 order-2 order-md-1 align-self-center pt-5 pt-md-0 text-center text-md-start">
                  <h4 class="fw-normal">
                    <img class="me-1" src="/img/check.svg" alt="Check icon">
                    No membership fee.
                  </h4>
                  <h4 class="fw-normal">
                    <img class="me-1" src="/img/check.svg" alt="Check icon">
                    Wrap and unwrap for free.
                  </h4>
                  <h4 class="fw-normal">
                    <img class="me-1" src="/img/check.svg" alt="Check icon">
                    Wrap and unwrap by professionals.
                  </h4>
                </div>
                <div class="col-12 col-md-6 order-1 order-md-2">
                  <img class="section-27" src="/img/luxcar.jpg" alt="Advva Lux car" width="100%">
                </div>
              </div>
            </div>
          </div>
          
          <!-- SingUp Banner -->
          <div class="section-8 banner3 text-center my-5 py-5">
            <h4 class="fw-bold white mt-5 p-5">Don’t miss your next opportunity!</h4>
            <a href="#sign_up2"><button class="section-28 button1 mb-5 mt-4 py-2 px-5" href="#sign_up2">Sign up today</button></a>
          </div>
          <!-- Video Section -->
          <div class="section-9 container my-5 py-5">
            <div class="section-29 row text-center mb-5">
              <h2>DRIVE SMARTER, LIVE HAPPIER</h2>
            </div>
            <div class="row">
              <div class="col-12 col-md-7">
                <div class="section-30 card img-fluid">
                  <img class="card-img-top image-cover" src="/img/video1.jpg" alt="advva video 1" height="510px">
                  <div class="card-img-overlay d-flex justify-content-center align-items-center">
                    <a href="#"><img src="/img/play-icon.svg" alt="play icon"></a>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-5">
                <div class="section-31 card img-fluid mt-4 mt-md-0 mb-md-4">
                  <img class="card-img-top image-cover" src="/img/video2.jpg" alt="advva video 1" height="240px">
                  <div class="card-img-overlay d-flex justify-content-center align-items-center">
                    <a href="#"><img src="/img/play-icon.svg" alt="play icon"></a>
                  </div>
                </div>
                <div class="section-32 card img-fluid">
                  <img class="card-img-top image-cover" src="/img/video3.jpg" alt="advva video 1" height="240px">
                  <div class="card-img-overlay d-flex justify-content-center align-items-center">
                    <a href="#"><img src="/img/play-icon.svg" alt="play icon"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- FAQs Section -->
          <div class="section-10 banner4 py-5">
            <div class="container my-5 overflow-hidden">
              <div class="row">
                <div class="col-12 col-md-4 align-self-center ">
                  <h3 class="section-33 black">FAQs</h3>
                </div>
                <div class="section-34 col-12 col-md-8">
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          <h6>Do I have to pay anything to get started?</h6>
                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                          <h6>How much money will I make?</h6>
                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                          <h6>I’ve received emails offering to wrap my car and pay upwards of $400 per week.
                            Are these real opportunities?</h6>
                        </button>
                      </h2>
                      <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingfour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false" aria-controls="flush-collapsefour">
                          <h6>Do I get to pick what brand goes on my car?</h6>
                        </button>
                      </h2>
                      <div id="flush-collapsefour" class="accordion-collapse collapse" aria-labelledby="flush-headingfour" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                      </div>
                    </div>
                  </div>
                  <a class="red fw-bold" href="">Show More</a>
                </div>
              </div>
              
            </div>
          </div>
          <!-- Form Section -->
          <div class="section-11 form-banner2">
            <div class="container">
              <div class="row justify-content-center justify-content-md-between">
                <div class="section-35 col-md-6 col-12 mt-5 mt-md-0 py-5 pe-md-5 align-self-center text-center text-md-start">
                  <h3 class="text-uppercase">Become a Driver Today.</h3>
                  <h4 class="gray fw-normal pe-md-5">ADVVA takes advertising to a new different level by advertising business on individual cars.
                  </h4>
                </div>
                <div class="section-36 col-md-5 col-11 form-margin bg-light p-4 p-md-5 text-center" id="sign_up2">
                  <div class="box1 py-4 text-center">
                    <h4>EARN $300 TO $2000</h4>
                    <h4 class="fw-normal m-0">each campaign</h4>
                  </div>
                  <h6 class="my-5">Become a driver in just 3 easy steps</h6>
                  <div id="stepstwo" class="d-flex justify-content-between mb-4">
                    <span id="step-1" class="bar1 activate py-1"></span>
                    <span id="step-2" class="bar1 py-1"></span>
                    <span id="step-3" class="bar1 py-1"></span>
                  </div>
                      
                  <form id="formtwo" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="carousel slide" data-bs-interval="false" data-bs-ride="carousel" method="POST">
                    <?php if (! empty($formErrors)) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true"></span>
                        </button>
                        <?php
                            foreach($formErrors as $error) {
                                echo $error . '<br/>';
                            }
                        ?>
                    </div>
                    <?php } ?>
                    <?php if (isset($success)) { echo $success; } ?>
                    <div class="carousel-inner">
                      <div id="form21" class="carousel-item active">
                        <input id="fname" name="fname" type="name" class="form-control my-3 p-3" placeholder="First Name" value="<?php if (isset($fname)) { echo $fname; } ?>">
                        <input id="lname" name="lname" type="name" class="form-control my-3 p-3" placeholder="Last Name" value="<?php if (isset($lname)) { echo $lname; } ?>">
                        <input id="email" name="email" type="email" class="form-control my-3 p-3" placeholder="Primary Email" value="<?php if (isset($email)) { echo $email; } ?>">
                        <input id="tel" name="tel" type="tel" class="form-control my-3 p-3" placeholder="Primary Cell Phone Number" value="<?php if (isset($tel)) { echo $tel; } ?>">
                        <button type="button" class="button2 mw-100 w-100 p-3 fw-bold" data-bs-target="#formtwo" data-bs-slide-to="1">Next</button>
                      </div>

                      <div id="form22" class="carousel-item">
                        <input id="car" name="car" type="name" class="form-control my-3 p-3" placeholder="Car Brand/Model/Color" value="<?php if (isset($car)) { echo $car; } ?>">
                        <input id="ads" name="ads" type="name" class="form-control my-3 p-3" placeholder="How did you hear about us?" value="<?php if (isset($ads)) { echo $ads; } ?>">
                        <textarea name="msg" id="msg" class="form-control my-3 p-3" rows="5" placeholder="Describe your driving routine">
                          <?php if (isset($msg)) { echo $msg; } ?>
                        </textarea>
                        <div class="d-flex">
                          <button type="button" class="col btn2-silver p-3 fw-bold" data-bs-target="#formtwo" data-bs-slide-to="0">Previous</button>
                          <button type="button" class="col button2 p-3 fw-bold" data-bs-target="#formtwo" data-bs-slide-to="2">Next</button>
                        </div>
                      </div>

                      <div id="form23" class="carousel-item">
                        <input id="homecity" name="homecity" type="name" class="form-control my-3 p-3" placeholder="Home City" value="<?php if (isset($homecity)) { echo $homecity; } ?>">
                        <input id="workcity" name="workcity" type="name" class="form-control my-3 p-3" placeholder="Work City" value="<?php if (isset($workcity)) { echo $workcity; } ?>">
                        <input id="averagemiles" name="averagemiles" type="number" class="form-control my-3 p-3" placeholder="Average miles driven each week" value="<?php if (isset($averagemiles)) { echo $averagemiles; } ?>">
                        <input id="checkbox" name="checkbox" type="checkbox" required>
                        <label for="checkbox">I allow Advva to contact me via email/phone</label>
                        <div class="d-flex mt-3">
                          <button type="button" class="col btn2-silver p-3 fw-bold" data-bs-target="#formtwo" data-bs-slide-to="1">Previous</button>
                          <button type="submit" value="Send" class="col btn2-green p-3 fw-bold" data-bs-target="#formtwo">Submit</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          
        </main>
        
        <footer>
          <div class="section-12 container mt-md-0 mt-121 py-md-5">
            <div class="section-37 row my-md-4 py-md-4 justify-content-around">
              <div class="col-12 col-md-2 align-self-center text-center text-md-start">
                <img class="section-38" src="/img/Logo.svg" alt="Advva Logo" height="60px">
              </div>
              <div class="col-12 col-md-2 align-self-center text-center text-md-start mt-4 mt-md-0">
                <h6 class="fw-normal">
                  FOLLOW US
                </h6>
                <a href="https://www.instagram.com/advvainc/"><img src="/img/instagram.svg" alt="advva instagram"></a>
                <a href="https://www.facebook.com/Advva-103036491994850"><img src="/img/facebook.svg" alt="advva facebook"></a>
              </div>
              <div class="col-12 col-md-6 align-self-center text-center text-md-start mt-4 mt-md-0">
                <p>Advva, one of the largest advertising companies in the United States and Canada, is wrapping cars now.
                  You can make extra money every month.
                </p>
                <div class="d-md-flex justify-content-md-between mt-4 mt-md-0">
                  <p class=""><b>Advertising & Marketing Agency</b></p>
                  <p>Ⓒ 2022 Advva Inc.</p>
                </div>
                
              </div>
            </div>
            
          </div>
        </footer>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.1/ScrollTrigger.min.js"></script>
  
    <script src="/js/main.js"></script>
</body>
</html>