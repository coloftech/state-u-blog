<div class="col-sm-12 col-md-12 col-lg-12 create">

<div class="col-md-9">
	<div class="panel">
	<div class="heading"><h3>Create post</h3></div>
	<div class="body">
		<form class="form" id="frmcreate" name="frmcreate" method="post" action="">
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
				<label for="title">Keyword</label><input type="text" class="form-control" name="keyword"  id="keyword" placeholder="Enter keyword here"  value="<?php echo isset($p_keyword) ? $p_keyword : '';?>" />
			</div>

			<div class="form-group">
				<label for="title"></label><button class="btn btn-info" onclick="javascript:ispublish(1)">Publish</button> <button class="btn btn-warning"  onclick="javascript:ispublish(0)">Draft</button>
			</div>		
		</form>
	</div>
</div>
</div>
<div class="col-md-3">
<div class="row">
	<div class="panel">
		<div class="panel-heading">&nbsp;</div>
		<div class="panel-body">
			<h4>Featured image</h4>
			<div class="featured">
				
			<div class="featuredImg" id="featuredImg"><?php echo !empty($p_img) ? '<img src="'.$p_img.'" title="'.$p_title.'" />' : '';?></div>
			<input type="hidden" id="featuredimg_url" name="featuredimg_url" />
			<button class="btn btn-info" data-toggle="modal"  data-target="#uploadModal"type="button" ><i class="fa fa-camera"></i></button>
			</div>
			<br />
			<h4>Category <a class="btn btn" title="Add category"  data-toggle="modal"  data-target="#catModal"><i class="fa fa-plus-circle"></i></a></h4>
			<div class="category">
				<select class="form-control" style="width:100%;" id="category" name="category">

				<?php
					echo isset($cat_n) ? '<option value="'.$cat_id.'">'.$cat_n.'</option>' : '';
					foreach ($category as $key) {
						# code...
						echo "<option value='$key->id'>$key->name</option>";
					}
				?>
				</select>
			</div>

			<br />
			<h4>Privacy</h4>
			<div class="category">
				<select class="form-control" style="width:100%;" id="privacy" name="privacy">
					<option value="2">Public</option>
					<option value="1">Private</option>
				</select>
			</div>

			<br />
			<h4>Group</h4>
			<div class="category">
				<select class="form-control" style="width:100%;" id="group" name="group">
					<option value="1">Default</option>
				</select>
			</div>


		</div>
	</div>
</div>

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
		<form action="#">
			<div class="form-group">

			<input type="file" name="image" class="btn alert-default"  accept="image/gif, image/jpeg, image/png"  onChange="readURL(this);" >
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
        <button type="button" class="btn btn-default" data-dismiss="modal" onClick="clearform('frmupload');">Close</button>
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
</div>

        <script type="text/javascript" src="<?=base_url('assets/js/nicEdit.js');?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/dist/summernote.js');?>"></script>
<script type="text/javascript">

var publish = 0;
function ispublish (stat) {
	// body...
	if (stat == 1) {
		publish = 1;
	}else{

		publish = 0;
	}
}
	$(document).on('submit','form',function(e){
			e.preventDefault();

			$form = $(this);

              var selected = $('#isselected').val();
			//console.log(input.files[0])
			if (selected > 0) {

			uploadImage($form);
			}

		});
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


		function uploadImage($form){
			$form.find('.progress-bar').removeClass('progress-bar-success')
										.removeClass('progress-bar-danger');

			var formdata = new FormData($form[0]); //formelement
			if (window.XMLHttpRequest){
			        xmlhttp=new XMLHttpRequest();
			    }else{
			        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			    }

			var request = new XMLHttpRequest();

			//progress event...
			request.upload.addEventListener('progress',function(e){
				var percent = Math.round(e.loaded/e.total * 100);
				$form.find('.progress-bar').width(percent+'%').html(percent+'%');
			});

			request.open('post', '<?=site_url("ref=files&com=upload_image");?>');
			request.send(formdata);
				request.onreadystatechange = function() {
								

								request.addEventListener('load',function(e){


								        if(request.readyState == 4 && request.status == 200) {
								        	
								        	var data = JSON.parse(request.responseText);
								        	console.clear();
								        	console.log(data);
								        	if(data.stat == true ){

												$form.find('.progress-bar').addClass('progress-bar-success').html(data.msg);

												$form.find('input').val('');
												//$form.find('img').setAttribute('src','');

												var elem = document.createElement("img");
												elem.setAttribute("src", '<?=base_url();?>'+data.getlink);
												elem.setAttribute("style", "max-height:200px;max-width:200px;");
												$('#featuredImg').html(elem);
												$('#featuredimg_url').val('<?=base_url();?>'+data.getlink);


							        			$('#uploadModal').modal('hide');



								        	}else{
								        		request.abort();

													$form.find('.progress-bar')
														.addClass('progress-bar-danger')
														.removeClass('progress-bar-success')
														.html(data.msg);
												
								        	}

								        }else{
								        		request.abort();


													$form.find('.progress-bar')
														.addClass('progress-bar-danger')
														.removeClass('progress-bar-success')
														.html(request.responseText.msg);
								        }
								});
				}

			$form.on('click','.cancel',function(){
				request.abort();

				$form.find('.progress-bar')
					.addClass('progress-bar-danger')
					.removeClass('progress-bar-success')
					.html('upload aborted...');
			});

		}
</script>
<script type="text/javascript">
var isallowed = false;
	function clearform (frm) {
		// body...
		document.getElementById(frm).reset();
		$('#previewImg').addClass('hidden');
            $('#btnupload').addClass('hidden');

		return;
	}



    $(function(){
    	
    	var timer;
    	   $('#txtcat').on('keyup',function(){

    		var txtcat = $('#txtcat');

    		var str2 = txtcat.val();

    		if($.trim(str2).length <= 0){
    			txtcat.val('');
    		    return false;
    		}
    		if($.trim(str2).length < 2){
    		    return false;
    		}
   
		  clearTimeout(timer);       // clear timer
		  timer = setTimeout(verifycat, 2000);

    		return false;
    	});
    	$('#txtcat').on('keydown',function(){

		  clearTimeout(timer);       // clear timer
    	});
    	    	 function verifycat(cat){

    		var txtcat = $('#txtcat');
    		console.log(txtcat.val());

    		$.ajax({
    			type: 'post',
    			url: '<?=site_url("ref=post&com=verifycat");?>',
    			data: 'category='+txtcat.val(),
    			dataType: 'json',
    			success: function (resp) {
    				console.log(resp);

					        if(resp.stat == true){	
					        	txtcat.notify(resp.msg,
					        		{position:"top left",className:"success"}
					        		);

					        }else{

					        	txtcat.notify(resp.msg,
					        		{position:"top left",autoHide:false,className:"error"}
					        		);
					        }
    			}
    		});

					
    	}

    	$('#frmcat').on('submit',function (e) {


    		var txtcat = $('#txtcat');
    		var str2 = txtcat.val();

    		if($.trim(str2).length == 0 || txtcat.val().length < 2 ){

					        	txtcat.notify('Warning! Invalid input: too short!',
					        		{position:"top left",autoHide:false,className:"error"}
					        		);
    			return false;
    		}
    		
    		$.ajax({
    			type: 'post',
    			url: '<?=site_url("ref=post&com=verifytitle");?>',
    			data: 'title='+title.val(),
    			dataType: 'json',
    			success: function (resp) {
    				console.log(resp);

					        if(resp.stat == true){	
					        	title.notify(resp.msg,
					        		{position:"top left",className:"success"}
					        		);

    						isallowed = true;
					        }else{

					        	title.notify(resp.msg,
					        		{position:"top left",autoHide:false,className:"error"}
					        		);
    						isallowed = false;
					        }
    			}
    		});
    		return false;
    	})


    	$('#title').on('keyup',function(){

    		var title = $('#title');

    		var str = title.val();

    		if($.trim(str).length <= 0){
    			title.val('');
    		    return false;
    		}
    		if($.trim(str).length < 2){
    		    return false;
    		}
   
		  clearTimeout(timer);       // clear timer
		  timer = setTimeout(verifytitle, 2000);

    		return false;
    	});
    	$('#title').on('keydown',function(){

		  clearTimeout(timer);       // clear timer
    	});


    	function verifytitle(title){

    		var title = $('#title');
    		var intitle = $('#intitle');

    		$.ajax({
    			type: 'post',
    			url: '<?=site_url("ref=post&com=verifytitle");?>',
    			data: 'title='+title.val(),
    			dataType: 'json',
    			success: function (resp) {
    				console.log(resp);

					        if(resp.stat == true){	
					        	title.notify(resp.msg,
					        		{position:"top left",className:"success"}
					        		);

    						isallowed = true;
					        }else{

					        	title.notify(resp.msg,
					        		{position:"top left",autoHide:false,className:"error"}
					        		);
    						isallowed = false;
					        }
    			}
    		});

					
    	}
    	function savecontent(){

    		var title = $('#title');
    		var keyword =$('#keyword').val();
  			var content = $('#desc').summernote('code');
  			
    var content = $('#contents').summernote('code');
  			var featuredImg =$('#featuredimg_url').val();
  			var category =$('#category').val();
  			var group =$('#group').val();
  			console.clear();


    		/*if(isallowed == false){
    			warning.removeClass('hidden');
    			warning.removeClass('alert-success');
    			warning.addClass('alert-danger');
    			warning.html('Warning: Please check or input required information!');
    			return false;
    		}*/

    	if(keyword.length <= 0){
    		keyword = 'NULL';
    	}
    	

					obj = { "title":title.val(),"content":content,"keyword":keyword,"featuredImg":featuredImg,"category":category,"group":group,"status":publish};
					dbParam = JSON.stringify(obj);
					xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
					    if (this.readyState == 4 && this.status == 200) {

					        console.log(this.responseText);
					        resp = JSON.parse(this.responseText);
					        

					        if(resp.stat == true){	
					        	title.notify(title.val()+" "+resp.msg+' ,redirecting..',
					        		{position:"top left",className:"success"}
					        		);
					        	setTimeout(function () {

					        	window.location = '<?=site_url("ref=post&com=listall");?>';
					        	},2000)

					        }else{

					        	title.notify(title.val()+" "+resp.msg,
					        		{position:"top left",autoHide:false,className:"error"}
					        		);
					        }
					    }
					};
					xmlhttp.open("POST", "<?=site_url('ref=post&com=save');?>", true);
					xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xmlhttp.send("x=" + dbParam);

    	}


    	$('#frmcreate').on('submit',function(){

    		savecontent();return false;

    		

	});

});

$('#desc').summernote({
    callbacks: {
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
        }
    }
});
  $('#desc').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['table', ['table']],
    ['view',['codeview']]
  ],
  height: 250
});


</script>

<script type="text/javascript">
	
	function uploadFile(){
		var file = _("uploadfile").files[0];
		var formdata = new FormData();
		formdata.append("uploadfile",file);
		var ajax = new XMLHttpRequest();
		ajax.upload.addEventListener("progress",progressHandler,false);
		ajax.addEventListener("load",completeHandler,false);
		ajax.addEventListener("error",errorHandler,false);
		ajax.addEventListener("abort",abortHandler,false);
		ajax.open("Post", '../file/upload');
		ajax.send(formdata);

	}
	function progressHandler (event) {
		// body...
		_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
		var percent = (event.loaded/event.total) * 100;
		_("progressBar").value = Math.round(percent);
		_("status").innerHTML = Math.round(percent) + "% Uploaded... please wait";
	}
	function completeHandler (event) {
		// body...
		_("status").innerHTML = event.target.responseText;
		_("progressBar").value = 0;


	}
	function errorHandler (event) {
		// body...
		_("status").innerHTML = "Upload failed!";
	}

	function abortHandler (event) {
		// body...

		_("status").innerHTML = "Upload failed!";
	}
</script>
