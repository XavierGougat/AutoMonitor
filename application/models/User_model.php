<?php
class user_model extends CI_Model{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function findUserById($id){
        $query = $this->db->get_where('user', array('id' => $id));
        if($query!=null){ return $query->result();}
        return null;
    }

    function findUserByEmail($email){
        $query = $this->db->get_where('user', array('email' => $email));
        if($query!=null){return $query->result();}
        return null;
    }

    function findUserByEmailHash($email){
        $query = $this->db->get_where('user', array('emailHash' => $email));
        if($query!=null){return $query->result();}
        return null;
    }

    function insertUser($data)
    {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    function updateUser($data){
        $this->db->where('id', $data[0]->id);
        $this->db->update('user', $data[0]);
    }

    function updateUserEmail($data){
        $this->db->where('email', $data[0]->email);
        $this->db->update('user', $data[0]);
    }

    function countUser(){
        return $this->db->count_all_results('user');
    }

    function countUserPremiumToday(){
        $today_date=date('m/d/Y');
        $this->db->select('count(id) as count');
        $where = "DATE(premiumDate) = CURDATE()";
        $this->db->where($where);
        $this->db->from('user');
        $query = $this->db->get();
        return($query->result_array());
    }

    function addSmsToUser($user,$sms)
    {
        $this->db->where('id', $user);
        $this->db->set('smsCount', '`smsCount`'.$sms, FALSE);
        $this->db->update('user');
    }

}
?>