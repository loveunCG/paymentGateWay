<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of attendance_model
 *
 * @author NaYeM
 */
class Sitetable_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

 
    public function getAllLocations()
    {
         $this->db->select("*");
         $this->db->from("sitetable");
         $query = $this->db->get();        
         return $query->result();
    }
    
    
      public function getLocationByID($id)
    {
         $this->db->select("*");
         $this->db->from("sitetable");
          $this->db->where('id', $id);
         $query = $this->db->get();        
         return $query->result();
    }
    
      public function save($data,$id){
          
          $this->db->select("*");
          $this->db->from("sitetable");
          $this->db->where('id', $id);
          $this->db->update('sitetable', $data);
      }
      
      
     public function delete($data,$id){
          
          $this->db->select("*");
          $this->db->from("sitetable");
          $this->db->where('id', $id);
          $this->db->delete('sitetable', $data);
      }
}
