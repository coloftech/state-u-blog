<!DOCTYPE html>
<html>
<head>
    <title><?=$site_title;?></title>
        <link rel="shortcut icon" href="<?=base_url();?>public/images/logo-only-icon.png"/>
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/bootstrap/css/bootstrap.min.css">  
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/bootstrap/css/font-awesome.css">        
        <link href="<?=base_url('public/assets/css/animate.css');?>" rel="stylesheet">


        <link href="<?=base_url('public/assets/css/site/index.css');?>" rel="stylesheet">
        <?php // add css files
        $this->minify->css(array('animate.css','admin.css','print.css'));
        echo $this->minify->deploy_css(FALSE, 'admin-style.min.css');    ?>
        

        <!-- CORE PLUGINS -->
        <script src="<?=base_url('public/assets/js/jquery.11.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('public/assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('public/assets/js/notify/dist/notify.js');?>" type="text/javascript"></script>
</head>

    <div class="wrapper">
     <?php require_once 'common/admin_menu.php'; ?>
     </div>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row  main">
             
            <?php echo $body; ?>
             

            </div>

        </div>
        </div>

    </div>


  </body>
     
</html>