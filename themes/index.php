<?php

$type= "posts";
$name= 'posts';
global $title;
$title = $name;

$page = isset($_GET['page'])?$_GET['page']:1;
$page= max(1,$page);
$limit= $_ENV['per_page'];
$offset= ($page-1)*$limit;
$total_posts= db()::table('srz_cpt')->where([
    'post_type' =>$type,
    'status' => 1
    ])->count();

$total_pages= ceil($total_posts/$limit);



$posts = db()::table('srz_cpt')->where([
    'post_type' => $type,
    'status' => 1
])->limit($limit)->offset($offset)->orderBy('ID','desc')->get();



$getTrendingPosts = getTrendingposts();

get_header(); ?>
        <div class="box-layout-child bg-white">

        <a href="#wrapper" data-type="section-switch" class="scrollup back-top">
        <i class="bx bx-up-arrow-alt"></i>
    </a>

            <!-- Slider Area Start Here -->
            <section class="slider-wrap-layout1">
                <div class="container">
                    <div class="rc-carousel nav-control-layout1" data-loop="true" data-items="30" data-margin="30"
                        data-autoplay="true" data-autoplay-timeout="5000" data-smart-speed="2000" data-dots="false"
                        data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="true"
                        data-r-x-small-dots="false" data-r-x-medium="1" data-r-x-medium-nav="true" data-r-x-medium-dots="false"
                        data-r-small="1" data-r-small-nav="true" data-r-small-dots="false" data-r-medium="1"
                        data-r-medium-nav="true" data-r-medium-dots="false" data-r-large="1" data-r-large-nav="true"
                        data-r-large-dots="false" data-r-extra-large="1" data-r-extra-large-nav="true"
                        data-r-extra-large-dots="false">

                        <?php foreach($getTrendingPosts as $getTrendingPost){

                            $selected_cats = db()::table('cat_post_realtion')->where([
                                'cat_post_realtion.post_id' => $getTrendingPost->ID,
                                'cat_post_realtion.type' => 'posts'
                            ])
                            ->join('srz_cats', 'cat_post_realtion.cat_id', '=', 'srz_cats.ID')
                            ->select('srz_cats.*')
                            ->get();

                            $selected_catsIds= [];
                            foreach($selected_cats as  $cat){
                                $selected_catsIds[] = $cat->ID;
                            }
                            $catText ='';

                            if(count($selected_catsIds) == 0){
                                $catText= 'Uncategorized';
                            }else{
                                $catText= '';
                                foreach($selected_cats as $cat){
                                $catText.= $cat->name.', ';
                                }
                                $catText= rtrim($catText,', ');
                            } 

                            $catHtml= '';

                            if(count($selected_catsIds) == 0){
                                $catHtml= 'Uncategorized';
                            }else{
                                $catHtml= '';
                                foreach($selected_cats as $cat){
                                    $catHtml .= '<a href="/category/'.$cat->value.'" class="cat" rel="tag">'.$cat->name.'<span><i class="bx bxs-chevron-right"></i></span></a> ';
                                }

                                $catHtml= rtrim($catHtml,', ');
                            }
                        
                        
                        $img = get_field('img',$getTrendingPost->ID, 'posts','');
                        
                        ?>

                        <div class="slider-box-layout1">
                            <div class="item-img">
                                <img src="<?php echo  $img; ?>" alt="slider">
                            </div>
                            <div class="item-content">
                                <ul class="entry-meta meta-color-dark">
                                    <li><i class='bx bx-purchase-tag' ></i><?php echo $catHtml; ?></li>
                                    <li><i class='bx bxs-calendar' ></i><?php echo date('M d, Y',strtotime($getTrendingPost->pub_date)); ?></li>
                                    <li><i class='bx bx-user' ></i> BY <a href="#">Mark Willy</a></li>
                                    <li><i class='bx bx-time-five' ></i> 5 Mins Read</li>
                                </ul>
                                <h2 class="item-title"><a href="/<?php echo $getTrendingPost->slug; ?>"><?php echo $getTrendingPost->title; ?></a></h2>
                            </div>
                        </div>

                        <!-- <div class="slider-box-layout1">
                            <div class="item-img">
                                <img src="/assets/img/slider/slide1-1.jpg" alt="slider">
                            </div>
                            <div class="item-content">
                                <ul class="entry-meta meta-color-dark">
                                    <li><i class='bx bx-purchase-tag' ></i><?php //echo $catHtml; ?></li>
                                    <li><i class='bx bxs-calendar' ></i>Jan 19, 2019</li>
                                    <li><i class='bx bx-user' ></i> BY <a href="#">Mark Willy</a></li>
                                    <li><i class='bx bx-time-five' ></i> 5 Mins Read</li>
                                </ul>
                                <h2 class="item-title"><a href="/single">Business Partners Work at Office 2019</a></h2>
                            </div>
                        </div> -->
                        
                        <?php } ?>


                    </div>
                </div>
            </section>
            <!-- Slider Area End Here -->
            

    <div style=" height: 5vh; " ></div>

            <!-- Blog Area Start Here -->
            <section class="blog-wrap-layout2">
                <div class="container">
                    <div class="row gutters-40">
                        <div class="col-xl-9 col-lg-8">

                            <div class="row gutters-40">

                            <?php foreach($posts as $post){ 
                                
                                include 'themes/parts/post.php';  
                                
                                
                                } ?>


                            </div>
                            
                            <?php if($total_pages > 1){ ?>

                            <div class="pagination-layout1">
                                <ul>
                                <?php 
                                for($i=1;$i<=$total_pages;$i++){
                                    ?>
                                    <li class="<?php echo $page==$i?'active':'';?>"  ><a href="/?page=<?php echo $i;?>"><?php echo $i;?></a></li>

                                    <?php } ?>
                                </ul>
                            </div>

                            <?php } ?>
                        </div>
                        
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </section>
            <!-- Blog Area End Here -->
            <!-- Instagram Start Here -->
            <section class="instagram-feed-wrap">
                <div class="container">
                    <div class="instagram-feed-title"><a href="#">BLOGXER @ INSTAGRAM</a></div>
                    <div class="row gutters-10">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                            <div class="instagram-feed-figure">
                                <a href="#"><img src="assets/img/social_figure1.jpg" alt="Instagram"></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                            <div class="instagram-feed-figure">
                                <a href="#"><img src="/assets/img/social-figure11.jpg" alt="Instagram"></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                            <div class="instagram-feed-figure">
                                <a href="#"><img src="/assets/img/social-figure12.jpg" alt="Instagram"></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                            <div class="instagram-feed-figure">
                                <a href="#"><img src="/assets/img/social-figure13.jpg" alt="Instagram"></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                            <div class="instagram-feed-figure">
                                <a href="#"><img src="/assets/img/social-figure14.jpg" alt="Instagram"></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                            <div class="instagram-feed-figure">
                                <a href="#"><img src="/assets/img/social-figure15.jpg" alt="Instagram"></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                            <div class="instagram-feed-figure">
                                <a href="#"><img src="/assets/img/social-figure16.jpg" alt="Instagram"></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                            <div class="instagram-feed-figure">
                                <a href="#"><img src="/assets/img/social-figure17.jpg" alt="Instagram"></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                            <div class="instagram-feed-figure">
                                <a href="#"><img src="/assets/img/social-figure18.jpg" alt="Instagram"></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                            <div class="instagram-feed-figure">
                                <a href="#"><img src="/assets/img/social-figure19.jpg" alt="Instagram"></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                            <div class="instagram-feed-figure">
                                <a href="#"><img src="/assets/img/social-figure20.jpg" alt="Instagram"></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                            <div class="instagram-feed-figure">
                                <a href="#"><img src="/assets/img/social-figure21.jpg" alt="Instagram"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Instagram End Here -->
        </div>
        
        <?php get_footer(); ?>