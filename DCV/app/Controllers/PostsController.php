<?php

namespace Controllers;
use Models\posts;


class PostsController {

    public function __construct(){

    }

    public function getPosts($limit=""){

        $posts = new posts();

        $result = $posts->select(['a.title', 'a.body', 'date_format(a.created_at, "%d/%m/%Y") as fecha','b.name'])
                        ->join('user b','a.userId=b.id')
                        ->orderBy([['a.created_at','DESC']])
                        ->limit($limit)
                        ->get();
        return $result;
    }

}
