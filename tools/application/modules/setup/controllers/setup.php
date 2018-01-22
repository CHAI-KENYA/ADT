<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Setup extends MX_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index($message = '') {
		$data['active_menu'] = 7;
		$data['content_view'] = "setup/setup_view";
		$data['title'] = "Dashboard | System Setup";
		$this -> template($data);
	}

	public function initialize(){
		//Get mflcode
		$mflcode = $this->input->post('facility', TRUE);
		//Get database config
		$CI = &get_instance();
		$CI -> load -> database();
		//Update all users to mflcode
		$sql = "
		UPDATE facilities SET facilitycode = $mflcode ;
		UPDATE users SET Facility_Code = $mflcode ;
		UPDATE drug_stock_movement SET facility = $mflcode ;
		UPDATE drug_stock_movement SET source = $mflcode ;
		UPDATE drug_stock_movement SET destination = $mflcode ;
		UPDATE drug_cons_balance set facility = $mflcode ;
		UPDATE drug_stock_balance set facility_code = $mflcode;
		UPDATE patient SET facility_code = $mflcode ;
		UPDATE patient_visit SET facility = $mflcode ;
		UPDATE patient_appointment SET facility = $mflcode ;
		UPDATE clinic_appointment SET facility = $mflcode ;
		";
		
		$CI->db->query($sql);
		//Redirect with message
		$message = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> Facility initialized to MFLCODE: '.$mflcode.'</div>';
		$this->session->set_flashdata('init_msg', $message);
		redirect("setup");
	}

	public function template($data) {
		$data['show_menu'] = 0;
		$data['show_sidemenu'] = 0;
		$this -> load -> module('template');
		$this -> template -> index($data);
	}

}