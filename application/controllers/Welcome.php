<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{


	public function index()
	{
		$this->load->view('auth/index');
	}

	public function validation_login()
	{
		$real_username = $this->config->item('username');
		$real_password = $this->config->item('password');

		$input_username = $this->input->post('username');
		$input_password = md5(sha1($this->input->post('password')));

		if ($input_username == $real_username && $input_password == $real_password) {
			$data = [
				'username' => $real_username
			];
			$this->session->set_userdata($data);
			redirect(base_url('dashboard'));
		} else {
			$this->session->set_flashdata('false', 'invalid username or password');
			redirect(base_url('welcome'));
		}
	}
}
