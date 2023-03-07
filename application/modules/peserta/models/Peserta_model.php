<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_model extends CI_Model
{

  function get_document($user_id,$user_kategori_id){
    // $user_id = $this->session->userdata('user_id');
    // $user_kategori_id = $this->session->userdata('user_kategori_id');

    $kategori = $this->db->get_where('kategori',array('id' => $user_kategori_id))->row_array();
    $arr_kategori_id = explode(',',$kategori['set_jenis_dokumen']);

    $this->db->select(
      "a.id, a.nama,IFNULL(a.file_template,'none') AS file_template,
       IFNULL(b.file_dokumen,'belum') AS user_file_dokumen,
		   IF(IFNULL(b.file_dokumen,'belum') = 'belum','-',b.verifikasi) AS verifikasi"
    );
    $this->db->join('dokumen_pendaftar b','a.id = b.jenis_dokumen_id AND b.pendaftar_id = ' . $user_id,'LEFT OUTER');
    $this->db->where_in('a.id',$arr_kategori_id);
    return $this->db->get('jenis_dokumen a');

  }
}
