<?php
require 'util.php';
require 'functions.php';


global $nonceUtil,$title,$current;
//env load
$dotenv = Dotenv\Dotenv::createImmutable(app_dir);
$dotenv->safeLoad();
 

//connect db
require 'database.php';

$_ENV['per_page'] = get_option('posts_per_page',$_ENV['per_page']);

$router = new AltoRouter();
//'\p{L}+'
$router->addMatchTypes(array('slug' => '[a-zA-Z0-9\-]+'));

$router->map('GET|POST','/', function(){ 

	include app_dir.'/themes/index.php';
},'home');





$router->map('GET|POST','/contact', function(){ 

	include app_dir.'/themes/contact.php';
},'contacts');

$router->map('GET|POST','/about', function(){ 

	include app_dir.'/themes/about.php';
},'abouts');


// $router->map('GET|POST','/about', function(){ 

// 	include app_dir.'/themes/profile.php';
// },'profiles');





$router->map('GET|POST','/search', function(){ 
	global $title;
	$q = isset($_GET['q'])?$_GET['q']:'';
	if(empty($q)){
		redirect('/');
	} 
	$title= 'Search results for '.htmlspecialchars($q);

	include app_dir.'/themes/search.php';
},'search_results');

 

$router->map('GET|POST','/admin', function(){
	
	if(auth()->isLoggedIn()){
		redirect('/dashboard');
		return;
}
	include app_dir.'/themes/dashboard/login.php';
});

  
 
 
if(auth()->isLoggedIn()){
	
	$router->map('GET|POST','/dashboard', function(){
		include app_dir.'/themes/dashboard/index.php';
	},'dashboard');

	$router->map('GET|POST','/dashboard/[*:slug]', function($slug){
		$dir = app_dir.'/themes/dashboard/pages/'.$slug.'';
		$file = app_dir.'/themes/dashboard/pages/'.$slug.'.php';
		if(file_exists($dir) && is_dir($dir) ){
			include $dir.'/index.php';
			return;
		}else if(file_exists($file) && is_file($file)){
			include $file;
			return;
		} 

		redirect('/404');
	},'dashboard_pages');


	if(is_admin()){ 

		

	}
	$router->map('GET|POST','/logout', function(){
		auth()->logOut();
		redirect('/');
	});

	
}


 
$router->map('GET|POST','/sitemap', function(){ 
	include app_dir.'/themes/sitemap.php';

},'sitemap');

$router->map( 'GET|POST', '/sitemap-[*:id]', function($id) {
	$_GET['id']=$id;
	include app_dir . '/themes/sitemap.php';
},'sitemap_view');


$router->map('GET|POST','/404', function(){ 
	include app_dir.'/themes/404.php';
},'404');



// $router->map('GET|POST','/page/[*:slug]', function($slug){
	
// 	$slug = urldecode($slug);
// 	global $title,$post;
// 	$post= db()::table('srz_cpt')->where([
// 		'post_type' =>'page',
// 		'slug' => $slug,
// 		'status' => 1
// 		])->first();

// 	if(!$post){
// 		redirect('/404');
// 		exit();
// 	}
// 	$title= $post->title; 
	
// 	$views = get_field('views',$post->ID, 'page', 0);

// 	include app_dir.'/themes/single-page.php';
	 
// 	update_field('views', $views+1 ,  'page', $post->ID);
// 	},'single_page');



$router->map('GET|POST','/category/[*:slug]', function($slug){ 
	global $title;
	$category= db()::table('srz_cats')->where([
		'type' =>'movies',
		'value' => $slug
		])->first();
	if(!$category){
		redirect('/404');
		exit();
	}
	$title= $category->name;

	include app_dir.'/themes/category.php';
},'category_view');



	

$router->map('GET|POST','/[**:slug]', function($slug){
	$slug = urldecode($slug);
 
	global $title,$post;
	$post= db()::table('srz_cpt')->where([
		'post_type' =>'posts',
		'slug' => $slug,
		'status' => 1
		])->first();

	if(!$post){
		redirect('/404');
		exit();
	}
	$title= $post->title; 
	
	$views = intval(get_field('views',$post->ID, 'posts', 0));

	update_field('views', intval($views)+1 ,  'posts', $post->ID);
	include app_dir.'/themes/single.php';
	 
	},'single');
	  

 
$match = $router->match();
$current= $match['name'];

if (is_array($match) && is_callable($match['target'])) {
	call_user_func_array($match['target'], $match['params']);
} else {
	// no route was matched
	http_response_code(404);
	include app_dir.'/themes/404.php';
}
