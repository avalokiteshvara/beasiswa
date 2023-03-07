<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Verifikator_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*
    //DEPRECATED
    function pendaftar($kategori_id){

      $kategori = $this->db->get_where('kategori',array('id' => $kategori_id))->row_array();
      if($kategori['level_penerima'] === 'pelajar'){
        //query pelajar
        $this->db->select(
          "a.id,a.nik,a.nama_lengkap, a.alamat_rumah,a.kab_kota, a.jk, a.nama_lembaga, a.kelas,
		       a.semester, a.`status`,  GROUP_CONCAT(CONCAT(c.id,'|', REPLACE(b.file_dokumen,a.nik,''),'|',b.verifikasi,'|',b.id) SEPARATOR ';') AS dokumen"
        );
        $this->db->join("dokumen_pendaftar b","a.id = b.pendaftar_id","left");
        $this->db->join("jenis_dokumen c","b.jenis_dokumen_id = c.id","left");
        $this->db->group_by('a.id');

        return $this->db->get_where("pendaftar a",array("kategori_id" => $kategori_id));
      }else{
        //query mahasiswa
        $this->db->select(
          "a.id,a.nik,a.nama_lengkap, a.alamat_rumah,a.kab_kota, a.jk, a.nama_lembaga, a.program_studi, a.semester,
		       a.ip_semester, a.`status`,  GROUP_CONCAT(CONCAT(c.id,'|', REPLACE(b.file_dokumen,a.nik,''),'|',b.verifikasi,'|',b.id) SEPARATOR ';') AS dokumen"
        );
        $this->db->join("dokumen_pendaftar b","a.id = b.pendaftar_id","left");
        $this->db->join("jenis_dokumen c","b.jenis_dokumen_id = c.id","left");
        $this->db->group_by('a.id');

        return $this->db->get_where("pendaftar a",array("kategori_id" => $kategori_id));
      }

    }
  */

}
