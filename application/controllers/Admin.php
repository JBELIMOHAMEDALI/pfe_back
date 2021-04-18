<?php

require APPPATH . 'libraries/REST_Controller.php';
class Admin extends REST_Controller
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
	public function add_docture_post()
	{
		$cin = $this->input->post('cin');
		$password = $this->password_hash($cin);
		$data = array(
			'password' => $password,
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'cin' => $cin,
			'email	' => $this->input->post('email'),
			'speciality' => $this->input->post('speciality'),
			'id_department' => $this->input->post('id_department'),
			'phone' =>  $this->input->post('phone'),
		);

		if ($this->Model_generale->check_cin($cin, "cin", "docteur") === true) {
			$create = $this->Model_generale->add_fn($data, "docteur");
			if ($create) {
				$res = array(
					'erorer' => false,
					'msg' => "docteur Ajouté avec succès"
				);
				$this->response($res, REST_Controller::HTTP_OK);
			} else {
				$res = array(
					'erorer' => true,
					'msg' => "Ajouté d'un docteur n'a pas réussi"
				);
				$this->response($res, REST_Controller::HTTP_NOT_FOUND);
			}
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Cin Existe Déjà "
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function update_docture_post()
	{
		$cin = $this->input->post('cin');
		$data = array(
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'cin' => $cin,
			'email	' => $this->input->post('email'),
			'speciality' => $this->input->post('speciality'),
			'id_department' => $this->input->post('id_department'),
			'phone' =>  $this->input->post('phone'),
		);
		$id = $this->input->post('id_docteur', true);
		$update = $this->Model_generale->update_fn_bay_id($id, $data, "docteur", "id_docteur");
		if ($update) {
			$res = array(
				'erorer' => false,
				'msg' => "Modification Du Docteur avec succès"
			);
			$this->response($res, REST_Controller::HTTP_OK);
		} else {
			$res = array(
				'erorer' => true,
				'msg' => "Modification Du Docteur n'a pas réussi"
			);
			$this->response($res, REST_Controller::HTTP_NOT_FOUND);
		}
	}

}
