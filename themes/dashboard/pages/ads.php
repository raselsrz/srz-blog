<?php
$type= "ads";
$name= 'Ads';
global $title;
$title = 'Ads';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
      foreach ($_POST as $key => $value) {
        update_option($key,$value);
      }
        if(isset($_FILES['logo_file'])){ 

            
            $upload = new \Delight\FileUpload\FileUpload();
            $upload->withTargetDirectory(app_dir.'/assets/uploads');
            $upload->from('logo_file');
            $upload->withAllowedExtensions([ 'jpeg', 'jpg', 'png' ]);
        
            try {
                $uploadedFile = $upload->save();
                update_option('logo','/assets/uploads/'.$uploadedFile->getFilenameWithExtension()); 
            }
            catch (\Delight\FileUpload\Throwable\InputNotFoundException $e) {
                // input not found
            }
            catch (\Delight\FileUpload\Throwable\InvalidFilenameException $e) {
                // invalid filename
            }
            catch (\Delight\FileUpload\Throwable\InvalidExtensionException $e) {
                // invalid extension
            }
            catch (\Delight\FileUpload\Throwable\FileTooLargeException $e) {
                // file too large
            }
            catch (\Delight\FileUpload\Throwable\UploadCancelledException $e) {
                // upload cancelled
            } catch(Exception $e){

            }



            }


        $_SESSION['success'] = 'Settings updated successfully';
      redirect('/dashboard/'.$type);

}
  
 


get_dashboard_header();


 ?>
 <style>
    .input-group {
      margin-bottom: 10px;
    }
  </style>
 <div class="h-screen flex-grow-1 overflow-y-lg-auto">

<main class="py-6 bg-surface-secondary">
    <div class="container-fluid">
       
        <div class="card shadow border-0 mb-7">
            
            <div class="card-header add_cat">
                <h5 class="mb-0">Settings</h5>
                 
            </div>
            </div>
            <?php 
        if(isset($_SESSION['success'])){
            echo '<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
            unset($_SESSION['success']);
        }
        ?>
        <div class="card shadow border-0 mb-7 add-container">
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                     
                    
                    <div class="mb-3">
                        <label for="telegram" class="form-label">Sidebar Ads</label>
                        <textarea name="sidebar_ads" class="form-control" id="sidebar_ads"  ><?php echo htmlspecialchars(get_option('sidebar_ads',''));?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="footer_codes" class="form-label">Header Ads</label>
                        <textarea name="head_ads" class="form-control" id="head_ads"  ><?php echo htmlspecialchars(get_option('head_ads',''));?></textarea>
                    </div>
                      
                    <div class="mb-3">
                        <label for="blog_top_ads" class="form-label">Blog Top Ads</label>
                        <textarea name="blog_top_ads" class="form-control" id="blog_top_ads"  ><?php echo htmlspecialchars(get_option('blog_top_ads',''));?></textarea>
                    </div>
                      
                  

                    <button type="submit" class="btn btn-sm bg-surface-secondary btn-neutral" style="width: 20%; " >Update</button>
                </form>
            </div>
        </div>
    </div>
</main>
</div>
<link
  rel="stylesheet"
  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
/>
<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script>
          <script>
            
            var editor = Jodit.make('#content');

            jQuery(document).ready(function($) {
    $('select').select2();
}); 
          </script>  

    <?php 
    
get_dashboard_footer();
 ?>
