<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MX_Controller
{

    private $tahun_aktif;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->database();
        $this->load->helper(array('url', 'libs', 'alert'));
        $this->load->library(array('form_validation', 'session', 'alert', 'breadcrumbs'));

        $this->breadcrumbs->load_config('default');
        $this->load->model('Admin_model', 'admin_m');

        $level             = $this->session->userdata('user_level');
        $this->tahun_aktif = get_settings('small-text', 'tahun_aktif');

        if ($level !== 'admin') {
            redirect(site_url('web'), 'reload');
        }

        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    }

    public function _page_output($output = null)
    {
        $this->load->view('master.php', (array) $output);
    }

    public function get_datadiri()
    {
        header('content-type: application/json');
        $pendaftarId = $this->input->get('pendaftar_id');

        $this->load->model('peserta/Peserta_model', 'peserta_m');

        $this->db->select("a.id,a.kategori_id,a.email,a.file_foto,a.nik,a.nokk, a.alamat_rumah,
                       a.kelurahan_id,a.kelurahan,a.kecamatan, a.kab_kota,
                       a.status, a.status_akhir,b.strict_ip_minimal,b.ip_minimal,
                       a.akreditasi, a.ip_semester,b.akreditasi AS akreditasi_prog_studi,
                       b.semester AS semester_kategori,
                       a.jenis_jurusan,
                       a.semester, b.status_pendaftaran");
        $this->db->join('kategori b', 'a.kategori_id = b.id', 'left');
        $biodata = $this->db->get_where('pendaftar a', array('a.id' => $pendaftarId))->row_array();

        $user_id          = $biodata['id'];
        $user_kategori_id = $biodata['kategori_id'];
        $user_nik         = $biodata['nik'];

        $dokumen = $this->peserta_m->get_document($user_id, $user_kategori_id);

        echo json_encode(
            array(
                'biodata' => $this->load->view('ajax_datadiri/biodata', array('biodata' => $biodata), true),
                'dokumen' => $this->load->view('ajax_datadiri/dokumen', array('dokumen' => $dokumen, 'user_id' => $user_id, 'user_nik' => $user_nik), true),
            )
        );
    }

    public function index()
    {
        $this->breadcrumbs->push('Dashboard', '/admin');

        $data['page_name']  = 'beranda';
        $data['page_title'] = 'Beranda';
        $this->_page_output($data);
    }

    public function generate_nama_dokumen($user_nik, $jenis_dokumen_id)
    {
        $jenis_dokumen = $this->db->get_where('jenis_dokumen', array('id' => $jenis_dokumen_id))->row_array();

        return slugify($user_nik . '-' . $jenis_dokumen['nama']);
    }

    public function change_question_visible()
    {

        $isReply = $this->input->post('isreply');

        if ($isReply === 'Y') {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('pertanyaan_tanggapan', array('tampil' => $this->input->post('tampil')));
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('pertanyaan', array('tampil' => $this->input->post('tampil')));
        }
    }

    public function question_detail($question_id)
    {
        try {
            $this->load->library('grocery_CRUD');
            $crud = new Grocery_CRUD();

            $crud->set_table('pertanyaan_tanggapan');
            $crud->set_subject('Tanggapan Pertanyaan');
            $crud->where('id_pertanyaan', $question_id);
            $crud->order_by('inserted_at', 'ASC');

            $crud->columns('nama', 'komentar', 'tampil', 'inserted_at');

            $crud->field_type('id_pertanyaan', 'hidden', $question_id);

            $crud->field_type('id_pertanyaan', 'hidden', $question_id);

            $state = $crud->getState();

            if ($state === 'edit') {
                $crud->field_type('email', 'readonly');
                $crud->field_type('nama', 'readonly');
                $crud->field_type('komentar', 'readonly');

                $crud->field_type('inserted_at', 'readonly');
                $crud->field_type('updated_at', 'readonly');
            } elseif ($state === 'add') {

                $crud->field_type('email', 'hidden');
                $crud->field_type('nama', 'hidden', 'admin');
                $crud->field_type('tampil', 'hidden', 'Y');

                $date_now = date('Y-m-d H:i:s');

                $crud->field_type('inserted_at', 'hidden', $date_now);
                $crud->field_type('updated_at', 'hidden');
            }

            $crud->display_as('tampil', 'Tampilkan');
            $crud->display_as('inserted_at', 'Tanggal');

            $crud->callback_column('tampil', function ($value, $row) {

                $select = '<select id="select-' . $row->id . '" class="chosen-select" id="tampil">';
                $select .= ($value === 'Y') ? '  <option value="Y" selected>Ya</option>' : ' <option value="Y">Ya</option>';
                $select .= ($value === 'N') ? '  <option value="N" selected>Tidak</option>' : ' <option value="N">Tidak</option>';
                $select .= '</select>';

                $select .= '<script type="text/javascript">';
                $select .= '$("#select-' . $row->id . '").on("change", function() {';
                $select .= '  $.post( "' . site_url('admin/change-question-visible') . '", { id: "' . $row->id . '", tampil: this.value , isreply: "Y"} );';
                $select .= '});';
                $select .= '</script>';

                return $select;
            });

            $crud->callback_column('nama', function ($value, $row) {

                if ($value === 'admin') {
                    return '<span class="badge bg-danger">ADMINISTRATOR</span>';
                } else {
                    return $value;
                }
            });

            $q = $this->db->get_where('pertanyaan', array('id' => $question_id))->row_array();

            $pertanyaan = '<div class="alert alert-success" role="alert">';
            $pertanyaan .= '  <h5>' . $q['topik'] . '</h5>';
            $pertanyaan .= '</div>';

            $extra  = array('page_title' => '<div style="display:block" class="mb-3">Data Tanggapan Pertanyaan</div>' . $pertanyaan);
            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (\Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function pertanyaan()
    {
        try {
            $this->load->library('grocery_CRUD');
            $crud = new Grocery_CRUD();

            $crud->set_table('pertanyaan');
            $crud->set_subject('Data Pertanyaan');
            $crud->order_by('inserted_at', 'DESC');

            $crud->columns('nama', 'topik', 'tampil', 'tanggapan', 'inserted_at');

            $crud->display_as('tampil', 'Tampilkan');
            $crud->display_as('inserted_at', 'Tanggal');

            $crud->callback_column('tanggapan', function ($value, $row) {

                $query = $this->db->get_where('pertanyaan_tanggapan', array('id_pertanyaan' => $row->id));
                $q     = $query->num_rows();

                return ($q == 0) ? '<span class="badge bg-secondary">Belum ada</span>' : $q . ' tanggapan';
            });

            $crud->callback_column('tampil', function ($value, $row) {

                $select = '<select id="select-' . $row->id . '" class="chosen-select" id="tampil">';
                $select .= ($value === 'Y') ? '  <option value="Y" selected>Ya</option>' : ' <option value="Y">Ya</option>';
                $select .= ($value === 'N') ? '  <option value="N" selected>Tidak</option>' : ' <option value="N">Tidak</option>';
                $select .= '</select>';

                $select .= '<script type="text/javascript">';
                $select .= '$("#select-' . $row->id . '").on("change", function() {';
                $select .= '  $.post( "' . site_url('admin/change-question-visible') . '", { id: "' . $row->id . '", tampil: this.value , isreply : "N" } );';
                $select .= '});';
                $select .= '</script>';

                return $select;
            });

            $crud->callback_column('topik', function ($value, $row) {
                return '<a href="' . site_url('admin/question-detail/' . $row->id) . '">' . limit_text($value, 50) . '</a>';
            });

            $this->breadcrumbs->push('Dashboard', '/admin');
            $this->breadcrumbs->push('Data Pertanyaan', '/admin/pertanyaan');

            $extra  = array('page_title' => 'Data Pertanyaan');
            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (\Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function upload_dokumen()
    {
        header('content-type: application/json');

        $user_id          = $this->input->post('user_id');
        $user_nik         = $this->input->post('user_nik');
        $jenis_dokumen_id = $this->input->post('jenis_dokumen_id');

        $upload['upload_path']   = './uploads/dokumen';
        $upload['allowed_types'] = 'zip|rar|jpeg|jpg|pdf|doc|docx|xls|xlsx';
        $upload['encrypt_name']  = false;
        $upload['file_name']     = $this->generate_nama_dokumen($user_nik, $jenis_dokumen_id);
        $upload['overwrite']     = true;
        $upload['max_size']      = 1024;

        $this->load->library('upload', $upload);

        if (!$this->upload->do_upload('file_dokumen')) {

            echo json_encode(
                array(
                    'status'   => 'ERROR',
                    'msg'      => 'Ada kesalahan! Periksa kembali file yang anda unggah',
                    'dok_link' => 'none',
                )
            );

            exit(0);
        } else {
            $success   = $this->upload->data();
            $file_name = $success['file_name'];

            $this->db->query(
                "INSERT INTO dokumen_pendaftar (pendaftar_id, jenis_dokumen_id, file_dokumen)
                 VALUES($user_id, $jenis_dokumen_id, '$file_name')
                 ON DUPLICATE KEY UPDATE file_dokumen = '$file_name', verifikasi = 'pending'"
            );

            echo json_encode(
                array(
                    'status'   => 'OK',
                    'msg'      => 'File dokumen berhasil diunggah',
                    'dok_link' => site_url('uploads/dokumen/' . $file_name),
                )
            );
        }
    }

    //kamis, nov 8 2018

    public function update_biodata()
    {

        header('content-type: application/json');

        $user_id = $this->input->post('id');

        // $kab_kota  = $this->input->post('kab_kota');
        // $kecamatan = $this->input->post('kecamatan');
        // $kelurahan = $this->input->post('kelurahan');

        $wil = explode(':', $this->input->post('wilayah'));

        $wil_id   = $wil[0];
        $wil_desa = $wil[1];
        $wil_kec  = $wil[2];
        $wil_kab  = $wil[3];

        $akreditasi    = $this->input->post('akreditasi');
        $alamat_rumah  = $this->input->post('alamat_rumah');
        $ip_semester   = str_replace(',', '.', $this->input->post('ip_semester'));
        $semester      = $this->input->post('semester');
        $jenis_jurusan = $this->input->post('jenis_jurusan');

        $input = array(
            // 'kab_kota'      => $kab_kota,
            // 'kecamatan'     => $kecamatan,
            // 'kelurahan'     => $kelurahan,
            'kelurahan_id'  => $wil_id,
            'kelurahan'     => $wil_desa,
            'kecamatan'     => $wil_kec,
            'kab_kota'      => $wil_kab,
            'alamat_rumah'  => $alamat_rumah,

            'akreditasi'    => $akreditasi,
            'ip_semester'   => $ip_semester,
            'semester'      => $semester,
            'jenis_jurusan' => $jenis_jurusan,
        );

        if (!empty($_FILES['file_foto']['name'])) {

            $upload['upload_path']   = './uploads/foto';
            $upload['allowed_types'] = 'jpeg|jpg';
            $upload['encrypt_name']  = true;
            $upload['max_size']      = 512;

            $this->load->library('upload', $upload);
            if (!$this->upload->do_upload('file_foto')) {
                echo json_encode(
                    array(
                        'status' => 'ERROR',
                        'msg'    => 'Ada kesalahan! Periksa kembali file yang anda unggah',
                        'foto'   => 'use_old_foto',
                    )
                );

                exit(0);
            } else {

                $success   = $this->upload->data();
                $file_name = $success['file_name'];

                $input['file_foto'] = $file_name;
            }
        }

        $this->db->where('id', $user_id);
        $this->db->update('pendaftar', $input);

        $pendaftar = $this->db->get_where('pendaftar', array('id' => $user_id))->row_array();

        echo json_encode(
            array(
                'status' => 'OK',
                'msg'    => 'Data Terupdate',
                'foto'   => site_url('uploads/foto/' . $pendaftar['file_foto']),
            )
        );
    }

    public function ubah_email()
    {
        if (!empty($_POST)) {

            $pendaftar_id = $this->input->post('pendaftar_id');
            $email_baru   = $this->input->post('email_baru');

            $this->db->where('id <>', $pendaftar_id);
            $this->db->where('email', $email_baru);
            $cek = $this->db->get('pendaftar');

            if ($cek->num_rows() > 0) {
                echo json_encode(array('msg' => 'error'));
            } else {

                //update then send email
                $password = generateRandomString(6);

                $this->db->where('id', $pendaftar_id);
                $this->db->update('pendaftar', array('email' => $email_baru, 'password' => md5($password)));

                $message = "Berikut ini adalah informasi yang anda butuhkan untuk login <br />";
                $message .= "Username : (NIK / Email anda)<br />";
                $message .= "Password : " . $password;
                $message .= "<hr />";
                $message .= "{timestamp:" . date("Y-m-d H:i:s") . "}";
                sendEmail($email_baru, 'Informasi Login ' . site_url(), $message, 'none');

                echo json_encode(array('email_baru' => $email_baru, 'msg' => 'success'));
            }
        } else {
            header('content-type: application/json');
            $nik = $this->input->get('nik');

            $qry = $this->db->get_where('pendaftar', array('nik' => $nik));
            echo json_encode($qry->row());
        }
    }

    public function cetak_bukti_pendaftaran()
    {

        $pendaftarId = base64url_decode($this->uri->segment(3));
        bukti_pendaftaran($pendaftarId, true);
    }

    public function cetak_bukti_penerima_beasiswa()
    {
        $pendaftar_id = base64url_decode($this->uri->segment(3));
        bukti_dapat_beasiswa($pendaftar_id, true);
    }

    public function cetak_instrumen_verifikasi()
    {
        $pendaftar_id = base64url_decode($this->uri->segment(3));
        instrumen_verifikasi($pendaftar_id, true);
    }

    public function export_data()
    {

        $ctlObj = modules::load('export/export/')->query($this->uri->segment(3), $this->tahun_aktif);
    }

    public function kategori_beasiswa()
    {
        try {
            $this->load->library(array('grocery_CRUD', 'Grocery_Btn'));
            $crud = new Grocery_CRUD();

            $crud->set_table('kategori');
            $crud->set_subject('Kategori Beasiswa');
            $crud->order_by('sort_num', 'ASC');

            $crud->field_type('slug', 'hidden');

            $crud->display_as('prestasi', 'Beasiswa Prestasi ?');
            $crud->field_type('prestasi', 'hidden');

            $crud->display_as('tgl_buka', 'Dibuka');
            $crud->display_as('tgl_tutup', 'Ditutup');
            $crud->display_as('jml_penerima', 'Quota');

            $crud->display_as('ip_minimal', 'IPK Minimal');
            //https://forums.grocerycrud.com/topic/1779-some-text-before-or-after-input/
            // $crud->extra_output_before('ip_minimal', 'TEST text before');
            // $crud->extra_output_after('ip_minimal', 'TEST text after');
            $crud->extra_output_description('sort_num', 'Urutan kemunculan pada tampilan web');
            $crud->extra_output_description('akreditasi', 'Format: Huruf akreditasi dipisahkan dengan koma (",")');
            $crud->extra_output_description('semester', 'Format: Angka semester dipisahkan dengan koma (",")');

            $crud->extra_output_description('ip_minimal', 'Format: Minimal Eksakta:Minimal Non Eksakta (Misal: 2.75:3.00)');

            $crud->display_as('strict_ip_minimal', 'Keharusan IPK Minimal ?');
            $crud->display_as('set_jenis_dokumen', 'Dokumen yang dapat diunggah');


            $crud->display_as('sort_num', 'Urutan');

            $crud->required_fields(
                'level_penerima',
                'status_pendaftaran',
                'nama',
                'persyaratan',
                'tgl_buka',
                'tgl_tutup',
                'jml_penerima'
            );

            $crud->columns('nama', 'tgl_buka', 'tgl_tutup', 'jml_penerima', 'status', 'penerima_sebelumnya', 'pendaftar');

            $crud->callback_column('pendaftar', function ($value, $row) {
                $this->db->where('kategori_id', $row->id);
                $this->db->where('YEAR(created_at)', $this->tahun_aktif);
                $count_pendaftar = $this->db->count_all_results('pendaftar');

                //pendaftar tahun ini
                $pendaftar = '<a href="' . site_url('admin/pendaftar_ajax/' . $row->slug) . '">' . $count_pendaftar . ' Pendaftar </a>';

                return $pendaftar;
            });

            $crud->callback_edit_field('kelas', function ($value, $primary_key) {
                $return = '<input id="field-kelas" class="form-control" name="kelas" type="text" value="' . $value . '" maxlength="50">';
                $return .= '<script type="text/javascript">
                      var textKelas = document.getElementById("kelas_field_box");
                      if($("#field-level_penerima").find("option:selected").val() == "pelajar"){
                        textKelas.style.display = "block";
                      }else{
                        textKelas.style.display = "none";
                      }
                      $("#field-level_penerima").on("change", function() {
                        var selectedValue = $(this).find("option:selected").val();
                        if(selectedValue == "pelajar"){
                          textKelas.style.display = "block";
                        }else{
                          textKelas.style.display = "none";
                        }
                      });
                   </script>';
                return $return;
            });

            $crud->callback_column('penerima_sebelumnya', function ($value, $row) {
                $this->db->where('kategori_id', $row->id);
                $this->db->where('YEAR(created_at) < ', $this->tahun_aktif);
                $this->db->where('status_akhir', 'diterima');

                $count_penerima_sebelumnya = $this->db->count_all_results('pendaftar');

                //pendaftar tahun ini
                $penerima_sebelumnya = '<a style="color:red" href="' . site_url('admin/penerima_sebelumnya_ajax/' . $row->slug) . '">' . $count_penerima_sebelumnya . ' Penerima </a>';

                return $penerima_sebelumnya;
            });

            $crud->callback_column('qry_validation', function ($value, $row) {
                return '<a href="' . site_url('admin/qry_validation/' . $row->id) . '">Manage</a>';
            });

            $crud->callback_column('status', function ($value, $row) {
                if ($row->status_pendaftaran === 'tutup') {
                    return '<span class="badge bg-danger">Tutup</span>';
                } else {
                    return '<span class="badge bg-success">Buka</span>';
                }
                //return '<a href="' . site_url('admin/qry_validation/' . $row->id) .'">Manage</a>';
            });


            $sort_order = array();

            $sort_order['ipk'] = 'IPK';
            $sort_order['bobot'] = 'Sertifikat Prestasi'; //bobot sertifikat
            $sort_order['created_at'] = 'Tanggal daftar';

            $crud->field_type('query_sort_order', 'multiselect', $sort_order);
            $crud->display_as('query_sort_order', 'Urutan Prioritas');
            $crud->extra_output_description('query_sort_order', 'Prioritas urutan ranking pendaftar');

            //tags
            $this->db->order_by('nama ASC');
            $dokuments = $this->db->get('jenis_dokumen');

            $set_jenis_dokumen = array();
            foreach ($dokuments->result_array() as $row) {
                $set_jenis_dokumen[$row['id']] = $row['nama'];
            }

            $jmlkat       = $this->db->count_all('kategori');
            $urutan_words = array(1 => "Pertama", 2 => "Kedua", 3 => "Ketiga", 4 => "Keempat", 5 => "Kelima");
            $sort_num     = array();
            for ($i = 1; $i <= $jmlkat; $i++) {
                $sort_num[$i] = $urutan_words[$i];
            }

            $this->breadcrumbs->push('Dashboard', '/admin');
            $this->breadcrumbs->push('Kategori Beasiswa', '/admin/kategori-beasiswa');

            $crud->field_type('set_jenis_dokumen', 'multiselect', $set_jenis_dokumen);
            $crud->field_type('sort_num', 'dropdown', $sort_num);

            $crud->set_field_upload('template_lulus', 'uploads');
            $crud->set_field_upload('logo', 'uploads');

            $extra  = array('page_title' => 'Kategori beasiswa');
            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function qry_validation($kategori_id)
    {
        try {
            $this->load->library('grocery_CRUD');

            $crud = new Grocery_CRUD();

            $crud->set_table('kategori_qry_validation');
            $crud->set_subject('Query Validation');
            $crud->where('kategori_id', $kategori_id);

            $crud->columns('qry', 'error_msg', 'success_msg');

            $crud->field_type('kategori_id', 'hidden', $kategori_id);

            $crud->display_as('qry', 'Query');
            $crud->display_as('success_msg', 'Pesan berhasil');
            $crud->display_as('error_msg', 'Pesan error');

            $this->breadcrumbs->push('Dashboard', '/admin');
            $this->breadcrumbs->push('Kategori Beasiswa', '/admin/kategori-beasiswa');
            $this->breadcrumbs->push('Query Validation', '/admin/qry_validation');

            $extra  = array('page_title' => 'Query Validation');
            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function faq_list()
    {
        try {
            $this->load->library('grocery_CRUD');

            $crud = new Grocery_CRUD();

            $crud->set_table('faq');
            $crud->set_subject('Daftar FAQ');

            $crud->columns('pertanyaan');

            $this->breadcrumbs->push('Dashboard', '/admin');
            $this->breadcrumbs->push('Data FAQ', '/admin/faq_list');

            $extra  = array('page_title' => 'Data FAQ');
            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function rundown()
    {
        try {
            $this->load->library('grocery_CRUD');

            $crud = new Grocery_CRUD();

            $crud->set_table('rundown');
            $crud->set_subject('Rundown');

            $crud->columns('jadwal', 'kegiatan', 'keterangan');

            $this->breadcrumbs->push('Dashboard', '/admin');
            $this->breadcrumbs->push('Data FAQ', '/admin/rundown');

            $extra  = array('page_title' => 'Rundown');
            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function jenis_dokumen()
    {
        try {
            $this->load->library('grocery_CRUD');
            $crud = new Grocery_CRUD();

            $crud->set_table('jenis_dokumen');
            $crud->set_subject('Jenis Dokumen');

            $crud->columns('nama', 'template');
            $crud->set_field_upload('file_template', 'uploads');
            $crud->display_as('template', 'File Template');
            $crud->display_as('dok_prestasi', 'Dokumen Prestasi ?');

            $crud->callback_column('template', function ($value, $row) {
                if (empty($row->file_template)) {
                    return 'Belum diunggah';
                } else {
                    return '<a href="' . site_url('uploads/' . $row->file_template) . '">Download</a>';
                }
            });

            $this->breadcrumbs->push('Dashboard', '/admin/index');
            $this->breadcrumbs->push('Jenis Dokumen', '/admin/jenis_dokumen');

            $extra = array('page_title' => 'Jenis Dokumen');

            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    //<admin_user>
    public function data_user()
    {
        try {
            $this->load->library('grocery_CRUD');
            $crud = new Grocery_CRUD();

            $crud->set_table('user');
            $crud->set_subject('Data User');

            $crud->add_fields(array('level', 'username', 'password', 'hak_akses'));
            $crud->edit_fields(array('level', 'username', 'hak_akses'));

            $crud->required_fields('level', 'username', 'password');
            $crud->callback_before_insert(array($this, 'encrypt_password_callback'));

            $crud->columns('username', 'level', 'hak_akses');

            $kategori = array();
            $kat      = $this->db->get('kategori');
            foreach ($kat->result_array() as $k) {
                $kategori[$k['id']] = $k['nama'];
            }

            $crud->field_type('hak_akses', 'multiselect', $kategori);

            $crud->callback_column('hak_akses', function ($value, $row) {
                $hak_akses = explode(',', $row->hak_akses);

                if (count(array_filter($hak_akses, 'strlen')) > 0) {
                    $this->db->select('nama');
                    $this->db->where_in('id', $hak_akses);
                    $kat = $this->db->get('kategori');

                    $kat_nama = "";
                    foreach ($kat->result_array() as $k) {
                        $kat_nama .= $k['nama'] . '<br />';
                    }

                    return $kat_nama;
                };
            });

            $crud->unset_read_fields('password');

            $this->breadcrumbs->push('Dashboard', '/admin');
            $this->breadcrumbs->push('Data User', '/admin/data-user');

            $extra  = array('page_title' => 'Data User');
            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    //</admin_user>

    public function encrypt_password_callback($post_array, $primary_key = null)
    {
        $post_array['password'] = md5($post_array['password']);
        return $post_array;
    }

    public function web_content()
    {
        try {
            $this->load->library('grocery_CRUD');
            $crud = new Grocery_CRUD();

            $crud->set_table('web_content');
            $crud->set_subject('Konten Web');

            $this->breadcrumbs->push('Dashboard', '/admin');
            $this->breadcrumbs->push('Konten Web', '/admin/web-content');

            $crud->unset_delete();
            $crud->unset_add();

            $extra  = array('page_title' => 'Konten Web');
            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function hapus_pendaftaran()
    {
        $pendaftar_id = $this->uri->segment(3);

        $this->db->delete('dokumen_pendaftar', array('pendaftar_id' => $pendaftar_id));
        $this->db->delete('pendaftar', array('id' => $pendaftar_id));

        echo "OK";
    }

    public function set_status_pendaftaran()
    {
        $status       = $this->uri->segment(3);
        $pendaftar_id = $this->uri->segment(4);
        // $slug_kategori = base64url_decode($this->uri->segment(5));

        $this->db->where('id', $pendaftar_id);
        $this->db->update('pendaftar', array('status' => $status));

        /*
        1.generate bukti pendaftaran
        2.kirim email
         */

        if ($status === 'diterima') {
            $pendaftar      = $this->db->get_where('pendaftar', array('id' => $pendaftar_id))->row_array();
            $file_save_path = bukti_pendaftaran($pendaftar_id, false);

            $msg = 'Selamat, anda telah lolos Verifikasi bahan beasiswa pada portal beasiswa Biro Kesra Provinsi Jambi <br />';
            $msg .= 'Mohon untuk mencetak Kartu tanda pendaftar beasiswa Biro Kesra Provinsi Jambi yang terlampir <br />';
            $msg .= "<hr />";
            $msg .= "{timestamp:" . date("Y-m-d H:i:s") . "}";

            sendEmail($pendaftar['email'], 'Status verifikasi berkas', $msg, $file_save_path);

            $msg = 'Selamat, anda telah lolos Verifikasi bahan beasiswa pada portal beasiswa Biro Kesra Provinsi Jambi. ';
            $msg .= 'Mohon untuk mencetak Kartu tanda pendaftar beasiswa (Silahkan download file-nya pada akun anda)';

            sendWa($pendaftar['no_hp'], $msg);
        }

        // $this->alert->set('alert-success', 'Status berhasil di ubah');
        // redirect(site_url('admin/pendaftar/' . $slug_kategori),'reload');

        if ($status === 'diterima') {
            echo '<span class="badge bg-success">Diterima</span>&nbsp;-&nbsp;
              <a href="' . site_url('admin/cetak_bukti_pendaftaran/' . base64url_encode($pendaftar_id)) . '">[ Download Bukti ]</a>';
        } else {
            echo '<span class="badge bg-danger">Ditolak</span>';
        }
    }

    public function set_status_akhir()
    {
        $status       = $this->uri->segment(3);
        $pendaftar_id = $this->uri->segment(4);
        // $slug_kategori = base64url_decode($this->uri->segment(5));

        $this->db->where('id', $pendaftar_id);
        $this->db->update('pendaftar', array('status_akhir' => $status));

        /*
        1.generate bukti pendaftaran
        2.kirim email
         */

        if ($status === 'diterima') {
            $pendaftar      = $this->db->get_where('pendaftar', array('id' => $pendaftar_id))->row_array();
            $file_save_path = bukti_dapat_beasiswa($pendaftar_id, false);

            $msg = 'Selamat, anda telah lolos Verifikasi akhir beasiswa pada portal beasiswa Biro Kesra Provinsi Jambi <br />';
            $msg .= 'Mohon untuk mencetak Kartu tanda penerima beasiswa Biro Kesra Provinsi Jambi yang terlampir <br />';
            $msg .= "<hr />";
            $msg .= "{timestamp:" . date("Y-m-d H:i:s") . "}";

            sendEmail($pendaftar['email'], 'Status verifikasi akhir berkas', $msg, $file_save_path);

            $msg = 'Selamat, anda telah lolos Verifikasi akhir beasiswa pada portal beasiswa Biro Kesra Provinsi Jambi. ';
            $msg .= 'Mohon untuk mencetak Kartu tanda penerima beasiswa (Silahkan download file-nya pada akun anda)';

            sendWa($pendaftar['no_hp'], $msg);
        }

        // $this->alert->set('alert-success', 'Status berhasil di ubah');
        // redirect(site_url('admin/pendaftar/' . $slug_kategori),'reload');

        if ($status === 'diterima') {
            echo 'AKHIR :<span class="badge bg-success">Diterima</span>&nbsp;-&nbsp;
              <a href="' . site_url('admin/cetak_bukti_penerima_beasiswa/' . base64url_encode($pendaftar_id)) . '">[ Download Bukti ]</a>';
        } else {
            echo 'AKHIR :<span class="badge bg-danger">Ditolak</span>';
        }
    }

    //<profile>
    public function ganti_password()
    {
        $user_id = $this->session->userdata('user_id');

        if (!empty($_POST['pass_lama'])) {

            $password = $this->input->post('pass_lama');

            $cek_user = $this->db->get_where('user', array('id' => $user_id, 'password' => md5($password)));

            if ($cek_user->num_rows() > 0) {
                if (empty($_POST['pass_baru']) || empty($_POST['pass_ulangi'])) {
                    $this->alert->set('alert-danger', 'Password baru / ulangan tidak boleh kosong');
                    redirect(site_url('admin/ganti-password'), 'reload');
                } else {
                    $pass_baru   = $this->input->post('pass_baru');
                    $pass_ulangi = $this->input->post('pass_ulangi');

                    if ($pass_baru !== $pass_ulangi) {
                        $this->alert->set('alert-danger', 'Password baru & ulangan harus sama');
                        redirect(site_url('admin/ganti-password'), 'reload');
                    } else {
                        // $realname = $this->input->post('realname');
                        // $email    = $this->input->post('email');

                        $this->db->where('id', $user_id);
                        $this->db->update('user', array('password' => md5($pass_ulangi)));

                        $this->alert->set('alert-success', 'Password berhasil diupdate');
                        redirect(site_url('admin/ganti-password'), 'reload');
                    }
                }
            } else {
                $this->alert->set('alert-danger', 'Password Lama Salah');
                redirect(site_url('admin/ganti-password'), 'reload');
            }
        }

        $data['page_name'] = 'ganti_password';

        $this->breadcrumbs->push('Beranda', '/admin');
        $this->breadcrumbs->push('Ganti Password', '/admin/ganti_password');

        $data['page_title'] = 'Ganti Password';

        $this->_page_output($data);
    }
    //</profile>

    public function settings()
    {
        $this->breadcrumbs->push('Dashboard', '/admin');
        $this->breadcrumbs->push('Setting', '/settings');

        $data['breadcrumbs'] = $this->breadcrumbs->show();

        $act   = $this->uri->segment(3);
        $param = $this->uri->segment(4);

        if ($act === 'edt-value') {
            $value = $this->input->post('value');

            $this->db->where('title', $param);
            $this->db->update('settings', array('value' => $value));

            exit(0);
        } elseif ($act === 'edt-show') {
            $value = $this->input->post('value');

            $this->db->where('title', $param);
            $this->db->update('settings', array('show' => $value));

            exit(0);
        }

        $data['setting']    = $this->db->get('settings');
        $data['page_name']  = 'settings';
        $data['page_title'] = 'Data Settings';

        $this->_page_output($data);
    }

    public function image_slider($cat_id = 0)
    {

        $this->load->library('image_CRUD');

        $image_crud = new image_CRUD();

        $image_crud->set_primary_key_field('id');
        $image_crud->set_url_field('url');
        $image_crud->set_relation_field('category_id');

        $image_crud->set_table('image_slider');
        $image_crud->set_image_path('uploads/slider');

        $extra  = array('page_title' => 'Image Slider');
        $output = $image_crud->render();

        $output = array_merge((array) $output, $extra);

        $this->_page_output($output);
    }

    //!!!!!!!!!!!!!!!!!!!!! TESTING !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    public function penerima_sebelumnya_ajax()
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
                $this->datatables->where('YEAR(created_at) < ', $this->tahun_aktif);
                $this->datatables->where('status_akhir', 'diterima');
            } else {

                $set_jenis_dokumen = $kategori['set_jenis_dokumen'];
                //nama_lengkap,
                //kab_kota,jenis_kelamin,perguruan_tinggi,program_studi,akreditasi,semester,ip_semester
                //dokumen,status,ubah_email,hapus
                $this->datatables->select(
                    "  a.id,CONCAT('tr_',a.id) AS DT_RowId,
                    a.nik,
                    UPPER(a.nama_lengkap) AS nama_lengkap,
                    UPPER(a.kab_kota) AS kab_kota,
                    UPPER(a.jk) AS jk,
                    UPPER(a.nama_lembaga) AS nama_lembaga,
                    UPPER(a.program_studi) AS program_studi,
                    a.akreditasi,
                    a.semester,
                    a.ip_semester,
                    CONCAT(
                        LPAD(CAST((SELECT COUNT(*) FROM `dokumen_pendaftar` WHERE `pendaftar_id` = `a`.`id`) AS UNSIGNED),2,'0'),
                        '-',
                        LPAD(CAST((SELECT COUNT(*) FROM `dokumen_pendaftar` WHERE `pendaftar_id` = `a`.`id` AND `verifikasi` = 'diterima') AS UNSIGNED),2,'0'),
                        '-',
                        LPAD(CAST((SELECT COUNT(*) FROM `dokumen_pendaftar` WHERE `pendaftar_id` = `a`.`id` AND `verifikasi` = 'ditolak') AS UNSIGNED),2,'0')
                    ) AS `dokumen`,

                    a.status,
                    a.status_akhir,
                    a.email,
                    DATE_FORMAT(`a`.`created_at`,'%d-%m-%Y %H:%i:%s') AS `tgl_daftar`,
                    a.kategori_id"
                );

                $this->datatables->from('pendaftar a');
                $this->datatables->group_by('a.id');
                $this->datatables->where('kategori_id', $kategori['id']);
                $this->datatables->not_like("DATE_FORMAT(a.created_at,'%d-%m-%Y %H:%i:%s')", $this->tahun_aktif);
                $this->datatables->where('status_akhir', 'diterima');

                // $this->datatables->unset_column('hapus');
                // $this->datatables->unset_column('ubah_email');
                // $this->datatables->unset_column('dokumen');
            }

            echo $this->datatables->generate();
        } else {
            $slug = $this->uri->segment(3);
            $kat  = $this->db->get_where('kategori', array('slug' => $slug));

            if ($kat->num_rows() == 0) {
                redirect(site_url('admin'), 'reload');
            }

            $kategori = $kat->row_array();
            $this->breadcrumbs->push('Dashboard', '/admin');
            $this->breadcrumbs->push('Kategori Beasiswa', '/admin/kategori-beasiswa');
            $this->breadcrumbs->push('Penerima&nbsp;' . $kategori['nama'] . ' Sebelumnya', '/admin/penerima-sebelumnya-ajax/' . $slug);

            // echo $kategori['level_penerima'];
            if ($kategori['level_penerima'] === 'pelajar') {
                $data['page_name']  = 'penerima_sebelumnya/pelajar_ajax';
                $data['page_title'] = 'Data Penerima';
            } else {
                $data['page_name']  = 'penerima_sebelumnya/mahasiswa_ajax';
                $data['page_title'] = 'Data Penerima';
            }

            $this->_page_output($data);
        }
    }

    //merubah kategori pendaftar
    public function ubah_kategori()
    {
        $nik         = $this->input->post('nik');
        $kategori_id = $this->input->post('kategori_id');

        $this->db->where('nik', $nik);
        $this->db->update('pendaftar', array('kategori_id' => $kategori_id));
        echo "OK";
    }

    //pendaftar untuk tahun aktif
    public function pendaftar_ajax()
    {
        $slug = $this->uri->segment(3);
        $kat  = $this->db->get_where('kategori', array('slug' => $slug));

        if ($kat->num_rows() == 0) {
            redirect(site_url('admin'), 'reload');
        }

        $kategori = $kat->row_array();
        $this->breadcrumbs->push('Dashboard', '/admin');
        $this->breadcrumbs->push('Kategori Beasiswa', '/admin/kategori-beasiswa');
        $this->breadcrumbs->push($kategori['nama'], '/admin/pendaftar/' . $slug);

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

    public function load_dokumen()
    {
        $pendaftar_id = $this->input->get('pendaftar_id');
        $slug         = base64url_decode($this->input->get('slug'));

        // echo base64url_decode($slug);
        // $dok = "<div class=\"alert alert-warning\" role=\"alert\"> <i class=\"bi bi-info-circle-fill me-2\"></i>Klik pada baris untuk mengetahui alasan penolakan</div>";

        $dok = "<table class='table table-striped accordion'>";
        $dok .= " <tbody>";
        $kategori      = $this->db->get_where('kategori', array('slug' => $slug))->row_array();
        $jenis_dokumen = explode(',', $kategori['set_jenis_dokumen']);
        $i             = 1;
        foreach ($jenis_dokumen as $jd) {

            $jenis_dokumen = jenis_dokumen($jd);

            if ($jenis_dokumen == '') {
                continue;
            }

            $dok .= " <tr id=\"tr_" . $i . "\" data-bs-toggle=\"collapse\" data-bs-target=\"#r" . $i . "\">";
            $dok .= "   <td>" . jenis_dokumen($jd) . "</td>";

            $cek = $this->db->get_where('dokumen_pendaftar', array('jenis_dokumen_id' => $jd, 'pendaftar_id' => $pendaftar_id));
            if ($cek->num_rows() > 0) {
                $dokumen_pendaftar = $cek->row_array();
                $dok .= "<td><a href='" . site_url('uploads/dokumen/' . $dokumen_pendaftar['file_dokumen']) . "'>Download</a></td>";
                $dok .= "<td>";
                $status_dok = $dokumen_pendaftar['verifikasi'];
                if ($status_dok === 'pending') {
                    $dok .= '<span class="badge bg-secondary">Belum verifikasi</span>';
                    $dok .= "<script>";
                    $dok .= "   const trElement = document.querySelector('#tr_" . $i . "');trElement.removeAttribute('data-bs-toggle');";
                    $dok .= "</script>";
                } elseif ($status_dok === 'diterima') {
                    $dok .= '<span class="badge bg-success">Diterima</span>';
                    $dok .= "<script>";
                    $dok .= "   const trElement = document.querySelector('#tr_" . $i . "');trElement.removeAttribute('data-bs-toggle');";
                    $dok .= "</script>";
                } else {
                    $dok .= '<span class="badge bg-danger">Ditolak <i class="bi bi-chevron-down"></i></span>';
                }

                $dok .= "</td>";
            } else {
                $dok .= "<td colspan=2><span class=\"badge bg-warning text-dark\">Belum diunggah</span></td>";
                $dok .= "<script>";
                $dok .= "   const trElement = document.querySelector('#tr_" . $i . "');trElement.removeAttribute('data-bs-toggle');";
                $dok .= "</script>";
            }

            $dok .= " </tr>";

            if ($cek->num_rows() > 0) {
                $dokumen_pendaftar = $cek->row_array();

                $status_dok = $dokumen_pendaftar['verifikasi'];
                if ($status_dok === "ditolak") {
                    $alasan = $dokumen_pendaftar['alasan'];

                    $dok .= "<tr class=\"collapse accordion-collapse show table-danger\" id=\"r" . $i . "\" data-bs-parent=\".table\">";
                    $dok .= "   <td colspan=\"3\" class=\"link-danger text-center\">Alasan penolakan: " . $alasan . "</td>";
                    $dok .= "</tr>";
                }
            }

            $i++;
        }

        $dok .= " </tbody>";
        $dok .= "</table>";

        echo $dok;
    }
}
