<?php



$cats = db()::table('srz_cats')->where([
    'type' => 'movies',
])->orderBy('ID','desc')->get();


$featured_posts = featured_post();

?>

<div class="col-xl-3 col-lg-4 sidebar-widget-area sidebar-break-md">
                            <div class="widget">
                                <div class="section-heading heading-dark">
                                    <h3 class="item-heading">ABOUT ME</h3>
                                </div>
                                <div class="widget-about">
                                    <figure class="author-figure"><img src="/assets/uploads/c202f717b6ef1e6a7f5fe6a8783351bdc78727b3d64860dce5d212c2ea2f5b1f.png" alt="about"></figure>
                                    <p>Fusce mauris auctor ollicituder teary iner hendrerit risusey aeenean rauctor
                                        pibus
                                        doloer.</p>
                                </div>
                            </div>

    

                            <!-- <div class="widget">
                                <div class="widget-ad">
                                    <a href="#"><img src="/assets/img/figure/figure1.jpg" alt="Ad" class="img-fluid"></a>
                                </div>
                            </div> -->

                            <div class="widget">
                                <div class="section-heading heading-dark">
                                    <h3 class="item-heading">CATEGORIES</h3>
                                </div>
                                <div class="widget-categories">
                                    <ul>
                                        <?php foreach($cats as $cat){
                                            
                                            $total_count = db()::table('cat_post_realtion')->where(
                                                ['cat_id' =>$cat->ID ]
                                            )->count();
                                            if($total_count <= 0){continue;}

                                            ?>
                                        <li>
                                            <a href="/category/<?php echo $cat->value; ?>"><?php echo $cat->name; ?>
                                                <span>(<?php echo $total_count; ?>)</span>
                                            </a>
                                        </li>

                                        <?php } ?>

                                    </ul>
                                </div>
                            </div>


                            <div class="widget">
                                <div class="section-heading heading-dark">
                                    <h3 class="item-heading">FEATURED ARTICLE</h3>
                                </div>
                                <div class="widget-featured-feed">
                                    <div class="rc-carousel dot-control-layout1" data-loop="true" data-items="3"
                                        data-margin="5" data-autoplay="false" data-autoplay-timeout="5000"
                                        data-smart-speed="1000" data-dots="true" data-nav="false" data-nav-speed="false"
                                        data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true"
                                        data-r-x-medium="1" data-r-x-medium-nav="false" data-r-x-medium-dots="true"
                                        data-r-small="1" data-r-small-nav="false" data-r-small-dots="true"
                                        data-r-medium="1" data-r-medium-nav="false" data-r-medium-dots="true"
                                        data-r-large="1" data-r-large-nav="false" data-r-large-dots="true"
                                        data-r-extra-large="1" data-r-extra-large-nav="false" data-r-extra-large-dots="true">
                                        
                                        <?php foreach($featured_posts as $post){ 
                                            

                                            $img = get_field('img',$post->ID, 'posts','');
                                            
                                            
                                            ?>





                                        <div class="featured-box-layout1">
                                            <div class="item-img">
                                                <img src="<?php echo $img; ?>" alt="Brand" class="img-fluid">
                                            </div>
                                            <div class="item-content">
                                            <li><i class='bx bxs-calendar' ></i><?php echo date('M d, Y',strtotime($post->pub_date)); ?></li>
                                            <h5 class="item-title
                                                "><a href="/post/<?php echo $post->slug; ?>"><?php echo $post->title; ?></a></h5>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    


                                    </div>
                                </div>
                            </div>

                        </div>