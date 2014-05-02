<?php
/* SVN FILE: $Id$ */
/**
 * [SMARTPHONE] メールフォーム本体
 *
 * PHP versions 5
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2013, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2008 - 2013, baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Baser.Plugin.Mail.View
 * @since			baserCMS v 0.1.0
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://basercms.net/license/index.html
 */
if (!isset($blockStart)) {
	$blockStart = 0;
}
if (!isset($blockEnd)) {
	$blockEnd = null;
}
$data = array(
	'blockStart'	=> $blockStart,
	'blockEnd'		=> $blockEnd
);
$this->BcBaser->includeCore('Mail.Elements/smartphone/mail_input', $data);
