<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

	public function index()
	{
		$this->load->view('naviBarView');
		$this->load->view('searchBar');
		$this->load->view('footer');
	}

	public function locations() {
		$this->load->view('naviBarView');
		$this->load->view('galleryView');
		$this->load->view('footer');
	}

	public function detailPage() {
		$this->load->view('naviBarView');
		$this->load->view('Detail_Page_view');
		$this->load->view('footer');
	}
	
}
