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
            case 'genre':
                $this->db->where('id', $id)->delete('genre');
                $this->result('Genre', 'hapus');
                break;
            case 'content':
                $this->db->trans_begin();
                $this->db->where('id', $id)->delete('content');
                $this->db->where('id_content', $id)->delete('episode');
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $params = [
                        'status' => false,
                        'msg' => 'Content gagal di hapus'
                    ];
                } else {
                    $this->db->trans_commit();
                    $params = [
                        'status' => true,
                        'msg' => 'Content berhasil di hapus'
                    ];
                }
                echo json_encode($params);
                die;
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

    public function genre()
    {
        cek_ajax();
        $id = $this->input->post('id');
        $act = $this->input->post('act');
        switch ($act) {
            case 'add':
                $data = ['genre_name' => htmlspecialchars($this->input->post('genre'))];
                $this->db->insert('genre', $data);
                $this->result('Genre', 'tambahkan');
                break;
            case 'edit':
                $data = ['genre_name' => htmlspecialchars($this->input->post('genre'))];
                $this->db->where('id', $id)->update('genre', $data);
                $this->result('Genre', 'edit');
                break;
        }
    }

    public function content()
    {
        cek_ajax();
        $id = $this->input->post('id');
        $act = $this->input->post('act');
        switch ($act) {
            case 'add':
                $input_genre = $this->input->post('genre');
                $about_name = $this->input->post('about_name');
                $about_value = $this->input->post('about_value');

                $count_genre = count($input_genre);
                $count_about = count($about_name);

                $array_genre = [];
                $array_about = [];

                for ($a = 0; $a < $count_genre; $a++) {
                    $row = [];
                    $row['genre'] = $input_genre[$a];
                    $array_genre[] = $row;
                }

                for ($i = 0; $i < $count_about; $i++) {
                    $row = [
                        'name' => $about_name[$i],
                        'value' => $about_value[$i]
                    ];
                    $array_about[] = $row;
                }


                $data_genre = json_encode($array_genre);
                $data_about = json_encode($array_about);


                $main_data = [
                    'title' => $this->input->post('title'),
                    'url' => $this->input->post('url'),
                    'image_url' => $this->input->post('image'),
                    'season' => $this->input->post('season'),
                    'genre' => $data_genre,
                    'category' => $this->input->post('category'),
                    'description' => $this->input->post('desc'),
                    'about' => $data_about
                ];
                $this->db->insert('content', $main_data);
                $this->result('Content', 'tambahkan');
                break;
            case 'edit':
                $input_genre = $this->input->post('genre');
                $about_name = $this->input->post('about_name');
                $about_value = $this->input->post('about_value');

                $count_genre = count($input_genre);
                $count_about = count($about_name);

                $array_genre = [];
                $array_about = [];

                for ($a = 0; $a < $count_genre; $a++) {
                    $row = [];
                    $row['genre'] = $input_genre[$a];
                    $array_genre[] = $row;
                }

                for ($i = 0; $i < $count_about; $i++) {
                    $row = [
                        'name' => $about_name[$i],
                        'value' => $about_value[$i]
                    ];
                    $array_about[] = $row;
                }


                $data_genre = json_encode($array_genre);
                $data_about = json_encode($array_about);


                $main_data = [
                    'title' => $this->input->post('title'),
                    'url' => $this->input->post('url'),
                    'image_url' => $this->input->post('image'),
                    'season' => $this->input->post('season'),
                    'genre' => $data_genre,
                    'category' => $this->input->post('category'),
                    'description' => $this->input->post('desc'),
                    'about' => $data_about
                ];
                $this->db->where('id', $id)->update('content', $main_data);
                $this->result('Content', 'edit');
                break;
        }
    }

    public function datatable_content()
    {
        cek_ajax();
        $get_data = $this->app->get_data_content();
        $data = [];
        $i = 1;
        $from = 'content';
        foreach ($get_data as $gt) {
            $button = '
                <button type="button" class="btn btn-sm btn-danger" onclick="delete_data(\'' . $gt->id . '\', \'' . $from . '\')"><i class="fa fa-trash"></i></button>
                <button type="button" class="btn btn-sm btn-success" onclick="edit_content(\'' . $gt->id . '\')"><i class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-sm btn-primary" onclick="detail_data(\'' . $gt->id . '\')"><i class="fa fa-search"></i></button>
                <a href="' . base_url('dashboard/anime/') . $gt->id . '" class="btn btn-sm btn-dark"><i class="fas fa-film"></i></a>

            ';
            $row = [];
            $row[] = $i++;
            $row[] = $gt->title;
            $row[] = $gt->url;
            $row[] = $button;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->app->count_all_content(),
            "recordsFiltered" => $this->app->filtered_content(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function get_content_for_edit()
    {
        cek_ajax();
        $id = $this->input->post('id');
        $data = $this->app->get_content_id($id)->row();
        $data_genre = json_decode($data->genre);
        $data_about = json_decode($data->about);


        $output = [
            'title' => $data->title,
            'url' => $data->url,
            'image_url' => $data->image_url,
            'season' => $data->season,
            'category' => $data->category,
            'description' => $data->description,
            'genre' => $data_genre,
            'about' => $data_about,
            'kategori' => $data->kategori,
            'musim' => $data->musim
        ];
        echo json_encode($output);
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
