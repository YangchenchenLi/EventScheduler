<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends CI_Model{

    function __construct() {
        $this->proTable   = 'products';
        $this->ordTable = 'orders';
    }

    /*
     * Fetch products data from the database
     * @param id returns a single record if specified, otherwise all records
     */
    public function getRows($id = ''){
        $this->db->select('*');
        $this->db->from($this->proTable);
        $this->db->where('status', '1');
        if($id){
            $this->db->where('id', $id);
            $query  = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->row_array():array();
        }else{
            $this->db->order_by('name', 'asc');
            $query  = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():array();
        }

        // return fetched data
        return !empty($result)?$result:false;
    }

    /*
     * Fetch order data from the database
     * @param id returns a single record
     */
    public function getOrder($id){
        $this->db->select('r.*, p.name as product_name, p.price as product_price, p.currency as product_price_currency');
        $this->db->from($this->ordTable.' as r');
        $this->db->join($this->proTable.' as p', 'p.id = r.product_id', 'left');
        $this->db->where('r.id', $id);
        $query  = $this->db->get();
        return ($query->num_rows() > 0)?$query->row_array():false;
    }

    /*
     * Insert transaction data in the database
     * @param data array
     */
    public function insertOrder($data){
        $insert = $this->db->insert($this->ordTable,$data);
        return $insert?$this->db->insert_id():false;
    }

}