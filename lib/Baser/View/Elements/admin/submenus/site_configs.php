<?php
/**
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright (c) baserCMS Users Community <http://basercms.net/community/>
 *
 * @copyright		Copyright (c) baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Baser.View
 * @since			baserCMS v 0.1.0
 * @license			http://basercms.net/license/index.html
 */

/**
 * [ADMIN] システム設定メニュー
 */
?>


<tr>
	<th>システム設定メニュー</th>
	<td>
		<ul class="cleafix">
			<li><?php $this->BcBaser->link('サイト基本設定', array('controller' => 'site_configs', 'action' => 'form', 'plugin' => null)) ?></li>
			<li><?php $this->BcBaser->link('ユーザー管理', array('controller' => 'users', 'action' => 'index', 'plugin' => null)) ?></li>
			<li><?php $this->BcBaser->link('ユーザーグループ管理', array('controller' => 'user_groups', 'action' => 'index', 'plugin' => null)) ?></li>
			<li><?php $this->BcBaser->link('検索インデックス管理', array('controller' => 'search_indices', 'action' => 'index', 'plugin' => null)) ?></li>
			<li><?php $this->BcBaser->link('エディタテンプレート管理', array('controller' => 'editor_templates', 'action' => 'index', 'plugin' => null)) ?></li>
<<<<<<< .merge_file_WBmPMR
			<li><?php $this->BcBaser->link('サブサイト管理', array('controller' => 'sites', 'action' => 'index', 'plugin' => null)) ?></li>
			<li><?php $this->BcBaser->link('ユーティリティ', array('controller' => 'tools', 'action' => 'index', 'plugin' => null)) ?></li>
=======
		</ul>
	</td>
</tr>
<tr>
	<th>ユーティリティ</th>
	<td>
		<ul class="cleafix">
			<li><?php $this->BcBaser->link('サーバーキャッシュ削除', array('controller' => 'site_configs', 'action' => 'del_cache', 'plugin' => null), array('confirm' => 'サーバーキャッシュを削除します。いいですか？')) ?></li>
			<li><?php $this->BcBaser->link('データメンテナンス', array('controller' => 'tools', 'action' => 'maintenance', 'plugin' => null)) ?></li>
			<li><?php $this->BcBaser->link('ログメンテナンス', array('controller' => 'tools', 'action' => 'log', 'plugin' => null)) ?></li>
			<li><?php $this->BcBaser->link('環境情報', array('controller' => 'site_configs', 'action' => 'info', 'plugin' => null)) ?></li>
			<li><?php $this->BcBaser->link('クレジット', 'javascript:void(0)', array('id' => 'BtnCredit')) ?></li>
>>>>>>> .merge_file_UbCGzS
		</ul>
	</td>
</tr>
