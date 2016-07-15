<?php
/**
 * Created by PhpStorm.
 * User: luan
 * Date: 14/07/16
 * Time: 13:39
 */


define('ROOT_DIR', realpath((dirname(__DIR__))));
define( 'APP_DIR', ROOT_DIR . '/application');

require(ROOT_DIR . '/application/config/config.php');
require(ROOT_DIR . '/system/model.php');
require(ROOT_DIR . '/system/view.php');
require(ROOT_DIR . '/system/controller.php');

require(APP_DIR . '/Bootstrap.php');
