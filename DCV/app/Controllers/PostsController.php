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

    public function myPosts($id){
        $post = new posts();
        $result = $post->select(['id','title','body','date_format(created_at,"%d/%m/%Y") as fecha'])
                    ->where([['userId',$id]])
                    ->orderBy([['created_at','DESC']])
                    ->get();
        return $result;
    }

    public function newPost($datos){
        $post = new posts();
        $post->valores = [$datos['uid'],$datos['title'],$datos['body']];
        $result = $post->create();


    }
}