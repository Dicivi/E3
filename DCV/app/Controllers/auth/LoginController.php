<?php

namespace Controllers\auth;

use Models\user;

class LoginController {

    public $sv;
    public $name;
    public function __construct(){
        $this->sv = false;
    }

    public function userAuth($datos){
        $user = new user;
        $result = $user->where([['email',$datos['email']],['passwd',sha1($datos['passwd'])]])->get();
        if(sizeof(json_decode($result)) > 0){
            return $this->sessionRegister($datos);
        }else{
            $this->sessionDestroy();
            echo json_encode(["r"=>false]);
        }
    }

    function sessionRegister($datos){
        session_start();
        $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['email'] = $datos['email'];
        $_SESSION['passwd'] = sha1($datos['passwd']);
        session_write_close();
        return \json_encode(["r"=>true]);

    }

    public function sessionValidate(){
        $user = new user;
        session_start();
        if(\session_status() == PHP_SESSION_ACTIVE && count($_SESSION) > 0){
            $datos = $_SESSION;
            $result = $user->where ([['email',$datos['email']],['passwd',$datos['passwd']]])->get();
            if(sizeof(json_decode($result)) > 0 && $datos['IP'] == $_SERVER['REMOTE_ADDR']){
                session_write_close();
                $this->sv = true;
                $this->name = \json_decode($result)[0]->name;
                return $result;
            }
        }
        session_write_close();
        $this->sessionDestroy();
        return null;
    }

    public function userLogout(){
        $this->sessionDestroy();
        return;
    }

    function sessionDestroy(){
        session_start();
        $_SESSION = [];
        \session_destroy();
        \session_write_close();
        $this->sv = false;
        $this->name = "";
        return;
    }
}