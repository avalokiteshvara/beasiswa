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
    private $data = array();

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

        $this->db->select('b.nama,a.status AS status_lv1,a.status_akhir AS status_lv2');
        $this->db->join('kategori b', 'a.kategori_id = b.id', 'left');
        $kat = $jenis_beasiswa = $this->db->get_where('pendaftar a', array('a.id' => $user_id))->row_array();

        $output['kat_beasiswa'] = $kat['nama'];
        $output['status_lv1']   = $kat['status_lv1'];
        $output['status_lv2']   = $kat['status_lv2'];

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

        $this->db->select("a.email,a.file_foto,a.nik,a.kab_kota,a.status,a.status_akhir,b.strict_ip_minimal,b.ip_minimal,
                         a.akreditasi, a.ip_semester,b.akreditasi AS akreditasi_prog_studi,
                         b.semester AS semester_kategori,
                         a.semester, b.status_pendaftaran");
        $this->db->join('kategori b', 'a.kategori_id = b.id', 'left');
        $data['biodata'] = $this->db->get_where('pendaftar a', array('a.id' => $user_id))->row_array();
        
        $user_id = $this->session->userdata('user_id');
        $user_kategori_id = $this->session->userdata('user_kategori_id');


        $data['dokumen'] = $this->peserta_m->get_document($user_id,$user_kategori_id);
        // $this->load->view('master',$data);
        $data['page_name'] = 'beranda';
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
                $this->db->update('pendaftar',
                    array(
                        // 'nik'         => $nik,
                        // 'kab_kota'    => $kab_kota,
                        // 'akreditasi'  => $akreditasi,
                        // 'ip_semester' => $ip_semester,
                        'file_foto'   => $file_name,
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

        $user_id = $this->session->userdata('user_id');

        if (!empty($_POST)) {

            //cek apakah nik baru tidak ada yang memiliki ?
            $nik = $this->input->post('nik');

            $this->db->where('nik', $nik);
            $this->db->where('id !=', $user_id);

            $cek_nik = $this->db->get('pendaftar');

            //cek apakah email baru tidak ada yang memiliki ?
            $email = $this->input->post('email');

            $this->db->where('email', $email);
            $this->db->where('id !=', $user_id);

            $cek_email = $this->db->get('pendaftar');

            if ($cek_nik->num_rows() > 0 || $cek_email->num_rows() > 0) {
                $this->alert->set('alert-danger', 'NIK atau Email baru ini sudah digunakan oleh pendaftar lain');
                redirect(site_url('peserta/index'), 'reload');
            } else {

                if (!empty($_FILES['file_foto']['name'])) {

                    // $jenis_dokumen_id = $this->input->post('jenis_dokumen_id');
                    // $user_nik         = $this->session->userdata('user_nik');
                    $user_id = $this->session->userdata('user_id');

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

                        $nik         = $this->input->post('nik');
                        $kab_kota    = $this->input->post('kab_kota');
                        $akreditasi  = $this->input->post('akreditasi');
                        $ip_semester = str_replace(',', '.', $this->input->post('ip_semester'));
                        $semester    = $this->input->post('semester');

                        $this->db->where('id', $user_id);
                        $this->db->update('pendaftar',
                            array(
                                'nik'         => $nik,
                                'kab_kota'    => $kab_kota,
                                'akreditasi'  => $akreditasi,
                                'ip_semester' => $ip_semester,
                                'file_foto'   => $file_name,
                                'semester'    => $semester,
                            )
                        );

                        $this->alert->set('alert-success', 'Biodata berhasil diupdate');
                        redirect(site_url('peserta/index'), 'reload');
                    }
                } else {
                    $nik         = $this->input->post('nik');
                    $ip_semester = str_replace(',', '.', $this->input->post('ip_semester'));
                    $kab_kota    = $this->input->post('kab_kota');
                    $akreditasi  = $this->input->post('akreditasi');
                    $semester    = $this->input->post('semester');

                    $this->db->where('id', $user_id);
                    $this->db->update('pendaftar',
                        array(
                            'nik'         => $nik,
                            'kab_kota'    => $kab_kota,
                            'akreditasi'  => $akreditasi,
                            'ip_semester' => $ip_semester,
                            'semester'    => $semester,
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
            $upload['allowed_types'] = 'zip|rar|jpeg|jpg|pdf|doc|docx|xls|xlsx';
            $upload['encrypt_name']  = false;
            $upload['file_name']     = $this->generate_nama_dokumen($user_nik, $jenis_dokumen_id);
            $upload['overwrite']     = true;
            $upload['max_size']      = 1024;

            $this->load->library('upload', $upload);

            if (!$this->upload->do_upload('file_dokumen')) {
                // $data['msg'] = $this->upload->display_errors();
                $this->alert->set('alert-danger', 'Ada kesalahan! Periksa kembali file yang anda unggah');
                redirect(site_url('peserta/index'), 'reload');
            } else {
                $success   = $this->upload->data();
                $file_name = $success['file_name'];

                $this->db->query(
                    "INSERT INTO dokumen_pendaftar (pendaftar_id, jenis_dokumen_id, file_dokumen)
                     VALUES($user_id, $jenis_dokumen_id, '$file_name')
                     ON DUPLICATE KEY UPDATE file_dokumen = '$file_name', verifikasi = 'pending'"
                );

                $this->alert->set('alert-success', 'File dokumen berhasil diunggah');
                redirect(site_url('peserta/index'), 'reload');
            }
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
                        $realname = $this->input->post('realname');
                        $email    = $this->input->post('email');

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
