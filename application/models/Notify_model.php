<?php
class notify_model extends CI_Model{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insertNotify($data)
    {
        $this->db->insert('notify', $data);
        return $this->db->insert_id();
    }

    function getContactId($monitorId)
    {
        $query = $this->db->get_where('notify', array('monitorId' => $monitorId));
        if($query!=null){return $query->result();}
        return null; 
    }
    
    function deleteNotify($monitorId)
    {
        $this->db->delete('notify', array('monitorId' => $monitorId));
    }

}