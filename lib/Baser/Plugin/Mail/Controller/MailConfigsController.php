<?php

/* SVN FILE: $Id$ */
/**
 * メールフォーム設定コントローラー
 *
 * PHP versions 5
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2013, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2008 - 2013, baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Baser.Plugin.Mail.Controller
 * @since			baserCMS v 0.1.0
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://basercms.net/license/index.html
 */
/**
 * Include files
 */

/**
 * メールフォーム設定コントローラー
 *
 * @package Baser.Plugin.Mail.Controller
 */
class MailConfigsController extends MailAppController {

/**
 * クラス名
 *
 * @var string
 * @access public
 */
	public $name = 'MailConfigs';

/**
 * モデル
 *
 * @var array
 * @access public
 */
	public $uses = array('Mail.MailConfig');

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
 * @var array
 * @access public
 */
	public $crumbs = array(
		array('name' => 'プラグイン管理', 'url' => array('plugin' => '', 'controller' => 'plugins', 'action' => 'index')),
		array('name' => 'メールフォーム管理', 'url' => array('plugin' => 'mail', 'controller' => 'mail_contents', 'action' => 'index'))
	);

/**
 * [ADMIN] メールフォーム設定
 *
 * @return void
 * @access public
 */
	public function admin_form() {
		if (empty($this->request->data)) {
			$this->request->data = $this->MailConfig->read(null, 1);
		} else {

			/* 更新処理 */
			if ($this->MailConfig->save($this->request->data)) {
				$this->setMessage('メールフォーム設定を保存しました。');
				$this->redirect(array('action' => 'form'));
			} else {
				$this->setMessage('入力エラーです。内容を修正してください。', true);
			}
		}

		/* 表示設定 */
		$this->subMenuElements = array('mail_common');
		$this->pageTitle = 'メールプラグイン基本設定';
		$this->help = 'mail_configs_form';
	}

}
