
<?php


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





  $related_posts = db()::table('srz_cpt') 
  ->rightJoin('cat_post_realtion', 'srz_cpt.ID', '=', 'cat_post_realtion.post_id')
  ->whereIn('cat_post_realtion.cat_id', $selected_catsIds)
  ->where('srz_cpt.ID', '!=', $post->ID)
  ->where([
      'srz_cpt.post_type' => 'posts',
      'srz_cpt.status' => 1
  ])
  ->limit(4)
  ->orderBy('srz_cpt.ID', 'desc')
  ->get();



get_header(); ?>
<a href="#wrapper" data-type="section-switch" class="scrollup back-top">
        <i class="bx bx-up-arrow-alt"></i>
    </a>
        <!-- Single Blog Banner Start Here -->
        <section class="single-blog-wrap-layout3">
            <div class="container">
                <div class="row gutters-50">
                    <div class="col-lg-8">
                        <div class="single-blog-box-layout3">
                            <div class="blog-banner">
                                <img src="<?php echo  $img; ?>" alt="blog">
                            </div>
                            <div class="single-blog-content">
                                <div class="blog-entry-content">
                                <ul class="entry-meta meta-color-dark">
                                        <li><i class='bx bx-purchase-tag' ></i><?php echo $catHtml; ?></li>
                                        <li><i class='bx bxs-calendar' ></i><?php echo date('d M Y',strtotime($post->pub_date));?></li>
                                        <li><i class='bx bx-user' ></i>BY <a href="#">Admi</a></li>
                                        <!-- <li><i class='bx bx-time-five' ></i> 5 Mins Read</li> -->
                                    </ul>
                                    <h2 class="item-title"><?php echo $post->title; ?></h2>
                                    <ul class="item-social">

                                    <!-- SHARE socile  -->
                                     <li>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post->slug; ?>" class="facebook" target="_blank">
                                            <i class='bx bxl-facebook' ></i>SHARE
                                        </a>
                                     </li>
                                        <li>
                                            <a href="https://twitter.com/intent/tweet?url=<?php echo $post->slug; ?>" class="twitter" target="_blank">
                                                <i class='bx bxl-twitter' ></i>SHARE
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://plus.google.com/share?url=<?php echo $post->slug; ?>" class="g-plus" target="_blank">
                                                <i class='bx bxl-google' ></i>SHARE
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://pinterest.com/pin/create/button/?url=<?php echo $post->slug; ?>" class="pinterst" target="_blank">
                                                <i class='bx bxl-pinterest-alt' ></i>PIN IT
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="load-more">
                                                <i class='bx bx-plus
                                                ' ></i>MORE
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="response-area">
                                        <li><a href="#"><i class='bx bx-message-rounded-dots' ></i>02</a></li>
                                        <li><a href="#"><i class='bx bx-show' ></i>
                                        <?php echo get_field('views',$post->ID, 'posts',''); ?>

                                    </a></li>
                                    </ul>
                                </div>
                                <div class="blog-details">
                                    <p><?php echo $post->description; ?></p>
                                </div>
                                
                                <div class="related-item">
                                    <div class="section-heading heading-dark">
                                        <h3 class="item-heading">YOU MAY ALSO LIKE</h3>
                                    </div>
                                    <div class="rc-carousel dot-control-layout2" data-loop="true" data-items="3"
                                        data-margin="30" data-autoplay="false" data-autoplay-timeout="5000"
                                        data-smart-speed="700" data-dots="true" data-nav="false" data-nav-speed="false"
                                        data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true"
                                        data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="true"
                                        data-r-small="2" data-r-small-nav="false" data-r-small-dots="true"
                                        data-r-medium="3" data-r-medium-nav="false" data-r-medium-dots="true"
                                        data-r-large="3" data-r-large-nav="false" data-r-large-dots="true"
                                        data-r-extra-large="3" data-r-extra-large-nav="false" data-r-extra-large-dots="true">
                                        


                        <?php foreach ($related_posts as $related_post) { 

                                                // Fetch the image associated with the post
                                                $img = get_field('img', $related_post->ID, 'posts', '');
                                                $post_slug = urlencode($related_post->slug);
                                            ?>

                                            <div class="blog-box-layout1 text-left">
                                                <div class="item-img">
                                                    <a href="<?php echo $post_slug; ?>">
                                                        <img src="<?php echo $img; ?>" alt="blog">
                                                    </a>
                                                </div>
                                                <div class="item-content">
                                                    <ul class="entry-meta meta-color-dark">
                                                        <li><i class="bx bxs-user"></i>BY <a href="#">Admin</a></li>
                                                        <li><i class="bx bxs-calendar"></i>
                                                            <?php echo date('d M Y', strtotime($related_post->pub_date)); ?>
                                                        </li>
                                                    </ul>
                                                    <h5 class="item-title">
                                                        <a href="<?php echo $post_slug; ?>">
                                                            <?php echo $related_post->title; ?>
                                                        </a>
                                                    </h5>
                                                </div>
                                            </div>

                                            <?php } ?>


                                    </div>
                                </div>
                                <div class="blog-comment">
                                    <div class="section-heading-4 heading-dark">
                                        <h3 class="item-heading"><?php echo db()::table('comments')
                                    ->where('post_id', $post->ID)
                                    ->orderBy('ID', 'desc')
                                    ->count();
                                    
                                    ?>
                                             COMMENTS</h3>
                                    </div>

                                    <?php

                                    $comments = db()::table('comments')
                                    ->where('post_id', $post->ID)
                                    ->orderBy('ID', 'desc')
                                    ->get();

                                    foreach ($comments as $comment) {
                                    ?>
                                    <div class="media media-none--xs">
                                        <img src="https://cdn-icons-png.flaticon.com/512/219/219983.png" alt="Blog Comments" class="img-fluid media-img-auto">
                                        <div class="media-body">
                                            <h4 class="item-title"><?php echo $comment->name; ?></h4>
                                            <div class="item-subtitle"><?php echo date(format: 'd M Y', timestamp: strtotime($comment->created_at)); ?></div>      
                                            <p><?php echo $comment->comment_text; ?></p>
                                        </div>
                                    </div>
                                    <?php } ?>


                                </div>
                                <div class="blog-form">
                                    <div class="section-heading-4 heading-dark">
                                        <h3 class="item-heading">WRITE A COMMENT</h3>
                                    </div>



                        <?php

                        // Initialize variables for success and error messages
                        $successMessage = '';
                        $errorMessage = '';

                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            // Check if required fields are filled
                            if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comment_text']) && !empty($_POST['post_id'])) {
                                // Prepare data for insertion
                                try {
                                    // Insert data into the database
                                    $post_id = $_POST['post_id']; // Get the post ID from the form
                                    $commentId = db()::table('comments')->insertGetId([
                                        'name' => $_POST['name'],
                                        'email' => $_POST['email'],
                                        'comment_text' => $_POST['comment_text'],
                                        'post_id' => $post_id,
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s')
                                    ]);

                                    if ($commentId) {
                                        $successMessage = 'Comment Added Successfully';
                                    } else {
                                        $errorMessage = 'Failed to add comment. Please try again.';
                                    }
                                } catch (Exception $e) {
                                    // Catch and handle any errors during the database operation
                                    $errorMessage = 'Error: ' . $e->getMessage(); // Display the exact error
                                }

                                //reload the page
                                echo "<meta http-equiv='refresh' content='0'>";

                            } else {
                                // Validation failed, return an error
                                $errorMessage = 'All fields are required.';
                            }
                        }
                        ?>

                        <!-- Display success message if available -->
                        <?php if (!empty($successMessage)) : ?>
                            <div class="alert alert-success">
                                <?php echo $successMessage; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Display error message if available -->
                        <?php if (!empty($errorMessage)) : ?>
                            <div class="alert alert-danger">
                                <?php echo $errorMessage; ?>
                            </div>
                        <?php endif; ?>

                        <form class="contact-form-box" method="POST">
                            <div class="row gutters-15">
                                <!-- Name Field -->
                                <div class="col-md-4 form-group">
                                    <input type="text" placeholder="Name*" class="form-control" name="name"
                                        data-error="Name field is required" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <!-- Email Field -->
                                <div class="col-md-4 form-group">
                                    <input type="email" placeholder="E-mail*" class="form-control" name="email"
                                        data-error="E-mail field is required" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <!-- Message Field -->
                                <div class="col-12 form-group">
                                    <textarea placeholder="Write your comments ..." class="textarea form-control"
                                        name="comment_text" rows="9" cols="20" data-error="Message field is required" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <!-- Post ID Field (hidden) -->
                                <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post->ID); ?>">
                                <!-- Submit Button -->
                                <div class="col-12 form-group">
                                    <button type="submit" class="item-btn">POST COMMENT</button>
                                </div>
                            </div>
                            <div class="form-response"></div>
                        </form>


                                </div>
                            </div>
                        </div>
                    </div>
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </section>
        <!-- Single Blog Banner End Here -->
        <?php get_footer(); ?>