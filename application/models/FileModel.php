<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileModel extends CI_Model{
    public function insertProfileImg($uid,$filename){
        // one uid can only have one profile image
        $all_result = $this->db->select('*')->from('img_files')->where('uid', $uid)->count_all_results();
        // if already have uid
        if($all_result){
            $this->db->where('uid',$uid)->update('img_files', array(
                'file' => $filename
            ));
        }else{
            $this->db->insert('img_files', array(
                'uid' => $uid,
                'file' => $filename
            ));
        }
    }

    public function fetchProfile($uid){
        $all_result = $this->db->select('*')->from('img_files')->where('uid', $uid)->count_all_results();
        $profile_img = '';

        if($all_result){
            $query = $this->db->select('file')->from('img_files')->where('uid', $uid)->get();
            foreach ($query->result() as $row){
                $profile_img = strval($row->file);
            }
        }
        return $profile_img;
    }
}

