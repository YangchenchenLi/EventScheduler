<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxsearchModel extends CI_Model{

    function fetchData($uid,$query){
        $this->db->select('*');
        $this->db->from('calendar');
        $this->db->where('uid', $uid);

        if($query != ''){
            $this->db->like('date', $query);
            $this->db->or_like('data', $query);
        }
        return $this->db->get();
    }
}