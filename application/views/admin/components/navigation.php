<!-- Left side column. contains the logo and sidebar -->
<?php

//        echo '<pre>';
//        $menuId = $this->session->userdata('menua_ctive_id');
//        print_r($menuId);
//        exit();

$user_permission= $_SESSION["user_roll"];

foreach ($user_permission as $v_permission){
	
    $user_roll[$v_permission->menu_id]= $v_permission->menu_id;

}

?>

<div class="left-side sidebar-offcanvas" >

    <div  class="sidebar">

        <div id="main-menu">

            <?php
            echo $this->menu->dynamicMenu();
            ?>          
        </div>
    </div>
    <!-- /.sidebar -->
</div>
