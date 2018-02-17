<div class="col-sm-12 col-md-12 col-lg-12 create">
<br/>
<form class="form" id="frmcreate" name="frmcreate" method="post" action="<?=site_url('c=post&f=save_post');?>">
	<div class="col-md-8">
	
	<div class="panel pane-info">
	<div class="heading"><h4>Create new post</h4></div>
	<div class="body">
			<div class="form-group">
				<p class="btn hidden " id="warning_msg"></p>
			</div>
			<div class="form-group">
				<label for="title">Title</label><input type="text" class="form-control" name="title"  id="title" placeholder="Enter title here" value="<?php echo isset($p_title) ? $p_title : '';?>" required/>
				<p class="btn alert-danger hidden" id="intitle"></p>
			</div>	
			<div class="form-group">
				<label for="title">Description</label><textarea class="form-control" name="desc" id="desc"><?php echo isset($p_content) ? $p_content : '';?></textarea>
			</div>	

      <div class="form-group">
        <label for="Title">Keyword<i class='btn fa fa-undo' style='color:dodgerblue' onclick='cleartags("tags")' title='Clear all tags'></i></label><br/> <input type="text" class="form-control"  data-role="tagsinput" name="keyword" id="keyword" placeholder='Type here and press Enter' autocomplete="off"  style='min-width:200px;'>
        <div id="listoftags" class="listoftags"></div>
      </div>

			<div class="hidden">
				
			<input type="hidden" id="featuredImg" name="featuredImg" />
			</div>

	</div>
	</div>
	</div>


	<div class="col-md-4">
	<div class="row">
		<div class="panel">
			<div class="panel-heading"><h5><b>Publish</b> <span class="pull-right clickable" style="cursor: pointer;"><i class="glyphicon glyphicon-chevron-up"></i></span></h5></div>
			<div class="panel-body">
				
			<div class="category">
				<select class="form-control" style="width:100%;" id="privacy" name="privacy">
					<option value="2">Public</option>
					<option value="1">Private</option>
				</select>
			</div>
			<div class="category">
				<br />
				<div class="form-group">
					<button class="btn btn-info"  type="submit"  >Publish</button>
				
					<button class="btn btn-default pull-right"  type="submit"  >Draft</button>
				</div>
			</div>

			</div>
		</div>

		<div class="panel">
			<div class="panel-heading"><h5><b>Categories</b><a class="btn btn" title="Add category"  data-toggle="modal"  data-target="#catModal"><i class="fa fa-plus-circle"></i></a> <span class="pull-right clickable" style="cursor: pointer;"><i class="glyphicon glyphicon-chevron-up"></i></span></h5></div>
			<div class="panel-body">
					<div class="category">
				<select class="form-control" style="width:100%;" id="category" name="category">

				<?php
				if (isset($categories)) {
					foreach ($categories as $key) {
						# code...
						$cat_name = ucfirst($key->cat_name);
						echo "<option value='$key->cat_id'>$cat_name</option>";
					}
				}
					
				?>
				</select>
			</div>

			</div>
		</div>

		<div class="panel">
			<div class="panel-heading"><h5><b>Site</b> <span class="pull-right clickable" style="cursor: pointer;"><i class="glyphicon glyphicon-chevron-up"></i></span></h5></div>
			<div class="panel-body">
				
			<div class="category">
				<select class="form-control" style="width:100%;" id="group" name="group">
					<?php if (isset($hosted_site)): ?>
						<?php foreach ($hosted_site as $key): ?>
							
					<option value="<?=$key->site_id?>"><?=$key->site_name?></option>
						<?php endforeach ?>
					<?php endif ?>
				</select>
			</div>

			</div>
		</div>

		<div class="panel">
			<div class="panel-heading"><h5><b>Featured Image</b> <span class="pull-right clickable" style="cursor: pointer;"><i class="glyphicon glyphicon-chevron-up"></i></span></h5></div>
			<div class="panel-body">
			<div class="featured">
			<div class="featuredImg" id="featuredImg_side"><?php echo !empty($p_img) ? '<img src="'.$p_img.'" title="'.$p_title.'" />' : '';?>
				<img id="previewImg2" src="" class="hidden" style="width: 100%;">
				
			</div>
			<input type="hidden" id="featuredimg_url" name="featuredimg_url" />
			<button class="btn btn-info" data-toggle="modal"  data-target="#uploadModal"type="button" ><i class="fa fa-camera"></i></button>
			</div>
		</div>
		</div>
	
	</div>
	</div>
</form>
<div class="row">
	<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
<div class="modal-bg hidden">
	<!--span class="loader"></span -->
	<progress id="progressBar" value="0" maximum="100" style="width:300px;"></progress>
	<h3 id="status"></h3>
	<p id="loaded_n_total"></p>
</div>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Featured Image</h4>
      </div>
      <div class="modal-body">
        <p><div class="err_msg hidden"></div>			
		<form action="#" id="frmImage" name="frmImage">
			<div class="form-group">

			<input type="file" id="image" name="image" class="btn alert-default"  accept="image/gif, image/jpeg, image/png"  onChange="readURL(this);" >
			<button class="btn btn-sm btn-info upload" type="submit" id="upload">Upload</button>
			<button type="button" class="btn btn-sm btn-danger cancel">Cancel</button>
				
			</div>


			<div class="progress progress-striped active" style="width:100%">
				<div class="progress-bar" style="width:0%;"></div>
			</div>

        		<div class="form-group" style="max-width:400px;">
        			<label>Preview</label><br><img src="" id="previewImg" class="hidden" style="width:100%;">
        			<input type="hidden" id="isselected" value="0">	
        		</div>
		</form>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onClick="clearform('frmImage');">Close</button>
      </div>
    </div>

  </div>
</div>
</div>

<!-- category modal -->
<div class="row">
	<!-- Modal -->
<div id="catModal" class="modal fade" role="dialog">
<div class="modal-bg hidden">
	<!--span class="loader"></span -->
	<progress id="progressBar" value="0" maximum="100" style="width:300px;"></progress>
	<h3 id="status"></h3>
	<p id="loaded_n_total"></p>
</div>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New category</h4>
      </div>
      <div class="modal-body">
        <p><div class="err_msg hidden"></div>			
		<form action="#" id="frmcat">
			<div class="form-group">

			<input type="text" name="txtcat" id="txtcat" class="form-control" /><br />
			<button class="btn btn-sm btn-info upload" type="submit" id="add">Add</button>
				
			</div>


			<div class="progress progress-striped active" style="width:100%">
				<div class="progress-bar" style="width:0%;"></div>
			</div>

        		<div class="form-group" style="max-width:400px;">

        			<input type="hidden" id="isselected" value="0">	
        		</div>
		</form>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onClick="clearform('frmcat');">Close</button>
      </div>
    </div>

  </div>
</div>
</div>


</div> <!-- end of content -->


<script type="text/javascript">
	

$('#desc').summernote({

minHeight: 250,
            toolbar: [
                ['fontsize', ['bold', 'italic', 'fontsize']],
                ['style', ['highlight','underline', 'clear','color']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['paragraph','ul', 'ol',]],
                ['height', ['height']],
                ['insert', ['picture','link']],
                ['table', ['table']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
});

</script>

<script type="text/javascript">
	
	$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
})


</script>

<script type="text/javascript">
	

		function readURL(input) {

		 if (!window.FileReader) {
	        alert("Oops! This browser isn't supported yet. Please use higher browser to continue.");
	        return false;
	    	}
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();

	            reader.onload = function (e) {
	                $('#previewImg')
	                	.removeClass('hidden')
	                    .attr('src', e.target.result)
	                    .width('70%')
	                    .height('70%');

	                   $('#isselected').val(1);
	            };

	            reader.readAsDataURL(input.files[0]);
	        }
    	}


    var btnInput = 'image';
	$('#frmImage').on('submit',function(e){
			e.preventDefault();

            var selected = $('#isselected').val();

			if (selected > 0) {

				    var frmdata = new FormData();
				    var sfile = $('#'+btnInput).val() ;
				    var file = $('#'+btnInput);
				    ///alert(btnInput);return false;
				    var ins = document.getElementById(btnInput).files.length;
				    for (var x = 0; x < ins; x++) {
				        frmdata.append(btnInput+"[]", document.getElementById(btnInput).files[x]);
				    }
				    frmdata.append('btnInput',btnInput);

				uploadImage(frmdata);

			}else{
				console.log('No file selected');
			}

		});

		function uploadImage(data) {

		     console.clear();
			$.ajax({

		      type: 'post',
		      url: '<?=site_url('c=post&f=save_file');?>',
		      data: data,
		      processData: false,
		      contentType: false,
		      dataType:'json',
		      success: function (resp) {
		      		console.clear();
					console.log(resp);
					if(resp.stats == true){
						$('#previewImg2').removeClass('hidden');
						$('#previewImg2').attr('src','<?=base_url();?>'+resp.link);
						$('#featuredimg_url').val(resp.u_key);

					}
		      }
			});


      		return false;
		}

		function clearform(frm) {
			$('#'+frm)[0].reset();
			if($('#previewImg').hasClass('hidden')){

			}else{
				$('#previewImg').addClass('hidden')
			}
			return false;
		}
</script>

<script type="text/javascript">
	
		$('#frmcreate').on('submit',function(){
			var data = $(this).serialize();
		     console.clear();
			 //console.log(data);

			$.ajax({

		      type: 'post',
		      url: '<?=site_url('c=post&f=save_post');?>',
		      data: data,
		      dataType:'json',
		      success: function (resp) {
		      		if(resp.stats){

		             $('header').notify(resp.msg, { position:"bottom right", className:"success" }); 
			             setTimeout(function(){
			             	window.location.reload() = true;
			             },2000);

		         	}else{

		             $('header').notify(resp.msg, { position:"bottom right", className:"error" }); 
		         	}
							
		      }
			});


      		return false;
		});

</script>