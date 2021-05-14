<?php

require APPPATH . 'libraries/REST_Controller.php';
class Demonde_vaccin_admin extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
		$this->load->model("Model_demonde_vaccin_admin");
	}
		public function add_demonde_vaccin_admin_post()
	{
		$data = array(
			'id_admin' => $this->input->post('id_admin'),
			'id_vaccin' => $this->input->post('id_vaccin'),
			'description' => $this->input->post('description'),
			'qte' => $this->input->post('qte'),
			'date_demonde_vaccin' => date("Y-m-d"),

		);
		$create = $this->Model_generale->add_fn($data,"demonde_vaccin_admin");
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
	public function update_demonde_vaccin_admin_post()
	{
		$id = $this->input->post('id', true);

		$data = array(
			'id_admin ' => $this->input->post('id_admin '),
			'id_vaccin ' => $this->input->post('id_vaccin '),
			'description' => $this->input->post('description'),
			'qte' => $this->input->post('qte'),
		);
		$update = $this->Model_generale->update_fn_bay_id($id, $data, "demonde_vaccin_admin", "id_demonde_vaccin");
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

	/*public function get_demonde_vaccin_admin_Get()
	{
		$etat = $this->input->get('etat', TRUE);
		$data = $this->Model_demonde_vaccin_admin->get_demonde($etat);
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
	}*/
	/*public function get_demonde_vaccin_for_one_admin_Get()
	{
		$id = $this->input->get('id', TRUE);
		$data = $this->Model_demonde_vaccin_admin->get_list_demonde_for_admin($id);
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
	}*/

	public function get_demonde_vaccin_for_one_admin_bay_date_Get()
	{
		$id = $this->input->get('id', TRUE);
		$mois = $this->input->get('mois', TRUE);
		$anne = $this->input->get('anne', TRUE);

		$data = $this->Model_demonde_vaccin_admin->get_list_demonde_for_admin_bay_mois_anne($id,$mois,$anne);
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
