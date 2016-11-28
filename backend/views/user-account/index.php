
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\UserAccount;

$modelLabel = new \backend\models\UserAccount();
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
                <?php ActiveForm::begin(['id' => 'user-account-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('user-account/index')]); ?>     
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('uid')?>:</label>
                      <input type="text" class="form-control" id="query[uid]" name="query[uid]"  value="<?=isset($query["uid"]) ? $query["uid"] : "" ?>">
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
              echo '<th onclick="orderby(\'uid\', \'desc\')" '.CommonFun::sortClass($orderby, 'uid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('uid').'</th>';
              echo '<th onclick="orderby(\'username\', \'desc\')" '.CommonFun::sortClass($orderby, 'username').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('username').'</th>';
              echo '<th onclick="orderby(\'nickname\', \'desc\')" '.CommonFun::sortClass($orderby, 'nickname').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('nickname').'</th>';
              echo '<th onclick="orderby(\'email\', \'desc\')" '.CommonFun::sortClass($orderby, 'email').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('email').'</th>';
              echo '<th onclick="orderby(\'mobile\', \'desc\')" '.CommonFun::sortClass($orderby, 'mobile').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('mobile').'</th>';
              echo '<th onclick="orderby(\'avatar\', \'desc\')" '.CommonFun::sortClass($orderby, 'avatar').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('avatar').'</th>';
              echo '<th onclick="orderby(\'contact\', \'desc\')" '.CommonFun::sortClass($orderby, 'contact').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('contact').'</th>';
              echo '<th onclick="orderby(\'product\', \'desc\')" '.CommonFun::sortClass($orderby, 'product').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('product').'</th>';
              echo '<th onclick="orderby(\'product\', \'desc\')" '.CommonFun::sortClass($orderby, 'flag').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('flag').'</th>';
            ?>
	
            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_' . $model->id . '">';
                echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
                echo '  <td>' . $model->uid . '</td>';
                echo '  <td>' . $model->username . '</td>';
                echo '  <td>' . $model->nickname . '</td>';
                echo '  <td>' . $model->email . '</td>';
                echo '  <td>' . $model->mobile . '</td>';
                echo '  <td>' . $model->avatar . '</td>';
                echo '  <td>' . $model->contact . '</td>';
                echo '  <td>' . $model->product . '</td>';
                echo '  <td>' . $model->flag . '</td>';
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
                <?php $form = ActiveForm::begin(["id" => "user-account-form", "class"=>"form-horizontal", "action"=>Url::toRoute("user-account/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="UserAccount[uid]" />

          <div id="username_div" class="form-group">
              <label for="username" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("username")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="username" name="UserAccount[username]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="nickname_div" class="form-group">
              <label for="nickname" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("nickname")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="nickname" name="UserAccount[nickname]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="email_div" class="form-group">
              <label for="email" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("email")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" name="UserAccount[email]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="mobile_div" class="form-group">
              <label for="mobile" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("mobile")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="mobile" name="UserAccount[mobile]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="avatar_div" class="form-group">
              <label for="avatar" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("avatar")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="avatar" name="UserAccount[avatar]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="contact_div" class="form-group">
              <label for="contact" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("contact")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="contact" name="UserAccount[contact]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="product_div" class="form-group">
              <label for="product" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("product")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="product" name="UserAccount[product]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="parse_content_div" class="form-group">
              <label for="parse_content" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("parse_content")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="parse_content" name="UserAccount[parse_content]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="content_div" class="form-group">
              <label for="content" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("content")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="content" name="UserAccount[content]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

            <div id="flag_div" class="form-group">
                <label for="flag" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("flag")?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="flag" name="UserAccount[flag]" placeholder="1" />
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
		$('#user-account-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#uid").val('');
		$("#username").val('');
		$("#nickname").val('');
		$("#email").val('');
		$("#mobile").val('');
		$("#avatar").val('');
		$("#contact").val('');
		$("#product").val('');
		$("#parse_content").val('');
		$("#content").val('');
//        $("#flag").val('');
	}
	else{
		$("#uid").val(data.uid);
    	$("#username").val(data.username);
    	$("#nickname").val(data.nickname);
    	$("#email").val(data.email);
    	$("#mobile").val(data.mobile);
    	$("#avatar").val(data.avatar);
    	$("#contact").val(data.contact);
    	$("#product").val(data.product);
    	$("#parse_content").val(data.parse_content);
    	$("#content").val(data.content);
        $("#flag").val(flag.content);
    	}
	if(type == "view"){
      $("#uid").attr({readonly:true,disabled:true});
      $("#username").attr({readonly:true,disabled:true});
      $("#nickname").attr({readonly:true,disabled:true});
      $("#email").attr({readonly:true,disabled:true});
      $("#mobile").attr({readonly:true,disabled:true});
      $("#avatar").attr({readonly:true,disabled:true});
      $("#contact").attr({readonly:true,disabled:true});
      $("#product").attr({readonly:true,disabled:true});
      $("#parse_content").attr({readonly:true,disabled:true});
      $("#content").attr({readonly:true,disabled:true});
      $("#flag").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#uid").attr({readonly:false,disabled:false});
      $("#username").attr({readonly:false,disabled:false});
      $("#nickname").attr({readonly:false,disabled:false});
      $("#email").attr({readonly:false,disabled:false});
      $("#mobile").attr({readonly:false,disabled:false});
      $("#avatar").attr({readonly:false,disabled:false});
      $("#contact").attr({readonly:false,disabled:false});
      $("#product").attr({readonly:false,disabled:false});
      $("#parse_content").attr({readonly:false,disabled:false});
      $("#content").attr({readonly:false,disabled:false});
      $("#flag").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('user-account/view')?>",
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
				   url: "<?=Url::toRoute('user-account/delete')?>",
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
	$('#user-account-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#user-account-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('user-account/create')?>" : "<?=Url::toRoute('user-account/update')?>";
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