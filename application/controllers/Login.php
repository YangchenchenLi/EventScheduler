<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        //load the required libraries and helpers for login
        $this->load->library('form_validation');
        // load the database 
        $this->load->database();
        //load the Login Model
        $this->load->model('LoginModel');
        $this->load->model('GoogleLoginModel');
        $this->load->helper('cookie');
        $this->load->helper('captcha');
    }

    public function index() {
        $logged_in = $this->session->userdata('logged_in');
        // if already logged in, redirect to home page
        if ($logged_in){
            redirect(base_url().'Home');
        }
        // if not load the login page
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => 'system/fonts/texb.ttf',
            'img_width'     => '160',
            'img_height'    => '50',
            'word_length'   => 6,
            'font_size'     => 20
        );
        $captcha = create_captcha($config);
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);

        // Pass captcha image to view
        $data['captchaImg'] = $captcha['image'];

        // if not load the login page
        $this->load->view('login_page',$data);
    }

    public function doLogin(){
        // if not log in, do log in first
        if (!$this->session->userdata('logged_in')) {

            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $inputCaptcha = $this->input->post('captcha');

            // set captcha data
            $sessCaptcha = $this->session->userdata('captchaCode');
            // check captcha
            if ($inputCaptcha === $sessCaptcha) {
                echo 'Captcha code matched.';

                $check_username = $this->LoginModel->checkUsername($username, $email);

                // check if username has registered.
                if (!$check_username) {
                    $this->session->set_flashdata('msg', 'Invalid username or email, please register first');
                    redirect('Login');
                }

                $data['email'] = $email;
                $data['username'] = $username;

                // check the username and email if they match.
                $check_login = $this->LoginModel->checkLogin($data);
                // check if password match
                $check_password = password_verify($password,$check_login['password']);

                if ($check_login && $check_password) {
                    $check_active = $this->LoginModel->checkActive($email);
                    // check if user has active their account
                    if($check_active){
                        // if account has activated
                        // get the remember me check box result from user
                        // create cookie
                        $remember_me = $this->input->post('remember');
                        if ($remember_me) {
                            // create cookie for username
                            $this->input->set_cookie('username', $username, 86500);
                            // create cookie for email
                            $this->input->set_cookie('email', $email, 86500);
                            // create cookie for password
                            $this->input->set_cookie('password', $password, 86500);
                        } else {
                            // create cookie for username
                            $this->input->set_cookie('username', '', 86500);
                            // create cookie for email
                            $this->input->set_cookie('email', '', 86500);
                            // create cookie for password
                            $this->input->set_cookie('password', '', 86500);
                        }
                        // Create session
                        $user_data = array(
                            'username' => $username,
                            'email' => $email,
                            'logged_in' => true,
                        );
                        $this->session->set_userdata($user_data);
                        // set message
                        $this->session->set_flashdata('msg_login', 'You are now logged in');
                        // redirect to homepage
                        redirect(base_url() . 'Home');
                    }else{
                        //if account is not activated
                        // then set the session 'logged_in' as false
                        $this->session->set_userdata('logged_in', false);
                        //and redirect to login page with flashdata invalid msg
                        $this->session->set_flashdata('msg', 'Your account is not active yet, please active your account first.');
                        redirect('Login');
                    }
                }else {
                    //if not log in then set the session 'logged_in' as false
                    $this->session->set_userdata('logged_in', false);
                    //and redirect to login page with flashdata invalid msg
                    $this->session->set_flashdata('msg', 'Password is Invalid');
                    redirect('Login');
                }
            } else {
                // if enter the wrong captcha data
                // set the session 'logged_in' as false
                $this->session->set_userdata('logged_in', false);
                //and redirect to login page with flashdata invalid msg
                $this->session->set_flashdata('msg', 'Please enter correct captcha');
                redirect('Login');
            }
        }else{
            // if user already logged in, show homepage
            redirect('Home');
        }

    }

    public function captchaRefresh(){
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => 'system/fonts/texb.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 6,
            'font_size'     => 20
        );
        $captcha = create_captcha($config);

        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);

        // Display captcha image
        echo $captcha['image'];
    }

    public function logout() {
        //unset the logged_in session and redirect to login page
        $this->session->unset_userdata('logged_in');
        // unset the username
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');

        $this->session->unset_userdata('access_token');

        $this->session->unset_userdata('user_data');
        $this->session->set_flashdata('msg', 'You have successfully logged out!');

        redirect('Login');
    }


}

