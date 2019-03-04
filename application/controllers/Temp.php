<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temp extends CI_Controller {

	public function index()
	{
		echo $this->helper->rupiah(20000);
	}
}
