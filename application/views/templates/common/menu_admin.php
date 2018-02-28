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
                    <li><a href="<?=site_url('c=user&f=change_pass');?>"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
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
                    <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-book"></i>  Post Setting<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-2" class="collapse">

                        <li><a href="<?=site_url('c=post&f=create');?>"><i class="fa fa-angle-double-right"></i> New post</a></li>
                        <li><a href="<?=site_url('c=post&f=list_all');?>"><i class="fa fa-angle-double-right"></i> List posts</a></li>

                    
                        <li><a href="<?=site_url('ref=post&com=category');?>"><i class="fa fa-angle-double-right"></i> Category</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" data-toggle="collapse" data-target="#site_setting"><i class="fa fa-fw fa-globe"></i>  Site setting <i class="fa fa-fw fa-angle-down pull-right"></i></a>

                    <ul id="site_setting"  class="collapse">
                        <li><a href="<?=site_url('c=administration&f=sites&a=new')?>">New site</a></li>
                        <li><a href="<?=site_url('c=administration&f=sites');?>">List sites</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#page"><i class="fa fa-fw fa-file-powerpoint-o"></i> Page setting <i class="fa fa-fw fa-angle-down pull-right"></i></a>

                    <ul id="page"  class="collapse">
                        <li><a href="<?=site_url('c=pages&f=add_page')?>">New page</a></li>
                        <li><a href="<?=site_url('c=pages')?>">List pages</a></li>

                    </ul>
                </li>
                        <?php if ($this->permission->is_admin  ()): ?>
                            
                 <li>
                    <a href="#" data-toggle="collapse" data-target="#user"><i class="fa fa-fw fa-users"></i> User setting<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="user" class="collapse">
                        <li><a href="<?=site_url('c=user&f=create');?>"><i class="fa fa-angle-double-right"></i> New user</a></li>
                        <li><a href="<?=site_url('c=user');?>"><i class="fa fa-angle-double-right"></i> List users</a></li>                        
                        <li><a href="<?=site_url('c=user&f=permission');?>"><i class="fa fa-angle-double-right"></i> Permission</a></li>

                    </ul>
                </li>
                        <?php endif ?>


                <li><a href="<?=site_url('c=administration&f=create_zip');?>"><i class="fa fa-fw fa-home"></i>Backup</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>