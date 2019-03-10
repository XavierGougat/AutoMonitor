<?php
class contact_model extends CI_Model{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insertContact($data)
    {
        $this->db->insert('contact', $data);
        return $this->db->insert_id();
    }
    
    function findContactByUserId($userId){
        $this->db->select('*');
        $this->db->from('contact');
        $this->db->where('contact.userId',$userId);
        $this->db->order_by("type", "asc");
        $this->db->order_by("address", "asc");
        $query = $this->db->get();
        if($query!=null){ return $query->result();}
        return null;
    }
    
    function findContactById($id){
        $this->db->select('address as `address`, type as `type`');
        $this->db->from('contact');
        $this->db->where('contact.id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function deleteContact($data){
        $this->db->where('id', $data);
        $this->db->delete('contact'); 
    }
}
?>