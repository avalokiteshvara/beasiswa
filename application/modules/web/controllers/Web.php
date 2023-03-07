<?php

defined('BASEPATH') or exit('No direct script access allowed');
//https://betterexplained.com/articles/how-to-optimize-your-site-with-gzip-compression/
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    ob_start("ob_gzhandler");
} else {
    ob_start();
}

class Web extends CI_Controller
{
    private $data = array();

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');

        $this->load->helper(array('url', 'libs', 'form', 'alert'));
        $this->load->database();

        $this->load->libraries(array('session', 'form_validation', 'alert'));
        // $this->load->model('Web_model', 'web_m');

    }

    public function download_rekap_tahap_pertama()
    {
        $this->load->helper('download');
        $pth = file_get_contents(site_url('uploads/lolos_tahap_1.pdf'));
        $nme = "lolos_tahap_1.pdf";
        force_download($nme, $pth);
    }

    public function download_rekap_tahap_kedua()
    {
        $this->load->helper('download');
        $pth = file_get_contents(site_url('uploads/lolos_tahap_2.pdf'));
        $nme = "lolos_tahap_2.pdf";
        force_download($nme, $pth);
    }

    public function cek_hasil()
    {
        header('content-type: application/json');

        $nik = $this->input->post('nik');

        $this->db->select('a.nik,a.nama_lengkap,b.nama AS kategori,a.status,a.status_akhir');
        $this->db->join('kategori b', 'a.kategori_id = b.id', 'left');
        $cek = $this->db->get_where('pendaftar a', array('a.nik' => $nik));

        if ($cek->num_rows() > 0) {
            $pendaftar = $cek->row_array();
            $status    = $pendaftar['status'];
            if ($status === 'pending') {
                echo json_encode(array('alert_class' => 'alert-info', 'msg' => 'Berkas anda sedang diproses'));
            } elseif ($status === 'diterima') {
                $status_akhir = $pendaftar['status_akhir'];

                $msg = '<table>';
                $msg = '<tr><td>Nama</td><td>' . $pendaftar['nama_lengkap'] . '</td></tr>';
                $msg .= '<tr><td>Kategori</td><td>' . $pendaftar['kategori'] . '</td></tr>';
                $msg .= '<tr><td>Tahap Uji Bahan</td><td>' . strtoupper($status) . '</td></tr>';
                $msg .= '<tr><td>Tahap Uji Akhir</td><td>' . strtoupper($status_akhir) . ' </td></tr>';
                $msg .= '</table>';
                echo json_encode(
                    array(
                        'alert_class' => 'alert-success',
                        'msg'         => $msg)
                );
            } else {
                echo json_encode(array('alert_class' => 'alert-warning', 'msg' => '<strong>Maaf&nbsp;' . $pendaftar['nama_lengkap'] . '</strong>, Berkas anda dinyatakan <strong>TIDAK</strong> lolos uji bahan'));
            }

        } else {
            echo json_encode(array('alert_class' => 'alert-danger', 'msg' => 'NIK tidak ditemukan! Mohon periksa kembali NIK yang anda masukkan'));
        }

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

    public function index()
    {
        $this->load->library('recaptcha');

        if (!empty($_POST)) {

            switch ($_POST['submit']) {

                case 'login':
                    $captcha_answer = $this->input->post('g-recaptcha-response');
                    $response       = $this->recaptcha->verifyResponse($captcha_answer);

                    if ($response['success']) {
                        $this->form_validation->set_rules('username', 'NIK / Email', 'required');
                        $this->form_validation->set_rules('password', 'Password', 'required');

                        if ($this->form_validation->run() == true) {

                            $username = $this->input->post('username');
                            $password = md5($this->input->post('password'));

                            $this->db->where('password', $password);
                            $this->db->group_start();
                            $this->db->where('nik', $username);
                            $this->db->or_where('email', $username);
                            $this->db->group_end();
                            $cek = $this->db->get('pendaftar');

                            if ($cek->num_rows() > 0) {
                                $pendaftar = $cek->row_array();

                                $this->session->set_userdata(
                                    array(
                                        'user_id'           => $pendaftar['id'],
                                        'user_kategori_id'  => $pendaftar['kategori_id'],
                                        'user_nik'          => $pendaftar['nik'],
                                        'user_email'        => $pendaftar['email'],
                                        'user_nama_lengkap' => $pendaftar['nama_lengkap'],
                                        'user_level'        => 'peserta',
                                    )
                                );

                                redirect(site_url('peserta'), 'reload');
                            } else {
                                $this->alert->set('alert-danger', "User tidak ditemukan! Periksa kembali Email atau NIK dan Password yang anda masukkan", false);
                            }
                        } else {
                            $this->alert->set('alert-danger', "Periksa kembali data yang anda masukkan", false);
                        }
                    } else {
                        $this->alert->set('alert-danger', 'Validasi reCaptcha Error', false);
                    }

                    redirect(site_url('web'), 'reload');

                    break;

                case 'reset-password':

                    $email = $this->input->post('email');
                    $cek   = $this->db->get_where('pendaftar', array('email' => $email));
                    if ($cek->num_rows() > 0) {

                        // $token_reset_password = generate_uuid();
                        //
                        // $this->db->where('email',$email);
                        // $this->db->update('pendaftar',array('token_reset_password' => $token_reset_password ));

                        //function send_email($recipient_email_address,$subject,$message,$attachment){
                        // $message = "Seseorang telah melakukan permintaan reset password akun anda <br />";
                        // $message .= "Jika anda tidak merasa melakukan hal ini, jangan hiraukan permintaan ini<br />";
                        // $message .= "Klik <a href='" . site_url('web/reset-password/' . $token_reset_password) . "'>disini</a> jika anda ingin mereset password anda";
                        $new_pass = generateRandomString(6);

                        $this->db->where('email', $email);
                        $this->db->update('pendaftar', array('password' => md5($new_pass)));

                        $message = "Berikut ini adalah password anda yang baru : " . $new_pass;

                        $message .= "<hr />";
                        $message .= "{timestamp:" . date("Y-m-d H:i:s") . "}";
                        send_email($email, 'reset password', $message, 'none');
                        // echo "<script>alert('Silahkan buka email anda untuk langkah selanjutnya');</script>";
                        $this->alert->set('alert-success', 'Silahkan cek email untuk langkah selanjutnya', false);
                    }

                    redirect(site_url('web'), 'reload');

                    break;
            }

            // var_dump($response);
        }

        $rs_grafik_001 = $this->db->query("SELECT b.nama,
                                                (COUNT(a.id)/(SELECT COUNT(id) FROM pendaftar WHERE YEAR(created_at) = YEAR(NOW()) )) * 100 AS persentase
                                        FROM pendaftar a
                                        LEFT JOIN kategori b ON a.kategori_id = b.id
                                        WHERE YEAR(a.created_at) = YEAR(NOW())
                                        GROUP BY b.nama
                                        ORDER BY COUNT(a.id) DESC");

        $grafik_001 = "";
        foreach ($rs_grafik_001->result_array() as $key) {
            $grafik_001 .= '{';
            $grafik_001 .= "  name:" . "'" . $key['nama'] . "',";
            $grafik_001 .= "  y:" . $key['persentase'];
            $grafik_001 .= '},';
        }

        $data['grafik_001'] = array('data' => substr($grafik_001, 0, -1));

        $rs_grafik_002 = $this->db->query("SELECT nama_lembaga,
                                             (COUNT(id)/(SELECT COUNT(id) FROM pendaftar WHERE YEAR(created_at) = YEAR(NOW()) )) * 100 AS persentase
                                        FROM pendaftar
                                        WHERE YEAR(created_at) = YEAR(NOW())
                                        GROUP BY nama_lembaga
                                        ORDER BY COUNT(id) DESC
                                        LIMIT 15");
        $grafik_002       = "";
        $grafik_002_total = 0;
        foreach ($rs_grafik_002->result_array() as $key) {
            $grafik_002 .= '{';
            $grafik_002 .= "  name:" . "'" . preg_replace("/([{,])([a-zA-Z][^: ]+):/", "$1\"$2\":", $key['nama_lembaga']) . "',";
            $grafik_002 .= "  y:" . $key['persentase'];
            $grafik_002 .= '},';
            $grafik_002_total += $key['persentase'];
        }

        $data['grafik_002'] = array('data' => substr($grafik_002, 0, -1), 'lainnya' => (100 - $grafik_002_total));

        $rs_grafik_003 = $this->db->query("SELECT a.akreditasi ,
                                               (COUNT(a.id)/(SELECT COUNT(id) FROM pendaftar WHERE YEAR(created_at) = YEAR(NOW()) )) * 100 AS persentase
                                        FROM pendaftar a
                                        WHERE YEAR(created_at) = YEAR(NOW())
                                        GROUP BY a.akreditasi
                                        ORDER BY COUNT(a.id) DESC");
        $grafik_003 = "";
        foreach ($rs_grafik_003->result_array() as $key) {
            $grafik_003 .= '{';
            $grafik_003 .= "  name:" . "'Akreditasi " . $key['akreditasi'] . "',";
            $grafik_003 .= "  y:" . $key['persentase'];
            $grafik_003 .= '},';
        }

        $data['grafik_003'] = array('data' => substr($grafik_003, 0, -1));

        $data['faqs']    = $this->db->get('faq');
        $data['rundown'] = $this->db->get_where('web_content', array('judul' => 'rundown'))->row_array();
        $data['juknis']  = $this->db->get_where('web_content', array('judul' => 'juknis'))->row_array();

        $data['kategori'] = $this->db->get('kategori');
        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('email');
        $this->load->view('web/master.php', $data);
        // compress_output();
    }

    public function old_index()
    {
        $this->load->library('recaptcha');

        if (!empty($_POST)) {

            switch ($_POST['submit']) {

                case 'login':
                    $captcha_answer = $this->input->post('g-recaptcha-response');
                    $response       = $this->recaptcha->verifyResponse($captcha_answer);

                    if ($response['success']) {
                        $this->form_validation->set_rules('username', 'NIK / Email', 'required');
                        $this->form_validation->set_rules('password', 'Password', 'required');

                        if ($this->form_validation->run() == true) {

                            $username = $this->input->post('username');
                            $password = md5($this->input->post('password'));

                            $this->db->where('password', $password);
                            $this->db->group_start();
                            $this->db->where('nik', $username);
                            $this->db->or_where('email', $username);
                            $this->db->group_end();
                            $cek = $this->db->get('pendaftar');

                            if ($cek->num_rows() > 0) {
                                $pendaftar = $cek->row_array();

                                $this->session->set_userdata(
                                    array(
                                        'user_id'           => $pendaftar['id'],
                                        'user_kategori_id'  => $pendaftar['kategori_id'],
                                        'user_nik'          => $pendaftar['nik'],
                                        'user_email'        => $pendaftar['email'],
                                        'user_nama_lengkap' => $pendaftar['nama_lengkap'],
                                        'user_level'        => 'peserta',
                                    )
                                );

                                redirect(site_url('peserta'), 'reload');
                            } else {
                                $this->alert->set('alert-danger', "User tidak ditemukan! Periksa kembali Email atau NIK dan Password yang anda masukkan", false);
                            }
                        } else {
                            $this->alert->set('alert-danger', "Periksa kembali data yang anda masukkan", false);
                        }
                    } else {
                        $this->alert->set('alert-danger', 'Validasi reCaptcha Error', false);
                    }

                    redirect(site_url('web'), 'reload');

                    break;

                case 'reset-password':

                    $email = $this->input->post('email');
                    $cek   = $this->db->get_where('pendaftar', array('email' => $email));
                    if ($cek->num_rows() > 0) {

                        // $token_reset_password = generate_uuid();
                        //
                        // $this->db->where('email',$email);
                        // $this->db->update('pendaftar',array('token_reset_password' => $token_reset_password ));

                        //function send_email($recipient_email_address,$subject,$message,$attachment){
                        // $message = "Seseorang telah melakukan permintaan reset password akun anda <br />";
                        // $message .= "Jika anda tidak merasa melakukan hal ini, jangan hiraukan permintaan ini<br />";
                        // $message .= "Klik <a href='" . site_url('web/reset-password/' . $token_reset_password) . "'>disini</a> jika anda ingin mereset password anda";
                        $new_pass = generateRandomString(6);

                        $this->db->where('email', $email);
                        $this->db->update('pendaftar', array('password' => md5($new_pass)));

                        $message = "Berikut ini adalah password anda yang baru : " . $new_pass;

                        $message .= "<hr />";
                        $message .= "{timestamp:" . date("Y-m-d H:i:s") . "}";
                        send_email($email, 'reset password', $message, 'none');
                        // echo "<script>alert('Silahkan buka email anda untuk langkah selanjutnya');</script>";
                        $this->alert->set('alert-success', 'Silahkan cek email untuk langkah selanjutnya', false);
                    }

                    redirect(site_url('web'), 'reload');

                    break;
            }

            // var_dump($response);
        }

        $data['faqs']    = $this->db->get('faq');
        $data['rundown'] = $this->db->get_where('web_content', array('judul' => 'rundown'))->row_array();
        $data['juknis']  = $this->db->get_where('web_content', array('judul' => 'juknis'))->row_array();

        $data['kategori'] = $this->db->get('kategori');
        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('email');
        $this->load->view('web/old_master.php', $data);
        // compress_output();
    }

    public function reset_password()
    {
        $token_reset_password = $this->uri->segment(3);

        //cek apakah token valid
        $cek = $this->db->get_where('pendaftar', array('token_reset_password' => $token_reset_password));
        if ($cek->num_rows() == 0) {
            echo '<script>
                alert("Token tidak valid!");
                window.location = "' . site_url('web') . '";
              </script>';
        }

        if (!empty($_POST)) {
            $this->form_validation->set_rules('new_pass', 'Password baru', 'required');
            $this->form_validation->set_rules('repeat_pass', 'Password ulangi', 'required|matches[new_pass]');

            if ($this->form_validation->run() == true) {
                $new_password = $this->input->post('new_pass');
                $this->db->where('token_reset_password', $token_reset_password);
                $this->db->update('pendaftar', array('password' => md5($new_password), 'token_reset_password' => generate_uuid()));
                echo '<script>
                  alert("Password berhasil dirubah. Silahkan melakukan login dengan password yang baru");
                  window.location = "' . site_url('web') . '";
                </script>';
            } else {
                echo "<script>alert('Password tidak sama!');</script>";
            }
        }

        $this->load->view('reset_password');
    }

}
