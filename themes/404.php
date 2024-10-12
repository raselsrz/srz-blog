<?php get_header(); ?>
        <!-- Error Page Area Start Here -->
        <section class="error-page-wrap">
            <div class="container">
                <div class="error-page-box">
                    <div class="error-logo">
                        <img src="/assets/img/404.png" alt="error">
                    </div>
                    <h2 class="error-title">Ops! Something Wrong!</h2>
                    <p>We're sorry, but we can't find the page you were looking for. 
                    It's probably some thing we've done wrong but now we know about 
                    it and we'll try to fix it. In the meantime, try one of these options:</p>
                    <div class="error-newsletter">
                        <form action="/search">
                        <div class="input-group stylish-input-group">
                            <input type="text" name="q" class="form-control" placeholder="SEARCH KEYWORDS . . .">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <i class='bx bx-search' ></i>
                                </button>
                            </span>
                        </div>
                        </form>
                        
                    </div>
                    <a href="/" class="item-btn">GO TO HOME</a>
                </div>
            </div>
        </section>
        <!-- Error Page Area End Here -->
        <?php get_footer(); ?>