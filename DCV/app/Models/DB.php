<?php

namespace Models;

class DB{
    public $db_host;
    public $db_name;
    private $db_user;
    private $db_passwd;

    public $conn;

    public $s = " * ";
    public $w = " 1 ";
    public $j = "";
    public $o = "";
    public $l = "";
    public $r;

    function __construct($dbh = "localhost", $dbn = "blogx"){
        $this->db_user = "root";
        $this->db_host = $dbh;
        $this->db_name = $dbn;
    }

    public function db_connect(){
        $this->conex = new \mysqli($this->db_host, $this->db_user,"",$this->db_name);
        $this->conex->set_charset("utf8");
        if($this->conex->connect_error){
            echo "Fallo la conexión";
        }else{
            return $this->conex;
        }
    }

    public function select($cc=[]){
        if(count($cc) > 0){
            $this->s = implode(",",$cc);
        }
        return $this;
    }

    public function join($join="",$on=""){
        if($join != "" && $on != ""){
            $this->j = ' join ' . $join . ' on ' . $on . ' ';
        }
        return $this;
    }

    public function where($ww=[]){
        $this->w = "";
        if(count($ww) > 0){
            foreach($ww as $where){
                $this->w .= $where[0] . " like '" . $where[1] . "' " . " and ";
            }
            $this->w .= ' 1 ';
        }    
        return $this;
    }

    public function orderBy($ob=[]){
        $this->o = "";
        if(count($ob) > 0){
            foreach($ob as $orderBy){
                $this->o .= $orderBy[0] . ' ' . $orderBy[1] . ',';
            }
            $this->o = 'order by ' . trim($this->o,",");
        }
        return $this;
    }

    public function limit($l=""){
        $this->l = "";
        if($l != ""){
            $this->l = ' limit ' . $l;
        }
        return $this;
    }


    public function get(){
        $sql =  ' select ' . $this->s . 
                ' from ' . str_replace("Models\\","",get_class($this)) . ' a ' .
                $this->j .
                ' where ' . $this->w .
                $this->o .
                $this->l ;

        $this->r = $this->table->query($sql);

        $result = [];

        while( $f = $this->r->fetch_assoc()){
            $result[] = $f;
        }

        return json_encode($result);
    }
}