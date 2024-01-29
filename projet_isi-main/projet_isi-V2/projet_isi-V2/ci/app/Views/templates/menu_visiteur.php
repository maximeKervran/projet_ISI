<style>
#header {
  z-index: 997;
  padding: 15px 0;
  background: rgba(0, 0, 0, 1); /* Add this line to set the background color */
}

#header .logo a {
  color: #fff;
}

#header .logo a span {
  color: #ffc451;
}

/*--------------------------------------------------------------
# Navigation Menu
--------------------------------------------------------------*/
/**
* Desktop Navigation 
*/
.navbar a,
.navbar a:focus {
  padding: 10px 0 10px 30px;
  font-size: 15px;
  font-weight: 600;
  color: #fff;
  white-space: nowrap;
  transition: 0.3s;
}

.navbar a i,
.navbar a:focus i {
  font-size: 12px;
  line-height: 0;
  margin-left: 5px;
}

@media (max-width: 991px) {
  .navbar ul {
    display: flex !important; /* Add !important to override the 'display: none' property */
  }
}

.navbar-mobile {
  background: rgba(0, 0, 0, 0.9); /* Add this line to set the background color */
}



</style>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="<?php echo base_url();?>">spacescape</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <!--<li><a class="nav-link scrollto" href="<?php echo base_url();?>index.php/compte/lister">compte</a></li>-->
          <li><a class="nav-link scrollto" href="<?php echo base_url();?>index.php/actualite/afficher/1">Actualités</a></li>
           <!--<li><a class="nav-link scrollto " href="<?php echo base_url();?>index.php/compte/creer">Inscription</a></li>-->
          <li><a class="nav-link scrollto" href="<?php echo base_url();?>index.php/compte/connecter">Connexion</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="<?php echo base_url();?>index.php/scenario/jouer" class="get-started-btn scrollto" >JOUER</a>

    </div>
  </header><!-- End Header -->
  </br>
    </br>
    </br>
    </br>
    </br>
    </br>












