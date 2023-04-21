<?php defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    private $tahun_aktif;

    public function __construct()
    {
        parent::__construct();

        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->database();
        $this->load->helper(array('url', 'libs', 'alert'));
        $this->load->library(array('session'));

        $this->tahun_aktif = get_settings('small-text', 'tahun_aktif');
    }

    public function get_wilayah()
    {
        header('content-type: application/json');
        $param = $this->input->get('q');

        $this->db->select('c.id as desa_id,a.nama AS kab, b.nama AS kec, c.nama AS desa');
        $this->db->from('kota_kabupaten a');
        $this->db->join('kecamatan b', 'a.id = b.kab_id', 'left');
        $this->db->join('kelurahan c', 'b.id = c.kec_id', 'left');
        $this->db->where('c.nama LIKE', "$param%");
        // $this->db->limit(5);
        $query = $this->db->get();

        $result = [];
        foreach ($query->result_array() as $row) {
            $result[] = [
                'id'   => $row['desa_id'],
                'kab'  => $row['kab'],
                'kec'  => $row['kec'],
                'desa' => $row['desa'],
                'text' => $row['desa'] . ' - ' . $row['kec'] . ' - ' . $row['kab'],
            ];
        }

        echo json_encode($result);
    }

    public function pendaftar_details()
    {
        header('content-type: application/json');

        $nik = $this->input->get('nik');

        $this->db->select('a.*,b.level_penerima');
        $this->db->from('pendaftar a');
        $this->db->join('kategori b', 'a.kategori_id = b.id', 'left');
        $this->db->where('a.nik', $nik);
        $qry = $this->db->get();
        echo json_encode($qry->row());
    }

    public function rekap()
    {
        $penambahan_quota_berkas = get_settings('value', 'penambahan_tahap_berkas');

        $uri2 = base64url_decode($this->uri->segment(3));

        $this->db->select("a.jml_penerima AS quota_akhir,
                           ROUND(a.jml_penerima + (a.jml_penerima * ($penambahan_quota_berkas / 100))) AS quota_berkas,
                           COUNT(a.id) AS total_pendaftar,
                           SUM(IF(b.`status` = 'diterima',1,0)) AS tahap_berkas_diterima,
                           SUM(IF(b.`status` = 'ditolak',1,0)) AS tahap_berkas_ditolak,
                      	   SUM(IF(b.status_akhir = 'diterima',1,0)) AS tahap_akhir_diterima	,
                       	   SUM(IF(b.status_akhir = 'ditolak',1,0)) AS tahap_akhir_ditolak", false);

        $this->db->join('pendaftar b', 'a.id = b.kategori_id', 'left');
        $this->db->where('a.slug', $uri2);
        $this->db->where('YEAR(b.created_at)', $this->tahun_aktif);
        $this->db->group_by('a.id');
        $data = $this->db->get('kategori a');

        if ($data->num_rows() > 0) {
            $cek = $data->row_array();

            $return =
                '
          <ul>
            <li>Total Pendaftar&nbsp;:&nbsp;' . $cek['total_pendaftar'] . ' Pendaftar</li>
            <li>Quota Berkas&nbsp;:&nbsp;' . $cek['quota_berkas'] . ' Pendaftar (Quota Akhir + ' . $penambahan_quota_berkas . '%)</li>
            <li>Quota Akhir&nbsp;:&nbsp;' . $cek['quota_akhir'] . ' Pendaftar</li>
            <li><h5>Tahap Berkas&nbsp;:&nbsp;
                  <span class="badge bg-success">' . $cek['tahap_berkas_diterima'] . ' Diterima&nbsp;( Sisa quota: ' . ($cek['quota_berkas'] - $cek['tahap_berkas_diterima']) . ' )</span>
                  <span class="badge bg-danger">' . $cek['tahap_berkas_ditolak'] . ' Ditolak</span>
                </h5>
            </li>

            <li><h5>Tahap Akhir&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
                  <span class="badge bg-success">' . $cek['tahap_akhir_diterima'] . ' Diterima&nbsp;( Sisa quota: ' . ($cek['quota_akhir'] - $cek['tahap_akhir_diterima']) . ' )</span>
                  <span class="badge bg-danger">' . $cek['tahap_akhir_ditolak'] . ' Ditolak</span>
                </h5>
            </li>

          </ul>';
        } else {
            $return = "Data rekap belum tersedia...";
        }

        echo $return;
    }


    public function lolos1()
    {
        $filter_kat = $this->input->post('filter_kat');
        $filter_jur = $this->input->post('filter_jur');


        $this->load->library('Datatables');

        $this->datatables->select(
            "nik,
            UCASE(nama_lengkap) AS nama_lengkap,
            UCASE(nama_lembaga) AS nama_lembaga,
            UCASE(program_studi) AS program_studi,
            jenis_jurusan,
            akreditasi,
            ip_semester,
            created_at"
        );

        if ($filter_jur) {
            $this->datatables->where('jenis_jurusan', $filter_jur);
        }

        $this->datatables->from('pendaftar');
        if ($filter_kat) {
            $this->datatables->where('kategori_id', $filter_kat);
        }
        $this->datatables->where('status', 'diterima');
        $this->datatables->like("DATE_FORMAT(created_at, '%d-%m-%Y %H:%i:%s')", $this->tahun_aktif);
        // $this->datatables->order_by('ip_semester', 'desc');
        // $this->datatables->order_by('akreditasi', 'asc');
        // $this->datatables->order_by('created_at', 'asc');


        echo $this->datatables->generate();
    }

    public function lolos2()
    {
        $filter_kat = $this->input->post('filter_kat');
        $filter_jur = $this->input->post('filter_jur');


        $this->load->library('Datatables');

        $this->datatables->select(
            "nik,
            UCASE(nama_lengkap) AS nama_lengkap,
            UCASE(nama_lembaga) AS nama_lembaga,
            UCASE(program_studi) AS program_studi,
            jenis_jurusan,
            akreditasi,
            ip_semester,
            created_at"
        );

        if ($filter_jur) {
            $this->datatables->where('jenis_jurusan', $filter_jur);
        }

        $this->datatables->from('pendaftar');
        if ($filter_kat) {
            $this->datatables->where('kategori_id', $filter_kat);
        }
        $this->datatables->where('status_akhir', 'diterima');
        $this->datatables->like("DATE_FORMAT(created_at, '%d-%m-%Y %H:%i:%s')", $this->tahun_aktif);
        // $this->datatables->order_by('ip_semester', 'desc');
        // $this->datatables->order_by('akreditasi', 'asc');
        // $this->datatables->order_by('created_at', 'asc');


        echo $this->datatables->generate();
    }

    public function update_grafik_002()
    {
        // header('content-type: application/json');

        $kategori = $this->input->get('kategori');

        $rs_grafik_002 = $this->db->query("SELECT nama_lembaga,
                                             (COUNT(id)/(SELECT COUNT(id) FROM pendaftar WHERE YEAR(created_at) = YEAR(NOW()) AND kategori_id = $kategori )) * 100 AS persentase
                                        FROM pendaftar
                                        WHERE YEAR(created_at) = YEAR(NOW()) AND kategori_id = $kategori
                                        GROUP BY nama_lembaga
                                        ORDER BY COUNT(id) DESC
                                        LIMIT 8");

        //$data['grafik_002'] = array('data' => substr($grafik_002,0,-1),'lainnya' => (100 - $grafik_002_total));

        if ($rs_grafik_002->num_rows() > 0) {
            $grafik_002       = "";
            $grafik_002_total = 0;
            foreach ($rs_grafik_002->result_array() as $key) {
                $grafik_002 .= '{';
                $grafik_002 .= '"name":' . '"' . preg_replace("/([{,])([a-zA-Z][^: ]+):/", "$1\"$2\":", $key['nama_lembaga']) . '",';
                $grafik_002 .= '"y":' . $key['persentase'];
                $grafik_002 .= '},';
                $grafik_002_total += $key['persentase'];
            }
            echo substr($grafik_002, 0, -1) . ',{ "name":"Lainnya",  "y": ' . (100 - $grafik_002_total) . '}';
        } else {
            echo "";
        }
    }

    public function update_grafik_003()
    {
        // header('content-type: application/json');

        $kategori = $this->input->get('kategori');

        $rs_grafik_003 = $this->db->query("SELECT a.akreditasi ,
                                               (COUNT(a.id)/(SELECT COUNT(id) FROM pendaftar WHERE YEAR(created_at) = YEAR(NOW()) AND kategori_id = $kategori )) * 100 AS persentase
                                        FROM pendaftar a
                                        WHERE YEAR(created_at) = YEAR(NOW()) AND kategori_id = $kategori
                                        GROUP BY a.akreditasi
                                        ORDER BY COUNT(a.id) DESC");

        //$data['grafik_002'] = array('data' => substr($grafik_002,0,-1),'lainnya' => (100 - $grafik_002_total));

        if ($rs_grafik_003->num_rows() > 0) {
            $grafik_003 = "";
            foreach ($rs_grafik_003->result_array() as $key) {
                $grafik_003 .= '{';
                $grafik_003 .= "  name:" . "'Akreditasi " . $key['akreditasi'] . "',";
                $grafik_003 .= "  y:" . $key['persentase'];
                $grafik_003 .= '},';
            }
            echo substr($grafik_003, 0, -1);
        } else {
            echo "";
        }
    }

    public function get_persyaratan()
    {
        header('content-type: application/json');
        $id = $this->input->get('id');

        $kat = $this->db->get_where('kategori', array('id' => $id))->row_array();
        echo json_encode(array('persyaratan' => $kat['persyaratan']));
    }


    public function pendaftar_ajax()
    {
        //get data
        $this->load->library('Datatables');
        $this->load->helper('pendaftar');

        $slug = $this->input->post('slug');
        $kat  = $this->db->get_where('kategori', array('slug' => $slug));

        $kategori = $kat->row_array();


        if ($kategori['level_penerima'] === 'pelajar') {

            // $set_jenis_dokumen = $kategori['set_jenis_dokumen'];

            $this->datatables->select(
                "a.email,a.id,a.nik,a.nama_lengkap, a.alamat_rumah,a.kab_kota, a.jk, a.nama_lembaga, a.kelas,
                 a.semester, a.`status`, GROUP_CONCAT(CONCAT(c.id,'|', REPLACE(b.file_dokumen,a.nik,'') ,'|',b.verifikasi) SEPARATOR ';') AS dokumen"
            );

            $this->db->from('pendaftar a');
            $this->datatables->where('kategori_id', $kategori['id']);
            $this->datatables->where('YEAR(created_at)', $this->tahun_aktif);
        } else {

            // $set_jenis_dokumen = $kategori['set_jenis_dokumen'];

            $this->datatables->select(
                "a.id,CONCAT('tr_',a.id) AS DT_RowId,
             a.nik,
             UPPER(a.nama_lengkap) AS nama_lengkap,
             UPPER(a.kab_kota) AS kab_kota,
             UPPER(a.kecamatan) AS kecamatan,
             UPPER(a.kelurahan) AS kelurahan,
             UPPER(a.jk) AS jk,
             UPPER(a.nama_lembaga) AS nama_lembaga,
             UPPER(a.program_studi) AS program_studi,
             a.akreditasi,
             a.semester,
             a.ip_semester,
             a.jenis_jurusan AS jenis_jurusan,
             CONCAT(
                  LPAD(CAST((SELECT COUNT(*) FROM `dokumen_pendaftar` WHERE `pendaftar_id` = `a`.`id`) AS UNSIGNED),2,'0'),
                  '-',
                  LPAD(CAST((SELECT COUNT(*) FROM `dokumen_pendaftar` WHERE `pendaftar_id` = `a`.`id` AND `verifikasi` = 'diterima') AS UNSIGNED),2,'0'),
                  '-',
                  LPAD(CAST((SELECT COUNT(*) FROM `dokumen_pendaftar` WHERE `pendaftar_id` = `a`.`id` AND `verifikasi` = 'ditolak') AS UNSIGNED),2,'0')
              ) AS dokumen,

             a.status,
             a.status_akhir,
             a.email,
             DATE_FORMAT(`a`.`created_at`,'%d-%m-%Y %H:%i:%s') AS `tgl_daftar`,
             a.kategori_id"
            );

            $this->datatables->from('pendaftar a');
            $this->datatables->group_by('a.id');
            $this->datatables->where('a.kategori_id', $kategori['id']);

            $jenis_jurusan = $this->input->post('filter');
            if ($jenis_jurusan) {
                $this->datatables->where('a.jenis_jurusan', $jenis_jurusan);
            }

            $this->datatables->like("DATE_FORMAT(a.created_at,'%d-%m-%Y %H:%i:%s')", $this->tahun_aktif);
        }

        echo $this->datatables->generate();
    }
}
