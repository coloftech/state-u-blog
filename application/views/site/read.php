<div class="wrapper site-wrapper">
    <br />
</div>
<div class="wrapper site-wrapper">
	<div class="container site-container">
		
		<div class="col-md-9">
			<div class="post-read">
				<?php if (isset($post)): ?>
			   	<?php if (is_array($post)): ?>
			   		<?php foreach ($post as $key): ?>
			   			
			   			<div class="post-featured-img">
			   				<a href="#">

									<?php if ($img_link = $this->post_m->get_featuredImg($key->post_id)): ?>
										
									<img src="<?=base_url($img_link)?>">
									<?php else: ?>

									<img src="<?=base_url('public/images/post-img.png')?>">
									<?php endif ?>
								</a>
			   			</div>
			   			<div class="post-content">
			   				<div class="post-title">

			   					<h3><?php echo $key->post_title; ?> <a href="<?=site_url("c=post&f=edit&id=$key->post_id");?>"><i class="btn fa fa-edit"></i></a></h3>
			   					</div>
			   				<div class="post-content-desc">
			   					<?php echo $key->post_content; ?>
			   				</div>
			   				<div class="post-options">
			   					<div class="posted-by"><?=$this->post_m->posted_by($key->user_id);?> | <?=date('F d, Y',strtotime($key->date_posted));?></div>
			   				</div>
			   			</div>
			   		<?php endforeach ?>
			   	<?php endif ?>
			   <?php endif ?>
			</div>
		   

		</div>
<div class="col-md-3 side-bar">
	<div class="panel panel-search">
	<div class="panel-body">
		<input class="form-control" placeholder="Search" id="search" name="q" /><i class="fa fa-search pul"></i></div>
	</div>
	<div class="panel">
		<div class="panel-heading"><h4>RECENT POST</h4></div>
		<div class="panel-body">
			<ul class="recent-post">
				<?php echo $this->auto_m->recent_post(); ?>
			</ul>
		</div>


	</div>
</div>

	</div>

</div>