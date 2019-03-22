<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/19
 * Time: 21:32
 */

$host = substr($_SERVER['SERVER_NAME'],strrpos($_SERVER['SERVER_NAME'],'admin'));
define( 'BASE_DOMAIN', $host);