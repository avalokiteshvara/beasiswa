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
                $msg .= '<tr><td>Nama</td><td>' . $pendaftar['nama_lengkap'] . '</td></tr>';
                $msg .= '<tr><td>Kategori</td><td>' . $pendaftar['kategori'] . '</td></tr>';
                $msg .= '<tr><td>Tahap Uji Bahan</td><td>' . strtoupper($status) . '</td></tr>';
                $msg .= '<tr><td>Tahap Uji Akhir</td><td>' . strtoupper($status_akhir) . ' </td></tr>';
                $msg .= '</table>';
                echo json_encode(
                    array(
                        'alert_class' => 'alert-success',
                        'msg'         => $msg,
                    )
                );
            } else {
                echo json_encode(array('alert_class' => 'alert-warning', 'msg' => '<strong>Maaf&nbsp;' . $pendaftar['nama_lengkap'] . '</strong>, Berkas anda dinyatakan <strong>TIDAK</strong> lolos uji bahan'));
            }
        } else {
            echo json_encode(array('alert_class' => 'alert-danger', 'msg' => 'NIK tidak ditemukan! Mohon periksa kembali NIK yang anda masukkan'));
        }
    }



    public function questions_add_topic()
    {
        $this->load->library('recaptcha');

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('topik', 'Topik', 'required');
        $this->form_validation->set_rules('recaptcha', 'Recaptcha', 'required');

        if ($this->form_validation->run() == true) {

            $captcha_answer = $this->input->post('recaptcha');
            $response       = $this->recaptcha->verifyResponse($captcha_answer);

            if ($response['success']) {
                header('content-type: application/json');

                $nama  = $this->input->post('nama');
                $email = $this->input->post('email');
                $topik = $this->input->post('topik');

                $date_now = date('Y-m-d H:i:s');

                if (strtolower($nama) === 'administrator' || strtolower($nama) === 'admin') {
                    $nama = 'Guest';
                }

                $this->db->insert('pertanyaan', array('nama' => $nama, 'email' => $email, 'topik' => $topik, 'inserted_at' => $date_now));

                echo json_encode(
                    array(
                        'alert_class' => 'success',
                        'msg'         => 'Pesan anda berhasil dikirim',
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'alert_class' => 'error',
                        'msg'         => '[1] Pesan anda gagal dikirim',
                    )
                );
            }
        } else {
            echo json_encode(
                array(
                    'alert_class' => 'error',
                    'msg'         => '[2] Pesan anda gagal dikirim',
                )
            );
        }
    }

    public function index()
    {

        $this->load->library('recaptcha');

        $this->session->unset_userdata('q_question');

        if (!empty($_POST)) {

            switch ($_POST['submit']) {

                case 'login':
                    $captchaAnswer = $this->input->post('g-recaptcha-response');
                    $response      = $this->recaptcha->verifyResponse($captchaAnswer);

                    if ($response['success']) {
                        $this->form_validation->set_rules('username', 'NIK / Email', 'required|trim');
                        $this->form_validation->set_rules('password', 'Password', 'required|trim');

                        if ($this->form_validation->run() == true) {

                            $date_now = date('Y-m-d H:i:s');

                            $username = $this->input->post('username');
                            $password = $this->input->post('password');

                            $this->db->group_start();
                            $this->db->where('password', md5($password));
                            $this->db->group_end();

                            $this->db->group_start();
                            $this->db->where('nik', $username);
                            $this->db->or_where('email', $username);
                            $this->db->group_end();

                            $cek = $this->db->get('pendaftar');

                            if ($cek->num_rows() > 0) {
                                $pendaftar = $cek->row_array();

                                $this->db->where('id', $pendaftar['id']);
                                $this->db->update('pendaftar', array('token_reset_password' => ""));

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

                    $emailOrPhoneNumber = $this->input->post('email');

                    if (is_valid_email($emailOrPhoneNumber)) {
                        //reset password dengan email

                        $cek = $this->db->get_where('pendaftar', array('email' => trim($emailOrPhoneNumber)));
                        if ($cek->num_rows() > 0) {

                            $tokenReset = generateNumericOTP(6);
                            $message    = "Seseorang telah melakukan permintaan reset password untuk akun anda <br />";
                            $message .= "Jika anda tidak merasa melakukan hal ini, jangan hiraukan permintaan ini<br/>";
                            $message .= "Berikut ini adalah kode OTP: " . $tokenReset . "<br />";
                            $message .= "Gunakan kode ini untuk mereset password anda";
                            $message .= "<hr />";
                            $message .= "{timestamp:" . date("Y-m-d H:i:s") . "}";

                            $dateTime = new DateTime();
                            $dateTime->modify('+3 minutes');
                            $now = $dateTime->format('Y-m-d H:i:s');

                            $this->db->where('email', $emailOrPhoneNumber);
                            $this->db->update(
                                'pendaftar',
                                array(
                                    'token_reset_password' => md5($tokenReset),
                                    'token_expired'        => $now,
                                )
                            );

                            sendEmail($emailOrPhoneNumber, 'reset password', $message, 'none');

                            redirect(site_url('web/otp/' . base64url_encode($emailOrPhoneNumber)), 'reload');
                        } else {
                            $this->alert->set('alert-danger', 'Email tidak ditemukan', false);
                        }
                    } else { //reset password dengan wa

                        $cek = $this->db->get_where('pendaftar', array('no_hp' => trim($emailOrPhoneNumber)));
                        if ($cek->num_rows() > 0) {
                            $pendaftar = $cek->row_array();

                            if (validateDate($pendaftar['token_expired'])) {
                                $date_exp = new DateTime($pendaftar['token_expired']);
                                $date_now = new DateTime();

                                if ($date_exp > $date_now) {
                                    $this->alert->set('alert-danger', 'Mohon tunggu 3 menit sebelum request OTP baru', false);
                                    redirect(site_url('web'), 'reload');
                                    break;
                                }
                            }

                            $tokenReset = generateNumericOTP(6);
                            $message    = "Nomor OTP anda adalah: " . $tokenReset . " ";
                            $message .= "Gunakan kode ini untuk mereset password anda ";

                            $dateTime = new DateTime();
                            $dateTime->modify('+3 minutes');
                            $now = $dateTime->format('Y-m-d H:i:s');

                            $this->db->where('no_hp', trim($emailOrPhoneNumber));
                            $this->db->update(
                                'pendaftar',
                                array(
                                    'token_reset_password' => md5($tokenReset),
                                    'token_expired'        => $now,
                                )
                            );

                            sendWa($emailOrPhoneNumber, $message);

                            redirect(site_url('web/otp/' . base64url_encode($emailOrPhoneNumber)), 'reload');
                        } else {

                            $this->alert->set('alert-danger', 'Nomor WhatsApp tidak ditemukan', false);
                        }
                    }

                    redirect(site_url('web'), 'reload');

                    break;

                default:

                    break;
            }
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

        $this->db->order_by('sort_num', 'ASC');
        $data['kategori'] = $this->db->get('kategori');

        //untuk pendaftaran unset
        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('pt_dinas');
        $this->session->unset_userdata('prodi_dinas');

        //<!-- questions -->
        // Get questions data from the database
        $perPage = 4;
        $this->load->model('question');
        $this->load->library('ajax_pagination');

        // Get record count
        $conditions['returnType'] = 'count';
        $conditions['where']      = array('tampil' => 'Y');
        $totalRec                 = $this->question->getRows($conditions);

        // Pagination configuration
        $config['target']     = '#dataList';
        $config['base_url']   = base_url('web/questionPaginationData');
        $config['total_rows'] = $totalRec;
        $config['per_page']   = $perPage;

        // Initialize pagination library
        $this->ajax_pagination->initialize($config);

        // Get records
        $conditions = array(
            'limit' => $perPage,
            'where' => array('tampil' => 'Y'),
        );
        $data['questions'] = $this->question->getRows($conditions);

        $data['img_sliders'] = $this->db->get('image_slider');

        
        // $data['kat'] = $this->db->get('kategori');

        $this->load->view('web/master.php', $data);
        // compress_output();
    }

    public function get_question_reply()
    {
        $pertanyaanId = $this->input->get('id');

        $this->db->where(array('id' => $pertanyaanId));
        $data['pertanyaan'] = $this->db->get('pertanyaan')->row_array();

        $this->db->where(array('id_pertanyaan' => $pertanyaanId, 'tampil' => 'Y'));

        $data['tanggapan'] = $this->db->get('pertanyaan_tanggapan');
        $this->load->view('web/question-reply', $data, false);
    }

    public function questions_add_reply()
    {
        $this->load->library('recaptcha');

        $this->form_validation->set_rules('idPertanyaan', 'Id Pertanyaan', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('topik', 'Topik', 'required');
        $this->form_validation->set_rules('recaptcha', 'Recaptcha', 'required');

        if ($this->form_validation->run() == true) {

            $captcha_answer = $this->input->post('recaptcha');
            $response       = $this->recaptcha->verifyResponse($captcha_answer);

            if ($response['success']) {
                header('content-type: application/json');

                $idPertanyaan = $this->input->post('idPertanyaan');
                $nama         = $this->input->post('nama');
                $email        = $this->input->post('email');
                $topik        = $this->input->post('topik');

                $date_now = date('Y-m-d H:i:s');

                if (strtolower($nama) === 'administrator' || strtolower($nama) === 'admin') {
                    $nama = 'Guest';
                }

                $this->db->insert(
                    'pertanyaan_tanggapan',
                    array(
                        'id_pertanyaan' => $idPertanyaan,
                        'nama'          => $nama,
                        'email'         => $email,
                        'komentar'      => $topik,
                        'inserted_at'   => $date_now,
                    )
                );

                echo json_encode(
                    array(
                        'alert_class' => 'success',
                        'msg'         => 'Pesan anda berhasil dikirim',
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'alert_class' => 'error',
                        'msg'         => '[1] Pesan anda gagal dikirim\n\rCaptcha Error',
                    )
                );
            }
        } else {
            echo json_encode(
                array(
                    'alert_class' => 'error',
                    'msg'         => '[2] Pesan anda gagal dikirim',
                )
            );
        }
    }

    public function set_q_question()
    {
        $q = $this->input->post('query');

        $this->session->set_userdata(array('q_question' => $q));
        $this->questionPaginationData();
    }

    public function unset_q_question()
    {
        $this->session->unset_userdata('q_question');
        $this->questionPaginationData();
    }

    public function questionPaginationData()
    {

        $this->load->model('question');
        $this->load->library('ajax_pagination');

        $perPage = 4;

        // Define offset
        $page = $this->input->post('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        // Get record count
        $query = $this->session->userdata('q_question');
        if ($query === null) {
            $query = '';
        }

        $query_terms = explode(' ', $query);

        if ($this->session->has_userdata('q_question') !== null) {
            $conditions['like'] = array('topik' => $query_terms[0]);

            foreach ($query_terms as $key => $term) {
                if ($key > 0) {
                    $conditions['or_like'] = array('topik' => $term);
                }
            }
        }

        $conditions['where']      = array('tampil' => 'Y');
        $conditions['returnType'] = 'count';
        $totalRec                 = $this->question->getRows($conditions);

        // Pagination configuration
        $config['target']     = '#dataList';
        $config['base_url']   = base_url('web/questionPaginationData');
        $config['total_rows'] = $totalRec;
        $config['per_page']   = $perPage;

        // Initialize pagination library
        $this->ajax_pagination->initialize($config);

        if ($this->session->has_userdata('q_question') !== null) {
            $conditions = array(
                'start' => $offset,
                'limit' => $perPage,
                'where' => array('tampil' => 'Y'),
                'like'  => array('topik' => $query_terms[0]),
            );

            foreach ($query_terms as $key => $term) {
                if ($key > 0) {
                    $conditions['or_like'] = array('topik' => $term);
                }
            }

            // Get records

            $data['questions'] = $this->question->getRows($conditions);

            // Load the data list view
            $this->load->view('web/question-ajax', $data, false);
        } else {
            $conditions = array(
                'start' => $offset,
                'limit' => $perPage,
                'where' => array('tampil' => 'Y'),
            );

            // Get records
            $data['questions'] = $this->question->getRows($conditions);

            // Load the data list view
            $this->load->view('web/question-ajax', $data, false);
        }
    }

    public function otp()
    {
        $token = base64url_decode($this->uri->segment(3));

        $this->db->where('email', $token);
        $this->db->or_where('no_hp', $token);
        $cek = $this->db->get('pendaftar');

        if ($cek->num_rows() > 0) {

            if (!empty($_POST)) {
                $txt_1 = $this->input->post('txt_1');
                $txt_2 = $this->input->post('txt_2');
                $txt_3 = $this->input->post('txt_3');
                $txt_4 = $this->input->post('txt_4');
                $txt_5 = $this->input->post('txt_5');
                $txt_6 = $this->input->post('txt_6');

                $otp = md5($txt_1 . $txt_2 . $txt_3 . $txt_4 . $txt_5 . $txt_6);

                $pendaftar = $cek->row_array();
                if ($pendaftar['token_reset_password'] === $otp) {

                    $new_token = generate_uuid();

                    $this->db->where('token_reset_password', $otp);
                    $this->db->update('pendaftar', array('token_reset_password' => $new_token));

                    redirect(site_url('web/reset_password/' . $new_token), 'reload');
                } else {
                    $this->alert->set('alert-danger', 'Kode OTP invalid', false);
                    redirect(site_url('web'), 'reload');
                }
            }
        } else {
            $this->alert->set('alert-danger', 'Kode token invalid', false);
            redirect(site_url('web'), 'reload');
        }

        $data['token'] = $this->uri->segment(3);

        $this->load->view('otp_form', $data);
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
