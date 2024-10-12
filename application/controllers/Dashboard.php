<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }
    public function index()
    {
        $data = [
            'view' => 'dashboard/index',
            'title' => 'Dashoard'
        ];

        $this->load->view('dashboard/template', $data);
    }

    public function category()
    {
        $data = [
            'view' => 'dashboard/category',
            'title' => 'Category'
        ];

        $this->load->view('dashboard/template', $data);
    }

    public function season()
    {
        $data = [
            'view' => 'dashboard/season',
            'title' => 'Season'
        ];

        $this->load->view('dashboard/template', $data);
    }
}
