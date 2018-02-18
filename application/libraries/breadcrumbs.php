<?php

class Breadcrumbs {

    public function build_breadcrumbs() {

        $CI = & get_instance();
        $id = $CI->session->userdata('menu_active_id');
        $ginfo = $CI->session->userdata('genaral_info');
        $active_laguage = $ginfo[0]->active_language;
        $menu_id=  array_reverse($id);
        $breadcrumbs = "";
        foreach ($menu_id as $v_id) {

            $menu = mysql_query("SELECT tbl_menu.*
                                        FROM tbl_menu
                                        WHERE tbl_menu.menu_id=$v_id ;");

            while ($items = mysql_fetch_assoc($menu)) {
               
                $breadcrumbs .= "<li>\n  <a href='" . base_url() . $items['link'] . "'>" . $items[$active_laguage] . "</a>\n</li> \n";

            }
        }
        
        return $breadcrumbs;
    }

}
