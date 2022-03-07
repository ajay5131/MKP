<!DOCTYPE html>
<html lang="en">
  <head>
    <title>MeetKeyPeople - Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
    <!-- External Css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- External Js   -->
    <script type="text/javascript" src="assets/js/script.js"></script>
    <!-- Font Awesome Cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap Datepicker css js  -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  </head>
  <body>
    <header id="header">
      <nav class="navbar navbar-expand-lg navbar-light" id="search-inputs">
        <a class="navbar-brand" href="#">
          <img src="assets/images/logo-1.png" class="desktop-logo">
        </a>
        <!--  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> -->
        <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
          <div class="row">
            <div class="col-sm-12 col-md-12 text-right mb-15">
              <a href="#" class="log-out-btn">Log Out</a>
            </div>
          </div>
          <div class="row ml-auto" id="search-panel">
            <div class="col-sm-12 col-md-12 col-lg-4 pr-0 pl-0">
              <select class="form-select lang-select-1" aria-label="Default select example">
                <option selected>Category</option>
                <option value="1"></option>
              </select>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 pr-0 pl-0">
              <input class="search-input-control keyword-search" type="text" placeholder="Keyword Search" aria-label="Search">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 search-control pr-0 pl-0">
              <span class="in-text">in</span>
              <input class="search-input-control search-btn-control" type="search" placeholder="Location" aria-label="Search">
              <button class="btn search-icon-btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </div>
          </div>
        </div>
      </nav>
      <!-- <nav class="navbar navbar-expand-md navbar-light navbar-bg-white"><a class="navbar-brand" href="#"><img src="assets/images/logo-1.png"></a><div class="collapse navbar-collapse" ><ul class="navbar-nav ml-auto"><li class="nav-item navItem"><a class="nav-link button" href="#">Regsiter</a></li><li class="nav-item navItem"><a class="nav-link button" href="#">Login</a></li><li class="nav-item navItem"><select class="form-select lang-select" aria-label="Default select example"><option selected>English</option><option value="1">French</option></select></li></ul></div></nav> -->
      <nav class="navbar navbar-expand-md navbar-light">
        <div class="">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item navItem">
              <h5 class="setting-title">Meet the right people in the right place. Reach your goals, MEET KEY PEOPLE ! </h5>
            </li>
          </ul>
        </div>
      </nav>
      <nav class="navbar navbar-expand-md navbar-light navbar-bg-white">
        <a class="navbar-brand" href="#">
          <img src="assets/images/logo-1.png" class="mobile-logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item navItem">
              <a class="nav-link button" href="#">Home</a>
            </li>
            <li class="nav-item navItem">
              <a class="nav-link button" href="#">Feed</a>
            </li>
            <li class="nav-item navItem">
              <div class="dropdown show">
                <a class="btn dropdown-toggle nav-link button" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> My Activity <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="#">Notification</a>
                  <a class="dropdown-item" href="#">My Agenda</a>
                </div>
              </div>
            </li>
            <li class="nav-item navItem">
              <a class="nav-link button" href="#">My Profile</a>
            </li>
            <li class="nav-item navItem">
              <a class="nav-link button" href="#">My Projects</a>
            </li>
            <li class="nav-item navItem">
              <div class="dropdown show">
                <a class="btn dropdown-toggle nav-link button" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> My Key List <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="#">Key List</a>
                  <a class="dropdown-item" href="#">Key People</a>
                </div>
              </div>
            </li>
            <li class="nav-item navItem">
              <a class="nav-link button" href="#">Messages</a>
            </li>
            <li class="nav-item navItem">
              <a class="nav-link button" href="#">Setting</a>
            </li>
          </ul>
        </div>
      </nav>
  </header>

<section id="posted-project-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-right add-project-area">
              <!--  <span class="add-project-txt-title">Add Project</span>
               <div><i class="fa fa-plus plus-icon" aria-hidden="true"></i></div> -->
            </div>
        </div>
         <div class="row pt-3">

          <div class="col-md-3">
          <div class="card project-card">
            <div class="card-img card-people">
                <img class="card-img-peopel" src="https://www.meetkeypeople.com/jobsportal/images/projects/1632900334.png">
            </div>
          <div class="card-body">
            <p class="card-text-txt">Short Film</p>
            <p class="project-name">Test Project</p>
            <div class="card-item">
                <p class="location-details">
                 <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span class="span-1">Nashik, India</span></p>
            </div> 
          </div>
          </div>
          </div>

           <div class="col-md-3">
          <div class="card project-card">
            <div class="card-img card-people">
                <img class="card-img-peopel" src="https://www.meetkeypeople.com/jobsportal/images/projects/1631869961.png">
            </div>
          <div class="card-body">
            <p class="card-text-txt">Short Film</p>
            <p class="project-name">Test Project</p>
            <div class="card-item">
                <p class="location-details">
                 <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span class="span-1">Nashik, India</span></p>
            </div> 
          </div>
          </div>
          </div>

           <div class="col-md-3">
          <div class="card project-card">
            <div class="card-img card-people">
                <img class="card-img-peopel" src="https://www.meetkeypeople.com/jobsportal/images/projects/1631076332.png">
            </div>
          <div class="card-body">
            <p class="card-text-txt">Short Film</p>
            <p class="project-name">Test Project</p>
            <div class="card-item">
                <p class="location-details">
                 <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span class="span-1">Nashik, India</span></p>
            </div> 
          </div>
          </div>
          </div>

           <div class="col-md-3">
          <div class="card project-card">
            <div class="card-img card-people">
                <img class="card-img-peopel" src="https://www.meetkeypeople.com/jobsportal/images/projects/1632900334.png">
            </div>
          <div class="card-body">
            <p class="card-text-txt">Short Film</p>
            <p class="project-name">Test Project</p>
            <div class="card-item">
                <p class="location-details">
                 <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span class="span-1">Nashik, India</span></p>
            </div> 
          </div>
          </div>
          </div>


           <div class="col-md-3">
          <div class="card project-card">
            <div class="card-img card-people">
                <img class="card-img-peopel" src="https://www.meetkeypeople.com/jobsportal/images/projects/1632900334.png">
            </div>
          <div class="card-body">
            <p class="card-text-txt">Short Film</p>
            <p class="project-name">Test Project</p>
            <div class="card-item">
                <p class="location-details">
                 <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span class="span-1">Nashik, India</span></p>
            </div> 
          </div>
          </div>
          </div>

           <div class="col-md-3">
          <div class="card project-card">
            <div class="card-img card-people">
                <img class="card-img-peopel" src="https://www.meetkeypeople.com/jobsportal/images/projects/1632900334.png">
            </div>
          <div class="card-body">
            <p class="card-text-txt">Short Film</p>
            <p class="project-name">Test Project</p>
            <div class="card-item">
                <p class="location-details">
                 <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span class="span-1">Nashik, India</span></p>
            </div> 
          </div>
          </div>
          </div>

           <div class="col-md-3">
          <div class="card project-card">
            <div class="card-img card-people">
                <img class="card-img-peopel" src="https://www.meetkeypeople.com/jobsportal/images/projects/1632900334.png">
            </div>
          <div class="card-body">
            <p class="card-text-txt">Short Film</p>
            <p class="project-name">Test Project</p>
            <div class="card-item">
                <p class="location-details">
                 <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span class="span-1">Nashik, India</span></p>
            </div> 
          </div>
          </div>
          </div>

           <div class="col-md-3">
          <div class="card project-card">
            <div class="card-img card-people">
                <img class="card-img-peopel" src="https://www.meetkeypeople.com/jobsportal/images/projects/1632900334.png">
            </div>
          <div class="card-body">
            <p class="card-text-txt">Short Film</p>
            <p class="project-name">Test Project</p>
            <div class="card-item">
                <p class="location-details">
                 <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span class="span-1">Nashik, India</span></p>
            </div> 
          </div>
          </div>
          </div>


         
         
        
         
          </div>
          </div>
        </div>
    </div>
</section>
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h4 class="footer-title">Quick Links</h4>
            <ul class="list-item-footer">
              <li>
                <a href="#">Home</a>
              </li>
              <li>
                <a href="#">About us</a>
              </li>
              <li>
                <a href="#">Contact Us</a>
              </li>
              <li>
                <a href="#">Term and Conditions</a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <h4 class="footer-title">Quick Links</h4>
            <ul class="list-item-footer">
              <li>
                <a href="#">Privacy Policy</a>
              </li>
              <li>
                <a href="#">Terms of Service</a>
              </li>
            </ul>
          </div>
          <div class="col-md-4 contact-bg-color">
            <h4 class="footer-title">Contact Us</h4>
            <div class="contact-details">
              <p>
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span class="contact-txt">503, Caledonian road, London N7 9RN</span>
              </p>
              <p>
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                <span class="contact-txt">info@meetkeypeople.com</span>
              </p>
              <p>
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span class="contact-txt">+447597537747</span>
              </p>
            </div>
            <div class="social-media-links">
              <ul class="list-item-social-m">
                <li>
                  <a href="#">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="footer-bottom-strip">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <p>Copyright © 2021 Meet Key People LLC. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-right m-align">
              <img src="https://www.meetkeypeople.com/images/payment-icons.png">
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
    <script type="text/javascript" src="assets/js/swiper-slider.js"></script>
    <script type="text/javascript" src="assets/js/custom.js"></script>
  </body>
</html>