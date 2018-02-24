<div class="wrapper admin-wrapper create">
<form class="form" id="frmcreate" name="frmcreate" method="post" action="<?=site_url('c=post&f=update_post');?>">
	<div class="col-md-8">
	
	<div class="panel pane-info">
	<div class="heading"><h4>Edit post <a href="<?=site_url("c=site&f=read&p=$p_site_path&i=$p_slug");?>" target="_blank" class="btn btn-sm btn-default" title="View post"><i class="fa fa-eye"></i></a></h4></div>
	<div class="body">
			<div class="form-group">
				<p class="btn hidden " id="warning_msg"></p>
			</div>
			<div class="form-group">
				<input type="hidden"  id="post_id" name="post_id" value="<?php echo $this->input->get('id');?>" />
			</div>
			<div class="form-group">
				<label for="title">Title</label><input type="text" class="form-control" name="title"  id="title" placeholder="Enter title here" value="<?php echo isset($p_title) ? $p_title : '';?>" required/>
				<p class="btn alert-danger hidden" id="intitle"></p>
			</div>	
			<div class="form-group">
				<label for="title">Description</label><textarea class="form-control" name="desc" id="desc"><?php echo isset($p_content) ? $p_content : '';?></textarea>
			</div>	

      <div class="form-group">
        <label for="Title">Keyword<i class='btn fa fa-undo' style='color:dodgerblue' onclick='cleartags("tags")' title='Clear all tags'></i></label><br/> <input type="text" class="form-control"  data-role="tagsinput" name="keyword" id="keyword" placeholder='Type here and press Enter' autocomplete="off"  style='min-width:200px;' value="<?=isset($tags) ? $tags : ''; ?>" />
        <div id="listoftags" class="listoftags"></div>
      </div>

			<div class="hidden">

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
				<label for="Title">Date &nbsp;</label><br />

<div class="col-md-4"  style="padding-left: 0; padding-right: 0;">
        <select class="form-control" name="months" id="months" >
        <?php 



        $months = array(
          array('id'=>1,'name'=>'Jan'),
          array('id'=>2,'name'=>'Feb'),
          array('id'=>3,'name'=>'Mar'),
          array('id'=>4,'name'=>'Apr'),
          array('id'=>5,'name'=>'May'),
          array('id'=>6,'name'=>'Jun'),
          array('id'=>7,'name'=>'Jul'),
          array('id'=>8,'name'=>'Aug'),
          array('id'=>9,'name'=>'Sep'),
          array('id'=>10,'name'=>'Oct'),
          array('id'=>11,'name'=>'Nov'),
          array('id'=>12,'name'=>'Dec')

          );

        //$m = date('m');

        foreach ($months as $key) {
          # code...
            if($key['id'] == $m){$iscurrent = 'selected';}else{$iscurrent='';}
            echo "<option value='".$key['id']."' $iscurrent>".$key['name']."</option>";
        }
        ?>
        </select></div>
         <div class="col-md-4"  style="padding-left: 0; padding-right: 0;">
        <select  class="form-control " name='days' id='days'  >
          
        <?php
        //$d = date('d');
        var_dump($d);
        for ($i=1; $i <=31; $i++) { 
          # code...
          echo "<option value ='$i'";
          if ($i == $d) {
            # code...
            echo ' selected';
          }
          echo ">$i</option>";
        }
        ?>
        </select>
       </div>
        <div class="col-md-4"  style="padding-left: 0;padding-right: 0; ">
        <select class="form-control" name="years" id="years"  >
          <?php 
          $currentY = date('Y');
          for ($i=1912; $i <= $currentY; $i++) { 
            # code...
            if($i == $Y){$iscurrent = 'selected';}else{$iscurrent='';}
            echo "<option value='$i' $iscurrent>$i</option>";

          }
          ?>
        </select> 
			</div>	
			</div>
			<div class="category"><label>Privacy:</label>
				<select class="form-control" style="width:100%;" id="privacy" name="privacy">
					<option value="2">Public</option>
					<option value="1">Private</option>
				</select>
			</div>
			<div class="category">
				<br />
				<div class="form-group">
					<button class="btn btn-success"  type="submit"  >Publish</button>
				
					<button class="btn btn-default pull-right"  type="submit"  >Draft</button>
				</div>
				<div class="form-group"><p id="response" class="alert hidden"></p></div>
			</div>

			</div>
		</div>

		<div class="panel">
			<div class="panel-heading"><h5><b>Categories</b><a class="btn btn" title="Add category"  data-toggle="modal"  data-target="#catModal"><i class="fa fa-plus-circle"></i></a> <span class="pull-right clickable" style="cursor: pointer;"><i class="glyphicon glyphicon-chevron-up"></i></span></h5></div>
			<div class="panel-body">
					<div class="category">
						<input type="hidden" name="old_cat_id" id="old_cat_id" value="<?=isset($categories) ? $categories[0]->cat_id : 0;?>">
				<select class="form-control" style="width:100%;" id="category" name="category">

				<?php
				if (isset($categories)) {
					foreach ($categories as $key) {
						
						$cat = '';
						if($category == $key->cat_id){
							$cat = ' selected';
						}
						$cat_name = ucfirst($key->cat_name);
						echo "<option value='$key->cat_id' $cat>$cat_name</option>";
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
							<?php $is_site_id = '';
							if ($key->site_id == $site_id) {
								
							 $is_site_id = 'selected';
							}
							 ?>
					<option value="<?=$key->site_id?>" <?=$is_site_id;?> ><?=$key->site_name?></option>
						<?php endforeach ?>
					<?php endif ?>
				</select>
			</div>

			</div>
		</div>

		<div class="panel">
			<div class="panel-heading"><h5><b>Featured Image</b> <span class="pull-right clickable" style="cursor: pointer;"><i class="glyphicon glyphicon-chevron-up"></i></span></h5></div>
			<div class="panel-body">
				<i style="font-size:10px;">Note: A featured image will display at the top of the post.</i>
			<div class="featured">
			<div class="featuredImg" id="featuredImg_side"><?php echo !empty($p_img) ? '<img src="'.$p_img.'" title="'.$p_title.'" />' : '';?>
				
				<?php if (!empty($img_link)): ?>
					<img  id="previewImg2" src="<?=base_url($img_link);?>" style="width: 100%;">

					<input type="hidden" id="featuredimg_url" name="featuredimg_url" value=""/>
				<?php else: ?>

				<img id="previewImg2" src="" class="hidden" style="width: 100%;">
				<input type="hidden" id="featuredimg_url" name="featuredimg_url" value=''/>
				<?php endif ?>
			</div>

			<button class="btn btn-info" data-toggle="modal"  data-target="#uploadModal"type="button" ><i class="fa fa-camera"></i></button>
			</div>
		</div>
		</div>


		<div class="panel">
			<div class="panel-heading"><h5><b>Photo gallery</b> <span class="pull-right clickable" style="cursor: pointer;"><i class="glyphicon glyphicon-chevron-up"></i></span></h5></div>
			<div class="panel-body">
				<i style="font-size:10px;">Note: A photo gallery is a group of images that will display at the bottom of the post.</i>
			
			<div class="featured">
			<button class="btn btn-default" data-toggle="modal"  data-target="#galleryModal"type="button" ><i class="fa fa-camera"></i></button>
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
        <button type="button" class="close" data-dismiss="modal"  onClick="clearform('frmImage');">&times;</button>
        <h4 class="modal-title">Upload Featured Image</h4>
      </div>
      <div class="modal-body">
        <p><div class="err_msg hidden"></div>			
		<form action="#" id="frmImage" name="frmImage">
			<div class="form-group">

			<div class="col-md-12">
				<input type="file" id="image" name="image" class="btn alert-default"  accept="image/gif, image/jpeg, image/png"  onChange="readURL(this);" >
			</div>
			<div class="col-md-12">
				<label style="width:12px;"></label><button class="btn btn-sm btn-info upload" type="submit" id="upload">Upload</button>
			</div>
			
				
			</div>

			    <div class="col-md-10">
			       <div class="col-md-12">
			        <div style="width:100%;margin-left:10px;text-align:left;" class="upload_img btn"></div> 
			        
			       
			          <br />
			        <div class="progress" id="progress-div" width="0%"><div class="bar" id="progress-bar"></div></div>
			    
			        </div>
			    </div>

        		<div class="form-group" style="max-width:400px;">
        			<label>Preview</label><br><img src="" id="previewImg" class="hidden" style="width:100%;">
        			<input type="hidden" id="isselected" value="0">	
        		</div>
		</form>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default hidden" data-dismiss="modal" onClick="clearform('frmImage');">Close</button>
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


    		var i = 0;
    		var percentComplete;
    		var xhr;
		function uploadImage(data) {

		     console.clear();
			$.ajax({


          	   xhr: function() {
          	   		

		                xhr = new window.XMLHttpRequest();

		                xhr.upload.addEventListener("progress", function(evt) {
		                  if (evt.lengthComputable) {
		                    percentComplete = evt.loaded / evt.total;
		                    percentComplete = parseInt(percentComplete * 100);
		                    $('.upload_img').html('Upload on progress with '+percentComplete+' % to complete.');
		                    //console.log(percentComplete);
		                   
		                    $(".progress").show('fast');
		                    $(".progress").width('100%');
		                    $(".progress-bar").width(percentComplete +'%')
		                    
		                    if (percentComplete < 10) {
		                      $('.upload_img').addClass('alert-danger');
		                    $(".bar").addClass('color-10');
		                    }
		                    if (percentComplete >=10 && percentComplete < 25) {
		                      $('.upload_img').removeClass('alert-danger');
		                    $(".bar").removeClass('color-10');
		                    $(".bar").addClass('color-25');
		                    }
		                    if (percentComplete >= 25 && percentComplete < 50) {
		                      $('.upload_img').removeClass('alert-danger');
		                      $('.upload_img').addClass('alert-warning');
		                    $(".bar").removeClass('color-25');
		                    $(".bar").addClass('color-50');
		                    }
		                    if (percentComplete >= 50 && percentComplete < 75) {
		                      $('.upload_img').removeClass('alert-warning');
		                      $('.upload_img').addClass('alert-info');
		                    $(".bar").removeClass('color-50');
		                    $(".bar").addClass('color-75');
		                    }
		                    if (percentComplete === 100) {
		                      $('.upload_img').removeClass('alert-info');
		                      $('.upload_img').addClass('alert-success');
		                      $('.upload_img').html('proccessing...');
		                    $(".bar").removeClass('color-75');
		                    $(".bar").addClass('color-100');

		                    }

		                  }
		                }, false);

		                return xhr;
          	   },

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
						setTimeout(function () {
							$('#uploadModal').modal('hide');
						},1000);

					}
		      },
		         complete: function() {
		          // setting a timeouti--;
		              if (i <= 0) {
		                      $('.upload_img').removeClass('alert-success');
		                      $('.upload_img').removeClass('btn');
		                  		$('.upload_img').html('');
		                  
		                  		$('.progress').hide('fast');

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
		      url: '<?=site_url('c=post&f=update_post');?>',
		      data: data,
		      dataType:'json',
		      success: function (resp) {
		      	console.log(resp);
		      		
		      		if(resp.stats == true){
		      			$('#response').removeClass('hidden').addClass('alert-success').html(resp.msg+ ' <i style="color:#000;">reloading...</i>');
		             $('#frmcreate').notify(resp.msg, { position:"bottom right", className:"success" }); 
			             setTimeout(function(){
			             	//window.location.reload() = true;

		      			$('#response').removeClass('alert-success').addClass('hidden').html('');
			             },3000);

			             setTimeout(function(){
			             	window.location.reload() = true;

		      			 },5000);

		         	}else{

		      			$('#response').removeClass('hidden').addClass('alert-danger').html(resp.msg);
		            	$('#frmcreate').notify(resp.msg, { position:"bottom right", className:"error" }); 
		             setTimeout(function(){
			             	//window.location.reload() = true;

		      			$('#response').removeClass('alert-danger').addClass('hidden').html('');
			             },5000);
		         	}
							
		      }
			});


      		return false;
		});

</script>