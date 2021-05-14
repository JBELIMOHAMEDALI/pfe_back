<?php

require APPPATH . 'libraries/REST_Controller.php';
class Demonde_vaccin_user extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
		$this->load->model("Model_demonde_vaccin_user");
	}
	public function add_demonde_vaccin_user_post()
	{
		$data = array(
			'id_user' => $this->input->post('id_user'),
			'id_vaccin' => $this->input->post('id_vaccin'),
			'hopital_proche' => $this->input->post('hopital_proche'),
			'maladies_chroniques' => $this->input->post('maladies_chroniques'),
			'date_demonde_vaccin_user' => date("Y-m-d"),

		);
		$create = $this->Model_generale->add_fn($data,"demonde_vaccin_user");
		if ($create) {
			$res = array(
				'error' => false,
				'msg' => " Ajouté avec succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'error' => true,
				'msg' => "Ajouté n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
	}
	public function update_demonde_vaccin_user_post()
	{
		$id = $this->input->post('id', true);
		$data = array(
			'id_user ' => $this->input->post('id_user '),
			'id_vaccin' => $this->input->post('id_vaccin'),
			'hopital_proche' => $this->input->post('hopital_proche'),
			'maladies_chroniques' => $this->input->post('maladies_chroniques'),
			'date_demonde_vaccin_user' => date("Y-m-d"),

		);
		$update = $this->Model_generale->update_fn_bay_id($id, $data, "demonde_vaccin_user", "id_demonde_vaccin_user");
		if ($update) {
			$res = array(
				'error' => false,
				'msg' => "Modification  avec succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'error' => true,
				'msg' => "Modification n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function get_demonde_vaccin_for_one_user_Get()
	{
		$id = $this->input->get('id', TRUE);
		$etat = $this->input->get('etat', TRUE);
		$year = $this->input->get('year', TRUE);
		if($etat!=null)
		$data = $this->Model_demonde_vaccin_user->get_list_demonde_for_user($id,$year,$etat);
		else
		$data = $this->Model_demonde_vaccin_user->get_list_demonde_for_user($id,$year,null);
		$total = count($data);
		if ($total != 0) {
			$res = array(
				'error' => false,
				'msg' => $data

			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'error' => true,
				'msg' => "Pas Des Donne "
			);

			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
