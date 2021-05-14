<?php


class Model_generale extends CI_Model
{
	public function __construct()
	{
	}
	public function login($email, $password,$tabName) {
		if($email && $password) {
			$sql = "SELECT * FROM users WHERE email = ? and users.statut = 1";
			$query = $this->db->query($sql, array($email));
			if($query->num_rows() == 1) {
				$result = $query->row_array();
				$hash_password = password_verify($password, $result['password']);
				if($hash_password === true) {
					return $result;
				}
				else {
					return false;
				}
			}
			else {
				return false;
			}
		}
	}
	public function reset_passwored($cin,$newpass,$nomtab,$email)
	{
		$sql="UPDATE ".$nomtab." SET password= '".$newpass."' WHERE cin ='".$cin."' and email = '".$email."'";
		$query = $this->db->query($sql);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function delete_fn($id,$tab,$nomIab){
		$this->db->where($nomIab, $id);
		$this->db->delete($tab);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function get_fn_Generale($id=null,$tabnam,$idname=null)
	{
		$this->db->select("*");
		$this->db->from($tabnam);
		if($id && $idname)
		{
			$this->db->where($idname,$id);
		}
		$query=$this->db->get();
		return $resulta = $query->result_array();
	}
	public function add_fn($data,$tabName)
	{
		$status = $this->db->insert($tabName, $data);
		return($this->db->affected_rows() != 1) ? false : true;
	}
	public function update_fn_bay_id($id,$data,$tab,$nomId)
	{
		$this->db->where($nomId, $id);
		$this->db->update($tab,$data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


}
