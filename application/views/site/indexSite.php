<div class="wrapper site-wrapper">
	<br />
	<div class="container site-container">
<div class="col-md-9">
	
<?php 

$page = $this->input->get('p') ? $this->input->get('p') : 'bilar';
 ?>
		<?php if (isset($posts)): ?>
			<?php if (is_array($posts)): ?>
				<?php foreach ($posts as $key): ?>
					<div class="post">
						<div class="col-md-6 post-featured-img">
							<div class="year"><?=$key->post_year;?></div>
							<div class="month"><?=$key->post_month;?></div>
							<div class="day"><?=$key->post_day;?></div>
							<div class="blured">
								<a href="<?=site_url("c=site&f=read&p=$key->site_path&i=$key->slug");?>"><img src="<?=base_url('public/images/post-img.png')?>"></a>

							</div>
							
						</div>
						<div class="col-md-6 post-content">
							<div class="post-title"><a href="<?=site_url("c=site&f=read&p=$key->site_path&i=$key->slug");?>"><h4><?=$key->post_title?></h4></a></div>
							<div class="post-content-desc"><?=$key->post_content?></div>
							<div class="post-options">
								<div class="posted-by">By <?=$this->post_m->posted_by($key->user_id);?></div>
								<div class="post-category">Research</div>
								<div class="post-details"><a href="<?=site_url("c=site&f=read&p=$key->site_path&i=$key->slug");?>" class="btn btn-default">Details <i class="fa fa-angle-right"></i></a href="#"></div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			<?php endif ?>
		<?php endif ?>

</div>
<div class="col-md-3 side-bar">
	<div class="panel panel-search">
	<div class="panel-body">
		<input class="form-control" placeholder="Search" id="search" name="q" /><i class="fa fa-search pul"></i></div>
	</div>
	<div class="panel">
		<div class="panel-heading"><h4>RECENT POST</h4></div>
		<div class="panel-body"></div>


	</div>
</div>
	</div>
</div>