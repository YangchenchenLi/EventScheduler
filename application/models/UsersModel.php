<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersModel extends CI_Model {

    public function getUserId(){
        // get the username from the session
        $username = $this->session->userdata('username');

        if($this->session->userdata('user_data')){
            $username = $this->session->userdata('user_data')['username'];
        }

        $query = $this->db->select('uid')->from('users')->where('username', $username)->get();

        $uid = null;
        foreach ($query->result() as $row){
            $uid = strval($row->uid);
        }
        return $uid;
    }

    public function fetchUsersData($uid){
        $query = $this->db->select('*')->from('users')->where('uid', $uid)->get();

        $user_info = array();
        foreach ($query->result() as $row){
            $user_info = array(
                'uid' => $row->uid,
                'username' => $row->username,
                'email' => $row->email,
                'password' => $row->password,
            );
        }
        return $user_info;
    }

    public function fetchProfileData($uid){
        $profile_data = array();
        $result = $this->db->select('*')->from('user_profile')->where('uid', $uid)->count_all_results();

        if ($result) {
            $query = $this->db->select('*')->from('user_profile')->where('uid', $uid)->get();
            foreach ($query->result() as $row){

                $profile_data = array(
                    'uid' => $row->uid,
                    'phone' => $row->phone,
                    'address' => $row->address,
                    'birthday' => $row->birthday,
                );
            }
        }else{
            $profile_data = array(
                'uid' => '',
                'phone' => '',
                'address' => '',
                'birthday' => ''
            );
        }
        return $profile_data;
    }

    public function changePassword($uid,$password){
        $this->db->where('uid',$uid)->update('users', array(
            'password' => $password
        ));
    }

    public function changePhone($uid,$phone){
        // check if uid already exist
        $all_result = $this->db->select('*')->from('user_profile')->where('uid', $uid)->count_all_results();

        if ($all_result){
            $phone_result = $this->db->select('phone')->from('user_profile')->where('uid', $uid)->count_all_results();
            if($phone_result){
                $this->db->where('uid', $uid)->update('user_profile', array(
                    'phone' => $phone
                ));
            }else{
                $this->db->insert('user_profile', array(
                    'phone' => $phone
                ));
            }
        }else{
            $this->db->insert('user_profile', array(
                'uid' => $uid,
                'phone' => $phone
            ));
        }
    }

    public function changeAddress($uid,$address){
        // check if uid already exist
        $all_result = $this->db->select('*')->from('user_profile')->where('uid', $uid)->count_all_results();

        if ($all_result){
            $address_result = $this->db->select('address')->from('user_profile')->where('uid', $uid)->count_all_results();
            if($address_result){
                $this->db->where('uid', $uid)->update('user_profile', array(
                    'address' => $address
                ));
            }else{
                $this->db->insert('user_profile', array(
                    'address' => $address
                ));
            }
        }else{
            $this->db->insert('user_profile', array(
                'uid' => $uid,
                'address' => $address
            ));
        }
    }


    public function changeBirthday($uid,$birthday){
        // check if uid already exist
        $all_result = $this->db->select('*')->from('user_profile')->where('uid', $uid)->count_all_results();

        if ($all_result){
            $birthday_result = $this->db->select('birthday')->from('user_profile')->where('uid', $uid)->count_all_results();
            if($birthday_result){
                $this->db->where('uid', $uid)->update('user_profile', array(
                    'birthday' => $birthday
                ));
            }else{
                $this->db->insert('user_profile', array(
                    'birthday' => $birthday
                ));
            }
        }else{
            $this->db->insert('user_profile', array(
                'uid' => $uid,
                'birthday' => $birthday
            ));
        }
    }
}