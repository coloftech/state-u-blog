<!DOCTYPE html>
<html>
<head>
    <title><?=$site_title;?></title>
        <link rel="shortcut icon" href="<?=base_url();?>public/images/logo-only-icon.png"/>
        
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/bootstrap/css/bootstrap.min.css">   
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/bootstrap/css/font-awesome.css">   
        <link rel="stylesheet" type="text/css"  href="<?=base_url('public/assets/js/dist/summernote.css');?>" rel="stylesheet">    
        <link rel="stylesheet" type="text/css" href="<?=base_url('public/assets/fullcalendar/fullcalendar.min.css');?>">   
        <link href="<?=base_url('public/assets/css/animate.css');?>" rel="stylesheet">
        <link href="<?=base_url('public/assets/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.css');?>" rel="stylesheet">


        <?php // add css files
        $this->minify->css(array('animate.css','admin.css','print.css'));
        echo $this->minify->deploy_css(FALSE, 'admin-style.min.css');    ?>
        

        <!-- CORE PLUGINS -->

<!-- CORE PLUGINS -->
        <script src="<?=base_url('public/assets/fullcalendar/lib/moment.min.js');?>" type="text/javascript" ></script>
        <script src="<?=base_url('public/assets/js/jquery-1.11.0.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('public/assets/fullcalendar/fullcalendar.min.js')?>" type="text/javascript" ></script>
        <script src="<?=base_url('public/assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('public/assets/js/notify/dist/notify.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('public/assets/bootstrap/dt/js/bootstrap-datetimepicker.min.js');?>" type="text/javascript"></script>
        
        <script type="text/javascript" src="<?=base_url('public/assets/js/dist/summernote.js');?>"></script>
        <script src="<?=base_url('public/assets/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.js');?>" type="text/javascript"></script>
</head>
<header>
    <div class="wrapper">
     <?php require_once 'common/menu_admin.php'; ?>
     </div>
</header>
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