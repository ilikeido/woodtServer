
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\Advert;

$modelLabel = new \backend\models\Advert();
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
                <?php ActiveForm::begin(['id' => 'advert-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('advert/index')]); ?>     
                
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
              echo '<th onclick="orderby(\'title\', \'desc\')" '.CommonFun::sortClass($orderby, 'title').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('title').'</th>';
              echo '<th onclick="orderby(\'description\', \'desc\')" '.CommonFun::sortClass($orderby, 'description').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('description').'</th>';
              echo '<th onclick="orderby(\'level\', \'desc\')" '.CommonFun::sortClass($orderby, 'level').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('level').'</th>';
              echo '<th onclick="orderby(\'goto\', \'desc\')" '.CommonFun::sortClass($orderby, 'goto').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('goto').'</th>';
              echo '<th onclick="orderby(\'record_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'record_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('record_id').'</th>';
              echo '<th onclick="orderby(\'category_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'category_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('category_id').'</th>';
              echo '<th onclick="orderby(\'category_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'category_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('category_name').'</th>';
              echo '<th onclick="orderby(\'category_title\', \'desc\')" '.CommonFun::sortClass($orderby, 'category_title').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('category_title').'</th>';
              echo '<th onclick="orderby(\'banner_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'banner_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('banner_id').'</th>';
              echo '<th onclick="orderby(\'banner_url\', \'desc\')" '.CommonFun::sortClass($orderby, 'banner_url').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('banner_url').'</th>';
         
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
                echo '  <td>' . $model->title . '</td>';
                echo '  <td>' . $model->description . '</td>';
                echo '  <td>' . $model->level . '</td>';
                echo '  <td>' . $model->goto . '</td>';
                echo '  <td>' . $model->record_id . '</td>';
                echo '  <td>' . $model->category_id . '</td>';
                echo '  <td>' . $model->category_name . '</td>';
                echo '  <td>' . $model->category_title . '</td>';
                echo '  <td>' . $model->banner_id . '</td>';
                echo '  <td>' . $model->banner_url . '</td>';
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
                <?php $form = ActiveForm::begin(["id" => "advert-form", "class"=>"form-horizontal", "action"=>Url::toRoute("advert/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="Advert[id]" />

          <div id="title_div" class="form-group">
              <label for="title" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("title")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="Advert[title]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="description_div" class="form-group">
              <label for="description" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("description")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="description" name="Advert[description]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="level_div" class="form-group">
              <label for="level" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("level")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="level" name="Advert[level]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="goto_div" class="form-group">
              <label for="goto" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("goto")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="goto" name="Advert[goto]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="record_id_div" class="form-group">
              <label for="record_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("record_id")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="record_id" name="Advert[record_id]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="category_id_div" class="form-group">
              <label for="category_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("category_id")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="category_id" name="Advert[category_id]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="category_name_div" class="form-group">
              <label for="category_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("category_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="category_name" name="Advert[category_name]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="category_title_div" class="form-group">
              <label for="category_title" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("category_title")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="category_title" name="Advert[category_title]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="banner_id_div" class="form-group">
              <label for="banner_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("banner_id")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="banner_id" name="Advert[banner_id]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="banner_url_div" class="form-group">
              <label for="banner_url" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("banner_url")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="banner_url" name="Advert[banner_url]" placeholder="必填" />
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
		$('#advert-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#title").val('');
		$("#description").val('');
		$("#level").val('');
		$("#goto").val('');
		$("#record_id").val('');
		$("#category_id").val('');
		$("#category_name").val('');
		$("#category_title").val('');
		$("#banner_id").val('');
		$("#banner_url").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#title").val(data.title);
    	$("#description").val(data.description);
    	$("#level").val(data.level);
    	$("#goto").val(data.goto);
    	$("#record_id").val(data.record_id);
    	$("#category_id").val(data.category_id);
    	$("#category_name").val(data.category_name);
    	$("#category_title").val(data.category_title);
    	$("#banner_id").val(data.banner_id);
    	$("#banner_url").val(data.banner_url);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#title").attr({readonly:true,disabled:true});
      $("#description").attr({readonly:true,disabled:true});
      $("#level").attr({readonly:true,disabled:true});
      $("#goto").attr({readonly:true,disabled:true});
      $("#record_id").attr({readonly:true,disabled:true});
      $("#category_id").attr({readonly:true,disabled:true});
      $("#category_name").attr({readonly:true,disabled:true});
      $("#category_title").attr({readonly:true,disabled:true});
      $("#banner_id").attr({readonly:true,disabled:true});
      $("#banner_url").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#title").attr({readonly:false,disabled:false});
      $("#description").attr({readonly:false,disabled:false});
      $("#level").attr({readonly:false,disabled:false});
      $("#goto").attr({readonly:false,disabled:false});
      $("#record_id").attr({readonly:false,disabled:false});
      $("#category_id").attr({readonly:false,disabled:false});
      $("#category_name").attr({readonly:false,disabled:false});
      $("#category_title").attr({readonly:false,disabled:false});
      $("#banner_id").attr({readonly:false,disabled:false});
      $("#banner_url").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('advert/view')?>",
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
				   url: "<?=Url::toRoute('advert/delete')?>",
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
	$('#advert-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#advert-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('advert/create')?>" : "<?=Url::toRoute('advert/update')?>";
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