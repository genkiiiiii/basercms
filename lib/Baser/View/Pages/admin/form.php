<?php
/**
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright (c) baserCMS Users Community <http://basercms.net/community/>
 *
 * @copyright		Copyright (c) baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Baser.View
 * @since			baserCMS v 2.0.0
 * @license			http://basercms.net/license/index.html
 */

/**
<<<<<<< .merge_file_e0dXXd
 * [ADMIN] ページ登録・編集フォーム
 * 
 * @var BcAppView $this
=======
 * 連動機能変更時イベント
 */
	$("#PageUnlinkedMobile").change(setStateReflectMobile);
	$("#PageUnlinkedSmartphone").click(setStateReflectSmartphone);
	setStateReflectMobile();
	setStateReflectSmartphone(); 
});
/**
 * モバイル反映欄の表示設定
 */
function pageCategoryIdChangeHandler() {

	var pageType = 1;
	var previewWidth;
	
	if($("#ReflectMobileOn").html() || $("#ReflectSmartphoneOn").html()) { 

		var pageCategoryId = $("#PagePageCategoryId").val();

		if($('input[name="data[Page][page_type]"]:checked').val() == 2 && !pageCategoryId) {
			pageCategoryId = $("#RootMobileId").html();
		} else if($('input[name="data[Page][page_type]"]:checked').val() == 3 && !pageCategoryId) {
			pageCategoryId = $("#RootSmartphoneId").html();
		}

		// モバイルカテゴリ判定
		if($('input[name="data[Page][page_type]"]:checked').val() == 2) {
			pageType = 2;
		} else if($('input[name="data[Page][page_type]"]:checked').val() == 3) {
			pageType = 3;
		}

		// モバイルカテゴリを選択した場合は表示しない
		if(pageType != 2 && $("#Action").html() == 'admin_edit'){
			$.ajax({
				type: "GET",
				url: $("#CheckAgentPageAddableUrl").html()+'/mobile/'+pageCategoryId,
				beforeSend: function() {
					$("#AjaxLoader").show();
				},
				success: function(result){
					if(result) {
						changeStateMobile(pageType, true);
					} else {
						changeStateMobile(pageType, false);
					}
				},
				complete: function() {
					$("#AjaxLoader").hide();
				}
			});
		}else{
			changeStateMobile(pageType, false);
		}
		// スマートフォンカテゴリを選択した場合は表示しない
		if(pageType != 3 && $("#Action").html() == 'admin_edit'){
			$.ajax({
				type: "GET",
				url: $("#CheckAgentPageAddableUrl").html()+'/smartphone/'+pageCategoryId,
				beforeSend: function() {
					$("#AjaxLoader").show();
				},
				success: function(result){
					if(result) {
						changeStateSmartphone(pageType, true);
					} else {
						changeStateSmartphone(pageType, false);
					}
				},
				complete: function() {
					$("#AjaxLoader").hide();
				}
			});
		}else{
			changeStateSmartphone(pageType, false);
		}

	}
	
	// プレビューをモバイル用にリサイズする
	if(pageType == 2) {
		previewWidth = '270px';
	}else if(pageType == 3) {
		previewWidth = '350px';
	} else {
		previewWidth = '90%';
	}

	$("#LinkPreview").colorbox({width: previewWidth, height:"90%", iframe:true,
		onCleanup: function() {
			$.bcToken.update(function(){
				$("input[name='data[_Token][key]']").val($.bcToken.key);
			}, {loaderType: 'none'});
		}
	});
	
}

/**
 * モバイルコピー機能の表示設定
 */
function setStateReflectMobile() {

	if (!$("#PageUnlinkedMobile").size() || $("#PageUnlinkedMobile").attr('checked')) {
		changeStateReflectMobile(true);
	} else {
		changeStateReflectMobile(false);
	}
	
}
/**
 * スマホコピー機能の表示設定
 */
function setStateReflectSmartphone() {

	if (!$("#PageUnlinkedSmartphone").size() || $("#PageUnlinkedSmartphone").attr('checked')) {
		changeStateReflectSmartphone(true);
	} else {
		changeStateReflectSmartphone(false);
	}
  
} 
/**
 * モバイルオプション表示切り替え
 */
function changeStateMobile(pageType, use) {
 
	if(use) {
		if(pageType == 2 || pageType == 3) {
			if($("#PageUnlinkedMobile").attr('checked')) {
				$("#RowMobile").show();
				$("#DivUnlinkedMobile").hide();
			} else {
				$("#RowMobile").hide();
			}
		} else {
			$("#RowMobile").show();
		}
	}else{
		$("#RowMobile").hide();
	}

} 

/**
 * スマートフォンオプション表示切り替え
 */
function changeStateSmartphone(pageType, use) {
  
	if(use) {
		if(pageType == 2 || pageType == 3) {
			if($("#PageUnlinkedSmartphone").attr('checked')) {
				$("#RowSmartphone").show();
				$("#DivUnlinkedSmartphone").hide();
			} else {
				$("#RowSmartphone").hide();
			}
		} else {
			$("#RowSmartphone").show();
		}
	}else{
		$("#RowSmartphone").hide();
	}
  
} 

/**
 * モバイルコピー機能表示切り替え
 */
function changeStateReflectMobile(use) {

	if(use) {
		$("#DivReflectMobile").show();
	}else{
		$("#PageReflectMobile").attr('checked', false);
		$("#DivReflectMobile").hide();
	}
  
} 

/**
 * スマートフォンコピー機能表示切り替え
>>>>>>> .merge_file_ISDO3c
 */
$this->BcBaser->css('admin/ckeditor/editor', array('inline' => true));
$this->BcBaser->js('admin/pages/edit', false);
?>


<div class="display-none">
	<div id="Action"><?php echo $this->request->action ?></div>
</div>

<?php echo $this->BcForm->create('Page') ?>
<?php echo $this->BcForm->input('Page.mode', array('type' => 'hidden')) ?>
<?php echo $this->BcForm->input('Page.id', array('type' => 'hidden')) ?>

<?php echo $this->BcFormTable->dispatchBefore() ?>

<div class="section editor-area">
	<?php echo $this->BcForm->input('Page.contents', array_merge(array(
        'type' => 'editor',
		'editor' => @$siteConfig['editor'],
		'editorUseDraft' => true,
		'editorDraftField' => 'draft',
		'editorWidth' => 'auto',
		'editorHeight' => '480px',
		'editorEnterBr' => @$siteConfig['editor_enter_br']
			), $editorOptions)); ?>
	<?php echo $this->BcForm->error('Page.contents') ?>
</div>

<?php if (BcUtil::isAdminUser()): ?>
<div class="section">
	<table cellpadding="0" cellspacing="0" class="form-table">
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Page.page_template', '固定ページテンプレート') ?></th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Page.page_template', array('type' => 'select', 'options' => $pageTemplateList)) ?>
				<div class="helptext">
					テーマフォルダ内の、Pages/templates テンプレートを配置する事で、ここでテンプレートを選択できます。
				</div>
				<?php echo $this->BcForm->error('Page.page_template') ?>
			</td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Page.code', 'コード') ?></th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Page.code', array(
					'type' => 'textarea',
					'cols' => 36,
					'rows' => 5,
					'style' => 'font-size:14px;font-family:Verdana,Arial,sans-serif;'
				)); ?>
				<?php echo $this->Html->image('admin/icn_help.png', array('class' => 'btn help', 'alt' => 'ヘルプ')) ?>
				<div class="helptext">
					固定ページの本文には、ソースコードに切り替えてPHPやJavascriptのコードを埋め込む事ができますが、ユーザーが間違って削除してしまわないようにこちらに入力しておく事もできます。<br />
					入力したコードは、自動的にコンテンツ本体の上部に差し込みます。
				</div>
				<?php echo $this->BcForm->error('Page.code') ?>
			</td>
		</tr>
		<?php echo $this->BcForm->dispatchAfterForm() ?>
	</table>
</div>
<?php endif ?>

<?php echo $this->BcFormTable->dispatchAfter() ?>

<div class="submit">
	<?php echo $this->BcForm->submit('保存', array('div' => false, 'class' => 'button', 'id' => 'BtnSave')) ?>
</div>

<?php echo $this->BcForm->end(); ?>
