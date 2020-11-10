<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {
    public function checkUsername($username,$email){
        $this->db->where('username', $username);
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->num_rows();
    }

    public function checkLogin($where = array()){
        if (! empty($where)) {
            $this->db->where($where);
            $query = $this->db->get('users');
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
        }else{
            $query = $this->db->get('users');
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
        }
    }

    public function checkActive($email){
        $this->db->where('email', $email);
        $query = $this->db->get('users');

        foreach ($query->result() as $row){
            return $result = $row->status;
        }
    }

    public function checkEmailExist($email){
        $this->db->select('username');
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        foreach ($query->result() as $row){
            return ($row->username)? $row->username : false;
        }
    }

    //send  email to user's email to reset password
    public function sendEmail($username, $to_email){
        $email_code = hash("sha256",$this->config->item('salt').$username);
        $from_email = 'wistestlycc@gmail.com'; //change this to yours
        $subject = 'Reset Your Password';
        $message = 'Dear '.$username.',<br><br>
        You have made a reset password request recently,
        Please <strong><a href="' .base_url(). 'ForgetPassword/reset_password_form/'.$to_email.'/'.$email_code.'">click here</a></strong>
        to reset your password.<br><br>
        Thanks<br />Event Scheduler';

        //configure email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = 'jsf8023cc'; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);

        //send mail
        $this->email->from($from_email, 'Event Scheduler');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }

    public function verify_reset_password_code($email, $code){
        $this->db->select('username');
        $this->db->select('email');
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        foreach ($query->result() as $row){
            $email = $row->email;
            $username = $row->username;
        }
        if($query->num_rows() === 1){
            return ($code == hash("sha256",$this->config->item('salt') . $username))? true : false;
        }else{
            return false;
        }
    }

    public function update_password($email, $password){
        $this->db->where('email',$email)->update('users', array(
            'password' => $password
        ));
        return true;
    }

}

