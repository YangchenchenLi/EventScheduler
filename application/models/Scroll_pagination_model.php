<?php
class Scroll_pagination_model extends CI_Model
{
	function fetch_data($limit, $start){

		$this->db->select("*");
		$this->db->from("event");
		$this->db->order_by("id", "ASC");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}
}
?>