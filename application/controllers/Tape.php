<?php
class Tape extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('tape_model');
	}

	public function index()
	{
		$data['tape'] =$this->tape_model->get_all_tape();
		$this->load->view('tape_view',$data);
	}

	public function tape_add() {
		$data = array(
			'tape_title' 	=> $this->input->post('tape_title'),
			'tape_category' => $this->input->post('tape_category'),
			'tape_quality' 	=> $this->input->post('tape_quality'),
		);

		$insert = $this->tape_model->tape_add($data);
		echo json_encode(array("status" => true));
	}

	public function ajax_edit($id) {
		$data = $this->tape_model->get_by_id($id);
		echo json_encode($data);

	}

	
	public function tape_update() {
		$data = array(
			'tape_title' => $this->input->post('tape_title'),
			'tape_category' => $this->input->post('tape_category'),
			'tape_quality' => $this->input->post('tape_quality'),
		);

		$this->tape_model->tape_update(array('tape_id' => $this->input->post('tape_id')) ,$data);

		echo json_encode(array("status" => TRUE));
	}


	public function tape_delete($id){
		$this->tape_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}