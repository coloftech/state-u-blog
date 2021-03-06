<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=site_url('c=administration');?>">
                <img src="<?=base_url('public/images/logo-line.png');?>">
            </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li><a href="<?=site_url();?>" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats">Visit site
                </a>
            </li>            
            <li><a href="#" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i class="fa fa-bar-chart-o"></i>
                </a>
            </li>            
            <li class="dropdown user-profile" >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$this->session->userdata['username'];?></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=site_url('u/editprofile');?>"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                    <li><a href="<?=site_url('u/changepass');?>"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=site_url("c=site&f=logout");?>"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li><a href="<?=site_url('c=administration');?>"><i class="fa fa-fw fa-home"></i>Dashboard</a></li>
                

                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-book"></i>  Post <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-2" class="collapse">
                        <li><a href="<?=site_url('c=post&f=create');?>"><i class="fa fa-angle-double-right"></i> New</a></li>
                        <li><a href="<?=site_url('c=post&f=list_all');?>"><i class="fa fa-angle-double-right"></i> List all</a></li>

                    
                        <li><a href="<?=site_url('ref=post&com=category');?>"><i class="fa fa-angle-double-right"></i> Category</a></li>
                    </ul>
                </li>


                <?php if ($this->permission->is_admin()): ?>
                    
                <li>
                    <a href="#" data-toggle="collapse" data-target="#messages"><i class="fa fa-fw fa-paper-plane-o"></i>  Messages <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="messages" class="collapse">
                        <li><a href="<?=site_url('messages/compose');?>"><i class="fa fa-angle-double-right"></i> Compose</a></li>
                        <li><a href="<?=site_url('messages');?>"><i class="fa fa-angle-double-right"></i> Inbox</a></li>
                        <li><a href="<?=site_url('messages/sent');?>"><i class="fa fa-angle-double-right"></i> Sent</a></li>
                    </ul>
                </li>
                <?php endif ?>
                                <li>
                    <a href="#" data-toggle="collapse" data-target="#Administration"><i class="fa fa-fw fa-gears"></i> Administration <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="Administration" class="collapse">
                        <?php if ($this->permission->is_admin  ()): ?>
                            
                        <li><a href="<?=site_url();?>"><i class="fa fa-angle-double-right"></i> Backup</a></li>
                        <li><a href="<?=site_url('c=settings');?>"><i class="fa fa-angle-double-right"></i>Site Settings</a></li>                 
                        <?php endif ?>
                        <li><a href="<?=site_url('c=administration&f=sites');?>"><i class="fa fa-angle-double-right"></i> Hosted site</a></li>       

                    </ul>
                </li>
                        <?php if ($this->permission->is_admin  ()): ?>
                            
                 <li>
                    <a href="#" data-toggle="collapse" data-target="#user"><i class="fa fa-fw fa-users"></i> User <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="user" class="collapse">
                        <li><a href="<?=site_url('c=user');?>"><i class="fa fa-angle-double-right"></i> List users</a></li>
                        <li><a href="<?=site_url('c=user&f=create');?>"><i class="fa fa-angle-double-right"></i> Create</a></li>                        
                        <li><a href="<?=site_url('c=user&f=permission');?>"><i class="fa fa-angle-double-right"></i> Permission</a></li>

                    </ul>
                </li>
                        <?php endif ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>