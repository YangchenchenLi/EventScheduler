<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterModel extends CI_Model{
    public function add_user($data){
        //get the data from controller and insert into the table 'users'
        $result = $this->db->insert('users', $data);
        return $result;
    }

    public function check_username_unique($username){
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->num_rows();
    }

    public function check_email_unique($email){
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->num_rows();
    }


   //send verification email to user's email id
    public function sendEmail($username, $to_email){
        $email_code = hash('sha256',$this->config->item('salt').$to_email);
        $from_email = 'wistestlycc@gmail.com'; //change this to yours
        $subject = 'Verify Your Email Address';
        $message = 'Dear '.$username.',<br><br>
        Thanks for registering on,<br /><br />
        Please <strong><a href="' .base_url(). 'Register/verify/'.$to_email.'/'.$email_code.'">click here</a></strong>
        to verify your email address. After you have active your account, you will be able log in your account and start doing business!<br><br>
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

    //activate user account
    function verifyEmailID($email, $email_code){
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        $num_rows =  $query->num_rows();

        if($num_rows === 1) {
            if(hash('sha256',$this->config->item('salt').$email) === $email_code){
                $result = $this->active_account($email);
            }else{
                $result = false;
            }
            if($result == true){
                return true;
            }else{
                // never happen
                echo 'There is an error when activating your account';
                return false;
            }
        }else{
            // never happen
            echo 'There is an error when validating your email';
        }
    }


    public function active_account($email){
        $this->db->where('email', $email);
        $token = hash('sha256',$this->config->item('salt').$email);
        $data = array(
            'status' => 1,
            'token' => $token
        );
        return $this->db->update('users', $data);
    }
}
