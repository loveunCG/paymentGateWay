<?php

class Notice_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    
    public function get_notice() {
        $post = new stdClass();
        $post->notice_id = '';
        $post->title = '';
        $post->short_description = '';
        $post->long_description = '';
        $post->employee_id = '';
        $post->created_date = '';                
        $post->flag = '';                

        return $post;
    }
}