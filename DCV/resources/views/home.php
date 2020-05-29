<?php

namespace views;

require "../../app/autoload.php";
include "layouts/main.php";

use Controllers\auth\LoginController as LoginController;

head(new LoginController);

?>

<div class="container pt-5">
    
    <div class="row">
        <div class="col-4">
            <div class="list-group" id="previous-posts">
           
            </div>
        </div>
        <div class="col-6 shadow rounded p-3" id="last-post">
        
        </div>
        <div class="col">
            <div class="list-group" id="authors">

            </div>
        </div>
    </div>
</div>

<?php scripts(); ?>
<script src="../../resources/js/app_home.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        app_home.previousPosts();
        app_home.lastPost(1);
    });
</script>

<?php
    footer();
?>