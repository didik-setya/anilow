<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ajax extends CI_Controller
{
    public function delete_data()
    {
        cek_ajax();
        $id = $this->input->post('id');
        $from = $this->input->post('from');
        switch ($from) {
            case 'category':
                $this->db->where('id', $id)->delete('category');
                $this->result('Category', 'hapus');
                break;
            case 'season':
                $this->db->where('id', $id)->delete('season');
                $this->result('Season', 'hapus');
                break;
        }
    }

    public function category()
    {
        cek_ajax();
        $id = $this->input->post('id');
        $act = $this->input->post('act');
        switch ($act) {
            case 'add':
                $data = ['category_name' => htmlspecialchars($this->input->post('category'))];
                $this->db->insert('category', $data);
                $this->result('Category', 'tambahkan');
                break;
            case 'edit':
                $data = ['category_name' => htmlspecialchars($this->input->post('category'))];
                $this->db->where('id', $id)->update('category', $data);
                $this->result('Category', 'edit');
                break;
        }
    }

    public function season()
    {
        cek_ajax();
        $id = $this->input->post('id');
        $act = $this->input->post('act');
        switch ($act) {
            case 'add':
                $data = ['season_name' => htmlspecialchars($this->input->post('season'))];
                $this->db->insert('season', $data);
                $this->result('Season', 'tambahkan');
                break;
            case 'edit':
                $data = ['season_name' => htmlspecialchars($this->input->post('season'))];
                $this->db->where('id', $id)->update('season', $data);
                $this->result('Season', 'edit');
                break;
        }
    }


    private function result($from, $action)
    {
        if ($this->db->affected_rows() > 0) {
            $params = [
                'status' => true,
                'msg' => $from . ' berhasil di ' . $action
            ];
        } else {
            $params = [
                'status' => false,
                'msg' => $from . ' gagal di ' . $action
            ];
        }
        echo json_encode($params);
    }
}
