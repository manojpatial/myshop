<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	  public function __construct()
    {
        parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Home_model');
		$this->load->library('calendar');
		$this->load->helper(array('url','form','file','cookie','captcha'));
		$autoload['helpers'] = array('form');
		$this->load->library('encrypt');
		//$this->load->library('pagination');
		
	 }
	 
	 
	public function index()
	{
		$this->load->view('home/index.php');
	}
}
