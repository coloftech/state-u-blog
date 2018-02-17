<?php 

$page = $this->input->get('p') ? $this->input->get('p') : 'bilar';


 ?>

<!-- Fixed navbar -->
        <nav id="header" class="navbar navbar-fixed-top">
            <div id="header-container" class="container navbar-container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a id="brand" class="navbar-brand" href="<?=site_url();?>"><div class="logo"><img src="<?=base_url('public/images/bisu-logo.png');?>"></div> </a>
                    
                    <a id="brand" class="navbar-brand" href="<?=site_url();?>"><div class="title"><div class="subtitle">Bohol Island State University</div>Bilar Campus</div> </a>

                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <div class="nav navbar-nav"></div>
                    <ul class="nav navbar-nav">

                        <li class="dropdown home">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-home"></i> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="<?=site_url("c=site&f=view&p=bilar");?>">Home</a></li>
                              <li><a href="<?=site_url("c=site&f=view&p=research");?>">Research</a></li>
                              <?php if ($this->permission->is_loggedIn()): ?>
                              <li role="separator" class="divider"></li>
                              <li><a href="<?=site_url("c=administration");?>">Administration</a></li>
                                  
                              <?php endif ?>

                            </ul>
                          </li>
                        <li><a href='<?=site_url("c=site&f=view&p=$page&i=about");?>'>About</a></li>
                        <li><a href="<?=site_url("c=site&f=view&p=$page&i=contact");?>">Contact</a></li>
                        <?php if ($this->permission->is_loggedIn()): ?>
                        <li><a href="<?=site_url("c=site&f=logout");?>">Logout</a></li>
                        <?php else: ?>
                        <li><a href="<?=site_url("c=site&f=login");?>">Login</a></li>
                        <?php endif ?>

                    </ul>
                </div><!-- /.nav-collapse -->
            </div><!-- /.container -->
        </nav><!-- /.navbar -->