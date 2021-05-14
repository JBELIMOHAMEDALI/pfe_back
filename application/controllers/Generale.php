<?php

require APPPATH . 'libraries/REST_Controller.php';
class Generale extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
	}
	public function password_hash($pass = '')
	{
		if ($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}
	public function login_get()
	{

		$email = $this->input->get('email', TRUE);
		$pass = $this->input->get('password', TRUE);
		$data = $this->Model_generale->login($email, $pass, "users");

		if (!empty($data) ) {
			$res = array(
				'error' => false,
				'msg' => $data
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'error' => true,
				'msg' => $this->db->error()
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
	}
	public function delete_generale_post()
	{
		$tabName = $this->input->post('tabname', TRUE);
		$id = $this->input->post('id', TRUE);
		$nomId = $this->input->post('nomId', TRUE);
		$delte = $this->Model_generale->delete_fn($id, $tabName, $nomId);
		if ($delte) {
			$res = array(
				'error' => false,
				'msg' => "Suppression Avec Succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'error' => true,
				'msg' => "Suppression n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		}
	}
	public function get_all_Generale_Get()
	{
		$tabName = $this->input->get('tabname', TRUE);
		$data = $this->Model_generale->get_fn_Generale(null, $tabName);
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
	public function get_One_Generale_By_ID_Get()
	{
		$tabName = $this->input->get('tabname', TRUE);
		$id = $this->input->get('id', TRUE);
		$nomId = $this->input->get('nomId', TRUE);
		$data = $this->Model_generale->get_fn_Generale($id, $tabName, $nomId);
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
