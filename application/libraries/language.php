<?php

class Language {

    public function form_heading() {
        $CI = & get_instance();
        $ginfo = $CI->session->userdata('genaral_info');
        $active_laguage = $ginfo[0]->active_language;
        
        // get active language info
        $form_info = mysql_query("SELECT form_id," . $active_laguage . " FROM tbl_form ORDER BY form_id");

        while ($current_laguage = mysql_fetch_assoc($form_info)) {
            $language[] = $current_laguage;
        }
        return $result = $this->active_language($language, $active_laguage);
    }

    public function active_language($language, $active_laguage) {

        foreach ($language as $v_language) {
            $lang[] = $v_language[$active_laguage];
        }
        return $lang;
    }

    public function from_body() {
        $CI = & get_instance();
        $ginfo = $CI->session->userdata('genaral_info');
        $active_laguage = $ginfo[0]->active_language;
        // get active language info
        $form_info = mysql_query("SELECT form_id FROM tbl_form ORDER BY form_id");
        while ($form_id = mysql_fetch_assoc($form_info)) {
            $id[] = $form_id;
        }
        foreach ($id as $v_id) {
            $f_id = $v_id['form_id'];
            $user_menu = mysql_query("SELECT tbl_form.*,tbl_form_body.*
                                        FROM tbl_form_body
                                        INNER JOIN tbl_form
                                        ON tbl_form_body.form_id=tbl_form.form_id
                                        WHERE tbl_form_body.form_id=$f_id
                                        ORDER BY form_body_id;");
            while ($form_data = mysql_fetch_assoc($user_menu)) {
                $label[$f_id][] = $form_data[$active_laguage];
            }
        }
        return $label;
    }

}
