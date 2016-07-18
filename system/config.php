<?php
/**
 * Created by PhpStorm.
 * User: luan
 * Date: 14/07/16
 * Time: 13:39
 */


define('ROOT_DIR', realpath((dirname(__DIR__))));
define('APP_DIR', ROOT_DIR . '/application');
define('MODEL_DIR', ROOT_DIR . '/application/model/');
define('VIEW_DIR', ROOT_DIR . '/application/view/');
define('CONTROLLER_DIR', ROOT_DIR . '/controller/');


require(ROOT_DIR . '/application/config/config.php');

require(ROOT_DIR . '/system/model.php');
require(ROOT_DIR . '/system/view.php');
require(ROOT_DIR . '/system/controller.php');

require(APP_DIR . '/Bootstrap.php');