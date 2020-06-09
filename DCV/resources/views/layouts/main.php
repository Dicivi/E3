<?php

function head($ua=null){
    !is_null($ua) ? $ua->sessionValidate() : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/app.css">
    <title>DCV.BLOG</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">DCV.BLOG</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" 
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
        aria-expanded="false" aria-label="Intercambiar navegacion">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="collapse-nav mr-auto">
            <?php if(!is_null($ua) && $ua->sv){ ?>
                <li class="nav-item active">
                    <a href="#" onclick="app.view('myposts')" class="nav-link">Feed</a>
                </li>
            <?php } ?>
            </ul>
            <ul class="navbar-nav navbar-rigth">
                <li class="nav-item dropdown">
            <?php if(is_null($ua) || !$ua->sv){ ?>
                <button class="nav-link btn btn-link" type="button" onclick="app.view('inisesion')">Sign in</button>
            <?php }else{ ?>
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" 
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?=$ua->name?></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <button type ='button' class="dropdown-item" onclick="app.view('logout')">Sign out</button>
               
               
                </div>
            <?php } ?>
                </li>
            </ul>
        </div>
    </nav>
<?php
}
function scripts($script=""){
    ?>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>
    <script src="https://kit.fontawesome.com/3bae5d87ff.js" crossorigin="anonymous"></script>
    <?php

    echo $script;
}

function footer($banner = "Blog | JS | DCV"){

?>
<footer>
    <small><?=$banner?></small>
</footer>
</body>
</html>

<?php
}