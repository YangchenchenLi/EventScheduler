<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgetPassword extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('LoginModel');
    }

    public function index(){
        $this->load->view('templates/header');
        $this->load->view('forgetPassword_page');
        $this->load->view('templates/footer');
    }

    public function checkEmail(){
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

            if($this->form_validation->run() == FALSE){
                $this->load->view('templates/header');
                $this->load->view('forgetPassword_page', array('error' => 'Please enter a valid email address'));
                $this->load->view('templates/footer');
            }else{
                $email = trim($this->input->post('email'));
                $username = $this->LoginModel->checkEmailExist($email);
                $send_email = $this->LoginModel->sendEmail($username, $email);
                // if there exist this email address in database
                if($send_email){
                    $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Please check your email.</div>');
                    redirect('ForgetPassword');
                }else{
                    $this->load->view('templates/header');
                    $this->load->view('forgetPassword_page', array('error' => 'Email address does not exist.'));
                    $this->load->view('templates/footer');
                }
            }
        }else{
            $this->load->view('templates/header');
            $this->load->view('forgetPassword_page');
            $this->load->view('templates/footer');
        }

    }

    public function reset_password_form($email, $email_code){
        if(isset($email, $email_code)){
            $email = trim($email);
            $email_hash = sha1($email . $email_code);
            $verified = $this->LoginModel->verify_reset_password_code($email, $email_code);

            if ($verified){
                $this->load->view('templates/header');
                $this->load->view('updatePassword_page', array('email_hash' => $email_hash, 'email_code' => $email_code, 'email' => $email));
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header');
                $this->load->view('forgetPassword_page',array('error' => 'There was a problem with your link,
                 please click it again or request to reset your password again.'));
                $this->load->view('templates/footer');
            }
        }
    }

    public function update_password(){
        if(!isset($_POST['email'], $_POST['email_hash']) || $_POST['email_hash'] !== sha1($_POST['email'] . $_POST['email_code'])){
            die('Error updating your password');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('email_hash', 'Email hash', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[50]');
        $this->form_validation->set_rules('password_conf', 'Confirm Password', 'trim|required|min_length[6]|max_length[50]');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header');
            $this->load->view('updatePassword_page');
            $this->load->view('templates/footer');
        }else{
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
            // successful update
            $result = $this->LoginModel->update_password($email, $encryptedPassword);

            if($result){
                $this->session->set_flashdata('update_msg','<div class="alert alert-success text-center">Your password has been updated! You may now log in to your account!.</div>');
                redirect('Login');
            }else{
                // should never happen
                $this->load->view('templates/header');
                $this->load->view('updatePassword_page',array('error' => 'There was a problem with your link,
                 please click it again or request to reset your password again.'));
                $this->load->view('templates/footer');
            }
        }

    }
}