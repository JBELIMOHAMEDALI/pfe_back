<?php

require APPPATH . 'libraries/REST_Controller.php';
class User extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
		$this->load->model("Model_users");
	}
	public function password_hash($pass = '')
	{
		if ($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}
	public function add_user_post()
	{
		$p = $this->input->post('password');
		$password = $this->password_hash($p);
		$data = array(
			'password' => $password,
			'email' => $this->input->post('email'),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'phone' => $this->input->post('phone'),
			'adresse' => $this->input->post('adresse'),
			'cin' => $this->input->post('cin'),
		);
		$create = $this->Model_users->create_user($data);
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
	public function update_user_post()
	{
		$id = $this->input->post('id', true);
		$data = array(
			'email' => $this->input->post('email'),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'phone' => $this->input->post('phone'),
			'adresse' => $this->input->post('adresse'),
		);

		$update = $this->Model_generale->update_fn_bay_id($id, $data, "user", "id_user");
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
	public function get_all_user_Get()
	{
	$statut=$this->input->get('statut');
		$data = $this->Model_users->get_all_user($statut);
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
	public function statut_compte_post()
	{
		$statut = $this->input->post('statut', TRUE);
		$id = $this->input->post('id', TRUE);
		$act = $this->Model_users->active_desc_user($id,$statut);
		if ($act) {
			$res = array(
				'erorer' => false,
				'msg' => "Operation Success "
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Operation N'a Pas Réussi "
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}

}
