<?php

require APPPATH . 'libraries/REST_Controller.php';
class Vaccin extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
		$this->load->model("Model_vaccin");
	}

	public function add_vaccin_post()
	{
		$data = array(
			'nom_vaccin' => $this->input->post('nom_vaccin'),
			'avantages' => $this->input->post('avantages'),
			'ingredients' => $this->input->post('ingredients'),
			'min_age' => $this->input->post('min_age'),
			'max_age' => $this->input->post('max_age'),
			'qte' => $this->input->post('qte'),
			'description' => $this->input->post('description'),
		);
		$create = $this->Model_generale->add_fn($data,"vaccin");
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
	public function update_vaccin_post()
	{
		$id = $this->input->post('id', true);

		$data = array(
			'nom_vaccin' => $this->input->post('nom_vaccin'),
			'avantages' => $this->input->post('avantages'),
			'ingredients' => $this->input->post('ingredients'),
			'min_age' => $this->input->post('min_age'),
			'max_age' => $this->input->post('max_age'),
			'qte' => $this->input->post('qte'),
			'description' => $this->input->post('description'),
		);
		$update = $this->Model_generale->update_fn_bay_id($id, $data, "vaccin", "id_vaccin");
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
	//$etat = true =>qte=0 else =>qte>0
	public function get_vaccin_Get()
	{
		$etat = $this->input->get('etat', TRUE);
		$data = $this->Model_vaccin->get_vaccin($etat);
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
	public function get_vaccin_demonde_Get()
	{
		$etat = $this->input->get('etat', TRUE);
		$data = $this->Model_vaccin->get_vaccin_demonde($etat);
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
	public function get_vaccin__for_domonde_not_do_Get()
	{
		$data = $this->Model_vaccin->grt_list_vaccin_for_detaile();
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
	//
	public function get_vaccin_all_Get()
	{
		$data = $this->Model_vaccin->getV_trie();
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
