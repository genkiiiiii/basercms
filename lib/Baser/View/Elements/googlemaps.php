<?php

/**
 * [PUBLISH] グールグルマップ
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2014, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2008 - 2014, baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Baser.View
 * @since			baserCMS v 0.1.0
 * @license			http://basercms.net/license/index.html
 * @deprecated since version 3.0.3
 */

trigger_error(deprecatedMessage('テンプレート：googlemaps.php', '3.0.3', '3.1.0', '$this->BcBaser->googleMaps() を利用してください。'), E_USER_DEPRECATED);

$_width = 600;
$_height = 400;
$_zoom = 16;
$_mapId = 'map';
$_address = $this->BcBaser->siteConfig['address'];
$_markerText = '<span class="sitename">' . $this->BcBaser->siteConfig['name'] . '</span><br /><span class="address">' . $_address . '</span>';
if (isset($width)) {
	$_width = $width;
}
if (isset($height)) {
	$_height = $height;
}
if (isset($zoom)) {
	$_zoom = $zoom;
}
if (isset($mapId)) {
	$_mapId = $mapId;
}
if (isset($address)) {
	$_address = $address;
}
if (isset($markerText)) {
	$_markerText = $markerText;
}
if (isset($longitude)) {
	$this->BcGooglemaps->longitude = $longitude;
}
if (isset($latitude)) {
	$this->BcGooglemaps->latitude = $latitude;
}
$this->BcGooglemaps->mapId = $_mapId;
$this->BcGooglemaps->zoom = $_zoom;
$this->BcGooglemaps->title = $this->BcBaser->siteConfig['name'];
$this->BcGooglemaps->markerText = $_markerText;
if (!$this->BcGooglemaps->load($_address, $_width, $_height)) {
	echo 'Google Maps を読み込めません。管理画面で正しい住所が設定されているか確認してください。';
}
