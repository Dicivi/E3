<?php

namespace app;

require_once "autoload.php";

use Controllers\auth\LoginController as LoginController;
use Controllers\PostsController as PostsController;

$login = in_array('login', array_keys($_POST));

if($login){
    $datos = \filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
    $userLogin = new LoginController();
    print_r($userLogin->userAuth($datos));
}

$logout = in_array('logout', array_keys($_GET));

if($logout){
    $userLogout = new LoginController();
    $userLogout->userLogout();

    header('Location: ../resources/views/home.php');
}
//**cargar publicaciones anteriores */
$pp = in_array('pp', array_keys($_GET));

if($pp){
    $pposts = new PostsController();
    print_r($pposts->getPosts());
}

//**cargar last post */

$lp = in_array('lp', array_keys($_GET));
if($lp){
    $limit = filter_input(INPUT_GET,'limit');
    $lpost = new PostsController();
    print_r($lpost->getPosts($limit));
}

/***CARGAR publicacion selected */

$op = in_array('op', array_keys($_GET));

if($op){
    $id = filter_input(INPUT_GET,'id');
    $opost = new PostsController();
    print_r($opost->openPost($id));
}