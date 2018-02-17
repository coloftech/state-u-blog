<!DOCTYPE html>
<html>
 
    <head>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">

<meta name="propeller" content="6db29e64f9cb4b5e95f5e9b6bd5fd21b" />

        <title><?php echo isset($title) ? 'COLOFTECH | '.$title: 'COLOFTECH'; ?></title>
        <link rel="shortcut icon" href="<?=base_url();?>public/images/logo-only-icon.png"/>
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/bootstrap/css/bootstrap.min.css">  
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/bootstrap/css/font-awesome.css">        
        <link href="<?=base_url('public/assets/css/animate.css');?>" rel="stylesheet">
            <?php // add css files
        $this->minify->css(array('style.css','carousel.animate.css'));
        echo $this->minify->deploy_css();
        /*
        $this->minify->js(array('helpers.js','jqModal.js'));
        echo $this->minify->deploy_js();
        //echo $this->minify->deploy_js(); */
    ?>
       
    </head>
 
    <body>
    <?php /*
<script type="text/javascript" src="//go.oclasrv.com/apu.php?zoneid=1440862"></script> */ ?>

    <div class="wrapper">
        <div class="container">
     <?php require_once 'common/default_menu.php'; ?>
        </div>
     </div>
        <div class="wrapper">
             <div class="container">
             <div class="row">
                 <div class="ads">
                 <div class="divider"></div>
                 </div>
             </div>

             <div class="row">

                 <div class="slider-show">
                    <?php
                    if (isset($carousel)) {
                         # code...
                        //echo 'carousel';
                        require_once 'common/carousel.php';
                     } ?>
                 </div>
             </div>

            <div class="row">
                <div class="col-md-12 content">

                    <?php echo $body; ?>
                </div>
            </div>
             </div>
             <?php $this->pagecounter->run_counter();?>
        </div>
                <footer class="footer navbar-fixed-bottom">
                <div class="wrapper">
                    <div class="container">

                    <div class="col-md-6 footer-left"></div>
                    <div class="col-md-6 footer-rigth"></div>
                    <div class="col-md-12 footer-full">
                    <span>Copyright @ <a href="<?=site_url();?> " class="t-link">COLOFTECH | State of the Arts and Technology </a>2016-2017</span>
                    <span style="display:inline-block;"><i class='v-line'></i>Visitors <a href="#" class="t-link"><?=$this->pagecounter->visit_total();?></a></span>
                    </div>
                        
                    </div>
                </div>

                </footer>

        <!-- CORE PLUGINS -->
        <script src="<?=base_url('public/assets/js/jquery.11.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('public/assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
         
        <!-- niceDIT! text area html editor -->
        
        <script type="text/javascript" src="<?=base_url('public/assets/nicEdit.js');?>"></script>
        <script type="text/javascript" src="<?=base_url('public/assets/scripts.min.js');?>"></script>
    </body>
     
</html>