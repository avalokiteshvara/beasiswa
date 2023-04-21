<?php defined('BASEPATH') or exit('No direct script access allowed');

function callback_nama($id){
  $CI = &get_instance();

  $pendaftar = $CI->db->get_where('pendaftar',array('id' => $id))->row_array();

  $nik = $pendaftar['nik'];
  $nama_lengkap = strtoupper( $pendaftar['nama_lengkap'] );

  return '<a href="#" class="detail" id="' . $nik . '" onclick="show_detail(\'' . $nik . '\')">'. $nama_lengkap .'</a>';

}
