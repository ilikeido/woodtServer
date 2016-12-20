
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\UserEvendata;

$modelLabel = new \backend\models\UserEvendata();
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
                <?php ActiveForm::begin(['id' => 'user-evendata-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('user-evendata/index')]); ?>     
                
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
              echo '<th onclick="orderby(\'uid\', \'desc\')" '.CommonFun::sortClass($orderby, 'uid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('uid').'</th>';
              echo '<th onclick="orderby(\'last_update_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'last_update_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('last_update_time').'</th>';
              echo '<th onclick="orderby(\'nickname\', \'desc\')" '.CommonFun::sortClass($orderby, 'nickname').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('nickname').'</th>';
              echo '<th onclick="orderby(\'avatar\', \'desc\')" '.CommonFun::sortClass($orderby, 'avatar').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('avatar').'</th>';
              echo '<th onclick="orderby(\'product\', \'desc\')" '.CommonFun::sortClass($orderby, 'product').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('product').'</th>';
              echo '<th onclick="orderby(\'contact\', \'desc\')" '.CommonFun::sortClass($orderby, 'contact').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('contact').'</th>';
              echo '<th onclick="orderby(\'level_number\', \'desc\')" '.CommonFun::sortClass($orderby, 'level_number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('level_number').'</th>';
              echo '<th onclick="orderby(\'dynamic_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'dynamic_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('dynamic_id').'</th>';
              echo '<th onclick="orderby(\'demand_count\', \'desc\')" '.CommonFun::sortClass($orderby, 'demand_count').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('demand_count').'</th>';
              echo '<th onclick="orderby(\'dynamic_count\', \'desc\')" '.CommonFun::sortClass($orderby, 'dynamic_count').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('dynamic_count').'</th>';
              echo '<th onclick="orderby(\'attention_count\', \'desc\')" '.CommonFun::sortClass($orderby, 'attention_count').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('attention_count').'</th>';
              echo '<th onclick="orderby(\'collection_count\', \'desc\')" '.CommonFun::sortClass($orderby, 'collection_count').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('collection_count').'</th>';
              echo '<th onclick="orderby(\'fans_count\', \'desc\')" '.CommonFun::sortClass($orderby, 'fans_count').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('fans_count').'</th>';
              echo '<th onclick="orderby(\'friend_count\', \'desc\')" '.CommonFun::sortClass($orderby, 'friend_count').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('friend_count').'</th>';
              echo '<th onclick="orderby(\'notify_count\', \'desc\')" '.CommonFun::sortClass($orderby, 'notify_count').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('notify_count').'</th>';
         
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
                echo '  <td>' . $model->uid . '</td>';
                echo '  <td>' . $model->last_update_time . '</td>';
                echo '  <td>' . $model->nickname . '</td>';
                echo '  <td>' . $model->avatar . '</td>';
                echo '  <td>' . $model->product . '</td>';
                echo '  <td>' . $model->contact . '</td>';
                echo '  <td>' . $model->level_number . '</td>';
                echo '  <td>' . $model->dynamic_id . '</td>';
                echo '  <td>' . $model->demand_count . '</td>';
                echo '  <td>' . $model->dynamic_count . '</td>';
                echo '  <td>' . $model->attention_count . '</td>';
                echo '  <td>' . $model->collection_count . '</td>';
                echo '  <td>' . $model->fans_count . '</td>';
                echo '  <td>' . $model->friend_count . '</td>';
                echo '  <td>' . $model->notify_count . '</td>';
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
                <?php $form = ActiveForm::begin(["id" => "user-evendata-form", "class"=>"form-horizontal", "action"=>Url::toRoute("user-evendata/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="UserEvendata[id]" />

          <div id="uid_div" class="form-group">
              <label for="uid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("uid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="uid" name="UserEvendata[uid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="last_update_time_div" class="form-group">
              <label for="last_update_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("last_update_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="last_update_time" name="UserEvendata[last_update_time]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="nickname_div" class="form-group">
              <label for="nickname" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("nickname")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="nickname" name="UserEvendata[nickname]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="avatar_div" class="form-group">
              <label for="avatar" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("avatar")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="avatar" name="UserEvendata[avatar]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="product_div" class="form-group">
              <label for="product" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("product")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="product" name="UserEvendata[product]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="contact_div" class="form-group">
              <label for="contact" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("contact")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="contact" name="UserEvendata[contact]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="level_number_div" class="form-group">
              <label for="level_number" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("level_number")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="level_number" name="UserEvendata[level_number]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="dynamic_id_div" class="form-group">
              <label for="dynamic_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("dynamic_id")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="dynamic_id" name="UserEvendata[dynamic_id]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="demand_count_div" class="form-group">
              <label for="demand_count" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("demand_count")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="demand_count" name="UserEvendata[demand_count]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="dynamic_count_div" class="form-group">
              <label for="dynamic_count" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("dynamic_count")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="dynamic_count" name="UserEvendata[dynamic_count]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="attention_count_div" class="form-group">
              <label for="attention_count" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("attention_count")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="attention_count" name="UserEvendata[attention_count]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="collection_count_div" class="form-group">
              <label for="collection_count" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("collection_count")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="collection_count" name="UserEvendata[collection_count]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="fans_count_div" class="form-group">
              <label for="fans_count" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("fans_count")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="fans_count" name="UserEvendata[fans_count]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="friend_count_div" class="form-group">
              <label for="friend_count" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("friend_count")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="friend_count" name="UserEvendata[friend_count]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="notify_count_div" class="form-group">
              <label for="notify_count" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("notify_count")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="notify_count" name="UserEvendata[notify_count]" placeholder="必填" />
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
		$('#user-evendata-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#uid").val('');
		$("#last_update_time").val('');
		$("#nickname").val('');
		$("#avatar").val('');
		$("#product").val('');
		$("#contact").val('');
		$("#level_number").val('');
		$("#dynamic_id").val('');
		$("#demand_count").val('');
		$("#dynamic_count").val('');
		$("#attention_count").val('');
		$("#collection_count").val('');
		$("#fans_count").val('');
		$("#friend_count").val('');
		$("#notify_count").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#uid").val(data.uid);
    	$("#last_update_time").val(data.last_update_time);
    	$("#nickname").val(data.nickname);
    	$("#avatar").val(data.avatar);
    	$("#product").val(data.product);
    	$("#contact").val(data.contact);
    	$("#level_number").val(data.level_number);
    	$("#dynamic_id").val(data.dynamic_id);
    	$("#demand_count").val(data.demand_count);
    	$("#dynamic_count").val(data.dynamic_count);
    	$("#attention_count").val(data.attention_count);
    	$("#collection_count").val(data.collection_count);
    	$("#fans_count").val(data.fans_count);
    	$("#friend_count").val(data.friend_count);
    	$("#notify_count").val(data.notify_count);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#uid").attr({readonly:true,disabled:true});
      $("#last_update_time").attr({readonly:true,disabled:true});
      $("#nickname").attr({readonly:true,disabled:true});
      $("#avatar").attr({readonly:true,disabled:true});
      $("#product").attr({readonly:true,disabled:true});
      $("#contact").attr({readonly:true,disabled:true});
      $("#level_number").attr({readonly:true,disabled:true});
      $("#dynamic_id").attr({readonly:true,disabled:true});
      $("#demand_count").attr({readonly:true,disabled:true});
      $("#dynamic_count").attr({readonly:true,disabled:true});
      $("#attention_count").attr({readonly:true,disabled:true});
      $("#collection_count").attr({readonly:true,disabled:true});
      $("#fans_count").attr({readonly:true,disabled:true});
      $("#friend_count").attr({readonly:true,disabled:true});
      $("#notify_count").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#uid").attr({readonly:false,disabled:false});
      $("#last_update_time").attr({readonly:false,disabled:false});
      $("#nickname").attr({readonly:false,disabled:false});
      $("#avatar").attr({readonly:false,disabled:false});
      $("#product").attr({readonly:false,disabled:false});
      $("#contact").attr({readonly:false,disabled:false});
      $("#level_number").attr({readonly:false,disabled:false});
      $("#dynamic_id").attr({readonly:false,disabled:false});
      $("#demand_count").attr({readonly:false,disabled:false});
      $("#dynamic_count").attr({readonly:false,disabled:false});
      $("#attention_count").attr({readonly:false,disabled:false});
      $("#collection_count").attr({readonly:false,disabled:false});
      $("#fans_count").attr({readonly:false,disabled:false});
      $("#friend_count").attr({readonly:false,disabled:false});
      $("#notify_count").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('user-evendata/view')?>",
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
				   url: "<?=Url::toRoute('user-evendata/delete')?>",
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
	$('#user-evendata-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#user-evendata-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('user-evendata/create')?>" : "<?=Url::toRoute('user-evendata/update')?>";
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