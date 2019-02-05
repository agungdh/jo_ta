<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use agungdh\Pustaka;

class Temp extends CI_Controller {
	public $pustaka;

	public function __construct()
	{
		parent::__construct();
		
		$this->pustaka = new Pustaka();
	}

	public function index()
	{
		// echo $this->pustaka;
		// echo $this->pustaka->rupiah(100000);
		$this->load->view('template/template');
	}
}
