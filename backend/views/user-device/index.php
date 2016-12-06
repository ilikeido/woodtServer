
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\UserDevice;

$modelLabel = new \backend\models\UserDevice();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      
        <div class="box-header">
          <h3 class="box-title">数据列表</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <button id="create_btn" type="button" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</button>
        			|
        		<button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <!-- row start search-->
          	<div class="row">
          	<div class="col-sm-12">
                <?php ActiveForm::begin(['id' => 'user-device-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('user-device/index')]); ?>     
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('id')?>:</label>
                      <input type="text" class="form-control" id="query[id]" name="query[id]"  value="<?=isset($query["id"]) ? $query["id"] : "" ?>">
                  </div>
              <div class="form-group">
              	<a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
           	  </div>
               <?php ActiveForm::end(); ?> 
            </div>
          	</div>
          	<!-- row end search -->
          	
          	<!-- row start -->
          	<div class="row">
          	<div class="col-sm-12">
          	<table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
            <thead>
            <tr role="row">
            
            <?php 
              $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
		      echo '<th><input id="data_table_check" type="checkbox"></th>';
              echo '<th onclick="orderby(\'id\', \'desc\')" '.CommonFun::sortClass($orderby, 'id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('id').'</th>';
              echo '<th onclick="orderby(\'device_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'device_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('device_id').'</th>';
              echo '<th onclick="orderby(\'device_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'device_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('device_name').'</th>';
              echo '<th onclick="orderby(\'device_model\', \'desc\')" '.CommonFun::sortClass($orderby, 'device_model').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('device_model').'</th>';
              echo '<th onclick="orderby(\'connection_type\', \'desc\')" '.CommonFun::sortClass($orderby, 'connection_type').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('connection_type').'</th>';
              echo '<th onclick="orderby(\'os_type\', \'desc\')" '.CommonFun::sortClass($orderby, 'os_type').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('os_type').'</th>';
              echo '<th onclick="orderby(\'os_version\', \'desc\')" '.CommonFun::sortClass($orderby, 'os_version').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('os_version').'</th>';
              echo '<th onclick="orderby(\'app_version\', \'desc\')" '.CommonFun::sortClass($orderby, 'app_version').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('app_version').'</th>';
              echo '<th onclick="orderby(\'tencent_push_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'tencent_push_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('tencent_push_id').'</th>';
              echo '<th onclick="orderby(\'tencent_push_token\', \'desc\')" '.CommonFun::sortClass($orderby, 'tencent_push_token').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('tencent_push_token').'</th>';
              echo '<th onclick="orderby(\'uid\', \'desc\')" '.CommonFun::sortClass($orderby, 'uid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('uid').'</th>';
              echo '<th onclick="orderby(\'create_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('create_time').'</th>';
              echo '<th onclick="orderby(\'ip\', \'desc\')" '.CommonFun::sortClass($orderby, 'ip').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('ip').'</th>';
         
			?>
	
            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_' . $model->id . '">';
                echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
                echo '  <td>' . $model->id . '</td>';
                echo '  <td>' . $model->device_id . '</td>';
                echo '  <td>' . $model->device_name . '</td>';
                echo '  <td>' . $model->device_model . '</td>';
                echo '  <td>' . $model->connection_type . '</td>';
                echo '  <td>' . $model->os_type . '</td>';
                echo '  <td>' . $model->os_version . '</td>';
                echo '  <td>' . $model->app_version . '</td>';
                echo '  <td>' . $model->tencent_push_id . '</td>';
                echo '  <td>' . $model->tencent_push_token . '</td>';
                echo '  <td>' . $model->uid . '</td>';
                echo '  <td>' . $model->create_time . '</td>';
                echo '  <td>' . $model->ip . '</td>';
                echo '  <td class="center">';
                echo '      <a id="view_btn" onclick="viewAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>';
                echo '      <a id="edit_btn" onclick="editAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>';
                echo '      <a id="delete_btn" onclick="deleteAction(' . $model->id . ')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                echo '  </td>';
                echo '</tr>';
            }
            
            ?>
            
           
           
            </tbody>
            <!-- <tfoot></tfoot> -->
          </table>
          </div>
          </div>
          <!-- row end -->
          
          <!-- row start -->
          <div class="row">
          	<div class="col-sm-5">
            	<div class="dataTables_info" id="data_table_info" role="status" aria-live="polite">
            		<div class="infos">
            		从<?= $pages->getPage() * $pages->getPageSize() + 1 ?>            		到 <?= ($pageCount = ($pages->getPage() + 1) * $pages->getPageSize()) < $pages->totalCount ?  $pageCount : $pages->totalCount?>            		 共 <?= $pages->totalCount?> 条记录</div>
            	</div>
            </div>
          	<div class="col-sm-7">
              	<div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
              	<?= LinkPager::widget([
              	    'pagination' => $pages,
              	    'nextPageLabel' => '»',
              	    'prevPageLabel' => '«',
              	    'firstPageLabel' => '首页',
              	    'lastPageLabel' => '尾页',
              	]); ?>	
              	
              	</div>
          	</div>
		  </div>
		  <!-- row end -->
        </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<div class="modal fade" id="edit_dialog" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "user-device-form", "class"=>"form-horizontal", "action"=>Url::toRoute("user-device/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="UserDevice[id]" />

          <div id="device_id_div" class="form-group">
              <label for="device_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("device_id")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="device_id" name="UserDevice[device_id]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="device_name_div" class="form-group">
              <label for="device_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("device_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="device_name" name="UserDevice[device_name]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="device_model_div" class="form-group">
              <label for="device_model" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("device_model")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="device_model" name="UserDevice[device_model]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="connection_type_div" class="form-group">
              <label for="connection_type" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("connection_type")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="connection_type" name="UserDevice[connection_type]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="os_type_div" class="form-group">
              <label for="os_type" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("os_type")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="os_type" name="UserDevice[os_type]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="os_version_div" class="form-group">
              <label for="os_version" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("os_version")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="os_version" name="UserDevice[os_version]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="app_version_div" class="form-group">
              <label for="app_version" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("app_version")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="app_version" name="UserDevice[app_version]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="tencent_push_id_div" class="form-group">
              <label for="tencent_push_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("tencent_push_id")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="tencent_push_id" name="UserDevice[tencent_push_id]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="tencent_push_token_div" class="form-group">
              <label for="tencent_push_token" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("tencent_push_token")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="tencent_push_token" name="UserDevice[tencent_push_token]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="uid_div" class="form-group">
              <label for="uid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("uid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="uid" name="UserDevice[uid]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_time_div" class="form-group">
              <label for="create_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="create_time" name="UserDevice[create_time]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="ip_div" class="form-group">
              <label for="ip" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("ip")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="ip" name="UserDevice[ip]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>
                    

			<?php ActiveForm::end(); ?>          
                </div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> <a
					id="edit_dialog_ok" href="#" class="btn btn-primary">确定</a>
			</div>
		</div>
	</div>
</div>
<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
 <script>
function orderby(field, op){
	 var url = window.location.search;
	 var optemp = field + " desc";
	 if(url.indexOf('orderby') != -1){
		 url = url.replace(/orderby=([^&?]*)/ig,  function($0, $1){ 
			 var optemp = field + " desc";
			 optemp = decodeURI($1) != optemp ? optemp : field + " asc";
			 return "orderby=" + optemp;
		   }); 
	 }
	 else{
		 if(url.indexOf('?') != -1){
			 url = url + "&orderby=" + encodeURI(optemp);
		 }
		 else{
			 url = url + "?orderby=" + encodeURI(optemp);
		 }
	 }
	 window.location.href=url; 
 }
 function searchAction(){
		$('#user-device-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#device_id").val('');
		$("#device_name").val('');
		$("#device_model").val('');
		$("#connection_type").val('');
		$("#os_type").val('');
		$("#os_version").val('');
		$("#app_version").val('');
		$("#tencent_push_id").val('');
		$("#tencent_push_token").val('');
		$("#uid").val('');
		$("#create_time").val('');
		$("#ip").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#device_id").val(data.device_id);
    	$("#device_name").val(data.device_name);
    	$("#device_model").val(data.device_model);
    	$("#connection_type").val(data.connection_type);
    	$("#os_type").val(data.os_type);
    	$("#os_version").val(data.os_version);
    	$("#app_version").val(data.app_version);
    	$("#tencent_push_id").val(data.tencent_push_id);
    	$("#tencent_push_token").val(data.tencent_push_token);
    	$("#uid").val(data.uid);
    	$("#create_time").val(data.create_time);
    	$("#ip").val(data.ip);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#device_id").attr({readonly:true,disabled:true});
      $("#device_name").attr({readonly:true,disabled:true});
      $("#device_model").attr({readonly:true,disabled:true});
      $("#connection_type").attr({readonly:true,disabled:true});
      $("#os_type").attr({readonly:true,disabled:true});
      $("#os_version").attr({readonly:true,disabled:true});
      $("#app_version").attr({readonly:true,disabled:true});
      $("#tencent_push_id").attr({readonly:true,disabled:true});
      $("#tencent_push_token").attr({readonly:true,disabled:true});
      $("#uid").attr({readonly:true,disabled:true});
      $("#create_time").attr({readonly:true,disabled:true});
      $("#ip").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#device_id").attr({readonly:false,disabled:false});
      $("#device_name").attr({readonly:false,disabled:false});
      $("#device_model").attr({readonly:false,disabled:false});
      $("#connection_type").attr({readonly:false,disabled:false});
      $("#os_type").attr({readonly:false,disabled:false});
      $("#os_version").attr({readonly:false,disabled:false});
      $("#app_version").attr({readonly:false,disabled:false});
      $("#tencent_push_id").attr({readonly:false,disabled:false});
      $("#tencent_push_token").attr({readonly:false,disabled:false});
      $("#uid").attr({readonly:false,disabled:false});
      $("#create_time").attr({readonly:false,disabled:false});
      $("#ip").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('user-device/view')?>",
		   data: {"id":id},
		   cache: false,
		   dataType:"json",
		   error: function (xmlHttpRequest, textStatus, errorThrown) {
			    alert("出错了，" + textStatus);
			},
		   success: function(data){
			   initEditSystemModule(data, type);
		   }
		});
}
	
function editAction(id){
	initModel(id, 'edit');
}

function deleteAction(id){
	var ids = [];
	if(!!id == true){
		ids[0] = id;
	}
	else{
		var checkboxs = $('#data_table :checked');
	    if(checkboxs.size() > 0){
	        var c = 0;
	        for(i = 0; i < checkboxs.size(); i++){
	            var id = checkboxs.eq(i).val();
	            if(id != ""){
	            	ids[c++] = id;
	            }
	        }
	    }
	}
	if(ids.length > 0){
		admin_tool.confirm('请确认是否删除', function(){
		    $.ajax({
				   type: "GET",
				   url: "<?=Url::toRoute('user-device/delete')?>",
				   data: {"ids":ids},
				   cache: false,
				   dataType:"json",
				   error: function (xmlHttpRequest, textStatus, errorThrown) {
					    admin_tool.alert('msg_info', '出错了，' + textStatus, 'warning');
					},
				   success: function(data){
					   for(i = 0; i < ids.length; i++){
						   $('#rowid_' + ids[i]).remove();
					   }
					   admin_tool.alert('msg_info', '删除成功', 'success');
					   window.location.reload();
				   }
				});
		});
	}
	else{
		admin_tool.alert('msg_info', '请先选择要删除的数据', 'warning');
	}
    
}

function getSelectedIdValues(formId)
{
	var value="";
	$( formId + " :checked").each(function(i)
	{
		if(!this.checked)
		{
			return true;
		}
		value += this.value;
		if(i != $("input[name='id']").size()-1)
		{
			value += ",";
		}
	 });
	return value;
}

$('#edit_dialog_ok').click(function (e) {
    e.preventDefault();
	$('#user-device-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#user-device-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('user-device/create')?>" : "<?=Url::toRoute('user-device/update')?>";
    $(this).ajaxSubmit({
    	type: "post",
    	dataType:"json",
		data:{id:id},
    	url: action,
    	success: function(value) 
    	{
        	if(value.errno == 0){
        		$('#edit_dialog').modal('hide');
        		admin_tool.alert('msg_info', '添加成功', 'success');
        		window.location.reload();
        	}
        	else{
            	var json = value.data;
        		for(var key in json){
        			$('#' + key).attr({'data-placement':'bottom', 'data-content':json[key], 'data-toggle':'popover'}).addClass('popover-show').popover('show');
        			
        		}
        	}

    	}
    });
});

 
</script>
<?php $this->endBlock(); ?>