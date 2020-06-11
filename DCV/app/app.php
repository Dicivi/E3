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

/**Cargar mis publicaciones */
$mp = in_array('mp', array_keys($_GET));

if($mp){
    $id = filter_input(INPUT_GET,'id');
    $mposts = new PostsController();
    print_r($mposts->myPosts($id));

}

/**New post */

$np = in_array('uid', array_keys($_POST));

if($np){
    $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
    $npost = new PostsController();
    $npost->newPost($datos);
    header("Location: ../resources/views/myposts.php");
}
$vp = in_array('vp', array_keys($_GET));

if($vp) {
    $id = filter_input(INPUT_GET,'id');
    $vpost = new PostsController();
    print_r($vpost->viewPost($id));
}

$dp = in_array('dp', array_keys($_GET));

if($dp) {
    $id = filter_input(INPUT_GET,'id');
    $dpost = new PostsController();
    $dpost->deletePost($id);

    header("Location: ../resources/views/myposts.php");
}
