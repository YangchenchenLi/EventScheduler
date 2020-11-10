<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();     
        // load url helpers
        $this->load->helper('url');
        // load library
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('email');

        // load database
        $this->load->database();
        //load Register model
        $this->load->model('RegisterModel');
    }

    //registration form page
    public function index(){
        //load the register page views
        $this->load->view('signin_page');
    }

    public function doRegister(){
        // form validation
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_message('is_unique', 'Email already exists.');

        // get the input values
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // check username unique
        $username_unique = $this->RegisterModel->check_username_unique($username);
        // if username already exist
        if($username_unique){
            $this->session->set_flashdata('msg', 'Username should be unique, please choose another one!');
            redirect('Register');
        }
        // check email unique
        $email_unique = $this->RegisterModel->check_email_unique($email);
        if($email_unique){
            $this->session->set_flashdata('msg', 'Email should be unique, please choose another one!');
            redirect('Register');
        }

        $is_password_strong = $this->is_password_strong($password);
        if (!$is_password_strong){
            $this->session->set_flashdata('msg', 'Please set a stronger password (it should contains number, character and uppercase)');
            redirect('Register');
        }

        // if username and email are unique, do register
        if(!$username_unique && !$email_unique && $is_password_strong){

            $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $encryptedPassword,
            ];

            // pass the input values to the RegisterModel, insert user into database
            $insert_data = $this->RegisterModel->add_user($data);

            if ($insert_data){
                // send email to verify
                if($this->RegisterModel->sendEmail($username, $email)){
                    // successfully sent mail
                    $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully Registered! Please confirm the mail sent to your Email address.</div>');
                    redirect('Register');
                }else{
                    // error
                    $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                    redirect('Register');
                }
            }else{
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later</div>');
                redirect('Register');
            }
        }
    }

    public function verify($email, $email_code){
        if($this->RegisterModel->verifyEmailID($email, $email_code)){
            $this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account!</div>');
            redirect('Login');
        }else{
            $this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');
            redirect('Register');
        }
    }


    public function is_password_strong($password){
        if (preg_match('#[0-9]#', $password) && preg_match('#[a-z]#', $password) && preg_match('#[A-Z]#', $password)){
            return TRUE;
        }
        return FALSE;
    }
}
