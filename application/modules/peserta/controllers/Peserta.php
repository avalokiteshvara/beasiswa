<?php

defined('BASEPATH') or exit('No direct script access allowed');
//https://betterexplained.com/articles/how-to-optimize-your-site-with-gzip-compression/
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    ob_start("ob_gzhandler");
} else {
    ob_start();
}

class Peserta extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');

        $this->load->helper(array('url', 'libs', 'form', 'alert'));
        $this->load->database();
        $this->load->libraries(array('session', 'form_validation', 'alert'));
        $this->load->model('Peserta_model', 'peserta_m');

        $level = $this->session->userdata('user_level');
        if ($level !== 'peserta') {
            redirect(site_url('web'), 'reload');
        }

        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    }

    public function _page_output($output = null)
    {
        $user_id = $this->session->userdata('user_id');

        $this->db->select('a.file_foto,b.nama,a.status AS status_lv1,a.status_akhir AS status_lv2');
        $this->db->join('kategori b', 'a.kategori_id = b.id', 'left');
        $kat = $jenis_beasiswa = $this->db->get_where('pendaftar a', array('a.id' => $user_id))->row_array();

        $output['kat_beasiswa'] = $kat['nama'];
        $output['status_lv1']   = $kat['status_lv1'];
        $output['status_lv2']   = $kat['status_lv2'];
        $output['file_foto'] = $kat['file_foto'];

        $this->load->view('master.php', (array) $output);
    }

    public function download_bukti_lulus_verifikasi()
    {
        $user_id      = $this->session->userdata('user_id');
        $pendaftar_id = $user_id;
        bukti_pendaftaran($pendaftar_id, true);
    }

    public function download_bukti_lulus_tahap_akhir()
    {
        $user_id      = $this->session->userdata('user_id');
        $pendaftar_id = $user_id;
        bukti_dapat_beasiswa($pendaftar_id, true);
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');

        $this->db->select("a.email,a.nama_lengkap,a.no_hp, a.file_foto,a.nik,
                         a.kelurahan_id,a.kelurahan,a.kecamatan,a.kab_kota,a.alamat_rumah, a.status,
                         a.status_akhir,b.strict_ip_minimal,b.ip_minimal,a.nama_lembaga,a.program_studi,
                         a.akreditasi, a.ip_semester,b.akreditasi AS akreditasi_prog_studi, a.jenis_jurusan,
                         b.semester AS semester_kategori,b.level_penerima,a.lembaga_kerja,a.prodi_kerja,a.nidn,
                         a.semester, b.status_pendaftaran");
        $this->db->join('kategori b', 'a.kategori_id = b.id', 'left');
        $data['biodata'] = $this->db->get_where('pendaftar a', array('a.id' => $user_id))->row_array();

        // $this->load->view('master',$data);
        $data['page_title'] = 'Biodata';
        $data['page_name']  = 'biodata';
        $this->_page_output($data);
    }

    public function dokumen()
    {
        $user_id          = $this->session->userdata('user_id');
        $user_kategori_id = $this->session->userdata('user_kategori_id');

        $this->db->select("a.file_foto,a.status,a.status_akhir,b.status_pendaftaran");
        $this->db->join('kategori b', 'a.kategori_id = b.id', 'left');
        $data['biodata'] = $this->db->get_where('pendaftar a', array('a.id' => $user_id))->row_array();

        $data['dokumen'] = $this->peserta_m->get_document($user_id, $user_kategori_id);
        // $this->load->view('master',$data);
        $data['page_title'] = 'Dokumen';
        $data['page_name']  = 'dokumen';
        $this->_page_output($data);
    }

    public function generate_nama_dokumen($user_nik, $jenis_dokumen_id)
    {
        $jenis_dokumen = $this->db->get_where('jenis_dokumen', array('id' => $jenis_dokumen_id))->row_array();

        return slugify($user_nik . '-' . $jenis_dokumen['nama']);
    }

    public function update_foto()
    {
        // $user_id = $this->session->userdata('user_id');

        if (!empty($_FILES['file_foto_sidebar']['name'])) {

            // $jenis_dokumen_id = $this->input->post('jenis_dokumen_id');
            // $user_nik         = $this->session->userdata('user_nik');
            $user_id = $this->session->userdata('user_id');

            $upload['upload_path']   = './uploads/foto';
            $upload['allowed_types'] = 'jpeg|jpg';
            $upload['encrypt_name']  = true;
            $upload['max_size']      = 512;

            $this->load->library('upload', $upload);

            if (!$this->upload->do_upload('file_foto_sidebar')) {
                // $data['msg'] = $this->upload->display_errors();
                $this->alert->set('alert-danger', 'Ada kesalahan! Periksa kembali file yang anda unggah');
                redirect(site_url('peserta/index'), 'reload');
            } else {
                $success   = $this->upload->data();
                $file_name = $success['file_name'];

                // $nik         = $this->input->post('nik');
                // $kab_kota    = $this->input->post('kab_kota');
                // $akreditasi  = $this->input->post('akreditasi');
                // $ip_semester = str_replace(',', '.', $this->input->post('ip_semester'));
                // $semester    = $this->input->post('semester');

                $this->db->where('id', $user_id);
                $this->db->update(
                    'pendaftar',
                    array(
                        // 'nik'         => $nik,
                        // 'kab_kota'    => $kab_kota,
                        // 'akreditasi'  => $akreditasi,
                        // 'ip_semester' => $ip_semester,
                        'file_foto' => $file_name,
                        // 'semester'    => $semester,
                    )
                );

                $this->alert->set('alert-success', 'Foto berhasil diupdate');
                redirect(site_url('peserta/index'), 'reload');
            }
        }
    }

    public function update_biodata()
    {

        $userId = $this->session->userdata('user_id');

        if (!empty($_POST)) {

            //cek apakah nik baru tidak ada yang memiliki ?
            $nik = $this->input->post('nik');

            $this->db->where('nik', $nik);
            $this->db->where('id !=', $userId);
            $cek_nik = $this->db->get('pendaftar');

            //cek apakah email baru tidak ada yang memiliki ?
            $email = $this->input->post('email');

            $this->db->where('email', $email);
            $this->db->where('id !=', $userId);
            $cek_email = $this->db->get('pendaftar');

            //cek apakah nomor hp baru tidak ada yang memiliki ?
            $no_hp = $this->input->post('no_hp');

            $this->db->where('no_hp', $no_hp);
            $this->db->where('id !=', $userId);
            $cek_hp = $this->db->get('pendaftar');

            if ($cek_nik->num_rows() > 0 || $cek_email->num_rows() > 0 || $cek_hp->num_rows() > 0) {
                $this->alert->set('alert-danger', 'NIK, Email atau No Handphone baru ini sudah digunakan oleh pendaftar lain');
                redirect(site_url('peserta/index'), 'reload');
            } else {

                if (!empty($_FILES['file_foto']['name'])) {

                    // $jenis_dokumen_id = $this->input->post('jenis_dokumen_id');
                    // $user_nik         = $this->session->userdata('user_nik');
                    $userId = $this->session->userdata('user_id');

                    $upload['upload_path']   = './uploads/foto';
                    $upload['allowed_types'] = 'jpeg|jpg';
                    $upload['encrypt_name']  = true;
                    $upload['max_size']      = 512;

                    $this->load->library('upload', $upload);

                    if (!$this->upload->do_upload('file_foto')) {
                        // $data['msg'] = $this->upload->display_errors();
                        $this->alert->set('alert-danger', 'Ada kesalahan! Periksa kembali file yang anda unggah');
                        redirect(site_url('peserta/index'), 'reload');
                    } else {
                        $success   = $this->upload->data();
                        $file_name = $success['file_name'];

                        $nik          = $this->input->post('nik');
                        $nama_lengkap = $this->input->post('nama_lengkap');
                        $email        = $this->input->post('email');
                        $no_hp        = $this->input->post('no_hp');

                        // $kab_kota     = $this->input->post('kab_kota');
                        $wil = explode(':', $this->input->post('wilayah'));

                        $wil_id   = $wil[0];
                        $wil_desa = $wil[1];
                        $wil_kec  = $wil[2];
                        $wil_kab  = $wil[3];

                        $nama_lembaga  = $this->input->post('nama_lembaga');
                        $program_studi = $this->input->post('program_studi');
                        $jenisJurusan  = $this->input->post('jenis_jurusan');

                        $akreditasi  = $this->input->post('akreditasi');
                        $semester    = $this->input->post('semester');
                        $ip_semester = str_replace(',', '.', $this->input->post('ip_semester'));

                        $this->db->where('id', $userId);
                        $this->db->update(
                            'pendaftar',
                            array(
                                'nik'           => $nik,
                                'nama_lengkap'  => $nama_lengkap,
                                'email'         => $email,
                                'no_hp'         => $no_hp,
                                // 'kab_kota'      => $kab_kota,
                                'kelurahan_id'  => $wil_id,
                                'kelurahan'     => $wil_desa,
                                'kecamatan'     => $wil_kec,
                                'kab_kota'      => $wil_kab,

                                'nama_lembaga'  => $nama_lembaga,
                                'program_studi' => $program_studi,
                                'jenis_jurusan' => $jenisJurusan,

                                'akreditasi'    => $akreditasi,
                                'semester'      => $semester,
                                'ip_semester'   => $ip_semester,
                                'file_foto'     => $file_name,

                            )
                        );

                        $this->alert->set('alert-success', 'Biodata berhasil diupdate');
                        redirect(site_url('peserta/index'), 'reload');
                    }
                } else {
                    $nik          = $this->input->post('nik');
                    $nama_lengkap = $this->input->post('nama_lengkap');
                    $email        = $this->input->post('email');
                    $no_hp        = $this->input->post('no_hp');
                    // $kab_kota     = $this->input->post('kab_kota');
                    $wil = explode(':', $this->input->post('wilayah'));

                    $wil_id   = $wil[0];
                    $wil_desa = $wil[1];
                    $wil_kec  = $wil[2];
                    $wil_kab  = $wil[3];


                    $nama_lembaga  = $this->input->post('nama_lembaga');
                    $program_studi = $this->input->post('program_studi');
                    $jenisJurusan  = $this->input->post('jenis_jurusan');

                    $akreditasi  = $this->input->post('akreditasi');
                    $semester    = $this->input->post('semester');
                    $ip_semester = str_replace(',', '.', $this->input->post('ip_semester'));

                    $this->db->where('id', $userId);
                    $this->db->update(
                        'pendaftar',
                        array(
                            'nik'           => $nik,
                            'nama_lengkap'  => $nama_lengkap,
                            'email'         => $email,
                            'no_hp'         => $no_hp,
                            // 'kab_kota'      => $kab_kota,
                            'kelurahan_id'  => $wil_id,
                            'kelurahan'     => $wil_desa,
                            'kecamatan'     => $wil_kec,
                            'kab_kota'      => $wil_kab,


                            'nama_lembaga'  => $nama_lembaga,
                            'program_studi' => $program_studi,
                            'jenis_jurusan' => $jenisJurusan,

                            'akreditasi'    => $akreditasi,
                            'semester'      => $semester,
                            'ip_semester'   => $ip_semester
                        )
                    );

                    $this->alert->set('alert-success', 'Biodata berhasil diupdate');
                    redirect(site_url('peserta/index'), 'reload');
                }
            }
        }
    }

    public function upload_dokumen()
    {

        if (!empty($_FILES['file_dokumen']['name'])) {

            $jenis_dokumen_id = $this->input->post('jenis_dokumen_id');
            $user_nik         = $this->session->userdata('user_nik');
            $user_id          = $this->session->userdata('user_id');

            $upload['upload_path']   = './uploads/dokumen';
            $upload['allowed_types'] = 'zip|rar|jpeg|jpg|png|bmp|pdf|doc|docx|xls|xlsx';
            $upload['encrypt_name']  = false;
            $upload['file_name']     = $this->generate_nama_dokumen($user_nik, $jenis_dokumen_id);
            $upload['overwrite']     = true;
            $upload['max_size']      = 1024;

            $this->load->library('upload', $upload);

            if (!$this->upload->do_upload('file_dokumen')) {
                // $data['msg'] = $this->upload->display_errors();
                $this->alert->set('alert-danger', 'Ada kesalahan! Periksa kembali file yang anda unggah\n\rPastikan file yang anda unggah memiliki format yang diijinkan dan besarnya tidak lebih dari 1 MB');
                redirect(site_url('peserta/dokumen'), 'reload');
            } else {
                $success   = $this->upload->data();
                $file_name = $success['file_name'];

                $this->db->query(
                    "INSERT INTO dokumen_pendaftar (pendaftar_id, jenis_dokumen_id, file_dokumen)
                     VALUES($user_id, $jenis_dokumen_id, '$file_name')
                     ON DUPLICATE KEY UPDATE file_dokumen = '$file_name', verifikasi = 'pending'"
                );

                $this->alert->set('alert-success', 'File dokumen berhasil diunggah');
                redirect(site_url('peserta/dokumen'), 'reload');
            }
        }
    }

    public function pertanyaan()
    {
        try {

            $userEmail       = $this->session->userdata('user_email');
            $userNamaLengkap = $this->session->userdata('user_nama_lengkap');

            $this->load->library('grocery_CRUD');
            $crud = new Grocery_CRUD();

            $date_now = date('Y-m-d H:i:s');

            $crud->set_table('pertanyaan');
            $crud->set_subject('Data Pertanyaan');
            $crud->where('email', $userEmail);
            $crud->order_by('inserted_at', 'DESC');

            $crud->field_type('email', 'hidden', $userEmail);
            $crud->field_type('nama', 'hidden', $userNamaLengkap);
            $crud->field_type('tampil', 'hidden', 'N');
            $crud->field_type('inserted_at', 'hidden', $date_now);
            $crud->field_type('updated_at', 'hidden', $date_now);

            $crud->columns('topik', 'tanggapan', 'inserted_at');

            $crud->display_as('tampil', 'Tampilkan');
            $crud->display_as('inserted_at', 'Tanggal');

            $crud->callback_column('tanggapan', function ($value, $row) {

                $query = $this->db->get_where('pertanyaan_tanggapan', array('id_pertanyaan' => $row->id));
                $q     = $query->num_rows();

                return ($q == 0) ? '<span class="badge bg-secondary">Belum ada</span>' : $q . ' tanggapan';
            });

            $crud->callback_column('topik', function ($value, $row) {
                return '<a href="' . site_url('peserta/question-detail/' . $row->id) . '">' . limit_text($value, 50) . '</a>';
            });

            $extra  = array('page_title' => 'Data Pertanyaan');
            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (\Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function question_detail($pertanyaanId)
    {

        $this->load->library('recaptcha');

        $this->db->where(array('id' => $pertanyaanId));
        $data['pertanyaan'] = $this->db->get('pertanyaan')->row_array();

        $this->db->where(array('id_pertanyaan' => $pertanyaanId));

        $data['pertanyaan_id'] = $pertanyaanId;
        $data['tanggapan']     = $this->db->get('pertanyaan_tanggapan');

        $data['page_title'] = 'Detail Pertanyaan';
        $data['page_name']  = 'question-reply';
        $this->_page_output($data);
    }

    public function questions_add_reply()
    {
        $this->load->library('recaptcha');

        $userEmail       = $this->session->userdata('user_email');
        $userNamaLengkap = $this->session->userdata('user_nama_lengkap');

        $this->form_validation->set_rules('pertanyaan_id', 'Pertanyaan Id', 'required');
        $this->form_validation->set_rules('topik', 'Topik', 'required');

        $idPertanyaan = $this->input->post('pertanyaan_id');
        $topik        = $this->input->post('topik');

        if ($this->form_validation->run() == true) {

            $date_now = date('Y-m-d H:i:s');

            $this->db->insert(
                'pertanyaan_tanggapan',
                array(
                    'id_pertanyaan' => $idPertanyaan,
                    'nama'          => $userNamaLengkap,
                    'email'         => $userEmail,
                    'komentar'      => $topik,
                    'inserted_at'   => $date_now,
                )
            );

            $this->alert->set('alert-success', 'Tanggapan berhasil disimpan');
            redirect(site_url('peserta/question-detail/' . $idPertanyaan), 'reload');
        } else {
            $this->alert->set('alert-danger', '[2] Tanggapan Gagal disimpan !');
            redirect(site_url('peserta/question-detail/' . $idPertanyaan), 'reload');
        }
    }

    public function ganti_password()
    {
        $user_id = $this->session->userdata('user_id');

        if (!empty($_POST['pass_lama'])) {

            $password = $this->input->post('pass_lama');

            $cek_user = $this->db->get_where('pendaftar', array('id' => $user_id, 'password' => md5($password)));

            if ($cek_user->num_rows() > 0) {
                if (empty($_POST['pass_baru']) || empty($_POST['pass_ulangi'])) {
                    $this->alert->set('alert-danger', 'Password baru / ulangan tidak boleh kosong');
                    redirect(site_url('peserta/ganti-password'), 'reload');
                } else {
                    $pass_baru   = $this->input->post('pass_baru');
                    $pass_ulangi = $this->input->post('pass_ulangi');

                    if ($pass_baru !== $pass_ulangi) {
                        $this->alert->set('alert-danger', 'Password baru & ulangan harus sama');
                        redirect(site_url('peserta/ganti-password'), 'reload');
                    } else {


                        $this->db->where('id', $user_id);
                        $this->db->update('pendaftar', array('password' => md5($pass_ulangi)));

                        $this->alert->set('alert-success', 'Password berhasil diupdate');
                        redirect(site_url('peserta/ganti-password'), 'reload');
                    }
                }
            } else {
                $this->alert->set('alert-danger', 'Password Lama Salah');
                redirect(site_url('peserta/ganti-password'), 'reload');
            }
        }

        $data['page_name'] = 'ganti_password';

        // $this->breadcrumbs->push('Beranda', '/peserta');
        // $this->breadcrumbs->push('Ganti Password', '/peserta/ganti_password');

        $data['page_title'] = 'Ganti Password';

        $this->_page_output($data);
    }
}
