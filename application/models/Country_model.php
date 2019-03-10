<?php
class country_model extends CI_Model{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function getCountryCodes()
    {
        $this->db->select('country.iso as `countryCode`, country.phonecode as `indicativ`, country.name as `label`');
        $this->db->from('country');
        $this->db->order_by('country.name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

}
?>