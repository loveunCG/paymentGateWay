<?php

/**
 * Created by PhpStorm.
 * User: zaman
 * Date: 2/25/15
 * Time: 12:36 AM
 */
class Menu {

    public function dynamicMenu() {

        $CI = & get_instance();

        $employee_login_id = 1;

        $user_type = $CI->session->userdata('user_type');

   

		if ($user_type != 1) {// query for employee user role            
            /*$user_menu = mysql_query("SELECT tbl_user_role.menu_id, tbl_user_role.employee_login_id, tbl_menu.*
                                        FROM tbl_user_role
                                        INNER JOIN tbl_menu
                                        ON tbl_user_role.menu_id=tbl_menu.menu_id
                                        WHERE tbl_user_role.employee_login_id=$employee_login_id
                                        ORDER BY sort;");*/
			$user_menu = mysql_query("SELECT tbl_user_role.menu_id, tbl_user_role.user_type_id, tbl_menu.*
                                        FROM tbl_user_role
                                        INNER JOIN tbl_menu
                                        ON tbl_user_role.menu_id=tbl_menu.menu_id
                                        WHERE tbl_user_role.user_type_id = $user_type
                                        ORDER BY sort;");
        } else { // get all menu for admin             
            $user_menu = mysql_query("SELECT * FROM tbl_menu ORDER BY sort");
        }
        $user_language = mysql_query("SELECT active_language FROM tbl_gsettings where id_gsettings=".$employee_login_id);
        
        // Create a multidimensional array to conatin a list of items and parents
        $menu = array(
            'items' => array(),
            'parents' => array()
        );

        // Builds the array lists with data from the menu table
        while ($active_laguage = mysql_fetch_assoc($user_language)) {

            // Creates entry into items array with current menu item id ie. $menu['items'][1]
            $language = $active_laguage['active_language'];
            // Creates entry into parents array. Parents array contains a list of all items with children            
        }
        // Builds the array lists with data from the menu table
        while ($items = mysql_fetch_assoc($user_menu)) {

            // Creates entry into items array with current menu item id ie. $menu['items'][1]
            $menu['items'][$items['menu_id']] = $items;

            // Creates entry into parents array. Parents array contains a list of all items with children
            $menu['parents'][$items['parent']][] = $items['menu_id'];
        }
		//print_r($CI->session->userdata('menu_active_id'));
        return $output = $this->buildMenu(0, $menu, $language);
		
    }

    public function buildMenu($parent, $menu, $language) {

        $html = "";

        if (isset($menu['parents'][$parent])) {
            $html .= "<ul>\n";
            
            foreach ($menu['parents'][$parent] as $itemId) {
                $result = $this->active_menu_id($menu['items'][$itemId]['menu_id']);

                if ($result) {
                    $active = 'active';
                    $opened = 'opened';
                } else {
                    $active = '';
                    $opened = '';
                }

                if (!isset($menu['parents'][$itemId])) { //if condition is false
                    if (!empty($language)) {
                        $html .= "<li class='" . $active . "' >\n  <a href='" . base_url() . $menu['items'][$itemId]['link'] . "'> <i class='" . $menu['items'][$itemId]['icon'] . "'></i><span>" . $menu['items'][$itemId][$language] . "</span></a>\n</li> \n";
                    } else {
                        $html .= "<li class='" . $active . "' >\n  <a href='" . base_url() . $menu['items'][$itemId]['link'] . "'> <i class='" . $menu['items'][$itemId]['icon'] . "'></i><span>" . $menu['items'][$itemId]['English'] . "</span></a>\n</li> \n";
                    }
                }

                if (isset($menu['parents'][$itemId])) { //if condition is true
                    if (!empty($language)) {
                    $html .= "<li class='" . $opened . "'>\n  <a href='" . base_url() . $menu['items'][$itemId]['link'] . "'> <i class='" . $menu['items'][$itemId]['icon'] . "'></i><span>" . $menu['items'][$itemId][$language] . "</span></a>\n";
                    }else{
                        $html .= "<li class='" . $opened . "'>\n  <a href='" . base_url() . $menu['items'][$itemId]['link'] . "'> <i class='" . $menu['items'][$itemId]['icon'] . "'></i><span>" . $menu['items'][$itemId]['English'] . "</span></a>\n";
                    }
                    $html .= self::buildMenu($itemId, $menu,$language);
                    $html .= "</li> \n";
                }
            }

            $html .= "</ul> \n";
        }
        return $html;
    }

    public function active_menu_id($id) {
        $CI = & get_instance();
        $activeId = $CI->session->userdata('menu_active_id');

        if (!empty($activeId)) {
            foreach ($activeId as $v_activeId) {
                if ($id == $v_activeId) {
                    return TRUE;
                }
            }
        }
        return FALSE;
    }

}
