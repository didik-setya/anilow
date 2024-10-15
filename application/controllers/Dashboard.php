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

    public function genre()
    {
        $data = [
            'view' => 'dashboard/genre',
            'title' => 'Genre'
        ];

        $this->load->view('dashboard/template', $data);
    }

    public function content()
    {
        $data = [
            'view' => 'dashboard/content',
            'title' => 'Content'
        ];

        $this->load->view('dashboard/template', $data);
    }


    public function anime($id = null)
    {
        $err_msg = [
            'heading' => 'tidak ada',
            'message' => 'halaman tidak di temukan'
        ];
        if ($id) {
            $data_content = $this->db->get_where('content', ['id' => $id])->row();
            if ($data_content) {
                $data_eps = $this->db->get_where('episode', ['id_content' => $id])->result();
                $data = [
                    'view' => 'dashboard/anime',
                    'title' => 'Anime',
                    'data' => $data_eps,
                    'content' => $data_content,
                    'id' => $id
                ];

                $this->load->view('dashboard/template', $data);
            } else {
                $this->load->view('errors/html/error_404', $err_msg);
            }
        } else {
            $this->load->view('errors/html/error_404', $err_msg);
        }
    }
}
