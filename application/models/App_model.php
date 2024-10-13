<?php
defined('BASEPATH') or exit('No direct script access allowed');
class App_model extends CI_Model
{
    private function query_data_content($id = null)
    {
        $this->db->select('
            content.*,
            category.category_name AS kategori,
            season.season_name AS musim
        ')
            ->from('content')
            ->join('category', 'content.category = category.id')
            ->join('season', 'content.season = season.id');
        if ($id) {
            $this->db->where('content.id', $id);
        }
    }

    private function filter_data_content()
    {
        $this->query_data_content();
        $search = ['title', 'url', 'genre', 'season_name'];
        $i = 0;
        foreach ($search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
    }

    public function get_data_content()
    {
        $this->filter_data_content();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function filtered_content()
    {
        $this->filter_data_content();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_content()
    {
        $this->query_data_content();
        return $this->db->count_all_results();
    }

    public function get_content_id($id)
    {
        $this->query_data_content($id);
        $data = $this->db->get();
        return $data;
    }
}
