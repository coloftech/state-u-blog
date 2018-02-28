<div class="wrapper site-wrapper">
	<div class="container site-container">
		<h4><?php echo $this->input->get('i') ? $this->input->get('i') : ''; ?></h4>

		<div class="col-md-8 page-content">
			<?=isset($about) ? $about : ''; ?>

		</div>
		<div class="col-md-4"></div>
	</div>
</div>