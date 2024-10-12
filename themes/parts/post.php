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
  
  $catHtml = '';



  $img = get_field('img',$post->ID, 'posts','');
    


?>


<div class="col-sm-6 col-12">
    <div class="blog-box-layout1">
        <div class="item-img">
            <a href="/<?php echo $post->slug; ?>"><img src="<?php echo   $img; ?>" alt="blog"></a>
        </div>
        <div class="item-content">
        <ul class="entry-meta meta-color-dark">
            <li><i class='bx bx-purchase-tag' ></i><?php echo $catText; ?></li>
            <li><i class='bx bxs-calendar' ></i><?php echo date('d M Y',strtotime($post->pub_date));?></li>
            <li><i class='bx bx-user' ></i>BY <a href="#">Mark Willy</a></li>
            <!-- <li><i class='bx bx-time-five' ></i> <?php //echo date('H i',strtotime($post->pub_date));?></li> -->
        </ul>
            <h3 class="item-title"> <a href="/<?php echo $post->slug; ?>"><?php echo $post->title; ?></a></h3>
            <p><?php echo substr($post->description,0,100); ?>...</p>
            <a href="/<?php echo $post->slug; ?>" class="item-btn">READ MORE<i class='bx bx-right-arrow-alt' ></i></a>
        </div>
    </div>
</div>

