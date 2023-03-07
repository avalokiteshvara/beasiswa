<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller
{

    private $tahun_aktif ;

    public function __construct()
    {
        parent::__construct();

        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->database();
        $this->load->helper(array('url', 'libs','alert'));
        $this->load->library(array('session'));

        $this->tahun_aktif = get_settings('small-text','tahun_aktif');

    }

    public function index()
    {
        $penambahan_quota_berkas =  get_settings('value','penambahan_tahap_berkas');

        $uri2 = base64url_decode($this->uri->segment(3));

        $this->db->select("a.jml_penerima AS quota_akhir,
                           ROUND(a.jml_penerima + (a.jml_penerima * ($penambahan_quota_berkas / 100))) AS quota_berkas,
                           COUNT(a.id) AS total_pendaftar,
                           SUM(IF(b.`status` = 'diterima',1,0)) AS tahap_berkas_diterima,
                           SUM(IF(b.`status` = 'ditolak',1,0)) AS tahap_berkas_ditolak,
                      		 SUM(IF(b.status_akhir = 'diterima',1,0)) AS tahap_akhir_diterima	,
                       		 SUM(IF(b.status_akhir = 'ditolak',1,0)) AS tahap_akhir_ditolak",false);

        $this->db->join('pendaftar b','a.id = b.kategori_id','left');
        $this->db->where('a.slug',$uri2);
        $this->db->where('YEAR(b.created_at)',$this->tahun_aktif);
        $cek = $this->db->get('kategori a')->row_array();



        // $this->db->query("SELECT COUNT(b.id) AS total_pendaftar,
        //                          COUNT(c.id) AS tahap_berkas_diterima,
        //                          COUNT(d.id) AS tahap_berkas_ditolak");

        $return =
        '<div class="panel-heading">
          <h3 class="panel-title">REKAP</h3>
        </div>
        <div class="panel-body">
          <ul>
            <li>Total Pendaftar&nbsp;:&nbsp;' . $cek['total_pendaftar'] .' Pendaftar</li>
            <li>Quota Berkas&nbsp;:&nbsp;' . $cek['quota_berkas'] .' Pendaftar (Quota Akhir + ' . $penambahan_quota_berkas .'%)</li>
            <li>Quota Akhir&nbsp;:&nbsp;' . $cek['quota_akhir'] .' Pendaftar</li>
            <li><h4>Tahap Berkas&nbsp;:&nbsp;
                  <span class="label label-success">' . $cek['tahap_berkas_diterima'] .' Diterima&nbsp;( Sisa quota: ' . ($cek['quota_berkas'] - $cek['tahap_berkas_diterima'])  .' )</span>
                  <span class="label label-danger">' . $cek['tahap_berkas_ditolak'] .' Ditolak</span>
                </h4>
            </li>

            <li><h4>Tahap Akhir&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
                  <span class="label label-success">' . $cek['tahap_akhir_diterima'] .' Diterima&nbsp;( Sisa quota: ' . ($cek['quota_akhir'] - $cek['tahap_akhir_diterima'])  .' )</span>
                  <span class="label label-danger">' . $cek['tahap_akhir_ditolak'] .' Ditolak</span>
                </h4>
            </li>

          </ul>
        </div>';

        echo $return;
    }
}
