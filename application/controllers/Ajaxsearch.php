<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxsearch extends CI_Controller{

    function index()
    {
        $this->load->view('ajaxSearch_page');

    }

    function fetch(){
        $this->load->model('AjaxsearchModel');
        $this->load->model('UsersModel');
        // get the uid for this username
        $uid = $this->UsersModel->getUserId();

        $output = '';
        $query = '';

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }

        $data = $this->AjaxsearchModel->fetchData($uid,$query);

        $output .= '
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                <th>Date</th>
                <th>Event</th>
                </tr> 
        ';

        if($data->num_rows() > 0){
            foreach ($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->date.'</td>
                        <td>'.$row->data.'</td>
                    </tr>                                   
                ';
            }
        }else{
            $output .= '
            <tr>
                <td colspan="5">No Data Found</td>
            </tr>            
            ';
        }

        $output .= '</table>';
        echo $output;
    }

}