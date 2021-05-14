<?php


class Model_demonde_vaccin_admin extends CI_Model
{
	/*public function get_demonde($etat)
	{
		$this->db->select("*");
		$this->db->from("demonde_vaccin_admin");
		if($etat==="true")
		{
			$this->db->where("statut","0");
		}else{
			$this->db->where("statut!=","0");
		}
		$query=$this->db->get();
		return $resulta = $query->result_array();
	}*/
	public function get_list_demonde_for_admin($id)
	{
		$sql="SELECT v.nom_vaccin,d.* from vaccin v join demonde_vaccin_admin d join users u on v.id_vaccin=d.id_vaccin and d.id_admin=u.id_user where u.id_user = ".$id." ORDER BY d.date_demonde_vaccin DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	//SELECT u.firstname,u.lastname FROM demonde_vaccin_admin d join vaccin v join users u on d.id_admin=u.id_user and d.id_vaccin=v.id_vaccin GROUP by u.id_user

	public function get_list_demonde_for_admin_bay_mois_anne($id,$mois,$anne)
	{
		$date=$anne."-".$mois;
		$sql="select v.nom_vaccin,d.* from demonde_vaccin_admin d JOIN vaccin v JOIN users u on d.id_admin=u.id_user and d.id_vaccin=v.id_vaccin WHERE u.id_user =".$id." and d.date_demonde_vaccin LIKE '".$date."%'GROUP BY d.id_demonde_vaccin ORDER BY `date_demonde_vaccin` ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

}
