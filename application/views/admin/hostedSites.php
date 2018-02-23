<div class="wrapper admin-wrapper create">

	<style type="text/css">
		
site-user. a {
  color: #000;
}

.select-dropdown .dropdown dd,
.select-dropdown .dropdown dt {
  margin: 0px;
  padding: 0px;
}

.select-dropdown .dropdown ul {
  margin: -1px 0 0 0;
}

.select-dropdown .dropdown dd {
  position: relative;
}

.select-dropdown .dropdown a,
.select-dropdown .dropdown a:visited {
  color: #fff;
  text-decoration: none;
  outline: none;
  font-size: 12px;
}

.select-dropdown .dropdown dt a {
  display: block;
  padding:10PX 0;
  min-height: 25px;
  line-height: 24px;
  overflow: hidden;
  border: 0;
  width: 100%;
}

   dt a span,
.multiSel span {
  cursor: pointer;
  display: inline-block;
  padding: 0 3px 2px 0;
}

.select-dropdown .dropdown dd ul {
  background-color: #4F6877;
  border: 0;
  color: #fff;
  display: none;
  left: 0px;
  padding: 2px 15px 2px 5px;
  position: absolute;
  top: 2px;
  width: 100% !important;
  list-style: none;
  height: 100px;
  overflow: auto;
}

.select-dropdown .dropdown span.value {
  display: none;
}

.select-dropdown .dropdown dd ul li a {
  padding: 5px;
  display: block;
}

.select-dropdown .dropdown dd ul li a:hover {
  background-color: #fff;
}
.hida{
	color: #000;
}
	</style>
	<div class="panel">
		<div class="panel-heading"><h4>Hosted Site <button class="btn btn-default" id="addhost"><i class="fa fa-plus"></i></button></h4> </div>

		<div class="panel-body add-form" style="display:none;">
			<div class="col-md-12">

				<div class="form-responsive">
					<form class="form" method="post" action="<?=site_url('c=administration&f=add_site');?>" name="frmhostedsite" id="frmhostedsite">
						<div class="form-group">
							<label>Site name</label><input type="text" name="site_name" id="site_name" class="form-control" />
						</div>

						<div class="form-group">
							<label>Site path</label><input type="text" name="site_path" id="site_path" class="form-control"/>
						</div>

						<div class="form-group select-dropdown">
							<label>Site user</label>
							
							<dl class="dropdown"> 
							  
							    <dt>
							    <a href="#">
							      <span class="hida form-control" style="width:100% !important;color:#000;">Select</span>    
							      <p class="multiSel" style="color:#000;"></p>  
							    </a>
							    </dt>
							  
							    <dd>
							        <div class="mutliSelect">
							            <ul>

								<?php if (!empty($users)): ?>
									<?php foreach ($users as $key ): ?>
										<li><input  type="checkbox"  value="<?=$key->user_name?>" /> <?=$key->user_name ?></li>
									<?php endforeach ?>
								<?php endif ?>
							            </ul>
							        </div>
							    </dd>
							  <button>Filter</button>
							</dl>
						</div>	
						<div class="form-group">
							<label></label><button class="btn btn-info">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="col-md-12">
				<table class="table table-striped">
					<thead>
						
					<tr>
						<th>ID #</th>
						<th>Site name</th>
						<th>Site path</th>
						<th></th>
					</tr>
					</thead>
					<tbody>

						<?php if (!empty($hosted_site)): ?>
							<?php foreach ($hosted_site as $key): ?>
							<tr>
							<td><?=$key->site_id;?></td>
							<td><?=$key->site_name;?></td>
							<td><?=$key->site_path;?></td>
							<td width="100px;"><button class="btn"><i class="fa fa-edit"></i></button><button class="btn"><i class="fa fa-remove"></i></button></td>
						</tr>
							<?php endforeach ?>
						<?php endif ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
var is_addhost = false;

$('#addhost').on('click',function(){
	
	if (is_addhost == true) {
		$('.add-form').hide('fast');
		is_addhost = false;
	}else{

		$('.add-form').show('slow');
		is_addhost = true;
	}
});
</script>

<script type="text/javascript">
	
	/*
	Dropdown with Multiple checkbox select with jQuery - May 27, 2013
	(c) 2013 @ElmahdiMahmoud
	license: https://www.opensource.org/licenses/mit-license.php
*/

$(".select-dropdown .dropdown dt a").on('click', function() {
  $(".select-dropdown .dropdown dd ul").slideToggle('fast');
});

$(".select-dropdown .dropdown dd ul li a").on('click', function() {
  $(".select-dropdown .dropdown dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdown")) $(".select-dropdown .dropdown dd ul").hide();
});

$('.mutliSelect input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
    $(".hida").hide();
  } else {
    $('span[title="' + title + '"]').remove();
    var ret = $(".hida");
    $('.select-dropdown .dropdown dt a').append(ret);

  }
});

</script>