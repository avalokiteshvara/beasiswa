<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Verifikator extends MX_Controller
{
    private $user_id;
    private $tahun_aktif;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->database();
        $this->load->helper(array('url', 'libs', 'alert'));
        $this->load->library(array('form_validation', 'session', 'alert', 'breadcrumbs'));

        $this->breadcrumbs->load_config('default');
        $this->load->model('Verifikator_model', 'verifikator_m');

        $level = $this->session->userdata('user_level');
        if ($level !== 'verifikator') {
            redirect(site_url('web'), 'reload');
        }

        $this->tahun_aktif = get_settings('small-text', 'tahun_aktif');

        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    }

    public function _page_output($output = null)
    {
        $this->load->view('master.php', (array) $output);
    }

    public function index()
    {
        $this->breadcrumbs->push('Dashboard', '/verifikator');

        $data['page_name']  = 'beranda';
        $data['page_title'] = 'Beranda';
        $this->_page_output($data);
    }

    public function cetak_instrumen_verifikasi()
    {
        $pendaftar_id = base64url_decode($this->uri->segment(3));
        instrumen_verifikasi($pendaftar_id, true);
    }

    public function pendaftar_details()
    {
        header('content-type: application/json');
        $nik = $this->input->get('nik');

        $qry = $this->db->get_where('pendaftar', array('nik' => $nik));
        echo json_encode($qry->row());
    }

    // public function cetak_bukti_pendaftaran(){
    //
    //   $pendaftar_id = base64url_decode($this->uri->segment(3));
    //   bukti_pendaftaran($pendaftar_id,true);
    // }

    public function export_data()
    {
        $param = explode('/', base64url_decode($this->uri->segment(3)));
        //'pdf/' . $this->uri->segment(3) . '/semua'
        $file_type     = $param[0];
        $slug_kategori = $param[1];
        $range         = $param[2];

        switch ($file_type) {
            case 'pdf':
                $kategori = $this->db->get_where('kategori', array('slug' => $slug_kategori))->row_array();
                if ($range === 'semua') {
                    //semua
                    $recordset = null;

                    if ($kategori['level_penerima'] === 'pelajar') {
                        //pelajar
                        $this->db->select(
                            "nik,nama_lengkap,alamat_rumah,kota_lahir,
                 tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                 email,nama_lembaga AS `Nama Sekolah`,kelas,semester");

                        $this->db->where('status <>', 'ditolak');
                        $this->db->where('YEAR(created_at)', $this->tahun_aktif);

                        $this->db->order_by('nama_lengkap', 'ASC');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));

                    } else {
                        //mahasiswa
                        $this->db->select(
                            "nik,nama_lengkap,alamat_rumah,kota_lahir,
                 tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                 email,nama_lembaga AS `Nama Universitas`,
                 program_studi,akreditasi,semester,ip_semester");

                        $this->db->where('status <>', 'ditolak');
                        $this->db->where('YEAR(created_at)', $this->tahun_aktif);

                        $this->db->order_by('ip_semester', 'DESC');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));

                    }

                    $ctlObj = modules::load('verifikator/export/')->pdf('semua-' . $slug_kategori, $recordset);

                } else {
                    //terpilih
                    $recordset = null;

                    if ($kategori['level_penerima'] === 'pelajar') {
                        //pelajar
                        $this->db->select(
                            "nik,nama_lengkap,alamat_rumah,kota_lahir,
                 tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                 email,nama_lembaga AS `Nama Sekolah`,kelas,semester");

                        $this->db->order_by('nama_lengkap', 'ASC');
                        $this->db->where('status', 'diterima');
                        $this->db->where('YEAR(created_at)', $this->tahun_aktif);

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));

                    } else {
                        //mahasiswa
                        $this->db->select(
                            "nik,nama_lengkap,alamat_rumah,kota_lahir,
                 tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                 email,nama_lembaga AS `Nama Universitas`,
                 program_studi,akreditasi,semester,ip_semester");

                        $this->db->where('status', 'diterima');
                        $this->db->where('YEAR(created_at)', $this->tahun_aktif);
                        $this->db->order_by('ip_semester', 'DESC');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));

                    }

                    $ctlObj = modules::load('verifikator/export/')->pdf('terpilih-' . $slug_kategori, $recordset);

                }

                break;

            case 'excel':
                $kategori = $this->db->get_where('kategori', array('slug' => $slug_kategori))->row_array();
                if ($range === 'semua') {
                    //semua
                    $recordset = null;

                    if ($kategori['level_penerima'] === 'pelajar') {
                        //pelajar
                        $this->db->select(
                            "nik,nama_lengkap,alamat_rumah,kota_lahir,
                   tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                   email,nama_lembaga AS `Nama Sekolah`,kelas,semester");

                        $this->db->where('status <>', 'ditolak');
                        $this->db->where('YEAR(created_at)', $this->tahun_aktif);
                        $this->db->order_by('nama_lengkap', 'ASC');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));

                    } else {
                        //mahasiswa
                        $this->db->select(
                            "nik,nama_lengkap,alamat_rumah,kota_lahir,
                   tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                   email,nama_lembaga AS `Nama Universitas`,
                   program_studi,akreditasi,semester,ip_semester");

                        $this->db->where('status <>', 'ditolak');
                        $this->db->where('YEAR(created_at)', $this->tahun_aktif);

                        $this->db->order_by('ip_semester', 'DESC');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));

                    }

                    $ctlObj = modules::load('verifikator/export/')->excel('semua-' . $slug_kategori, $recordset);

                } else {
                    //terpilih
                    $recordset = null;

                    if ($kategori['level_penerima'] === 'pelajar') {
                        //pelajar
                        $this->db->select(
                            "nik,nama_lengkap,alamat_rumah,kota_lahir,
                   tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                   email,nama_lembaga AS `Nama Sekolah`,kelas,semester");

                        $this->db->where('YEAR(created_at)', $this->tahun_aktif);
                        $this->db->order_by('nama_lengkap', 'ASC');
                        $this->db->where('status', 'diterima');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));

                    } else {
                        //mahasiswa
                        $this->db->select(
                            "nik,nama_lengkap,alamat_rumah,kota_lahir,
                   tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                   email,nama_lembaga AS `Nama Universitas`,
                   program_studi,akreditasi,semester,ip_semester");

                        $this->db->where('YEAR(created_at)', $this->tahun_aktif);
                        $this->db->where('status', 'diterima');
                        $this->db->order_by('ip_semester', 'DESC');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));

                    }

                    $ctlObj = modules::load('verifikator/export/')->excel('terpilih-' . $slug_kategori, $recordset);

                }

                break;

            default:
                # code...
                break;
        }
    }

    public function pendaftar_ajax()
    {

        if (!empty($_POST)) {
            //get data
            $this->load->library('Datatables');
            $this->load->helper('pendaftar');

            $slug = $this->input->post('slug');
            $kat  = $this->db->get_where('kategori', array('slug' => $slug));

            $kategori = $kat->row_array();

            // echo $kategori['level_penerima'];
            if ($kategori['level_penerima'] === 'pelajar') {

                $set_jenis_dokumen = $kategori['set_jenis_dokumen'];

                $this->datatables->select(
                    "a.email,a.id,a.nik,a.nama_lengkap, a.alamat_rumah,a.kab_kota, a.jk, a.nama_lembaga, a.kelas,
             a.semester, a.`status`, GROUP_CONCAT(CONCAT(c.id,'|', REPLACE(b.file_dokumen,a.nik,'') ,'|',b.verifikasi) SEPARATOR ';') AS dokumen"
                );

                $this->db->from('pendaftar a');
                $this->datatables->where('kategori_id', $kategori['id']);

            } else {

                $set_jenis_dokumen = $kategori['set_jenis_dokumen'];
                //nama_lengkap,
                //kab_kota,jenis_kelamin,perguruan_tinggi,program_studi,akreditasi,semester,ip_semester
                //dokumen,status,ubah_email,hapus
                $this->datatables->select(
                    "id,CONCAT('tr_',id) AS DT_RowId,
             nik,
             UPPER(nama_lengkap) AS nama_lengkap,
             UPPER(kab_kota) AS kab_kota,
             UPPER(jk) AS jk,
             UPPER(nama_lembaga) AS nama_lembaga,
             UPPER(program_studi) AS program_studi,
             akreditasi,
             semester,
             ip_semester,
             dokumen,
             status,
             status_akhir,
             email,
             tgl_daftar");
                // $this->datatables->add_column('nama_lengkap','$1','callback_nama("pendaftar_id")');
                // $this->datatables->add_column('dokumen','$1','callback_dokumen("pendaftar_id")');
                // $this->datatables->add_column('status','callback_status($1)','id');
                // $this->datatables->add_column('ubah_email','<a href="#" class="ubah_email alert-info" id="ubah_email_$1" onclick="show_ubah_email(\'$1\')">$2</a>','nik,email');
                // $this->datatables->add_column('hapus','<a class="alert alert-danger" onclick="hapus_pendaftaran($1)">HAPUS</a>','pendaftar_id');

                $this->datatables->from('v_pendaftar');
                // $this->datatables->join('dokumen_pendaftar b','a.id = b.pendaftar_id','left');
                // $this->datatables->join('dokumen_pendaftar c','a.id = c.pendaftar_id AND c.verifikasi = "diterima"','left');
                // $this->datatables->join('dokumen_pendaftar d','a.id = d.pendaftar_id AND d.verifikasi = "ditolak"','left');
                // $this->datatables->group_by('a.id');
                $this->datatables->where('kategori_id', $kategori['id']);
                $this->datatables->like('tgl_daftar', $this->tahun_aktif);
                // $this->datatables->unset_column('hapus');
                // $this->datatables->unset_column('ubah_email');
                // $this->datatables->unset_column('dokumen');
            }

            echo $this->datatables->generate();
        } else {
            $slug = $this->uri->segment(3);
            $kat  = $this->db->get_where('kategori', array('slug' => $slug));

            if ($kat->num_rows() == 0) {
                redirect(site_url('guest'), 'reload');
            }

            $kategori = $kat->row_array();
            $this->breadcrumbs->push('Dashboard', '/guest');
            $this->breadcrumbs->push('Kategori Beasiswa', '/guest/kategori-beasiswa');
            $this->breadcrumbs->push($kategori['nama'], '/guest/pendaftar/' . $slug);

            // echo $kategori['level_penerima'];
            if ($kategori['level_penerima'] === 'pelajar') {
                $data['page_name']  = 'pendaftar_pelajar_ajax';
                $data['page_title'] = 'Data Pendaftar';
            } else {

                $data['page_name']  = 'pendaftar_mahasiswa_ajax';
                $data['page_title'] = 'Data Pendaftar';

            }

            $this->_page_output($data);
        }

    }

    public function load_dokumen()
    {
        $pendaftar_id = $this->input->get('pendaftar_id');
        $slug         = base64url_decode($this->input->get('slug'));

        // echo base64url_decode($slug);

        $dok = "<table class='table table-striped'>";
        $dok .= " <tbody>";
        $kategori      = $this->db->get_where('kategori', array('slug' => $slug))->row_array();
        $jenis_dokumen = explode(',', $kategori['set_jenis_dokumen']);
        foreach ($jenis_dokumen as $jd) {

            $jenis_dokumen = jenis_dokumen($jd);

            if ($jenis_dokumen == '') {
                continue;
            }

            $dok .= " <tr>";
            $dok .= "   <td>" . $jenis_dokumen . "</td>";

            $cek = $this->db->get_where('dokumen_pendaftar', array('jenis_dokumen_id' => $jd, 'pendaftar_id' => $pendaftar_id));
            if ($cek->num_rows() > 0) {
                $dokumen_pendaftar = $cek->row_array();
                $dok .= "<td><a href='" . site_url('uploads/dokumen/' . $dokumen_pendaftar['file_dokumen']) . "'>Download</a></td>";
                $dok .= "<td id='td_" . $dokumen_pendaftar['id'] . "'>";
                $status_dok = $dokumen_pendaftar['verifikasi'];
                if ($status_dok === 'pending') {
                    $dok .= '<span class="label label-default">Belum verifikasi</span> | ';
                    $dok .= '<a id="link_diterima_' . $dokumen_pendaftar['id'] . '" class="diterima" onclick="change_status(' . $dokumen_pendaftar['id'] . ',\'diterima\')">TERIMA</a> | ';
                    $dok .= '<a id="link_ditolak_' . $dokumen_pendaftar['id'] . '" class="ditolak" onclick="change_status(' . $dokumen_pendaftar['id'] . ',\'ditolak\')">TOLAK</a></td>';
                } elseif ($status_dok === 'diterima') {
                    $dok .= '<span class="label label-success">Diterima</span>';
                } else {
                    $dok .= '<span class="label label-danger">Ditolak</span>';
                }

                $dok .= "</td>";

            } else {
                $dok .= "<td colspan=2><span class=\"label label-warning\">Belum diunggah</span></td>";
            }

            $dok .= " </tr>";
        }

        $dok .= " </tbody>";
        $dok .= "</table>";

        echo $dok;
    }

    /*
    //DEPRECATED
    public function pendaftar(){

    $slug = $this->uri->segment(3);
    $kat = $this->db->get_where('kategori',array('slug' => $slug));

    if($kat->num_rows() == 0){
    redirect(site_url('verifikator'),'reload');
    }

    $kategori = $kat->row_array();
    $my_hak_akses = explode(',',$this->session->userdata('user_hak_akses'));

    //cek apakah user punya hak akses untuk jenis pendaftar
    if(count(array_filter($my_hak_akses, 'strlen')) > 0){

    if(!in_array($kategori['id'],$my_hak_akses)){
    redirect(site_url('verifikator/index'));
    }
    }else{
    redirect(site_url('verifikator/index'));
    };

    $this->breadcrumbs->push('Dashboard', '/verifikator');
    $this->breadcrumbs->push('Kategori Beasiswa', '/verifikator/kategori-beasiswa');
    $this->breadcrumbs->push($kategori['nama'], '/verifikator/pendaftar/' . $slug);

    // echo $kategori['level_penerima'];
    if($kategori['level_penerima'] === 'pelajar'){

    $data['set_jenis_dokumen'] = $kategori['set_jenis_dokumen'];
    $data['page_name'] = 'pendaftar_pelajar';
    $data['page_title'] = 'Data Pendaftar';
    $data['pendaftar'] = $this->verifikator_m->pendaftar($kategori['id']);

    }else{

    $data['set_jenis_dokumen'] = $kategori['set_jenis_dokumen'];
    $data['page_name'] = 'pendaftar_mahasiswa';
    $data['page_title'] = 'Data Pendaftar';
    $data['pendaftar'] = $this->verifikator_m->pendaftar($kategori['id']);

    }

    $this->_page_output($data);
    }
     */

    public function kategori_beasiswa()
    {
        try {
            $this->load->library(array('grocery_CRUD', 'Grocery_Btn'));
            $crud = new Grocery_CRUD();

            $crud->set_table('kategori');
            $crud->set_subject('Kategori Beasiswa');
            $crud->order_by('nama', 'ASC');
            $crud->in_where('id', $this->session->userdata('user_hak_akses'));

            $crud->display_as('tgl_buka', 'Dibuka');
            $crud->display_as('tgl_tutup', 'Ditutup');
            $crud->display_as('jml_penerima', 'Quota');

            $crud->columns('nama', 'tgl_buka', 'tgl_tutup', 'jml_penerima', 'status', 'pendaftar');

            $crud->callback_column('pendaftar', function ($value, $row) {
                // $this->db->where('kategori_id',$row->id);
                // $count_pendaftar = $this->db->count_all_results('pendaftar');
                // return '<a href="' . site_url('verifikator/pendaftar_ajax/' . $row->slug) .'">Lihat (' . $count_pendaftar . ' Pendaftar) </a>';
                $this->db->where('kategori_id', $row->id);
                $this->db->where('YEAR(created_at)', $this->tahun_aktif);
                $count_pendaftar = $this->db->count_all_results('pendaftar');

                //pendaftar tahun ini
                $pendaftar = '<a href="' . site_url('verifikator/pendaftar_ajax/' . $row->slug) . '">' . $count_pendaftar . ' Pendaftar </a>';

                return $pendaftar;
            });

            $crud->unset_add();
            $crud->unset_delete();
            $crud->unset_edit();

            $crud->callback_column('status', function ($value, $row) {
                if ($row->status_pendaftaran === 'tutup') {
                    return '<span class="label label-danger">Tutup</span>';
                } else {
                    return '<span class="label label-success">Buka</span>';
                }
            });

            //tags
            $this->db->order_by('nama ASC');
            $dokuments = $this->db->get('jenis_dokumen');

            $set_jenis_dokumen = array();
            foreach ($dokuments->result_array() as $row) {
                $set_jenis_dokumen[$row['id']] = $row['nama'];
            }

            $this->breadcrumbs->push('Dashboard', '/verifikator');
            $this->breadcrumbs->push('Kategori Beasiswa', '/verifikator/kategori-beasiswa');

            $crud->field_type('set_jenis_dokumen', 'multiselect', $set_jenis_dokumen);

            $extra  = array('page_title' => 'Kategori beasiswa');
            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function set_verifikasi_berkas()
    {
        $verifikasi           = $this->uri->segment(3);
        $dokumen_pendaftar_id = $this->uri->segment(4);
        // $slug_kategori = base64url_decode($this->uri->segment(5));
        $user_id = $this->session->userdata('user_id');

        $this->db->where('id', $dokumen_pendaftar_id);
        $this->db->update('dokumen_pendaftar', array('verifikasi' => $verifikasi, 'verifikator_id' => $user_id));

        $this->db->select('b.nama, a.file_dokumen');
        $this->db->join('jenis_dokumen b', 'a.jenis_dokumen_id = b.id', 'left');
        $this->db->where('a.id', $dokumen_pendaftar_id);
        $msg = $this->db->get('dokumen_pendaftar a')->row_array();

        /*
        <span class="label label-default">Belum verifikasi</span> |
        <a id="link_diterima_8044" class="diterima" onclick="change_status(8044,'diterima')">TERIMA</a> |
        <a id="link_ditolak_8044" class="ditolak" onclick="change_status(8044,'ditolak')">TOLAK</a>
         */
        if ($verifikasi === 'diterima') {
            echo '<span class="label label-success">Diterima</span>';
        } else {
            echo '<span class="label label-danger">Ditolak</span>';
        }
        // $this->alert->set('alert-success', 'Status berhasil di ubah');
        // redirect(site_url('verifikator/pendaftar/' . $slug_kategori),'reload');
    }

    public function ganti_password()
    {
        $user_id = $this->session->userdata('user_id');

        if (!empty($_POST['pass_lama'])) {

            $password = $this->input->post('pass_lama');

            $cek_user = $this->db->get_where('user', array('id' => $user_id, 'password' => md5($password)));

            if ($cek_user->num_rows() > 0) {
                if (empty($_POST['pass_baru']) || empty($_POST['pass_ulangi'])) {
                    $this->alert->set('alert-danger', 'Password baru / ulangan tidak boleh kosong');
                    redirect(site_url('verifikator/ganti-password'), 'reload');
                } else {
                    $pass_baru   = $this->input->post('pass_baru');
                    $pass_ulangi = $this->input->post('pass_ulangi');

                    if ($pass_baru !== $pass_ulangi) {
                        $this->alert->set('alert-danger', 'Password baru & ulangan harus sama');
                        redirect(site_url('verifikator/ganti-password'), 'reload');
                    } else {
                        $realname = $this->input->post('realname');
                        $email    = $this->input->post('email');

                        $this->db->where('id', $user_id);
                        $this->db->update('user', array('password' => md5($pass_ulangi)));

                        $this->alert->set('alert-success', 'Password berhasil diupdate');
                        redirect(site_url('verifikator/ganti-password'), 'reload');
                    }
                }
            } else {
                $this->alert->set('alert-danger', 'Password Lama Salah');
                redirect(site_url('verifikator/ganti-password'), 'reload');
            }
        }

        $data['page_name'] = 'ganti_password';

        $this->breadcrumbs->push('Beranda', '/verifikator');
        $this->breadcrumbs->push('Ganti Password', '/verifikator/ganti_password');

        $data['page_title'] = 'Ganti Password';

        $this->_page_output($data);
    }

}
