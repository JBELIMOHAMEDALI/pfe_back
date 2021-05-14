<?php


class Model_vaccin extends CI_Model
{
	public function get_vaccin($etat)
	{
		$this->db->select("*");
		$this->db->from("vaccin");
		if($etat==="true")
		{
			$this->db->where("qte","0");
		}else{
			$this->db->where("qte!=","0");
		}
		$query=$this->db->get();
		return $resulta = $query->result_array();
	}
	public function grt_list_vaccin_for_detaile()
	{
		$sql="select vaccin.* from vaccin where vaccin.id_vaccin 
				not in(SELECT vaccin.id_vaccin from vaccin join demonde_vaccin_admin 
				on vaccin.id_vaccin=demonde_vaccin_admin.id_vaccin) and vaccin.qte = 0";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getV_trie()
	{
		$sql="SELECT * FROM vaccin ORDER BY nom_vaccin ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

}
