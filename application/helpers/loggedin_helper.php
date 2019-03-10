<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_logged_in'))
{
    function is_logged_in() {
        $CI =& get_instance();
        $cookie = get_cookie('remember_me');
        
        $is_logged_in = $CI->session->userdata('user_profile_id');
        if(isset($is_logged_in) && !empty($is_logged_in == true))
        {
            return true;     
        }
        
        if(!empty($cookie)){
            $data = $CI->user_model->findUserByEmailHash($cookie);
            if($data!= null)
            {
                $CI->session->set_userdata('user_profile_id', $data[0]->id);
                $CI->session->set_userdata('user_profile_name', $data[0]->name);
                $CI->session->set_userdata('user_profile_email', $data[0]->email);
                $CI->session->set_userdata('user_profile_premium', $data[0]->premium);
                $CI->session->set_userdata('user_profile_lang', $data[0]->lang);
                
                return true;
            }
        }
        return false;
    } 
}