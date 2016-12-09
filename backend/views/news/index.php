
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\News;

$modelLabel = new \backend\models\News();
?>

<?php $this->beginBlock('header');  ?>
<script src="<?=Url::base()?>/plugins/bootstrap-fileinput/fileinput.min.js"></script>
<link rel="stylesheet" href="<?=Url::base()?>/plugins/bootstrap-fileinput/fileinput.min.css">
<script src="<?=Url::base()?>/plugins/bootstrap-fileinput/locales/zh.js"></script>

<script src="<?=Url::base()?>/plugins/ckeditor/ckeditor.js"></script>
<script src="<?=Url::base()?>/plugins/ckeditor/styles.js"></script>
<script src="<?=Url::base()?>/plugins/ckeditor/lang/zh.js"></script>

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
                <?php ActiveForm::begin(['id' => 'news-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('news/index')]); ?>     
                
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
              echo '<th onclick="orderby(\'category_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'category_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('category_id').'</th>';
              echo '<th onclick="orderby(\'tags\', \'desc\')" '.CommonFun::sortClass($orderby, 'tags').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('tags').'</th>';
              echo '<th onclick="orderby(\'cover_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'cover_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('cover_id').'</th>';
              echo '<th onclick="orderby(\'cover_thumb_url\', \'desc\')" '.CommonFun::sortClass($orderby, 'cover_thumb_url').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('cover_thumb_url').'</th>';
              echo '<th onclick="orderby(\'create_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('create_time').'</th>';
              echo '<th onclick="orderby(\'view\', \'desc\')" '.CommonFun::sortClass($orderby, 'view').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('view').'</th>';
              echo '<th onclick="orderby(\'uid\', \'desc\')" '.CommonFun::sortClass($orderby, 'uid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('uid').'</th>';
              echo '<th onclick="orderby(\'sort\', \'desc\')" '.CommonFun::sortClass($orderby, 'sort').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('sort').'</th>';
              echo '<th onclick="orderby(\'flag\', \'desc\')" '.CommonFun::sortClass($orderby, 'flag').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('flag').'</th>';
         
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
                echo '  <td>' . $model->category_id . '</td>';
                echo '  <td>' . $model->tags . '</td>';
                echo '  <td>' . $model->cover_id . '</td>';
                echo '  <td>' . $model->cover_thumb_url . '</td>';
                echo '  <td>' . $model->create_time . '</td>';
                echo '  <td>' . $model->view . '</td>';
                echo '  <td>' . $model->uid . '</td>';
                echo '  <td>' . $model->sort . '</td>';
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
	<div class="modal-dialog" style="width: 800px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "news-form", "class"=>"form-horizontal", "action"=>Url::toRoute("news/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="News[id]" />

          <div id="title_div" class="form-group">
              <label for="title" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("title")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="News[title]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="description_div" class="form-group">
              <label for="description" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("description")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="description" name="News[description]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="category_id_div" class="form-group">
              <label for="category_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("category_id")?></label>
              <div class="col-sm-10">
				  <select class="form-control" name="News[category_id]" id="category_id">
					  <option>请选择</option>
					  <?php

					  foreach($categorys as $key=>$data){
						  echo "<option value='" . $key . "'>". $data."</option>";
					  }
					  ?>
				  </select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="tags_div" class="form-group">
              <label for="tags" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("tags")?></label>
              <div class="col-sm-10">
				  <select class="form-control" id="tags" name="News[tags]">
					  <option>请选择</option>
					  <?php

					  foreach($tags as $key=>$data){
						  echo "<option value='" . $data . "'>". $data."</option>";
					  }
					  ?>
				  </select>
              </div>
              <div class="clearfix"></div>
          </div>
          <input type="hidden" class="form-control" id="cover_id" name="News[cover_id]" placeholder="" />
          <div id="cover_thumb_url_div" class="form-group">
              <label for="cover_thumb_url" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cover_thumb_url")?></label>
              <div class="col-sm-10">
				  <input type="hidden" class="form-control" id="cover_thumb_url" name="News[cover_thumb_url]" placeholder="" />
				  <input id="input-image" name="file" type="file" multiple class="file-loading" accept="image/*">
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="parse_content_div" class="form-group">
              <label for="parse_content" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("parse_content")?></label>
              <div class="col-sm-10">
                  <input type="hidden"  id="parse_content" name="News[parse_content]" placeholder="必填" />
				  <textarea  id="editor" name="editor" ></textarea>
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
<!-- <body></body>后代码块 -->
<style>
	.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
		margin: 0;
		padding: 0;
		border: none;
		box-shadow: none;
		text-align: center;
	}
	.kv-avatar .file-input {
		display: table-cell;
		max-width: 220px;
	}
</style>
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
		$('#news-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#title").val('');
		$("#description").val('点木通');
		$("#category_id").val('');
		$("#tags").val('');
		$("#cover_id").val('');
		$("#cover_thumb_url").val('');
		$("#parse_content").val('');
	}
	else{
		$("#id").val(data.id);
    	$("#title").val(data.title);
    	$("#description").val(data.description);
    	$("#category_id").val(data.category_id);
    	$("#tags").val(data.tags);
    	$("#cover_id").val(data.cover_id);
    	$("#cover_thumb_url").val(data.cover_thumb_url);
    	$("#parse_content").val(data.parse_content);
		$("#editor").val(data.parse_content);
		initEditIconAction(data.cover_thumb_url);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#title").attr({readonly:true,disabled:true});
      $("#description").attr({readonly:true,disabled:true});
      $("#category_id").attr({readonly:true,disabled:true});
      $("#tags").attr({readonly:true,disabled:true});
      $("#parse_content").attr({readonly:true,disabled:true});
		$('#edit_dialog_ok').addClass('hidden');
		$("#input-image").attr({readonly:true,disabled:true});
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#title").attr({readonly:false,disabled:false});
      $("#description").attr({readonly:false,disabled:false});
      $("#category_id").attr({readonly:false,disabled:false});
      $("#tags").attr({readonly:false,disabled:false});
      $("#parse_content").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
//	 var ckpath = '<?//=Url::base()?>///plugins/';
	 initEditIconAction(data.cover_thumb_url);
	 var editor =CKEDITOR.replace( 'editor', {
		 uiColor: '#9AB8F3',
		 // Configure your file manager integration. This example uses CKFinder 3 for PHP.
//		 filebrowserBrowseUrl: ckpath + 'ckfinder/ckfinder.html',
//		 filebrowserImageBrowseUrl: ckpath +'ckfinder/ckfinder.html?type=Images',
//		 filebrowserUploadUrl: ckpath + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		 filebrowserUploadUrl:'/upload/ckimage',
		 filebrowserImageUploadUrl: '/upload/ckimage'
//		 filebrowserImageUploadUrl: ckpath + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
	 });
	 editor.on( 'change', function( evt ) {
		 $("#parse_content").val(evt.editor.getData());
	 });
}

function initEditIconAction($cover_thumb_url) {
	$("#input-image").fileinput({
		language: 'zh',
		uploadUrl: "/upload/image",
		overwriteInitial: true,
//		maxFileSize: 1500,
		maxImageWidth: 640,
		maxImageHeight: 300,
		resizeImage: true,
		showClose: false,
		showCaption: false,
		browseOnZoneClick: true,
		browseLabel: '',
		removeLabel: '',
		browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
		removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		removeTitle: '取消或重置',
		elErrorContainer: '#kv-avatar-errors-1',
		msgErrorClass: 'alert alert-block alert-danger',
		defaultPreviewContent: '<img src="' + $cover_thumb_url + '" alt="图标" style="width:150px">',
		layoutTemplates: {main2: '{preview}{remove}{browse}'},
		allowedFileExtensions: ["jpg", "png", "gif"]
	}).on('filepreupload', function() {
		$('#cover_thumb_url').val('');
	}).on('fileuploaded', function(event, data) {
		$('#cover_thumb_url').val(data.response.link);
	});
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('news/view')?>",
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
				   url: "<?=Url::toRoute('news/delete')?>",
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
	$('#news-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#news-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('news/create')?>" : "<?=Url::toRoute('news/update')?>";
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