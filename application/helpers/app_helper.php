<?php
function cek_url()
{
    $CI = get_instance();
    $urlnya1 = $CI->uri->segment(1);
    $urlnya2 = $CI->uri->segment(2);
    $urlnya3 = $CI->uri->segment(3);
    $urlnya4 = $CI->uri->segment(4);
    if (!empty($urlnya1)) {
        if (!empty($urlnya2)) {
            $result = $urlnya1 . '/' . $urlnya2 . '/';
        } else {
            $result = $urlnya1 . '/';
        }
    } else {
        $result = site_url();
    }
    return $result;
}

function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect(base_url('welcome'));
    }
}

function cek_ajax()
{
    $ci = get_instance();
    if (!$ci->input->is_ajax_request()) {
        exit('No direct script access allowed');
    }
}
