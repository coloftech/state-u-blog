<div class="col-md-12">
	<div class="panel">
		<div class="panel-heading"></div>
		<div class="panel-body">
		<div class="pull-right" style="text-align:right;"><form class="form form-horizontal"><div class="form-inline"><input type="text" name="q" id="q" class="form-control" /><button class="btn btn-default"><i class="fa fa-search"></i></button></div></form><?php echo $links;?></div>
			<table class="table table-hover tbl-list-post"><span style='font-size:3em;'><?=$title;?></span><p><label>Quick edit</label> - Double click on the category, status.</p>
				<thead><tr><th>#</th><th>Title</th><th>Category</th><th>Status</th><th>Action</th></tr></thead>
				<tbody>
					<?php 
						if(isset($listall)){
							if (is_array($listall)) {
								# code...

								$i = isset($start) ? $start : 0;
								

								foreach ($listall as $key) {
									# code...
									$i++;
									$status_n = $this->mglobal->p_status($key->status);

									$listallcat = $this->post_model->listpostcategory($key->page_id);

									if (is_array($listallcat)) {
										# code...

										$total = count($listallcat);
										$cat = '';
										foreach ($listallcat as $key2) {
										$name = $this->post_model->categoryname_by_id($key2->category_id);
										$cat[] = $name;
										}
									}
									if(count($cat) > 0){
										if (is_array($cat)) {
											# code...

										$post_category = implode(', ',$cat);
										}else{
											$post_category = $cat;
										}


									}else{ $post_category='';}
									echo "<tr>
									<td>$i</td>
									<td>$key->title</td>
									<td  ondblclick=\"editcategory($key->page_id)\" title ='Double click to quick edit!'><span id='spancat".$key->page_id."'>$post_category</span>
									<div id='divcat".$key->page_id."' style='display:none;'><input type='text' name='txtcategories' id='txtcategories".$key->page_id."' class='form-control' /><select id='selectcategory".$key->page_id."' class='form-control' multiple>$categories</select><button type='button' class='btn btn-success' style='margin:5px 0;padding:2px 5px;display:inline-block;' onClick=\"updatecats($key->page_id,'Category')\"><i class='fa fa-check'></i></button></div></td>
									<td ondblclick=\"editstatus($key->page_id)\" title ='Double click to quick edit!'><span id='span".$key->page_id."'>$status_n</span><div  id='div".$key->page_id."' style='display:none;'><form id='frm".$key->page_id."'><select  id='select".$key->page_id."'  style='max-width:70%;display:inline-block;'  class='form-control' name='select'><option value='$key->status'>$status_n</option><option value='0'>Draft</option><option value='1'>Published</option></select><button type='button' class='btn btn-success' style='margin-left:3px;padding:0 3px;display:inline-block;' onClick=\"updatestats($key->page_id,'Status')\"><i class='fa fa-check'></i></button></form></div></td>
									<td width='150px'><a class='btn btn-success' title='View post' href='".site_url('?ref=home&com=read_post&q=').$key->slug."'><i class='fa fa-eye'></i></a><button type='button' class='btn btn-default' onClick=\"javascript:buttonClick($key->page_id,'?ref=post&com=edit&id=$key->page_id');\" title='Edit post'><i class='fa fa-edit'></i></button><button type='button' class='btn btn-warning' title='Remove post'><i class='fa fa-remove'></i></button></td>
									</tr>";
								}
							}
						}
					?>
				</tbody>
			</table>
			<div class="col-md-12">

			<div class="pull-right"  style="text-align:right;"><?php echo $links; ?></div>
			<div class="pull-left total-records"  style="text-align:right;">
			<div style="text-align:right;padding-top:20px;font-size:18px;font-weight:bold;">Record: 
			<?php 
			echo $start+1;
			echo ' - ';
			echo $list_total+$start;
			echo ' of ';
			echo $total_posted;
			//echo $records =$total_posted-$list_total;

			?>

			</div></div>
			</div>
	
		</div>
	</div>
</div>
<script type="text/javascript">
$('#selectcategory').change(function(){
    var category = $(this).val();
    var selectedcategory = category.join(", "); // there is a break after comma

    //alert (selectedmeals); // just for testing what will be printed

})
	var options = false;
	/*$.notify.addStyle("success", { html: "<span style='color:lime;display:inline-block:min-width:150px;'> Update success. </span>" });*/

	function buttonClick(id,url) {
		// body...
		window.location = '<?=site_url();?>/'+url;
	}

	function updatecats(id,uoption){


		var txtcategories = $('#txtcategories'+id).val();
		var frmdata = 'category='+txtcategories+'&post_id='+id+'&type='+uoption;

			$('#spancat'+id).show();
			$('#divcat'+id).hide();
			options = false;
				$.ajax({
						type: 'post',
						url: '../post/update_post',
						data: frmdata,
						dataType:'json',
						success: function(response){
							console.clear();
							console.log(response);	
							if(response.stat == true){
							
							$('#spancat'+id).html(response.option);


								$("table").notify(
									  uoption+" Updated " + response.msg,
									  {position: "top right",autoHide:true,className:"success"}
									);

							}else{

								$("table").notify(
									  uoption+" Update error "+response.msg,
									  {position: "top right",autoHide:true,className:"error"}
									);

							}

						}
					});


			return false;
	}
	function updatestats(id,uoption){


		var status = $('#select'+id).val();
		//alert(status);return false;
		var frmdata = $('#frm'+id).serialize();
		frmdata = frmdata+'&post_id='+id+'&type='+uoption;


			$('#span'+id).show();
			$('#div'+id).hide();
			options = false;
				$.ajax({
						type: 'post',
						url: '../post/update_post',
						data: frmdata,
						dataType:'json',
						success: function(response){
							console.clear();
							console.log(response);	
							if(response.stat == true){
							
							$('#span'+id).html(response.option);


								$("table").notify(
									  uoption+" Updated " + response.msg,
									  {position: "top right",autoHide:true,className:"success"}
									);

							}else{

								$("table").notify(
									  uoption+" Update error "+response.msg,
									  {position: "top right",autoHide:true,className:"error"}
									);

							}

						}
					});


			return false;
	}
	function editstatus (id) {
		// body...
		if (options == false) {

		$('#span'+id).hide();
		$('#div'+id).show();
		options = true;
		return false;
	}else{

		$('#span'+id).show();
		$('#div'+id).hide();
		options = false;;
		return false;
	}

	}

	function editcategory (id) {
		// body...
		if (options == false) {

		$('#spancat'+id).hide();
		$('#divcat'+id).show();
		options = true;


		$('#selectcategory'+id).change(function(){
	    var category = $(this).val();
	    var selectedcategory = category.join(", ");
		    $('#txtcategories'+id).val(selectedcategory);
		    
		})
		return false;
	}else{

		$('#spancat'+id).show();
		$('#divcat'+id).hide();
		options = false;;
		return false;
	}

	}
</script>