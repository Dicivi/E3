<?php

namespace views;

require "../../app/autoload.php";
include "layouts/main.php";

use Controllers\auth\LoginController as LoginController;

$ua = new LoginController;

is_null($ua->sessionValidate()) ? header ("Location : ../../resources/views/auth/inisesion.php") : '';

head($ua);

?>

<div class="container pt-5">
    <h1 class="border-botton">New post</h1>
    <form action="/DCV/app/app.php" method="post">
    <input type="hidden" name="uid" value="<?=$ua->id?>">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" require>
    </div>
    <div class="form-groip">
        <label for="body" >Texto</label>
        <textarea name="body" id="body" cols="30" rows="10" required class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Guardar<i class="fas fa-download"></i></button>
    </form>

</div>

<?php scripts(); ?>
<script src="../../resources/js/app_newpost.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        app_myposts.getMyPosts(<?=$ua->id?>);
     
    });
</script>

<?php
    footer();
?>