<?php

$page = isset($_GET['page'])?$_GET['page']:1;
$page= max(1,$page);

$limit= $_ENV['per_page'];
$offset= ($page-1)*$limit;

$total_posts= db()::table('srz_cpt')
->rightJoin('cat_post_realtion', 'srz_cpt.ID', '=', 'cat_post_realtion.post_id')
->where('cat_post_realtion.cat_id', '=', $category->ID)
->where([
    'srz_cpt.post_type' =>'posts',
    'srz_cpt.status' => 1
])
 ->count();
 
$total_pages= ceil($total_posts/$limit);


$posts= db()::table('srz_cpt')
->rightJoin('cat_post_realtion', 'srz_cpt.ID', '=', 'cat_post_realtion.post_id')
->where('cat_post_realtion.cat_id', '=', $category->ID)
->where([
    'srz_cpt.post_type' =>'posts',
    'srz_cpt.status' => 1
])

->limit($limit)
->offset($offset)
->orderBy('srz_cpt.ID','desc')
->get();


get_header(); ?>
<a href="#wrapper" data-type="section-switch" class="scrollup back-top">
        <i class="bx bx-up-arrow-alt"></i>
    </a>
<section class="inner-page-banner bg-common">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumbs-area">
                            <h1>Category: "<?php echo $category->name; ?>"</h1>
                            <ul>
                                <li>
                                    <a href="/">Home</a>
                                </li>
                                <li><?php echo $category->name; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Blog Area Start Here -->
        <section class="blog-wrap-layout22">
            <div class="container">
                <div class="row gutters-50">
                    <div class="col-xl-9 col-lg-8">
                        <?php foreach($posts as $post){

                            $selected_cats = db()::table('cat_post_realtion')->where([
                                'cat_post_realtion.post_id' => $post->ID,
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

                            $img = get_field('img',$post->ID, 'posts','');

                        ?>

                        <div class="blog-box-layout4">
                            <div class="item-img">
                                <a href="/<?php echo $post->slug; ?>"><img src="<?php echo $img ?>" alt="blog"></a>
                            </div>
                            <div class="item-content">
                                <ul class="entry-meta meta-color-dark">
                                <li><i class='bx bx-purchase-tag' ></i><?php echo $catHtml; ?></li>
                                        <li><i class='bx bxs-calendar' ></i><?php echo date('d M Y',strtotime($post->pub_date));?></li>
                                        <li><i class='bx bx-time-five' ></i> 5 Mins Read</li>
                                </ul>
                                <h3 class="item-title"><a href="/<?php echo $post->slug; ?>"><?php echo $post->title; ?></a></h3>
                                <p><?php echo $post->description; ?></p>
                                <div class="action-area">
                                    <a href="/<?php echo $post->slug; ?>" class="item-btn">READ MORE<i class='bx bx-right-arrow-alt' ></i></a>
                                    <ul class="response-area">
                                        <li><a href="#"><i class='bx bx-heart' ></i>12</a></li>
                                        <li><a href="#"><i class='bx bx-message-rounded-dots' ></i>02</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <?php } ?>

                         <div class="pagination-layout1">

                         <?php if($page > 1){ ?>
                            <?php } ?>
                            <ul>
                                <?php for($i=1; $i<=$total_pages; $i++){ ?>
                                <li class="<?php echo $i == $page?'active':''; ?>"><a href="/category/<?php echo $category->value; ?>?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        


                    </div>

                    <?php get_sidebar(); ?>
                </div>
            </div>
        </section>
        <!-- Blog Area End Here -->

        <?php get_footer(); ?>

