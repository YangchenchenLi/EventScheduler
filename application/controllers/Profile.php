<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load the database
        $this->load->database();

        //load the Model
        $this->load->model('UsersModel');

        $this->load->model('FileModel');
    }

	public function index(){
        // get the uid for this username
        $uid = $this->UsersModel->getUserId();
        // get all the users info for this username
        $user_info = $this->UsersModel->fetchUsersData($uid);
        $profile_data = $this->UsersModel->fetchProfileData($uid);
        // add profile image
        $profile_img = $this->FileModel->fetchProfile($uid);
        $data = [
            'username' => $user_info['username'],
            'email' => $user_info['email'],
            'password' => $user_info['password'],
            'phone' => $profile_data['phone'],
            'address' => $profile_data['address'],
            'birthday' => $profile_data['birthday'],
            'profile_img' => $profile_img
        ];
        $this->load->view('profile_page',$data);
	}

	public function changeProfile(){
        $uid = $this->UsersModel->getUserId();
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');
        $birthday = $this->input->post('birthday');

        // change password
        if ($this->input->post('password')){
            $this->UsersModel->changePassword($uid, $password);
        }
        // change phone
        if ($this->input->post('phone')){
            $this->UsersModel->changePhone($uid, $phone);
        }
        // change address
        if ($this->input->post('address')){
            $this->UsersModel->changeAddress($uid, $address);
        }
        // change birthday
        if ($this->input->post('birthday')){
            $this->UsersModel->changeBirthday($uid, $birthday);
        }
        redirect("Profile");
    }

    public function addFile(){
        $this->load->model('FileModel');

        if($this->input->post('img_no_wa')){
           $uid = $this->input->post('upload_uid');
           // get the none watermark image file name
           $profime_img = $this->input->post('img_no_wa');
           $this->FileModel->insertProfileImg($uid,$profime_img);
        }

        if($this->input->post('img_wm')){
            $uid = $this->input->post('upload_uid');
            // get the watermark image file name
            $profime_img = substr($this->input->post('img_wm'),8);
            $this->FileModel->insertProfileImg($uid,$profime_img);
        }
        redirect("Profile");
    }
}
