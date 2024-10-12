<?php

$getParentCategories = getParentCategories();

?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Blogxer | Home 2</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.png">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="/assets/css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="/assets/css/fontawesome-all.min.css">
    <!-- Flat Icon CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/assets/css/flaticon.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <!-- Popup CSS -->
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="/assets/css/meanmenu.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="/assets/js/vendor/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/js/vendor/owl.theme.default.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- Modernize js -->
    <script src="/assets/js/modernizr-3.6.0.min.js"></script>
</head>

<body class="sticky-header">



    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->
    <!-- Preloader Start Here -->
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper">

    
        <!-- Add your site or application content here -->
        <!-- Header Area Start Here -->
        <header class="has-mobile-menu">
            <div id="header-middlebar" class="pt--29 pb--29 bg--dark">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-4">
                            <div class="header-action-items">
                            <ul>

                                    <li class="item-social-layout2"><a href="#" target="_blank" target="_blank" ><i class='bx bxl-facebook' ></i></a></li>
                                        <li class="item-social-layout2"><a href="#" target="_blank"><i class='bx bxl-instagram-alt' ></i></a></li>
                                        <li class="item-social-layout2"><a href="#" target="_blank"><i class='bx bxl-twitter' ></i></a></li>
                                        <li class="item-social-layout2"><a href="#" target="_blank"><i class='bx bxl-youtube' ></i></a></li>
                                        <li class="item-social-layout2"><a href="#" target="_blank"><i class='bx bxl-linkedin-square' ></i></a></li>
                                    
                                </ul>

                            </div>
                        </div>
                        <div class="col-lg-4 d-flex justify-content-center">
                            <div class="logo-area">
                                <a href="/" class="temp-logo" id="temp-logo">
                                    <img src="<?php echo get_option('logo',''); ?>" alt="logo" class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex justify-content-end">
                            <div class="header-action-items">
                                <ul>
                                    <li class="header-search-box divider-style-border">
                                        <a href="#header-search" title="Search">
                                        <i class='bx bx-search' ></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="rt-sticky-placeholder"></div>
            <div id="header-menu" class="header-menu menu-layout1 bg--light">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <nav id="dropdown" class="template-main-menu">
                                <ul>
                                    <li class="hide-on-mobile-menu">
                                        <a href="/">HOME</a>
                                    </li>
                                    <li>
                                        <a href="/about">ABOUT</a>
                                    </li>
                                    <li>
                                        <a href="#">CATEGORIES</a>
                                        <ul class="dropdown-menu-col-1">
                                            <?php foreach($getParentCategories as $getParentCategory){ ?>
                                            <li>
                                                <a href="/category/<?php echo $getParentCategory->value; ?>"><?php echo $getParentCategory->name; ?></a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="/contact">CONTACT</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <!-- Header Area End Here -->