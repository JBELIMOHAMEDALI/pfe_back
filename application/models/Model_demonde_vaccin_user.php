<?php


class Model_demonde_vaccin_user extends CI_Model
{
	public function get_list_demonde_for_user($id,$year,$etat=null)
	{
		if($etat!=null)
		{
			$sql="SELECT d.*,v.*,u.firstname,u.lastname,u.cin from demonde_vaccin_user d join vaccin v join users u on
 					d.id_user=u.id_user and d.id_vaccin=v.id_vaccin 
					WHERE u.id_user = ".$id." and d.date_demonde_vaccin_user LIKE '".$year."%' 
					and d.statut=".$etat." ORDER by d.date_demonde_vaccin_user asc";
		}else
		{
			$sql="SELECT d.*,v.*,u.firstname,u.lastname,u.cin from demonde_vaccin_user d join vaccin v join users u on
 					d.id_user=u.id_user and d.id_vaccin=v.id_vaccin 
					WHERE u.id_user = ".$id." and d.date_demonde_vaccin_user LIKE '".$year."%' 
					ORDER by d.date_demonde_vaccin_user asc";
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
