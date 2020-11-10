<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GoogleLogin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('GoogleLoginModel');
    }

    function login(){

        // Include file from google-php-client library in controller
        require_once APPPATH.'/libraries/google-api-php-client/vendor/autoload.php';

        $google_client = new Google_Client();

        //Define your ClientID
        $google_client->setClientId('1036237906722-9ip95367g7jnvjusai5h0saavfv9islp.apps.googleusercontent.com');
        //Define your Client Secret Key
        $google_client->setClientSecret('w-5-BNhBoVR-CKjIDsuEE008');
        //Define your Redirect Uri
        $google_client->setRedirectUri('http://localhost:8080/GoogleLogin/login');

        $google_client->addScope('email');

        $google_client->addScope('profile');

        if(isset($_GET["code"])){
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

            if(!isset($token["error"])){
                $google_client->setAccessToken($token['access_token']);

                $this->session->set_userdata('access_token', $token['access_token']);

                $google_service = new Google_Service_Oauth2($google_client);

                $data = $google_service->userinfo->get();
                if($this->GoogleLoginModel->Is_already_register($data['email'])){
                    //update data
                    $user_data = array(
                        'username'  => $data['given_name'] . $data['family_name'],
                        'email' => $data['email'],
                    );
                    $this->GoogleLoginModel->Update_user_data($user_data);
                }else{
                    //insert data
                    $user_data = array(
                        'username'  => $data['given_name'] . $data['family_name'],
                        'email'  => $data['email'],
                        'status' => '1'
                    );

                    $this->GoogleLoginModel->Insert_user_data($user_data);
                }
                $this->session->set_userdata('user_data', $user_data);
            }
        }
        $login_button = '';
        if(!$this->session->userdata('access_token')){
            $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="https://user-images.githubusercontent.com/1531669/41761606-83b5bd42-762a-11e8-811a-b78fdf68bc04.png" /></a>';
            $data['login_button'] = $login_button;

            $this->load->view('templates/header');
            $this->load->view('googleLogin_page', $data);
            $this->load->view('templates/footer');
        }
        else{
            $data['login_button'] = $login_button;

            $this->load->view('templates/header');
//            $this->load->view('googleLogin_page', $data);
            $this->load->view('googleLogin_page', $data);
            $this->load->view('templates/footer');
        }
    }

    function logout(){
        $this->session->unset_userdata('access_token');

        $this->session->unset_userdata('user_data');

        redirect('GoogleLogin/login');
    }

}
?>