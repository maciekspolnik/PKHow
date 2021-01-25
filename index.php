<?php
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'],'/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('','DefaultController');
Router::get('videos','DefaultController');
Router::get('faq','DefaultController');
Router::get('panel','DefaultController');
Router::post('login','SecurityController');
Router::post('register','SecurityController');
Router::post('logout','SecurityController');
Router::post('addfile','VideosController');
Router::post('search','VideosController');
Router::post('searchfaq','FaqController');

Router::run($path);