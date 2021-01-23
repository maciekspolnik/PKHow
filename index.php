<?php
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'],'/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('index','DefaultController');
Router::get('videos','VideosController');
Router::get('faq','FaqController');
Router::post('login','SecurityController');
Router::post('register','SecurityController');
Router::post('addfile','VideosController');
Router::post('search','VideosController');
Router::post('searchfaq','FaqController');

Router::run($path);