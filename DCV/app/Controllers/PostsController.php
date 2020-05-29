<?php

namespace Controllers;
use Models\posts;


class PostsController {

    public function __construct(){

    }

    public function getPosts($limit=""){

        $posts = new posts();

        $result = $posts->select(['a.id','a.title','a.body','date_format(a.created_at, "%d/%m/%Y") as fecha','b.name'])
                        ->join('user b','a.userId=b.id')
                        ->orderBy([['a.created_at','DESC']])
                        ->limit($limit)
                        ->get();
        return $result;
    }

    public function openPost($id){

        $posts = new posts();

        $result = $posts->select(['a.id','a.title','a.body','date_format(a.created_at, "%d/%m/%Y") as fecha','b.name'])
                        ->join('user b','a.userId=b.id')
                        ->where([['a.id',$id]])
                        ->get();
        return $result;
    }

}