<?php get_header(); ?>

<a href="#wrapper" data-type="section-switch" class="scrollup back-top">
        <i class="bx bx-up-arrow-alt"></i>
    </a>
        <!-- Inne Page Banner Area Start Here -->
        <section class="inner-page-banner bg-common">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumbs-area">
                            <h1>About Me</h1>
                            <ul>
                                <li>
                                    <a href="/">Home</a>
                                </li>
                                <li>About</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Inne Page Banner Area End Here --> 
        <!-- About Area Start Here -->
        <section class="about-wrap-layout1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-box-layout2">
                            <div class="item-subtitle">Hello!</div>
                            <h2 class="item-title"><span>I’m</span> Rasel Srz </h2>
                            <p>Worem Ipsum Nam nec tellus a odio tincidunt auctor. Proin 
                                gravida nibh vel velit auctor aliquet. Bendum auctor, 
                                nisi elit conseq aeuat ipsum, nec sagittis sem nibhety.</p>
                            <p>Worem Ipsum Nam nec tellus a odio tincidunt auctor. 
                                Proin gravida nibh vel velit auctWorem Ipsum Nam nec 
                                tellus a odio tincidunt auctor. Proin gravida nibh vel 
                                velit auctor aliquet.</p>
                            <ul class="item-social">


                                <li><a href="/<?php get_option('facebook',''); ?>">
                                    <i class="bx bxl-facebook"></i></a></li>
                                <li><a href="/<?php get_option('twitter',''); ?>">
                                    <i class="bx bxl-twitter"></i></a></li>
                                <li><a href="/<?php get_option('instagram',''); ?>">
                                    <i class="bx bxl-instagram"></i></a></li>
                                <li><a href="/<?php get_option('linkedin',''); ?>">
                                    <i class="bx bxl-linkedin"></i></a></li>
                                <li><a href="/<?php get_option('pinterest',''); ?>">
                                    <i class="bx bxl-pinterest"></i></a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-box-layout3">
                            <img src="/assets/uploads/c202f717b6ef1e6a7f5fe6a8783351bdc78727b3d64860dce5d212c2ea2f5b1f.png" alt="about">
                            <a class="play-btn popup-youtube" href="https://www.youtube.com/embed/<?php get_option('about_video',''); ?>">
                                <i class="bx bx-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Area End Here -->
        <!-- Progress Bar Start Here -->
        <section class="progress-wrap-layout1">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="progress-box-layout1">
                            <div class="item-icon">
                                <i class="bx bx-user"></i>
                            </div>
                            <div class="counter counter-text"><?php echo db()::table('srz_cpt')->where(['post_type' => 'posts'])->count(); ?></div>
                            <h3 class="item-title">Total Posts</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="progress-box-layout1">
                            <div class="item-icon">
                                <i class="bx bx-heart"></i>
                            </div>
                            <div class="counter counter-text"><?php echo db()::table('comments')->count(); ?></div>
                            <h3 class="item-title">Comment</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="progress-box-layout1">
                            <div class="item-icon">
                            <i class='bx bx-show'></i>
                            </div>
                            <div class="counter counter-text"><?php echo total_views(); ?></div>
                            <h3 class="item-title">Total Views</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Progress Bar End Here -->
        <!-- News Letter Start Here -->
        <section class="newsletter-wrap-layout1">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-7">
                        <div class="newsletter-box-layout1">
                            <h3 class="item-title">SUBSCRIBE TO NEWSLETTER</h3>
                            <div class="item-subtitle">Latest News &amp; Updates</div>
                            <form class="newsletter-subscribe-form">
                                <div class="row gutters-10 d-flex align-items-center">
                                    <div class="col-lg-9 form-group">
                                        <input type="email" placeholder="Enter your e-mail" class="form-control" name="email">
                                    </div>
                                    <div class="col-lg-3 form-group">
                                        <button class="item-btn">SUBSCRIBE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- News Letter End Here -->
        
        <?php get_footer(); ?>