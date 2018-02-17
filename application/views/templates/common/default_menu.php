    <div class="row">

      <div class="col-md-12" id="search-top-menu">
        <div class="bisu-logo">
          <nav class="navbar navbar-inverse">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                      <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a href="#" class="navbar-brand"><a href="<?=site_url();?>"><img src="<?=base_url('public/images/logo-line-sss.png')?>"></a></a>
                  <form class="navbar-form <?php echo isset($ishidesearch) ? $ishidesearch : ''; ?>" action="<?=site_url('search');?>" method="get">
                          <div class="input-group">
                              <input type="text" class="form-control" placeholder="Search" name="q">
                              <span class="input-group-btn">
                                  <button type="submit" class="btn btn-default" ><span class="glyphicon glyphicon-search"></span></button>
                              </span>
                          </div>
                      </form>
                  </div>
                  <!-- Collection of nav links, forms, and other content for toggling -->
                  <div id="navbarCollapse" class="collapse navbar-collapse">
                      
                      <ul class="nav navbar-nav navbar-right">

                          <li class="<?php  ?>"><a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
                          <?php
                          if ($this->aauth->is_loggedin()) {
                          	# code...
                          	?>
                          <li class="<?php ?>"><a href="<?=site_url('my_account');?>"><i class="fa fa-user"></i> Profile</a></li>
                          <li class="dropdown <?php  ?>">
                              <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-envelope"></i> Messages <b class="caret"></b></a>
                              <ul class="dropdown-menu">
                                  <li><a href="<?php echo site_url(); ?>/u/compose">Compose</a></li>
                                  <li><a href="<?php echo site_url(); ?>/u/inbox">Inbox</a></li>
                                  <li><a href="<?php echo site_url(); ?>/u/sents">Sent Items</a></li>
                                  <li class="divider"></li>
                                  <li><a href="<?php echo site_url(); ?>/u/trash">Trash</a></li>
                              </ul>
                          </li>
                          <?php if ($this->aauth->is_admin()) {
                            # code...
                            ?> 
                          <li><a href="<?=site_url('dashboard');?>"><i class="fa fa-gears"></i> <span>Panel</span></a></li>
                     
                            <?php
                          } ?>
                          <li><a href="<?=site_url('access');?>"><i class="fa fa-users"></i> <span>Group</span></a></li>
                     
                          <li><a href="<?=site_url('logout');?>"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>

                          <?php } ?>

                          <?php 
                          if (!$this->aauth->is_loggedin()) {
                          	# code...
                          	echo "
                          	<li><a href='".site_url('h/about')."'><i class=\"fa fa-question\"></i> <span>About</span></a></li>
                          	<li><a href='".site_url('h/project')."'><i class=\"fa fa-list-alt\"></i> <span>Projects</span></a></li>
                            <li><a href='".site_url('h/contact')."'><i class=\"fa fa-envelope\"></i> <span>Contact</span></a></li>
                          	<li><a href='#login'><i class=\"fa fa-sign-in\"></i> <span>Login</span></a></li>
                          	";
                          }

                          ?>
                      </ul>
                  </div>
              </nav>

        </div>              
      </div>
      <div class="row">
          
      </div>
    </div> <!-- div row -->