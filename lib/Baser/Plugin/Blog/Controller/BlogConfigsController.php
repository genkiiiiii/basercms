<?php

/**
 * ブログ設定コントローラー
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2015, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2008 - 2015, baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Blog.Controller
 * @since			baserCMS v 0.1.0
 * @license			http://basercms.net/license/index.html
 */
/**
 * Include files
 */

/**
 * ブログ設定コントローラー
 *
 * @package Blog.Controller
 */
class BlogConfigsController extends BlogAppController {

/**
 * クラス名
 *
 * @var string
 * @access public
 */
	public $name = 'BlogConfigs';

/**
 * モデル
 *
 * @var array
 * @access public
 */
	public $uses = array('User', 'Blog.BlogCategory', 'Blog.BlogConfig', 'Blog.BlogContent');

/**
 * コンポーネント
 *
 * @var array
 * @access public
 */
	public $components = array('BcAuth', 'Cookie', 'BcAuthConfigure');

/**
 * サブメニューエレメント
 *
 * @var array
 * @access public
 */
	public $subMenuElements = array();

/**
 * ぱんくずナビ
 *
 * @var string
 * @access public
 */
	public $crumbs = array(
		array('name' => 'プラグイン管理', 'url' => array('plugin' => '', 'controller' => 'plugins', 'action' => 'index')),
		array('name' => 'ブログ管理', 'url' => array('controller' => 'blog_contents', 'action' => 'index'))
	);

/**
 * before_filter
 *
 * @return void
 * @access public
 */
	public function beforeFilter() {
		parent::beforeFilter();
		if ($this->params['prefix'] == 'admin') {
			$this->subMenuElements = array('blog_common');
		}
	}

/**
 * [ADMIN] サイト基本設定
 *
 * @return void
 * @access public
 */
	public function admin_form() {
		if (empty($this->request->data)) {
			$this->request->data = $this->BlogConfig->read(null, 1);
			$blogContentList = $this->BlogContent->find("list");
			$this->set('blogContentList', $blogContentList);
			$userList = $this->User->find("list");
			$this->set('userList', $userList);
		} else {

			/* 更新処理 */
			if ($this->BlogConfig->save($this->request->data)) {
				$this->setMessage('ブログ設定を保存しました。', false, true);
				$this->redirect(array('action' => 'form'));
			} else {
				$this->setMessage('入力エラーです。内容を修正してください。', true);
			}
		}

		/* 表示設定 */
		$this->pageTitle = 'ブログ設定';
	}

}
