<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // load the database
        $this->load->database();
        $this->load->library('image_lib');
        $this->load->model('UsersModel');
    }

    public function index(){
        $this->load->model('UsersModel');
        $uid = $this->UsersModel->getUserId();

        $this->load->view('templates/header');
        $this->load->view('upload_page', array('error' => ' ' ,'wm' => '','no_wm' => '','success'=>''));
        $this->load->view('templates/footer');
    }

    public function do_upload(){
        $this->load->model('UsersModel');
        $uid = $this->UsersModel->getUserId();

        // set upload config
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        // upload through select file
        if($this->input->post('submit')) {
            // file upload
            if ($this->upload->do_upload('userfile')) {
                // add water mark
                if ($this->input->post('watermark')) {
                    $image_data = $this->upload->data();
                    $data = [
                        'upload_data' => $this->upload->data(),
                        'wm' => $this->water_marking($image_data),
                        'no_wm' => '',
                        'error' => ' ',
                        'success' => 'You have successfully upload',
                        'uid' => $uid
                    ];
                    $this->load->view('templates/header');
                    $this->load->view('upload_page', $data);
                    $this->load->view('templates/footer');
                } else {
                    $data = [
                        'upload_data' => $this->upload->data(),
                        'no_wm' => 'no water mark',
                        'wm' => '',
                        'error' => ' ',
                        'success' => 'You have successfully upload your image: ',
                        'uid' => $uid
                    ];
                    $this->load->view('templates/header');
                    $this->load->view('upload_page', $data);
                    $this->load->view('templates/footer');
                }

            } else {
                $data = [
                    'error' => $this->upload->display_errors(),
                    'no_wm' => '',
                    'wm' => '',
                ];
                $this->load->view('templates/header');
                $this->load->view('upload_page', $data);
                $this->load->view('templates/footer');
            }
        }else{
            // upload through drag and drop
            if (!empty($_FILES)) {
                $tempFile = $_FILES['file']['tmp_name'];
                $fileName = $_FILES['file']['name'];
                $targetPath = './uploads/';
                $targetFile = $targetPath . $fileName;
                move_uploaded_file($tempFile, $targetFile);

                $this->load->model('FileModel');
                $this->FileModel->insertProfileImg($uid, $fileName);
            }
        }
    }

    public function water_marking($img_data){
        $img = substr($img_data['full_path'], 26);
        $config['image_library'] = 'gd2';
        $config['source_image'] = $img_data['full_path'];
        $config['wm_text'] = $this->input->post('text');
        $config['wm_type'] = 'text';
        $config['wm_font_size'] = '200';
        $config['wm_font_color'] = '#707A7C';
        $config['wm_hor_alignment'] = 'center';
        $config['new_image'] = './uploads/watermark_' . $img;

        // send config array to image_lib's initialize function
        $this->image_lib->initialize($config);
        $src=$config['new_image'];

        $data['watermark_image'] = substr($src,2);
        $data['watermark_img'] = base_url() . $data['watermark_image'];
        // call watermark function in the image library
        $this->image_lib->watermark();

        return $data;
    }
}