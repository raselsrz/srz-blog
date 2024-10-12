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
                            <h1>Contact Us</h1>
                            <ul>
                                <li>
                                    <a href="/">Home</a>
                                </li>
                                <li>Contact</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Inne Page Banner Area End Here --> 
        <!-- Contact Area Start Here --> 
        <section class="contact-wrap-layout1">
            <div class="container">
                <div class="row gutters-50">
                    <div class="col-lg-8">
                        <div class="contact-box-layout1">
                            <div class="google-map-area">
                                <div id="googleMap" style="width:100%; height:450px; border-radius: 4px;">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d45430.503926181635!2d88.85664510825639!3d25.786166147884714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e351100277d20b%3A0x11cac2a1674e86be!2sSaidpur!5e1!3m2!1sen!2sbd!4v1728154855094!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                            <div class="contact-way">
                                <div class="contact-list">
                                    <h3 class="item-title">Office Address</h3>
                                    <p>Worem Ipsum Nam nec tellus a odio tincidunt auctor.
                                    Proin gravida nibh vel velit auctor aliquet. Bendum auctor, 
                                    nisi elit conseq aeuat ipsum, nec sagittis sem nibhety.</p>
                                </div>
                                <div class="contact-list">
                                    <h3 class="item-title">Phone</h3>
                                    <p><?php echo get_option('phone',''); ?></p>
                                </div>
                                <div class="contact-list">
                                    <h3 class="item-title">Mail Us</h3>
                                    <p><?php echo get_option('email',''); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 sidebar-widget-area sidebar-break-md">
                        <div class="widget">
                            <div class="widget-newsletter-subscribe-dark">
                                <h3>GET LATEST UPDATES</h3>
                                <p>NEWSLETTER SUBSCRIBE</p>
                                <form class="newsletter-subscribe-form">
                                    <div class="form-group">
                                        <input type="text" placeholder="your e-mail address" class="form-control" name="email"
                                            data-error="E-mail field is required" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group mb-none">
                                        <button type="submit" class="item-btn">SUBSCRIBE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="section-heading heading-dark">
                                <h3 class="item-heading">FOLLOW ME ON</h3>
                            </div>
                            <div class="widget-follow-us-2">
                                <ul>
                                    <li class="single-item"><a href="/<?php echo get_option('facebook',''); ?>"><i class="bx bxl-facebook"></i>
                                    LIKE ME ON</a></li>
                                    <li class="single-item"><a href="/<?php echo get_option('twitter',''); ?>"><i class="bx bxl-twitter"></i>
                                    FOLLOWE ME</a></li>
                                    <li class="single-item"><a href="/<?php echo get_option('instagram',''); ?>"><i class="bx bxl-instagram"></i>
                                    FOLLOW ME</a></li>
                                    <li class="single-item"><a href="/<?php echo get_option('youtube',''); ?>"><i class="bx bxl-youtube"></i>
                                    SUBSCRIBE</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget-ad">
                                <a href="#"><img src="img/figure/figure5.jpg" alt="Ad" class="img-fluid"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Area End Here --> 
        <?php get_footer(); ?>