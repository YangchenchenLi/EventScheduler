<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MultipleFileModel extends CI_Model{

    function __construct() {
        $this->tableName = 'multiplefiles';
    }

    /*
 * Insert file data into the database
 * @param array the data for inserting into the table
 */
    public function insert($data = array()){
        $insert = $this->db->insert_batch('multiplefiles',$data);
        return $insert?true:false;
    }

    /*
 * Fetch files data from the database
 * @param id returns a single record if specified, otherwise all records
 */
    public function getRows($uid){
        $this->db->select('id,file_name,uploaded_on');
        $this->db->from('multiplefiles');
        $this->db->where('uid', $uid);
        $this->db->order_by('uploaded_on','desc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
}