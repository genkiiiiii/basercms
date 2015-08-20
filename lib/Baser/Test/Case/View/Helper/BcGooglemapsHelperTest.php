<?php

/**
 * test for BcGooglemapsHelper
 *
 * baserCMS : Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2015, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright   Copyright 2008 - 2015, baserCMS Users Community
 * @link      http://basercms.net baserCMS Project
 * @since     baserCMS v 3.0.0-beta
 * @license     http://basercms.net/license/index.html
 */
App::uses('View', 'View');
App::uses('BcGooglemapsHelper', 'View/Helper');
App::uses('Component', 'Controller');

/**
 * text helper library.
 *
 * @package Baser.Test.Case.View.Helper
 * @property BcTextHelper $Helper
 */
class BcGooglemapsHelperTest extends BaserTestCase {

/**
 * Fixtures
 * @var array
 */
  public $fixtures = array();

  public function setUp() {
    parent::setUp();
    $View = new View();
    $this->BcGooglemaps = new BcGooglemapsHelper($View);
  }

  public function tearDown() {
    unset($this->BcGooglemaps);
    parent::tearDown();
  }


/**
 * Google マップ を読み込む
 * 
 * @param string $address
 * @param int $width
 * @param int $height
 * @param string $expexted 期待値
 * @dataProvider loadDataProvider
 */
  public function testLoad($address, $width, $height, $expexted) {
    $this->expectOutputRegex('/' . $expexted . '/');
    $this->BcGooglemaps->load($address, $width, $height);
  }

/**
 * loadLocation用のデータプロバイダ
 *
 * @return array
 */
  public function loadDataProvider() {
    return array(
      array('福岡', null, null, '<div id="map">'),
      array('福岡', 100, null, '<div id="map" style="width: 100px; height:px">'),
      array('福岡', null, 100, '<div id="map" style="width: px; height:100px">'),
      array('福岡', 100, 100, '<div id="map" style="width: 100px; height:100px">'),
      array('', 100, 100, '^$'),
    );
  }

/**
 * 位置情報を読み込む
 * 
 * @param string $address 位置情報を取得したい住所
 * @param boolean $expexted 期待値
 * @dataProvider loadLocationDataProvider
 */
  public function testLoadLocation($address, $expected) {
    $this->BcGooglemaps->address = $address;
    $result = $this->BcGooglemaps->loadLocation();
    $this->assertEquals($expected, $result);
  }

/**
 * loadLocation用のデータプロバイダ
 *
 * @return array
 */
  public function loadLocationDataProvider() {
    return array(
      array('福岡', true),
      array('', false)
    );
  }

/**
 * 位置情報を取得する
 *
 * @param string $address 位置情報を取得したい住所
 * @param array/boolean $expexted 期待値
 * @dataProvider getLocationDataProvider
 */
  public function testGetLocation($address, $expected) {
    $result = $this->BcGooglemaps->getLocation($address);
    $this->assertEquals($expected, $result);
  }

/**
 * getLocation用のデータプロバイダ
 *
 * @return array
 */
  public function getLocationDataProvider() {
    return array(
      array('福岡', array('latitude' => '36.7083110', 'longitude' => '136.9316680')),
      array('fukuoka', array('latitude' => '33.5903547', 'longitude' => '130.4017155')),
      array(8100042, array('latitude' => '33.5825552', 'longitude' => '130.3866644')),
      array('', false)
    );
  }

}