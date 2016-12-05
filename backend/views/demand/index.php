
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\Demand;

$modelLabel = new \backend\models\Demand();
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
                <?php ActiveForm::begin(['id' => 'demand-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('demand/index')]); ?>     
                
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
              echo '<th onclick="orderby(\'view\', \'desc\')" '.CommonFun::sortClass($orderby, 'view').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('view').'</th>';
              echo '<th onclick="orderby(\'create_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('create_time').'</th>';
              echo '<th onclick="orderby(\'price\', \'desc\')" '.CommonFun::sortClass($orderby, 'price').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('price').'</th>';
              echo '<th onclick="orderby(\'unit\', \'desc\')" '.CommonFun::sortClass($orderby, 'unit').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('unit').'</th>';
              echo '<th onclick="orderby(\'number\', \'desc\')" '.CommonFun::sortClass($orderby, 'number').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('number').'</th>';
              echo '<th onclick="orderby(\'group_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'group_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('group_id').'</th>';
              echo '<th onclick="orderby(\'buy_or_sale\', \'desc\')" '.CommonFun::sortClass($orderby, 'buy_or_sale').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('buy_or_sale').'</th>';
              echo '<th onclick="orderby(\'area\', \'desc\')" '.CommonFun::sortClass($orderby, 'area').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('area').'</th>';
              echo '<th onclick="orderby(\'category_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'category_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('category_name').'</th>';
              echo '<th onclick="orderby(\'category_title\', \'desc\')" '.CommonFun::sortClass($orderby, 'category_title').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('category_title').'</th>';
              echo '<th onclick="orderby(\'area_title\', \'desc\')" '.CommonFun::sortClass($orderby, 'area_title').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('area_title').'</th>';
              echo '<th onclick="orderby(\'group_title\', \'desc\')" '.CommonFun::sortClass($orderby, 'group_title').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('group_title').'</th>';
              echo '<th onclick="orderby(\'address\', \'desc\')" '.CommonFun::sortClass($orderby, 'address').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('address').'</th>';
              echo '<th onclick="orderby(\'parse_content\', \'desc\')" '.CommonFun::sortClass($orderby, 'parse_content').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('parse_content').'</th>';
         
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
                echo '  <td>' . $model->view . '</td>';
                echo '  <td>' . $model->create_time . '</td>';
                echo '  <td>' . $model->price . '</td>';
                echo '  <td>' . $model->unit . '</td>';
                echo '  <td>' . $model->number . '</td>';
                echo '  <td>' . $model->group_id . '</td>';
                echo '  <td>' . $model->buy_or_sale . '</td>';
                echo '  <td>' . $model->area . '</td>';
                echo '  <td>' . $model->category_name . '</td>';
                echo '  <td>' . $model->category_title . '</td>';
                echo '  <td>' . $model->area_title . '</td>';
                echo '  <td>' . $model->group_title . '</td>';
                echo '  <td>' . $model->address . '</td>';
                echo '  <td>' . $model->parse_content . '</td>';
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
                <?php $form = ActiveForm::begin(["id" => "demand-form", "class"=>"form-horizontal", "action"=>Url::toRoute("demand/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="Demand[id]" />

          <div id="title_div" class="form-group">
              <label for="title" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("title")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="Demand[title]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="view_div" class="form-group">
              <label for="view" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("view")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="view" name="Demand[view]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_time_div" class="form-group">
              <label for="create_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="create_time" name="Demand[create_time]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="price_div" class="form-group">
              <label for="price" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("price")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="price" name="Demand[price]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="unit_div" class="form-group">
              <label for="unit" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("unit")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="unit" name="Demand[unit]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="number_div" class="form-group">
              <label for="number" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("number")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="number" name="Demand[number]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="group_id_div" class="form-group">
              <label for="group_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("group_id")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="group_id" name="Demand[group_id]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="buy_or_sale_div" class="form-group">
              <label for="buy_or_sale" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("buy_or_sale")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="buy_or_sale" name="Demand[buy_or_sale]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="area_div" class="form-group">
              <label for="area" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("area")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="area" name="Demand[area]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="category_name_div" class="form-group">
              <label for="category_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("category_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="category_name" name="Demand[category_name]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="category_title_div" class="form-group">
              <label for="category_title" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("category_title")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="category_title" name="Demand[category_title]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="area_title_div" class="form-group">
              <label for="area_title" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("area_title")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="area_title" name="Demand[area_title]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="group_title_div" class="form-group">
              <label for="group_title" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("group_title")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="group_title" name="Demand[group_title]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="address_div" class="form-group">
              <label for="address" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("address")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="address" name="Demand[address]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="parse_content_div" class="form-group">
              <label for="parse_content" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("parse_content")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="parse_content" name="Demand[parse_content]" placeholder="必填" />
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
		$('#demand-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#title").val('');
		$("#view").val('');
		$("#create_time").val('');
		$("#price").val('');
		$("#unit").val('');
		$("#number").val('');
		$("#group_id").val('');
		$("#buy_or_sale").val('');
		$("#area").val('');
		$("#category_name").val('');
		$("#category_title").val('');
		$("#area_title").val('');
		$("#group_title").val('');
		$("#address").val('');
		$("#parse_content").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#title").val(data.title);
    	$("#view").val(data.view);
    	$("#create_time").val(data.create_time);
    	$("#price").val(data.price);
    	$("#unit").val(data.unit);
    	$("#number").val(data.number);
    	$("#group_id").val(data.group_id);
    	$("#buy_or_sale").val(data.buy_or_sale);
    	$("#area").val(data.area);
    	$("#category_name").val(data.category_name);
    	$("#category_title").val(data.category_title);
    	$("#area_title").val(data.area_title);
    	$("#group_title").val(data.group_title);
    	$("#address").val(data.address);
    	$("#parse_content").val(data.parse_content);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#title").attr({readonly:true,disabled:true});
      $("#view").attr({readonly:true,disabled:true});
      $("#create_time").attr({readonly:true,disabled:true});
      $("#price").attr({readonly:true,disabled:true});
      $("#unit").attr({readonly:true,disabled:true});
      $("#number").attr({readonly:true,disabled:true});
      $("#group_id").attr({readonly:true,disabled:true});
      $("#buy_or_sale").attr({readonly:true,disabled:true});
      $("#area").attr({readonly:true,disabled:true});
      $("#category_name").attr({readonly:true,disabled:true});
      $("#category_title").attr({readonly:true,disabled:true});
      $("#area_title").attr({readonly:true,disabled:true});
      $("#group_title").attr({readonly:true,disabled:true});
      $("#address").attr({readonly:true,disabled:true});
      $("#parse_content").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#title").attr({readonly:false,disabled:false});
      $("#view").attr({readonly:false,disabled:false});
      $("#create_time").attr({readonly:false,disabled:false});
      $("#price").attr({readonly:false,disabled:false});
      $("#unit").attr({readonly:false,disabled:false});
      $("#number").attr({readonly:false,disabled:false});
      $("#group_id").attr({readonly:false,disabled:false});
      $("#buy_or_sale").attr({readonly:false,disabled:false});
      $("#area").attr({readonly:false,disabled:false});
      $("#category_name").attr({readonly:false,disabled:false});
      $("#category_title").attr({readonly:false,disabled:false});
      $("#area_title").attr({readonly:false,disabled:false});
      $("#group_title").attr({readonly:false,disabled:false});
      $("#address").attr({readonly:false,disabled:false});
      $("#parse_content").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('demand/view')?>",
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
				   url: "<?=Url::toRoute('demand/delete')?>",
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
	$('#demand-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#demand-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('demand/create')?>" : "<?=Url::toRoute('demand/update')?>";
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