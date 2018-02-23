<div class="wrapper admin-wrapper create">

<div class="panel">
	<div class="panel-heading"><h4>List pages</h4></div>
	<div class="panel-body">
		<div class="form-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>PAGE TITLE</th>
						<th>SITE NAME</th>
						<th></th>
					</tr>

				</thead>
				<tbody>
					<?php if (!empty($list_pages)): ?>
						<?php foreach ($list_pages	as $key): ?>
							
					<tr>
						<td><?=$key->page_id?></td>
						<td><?=$key->page_title?></td>
						<td><?php echo $this->site_m->getSiteName(false,$key->site_id)[0]->site_name;?></td>
						<td width="100px"><a href="" class="btn"><i class="fa fa-edit"></i></a></td>
					</tr>

						<?php endforeach ?>
					<?php endif ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

</div>