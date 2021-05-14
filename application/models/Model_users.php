<?php

class Model_users extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	public function create_user($data)
	{
		//$retor = $this->db->insert("users", $data);
		if ($this->db->insert("users", $data)) {
			return true;
		}
		else { return false; }
	}
	public function get_all_user($statute)
	{
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("type","0");
		$this->db->where("statut",$statute);
		$query=$this->db->get();
		return $resulta = $query->result_array();
	}
	public function active_desc_user($id,$statut)
	{
		$this->db->where("id_user ",$id);
		$this->db->set('statut',$statut,FALSE);
		return $this->db->update("users");
	}

}
