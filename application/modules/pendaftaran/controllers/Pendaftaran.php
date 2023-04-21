<?php

defined('BASEPATH') or exit('No direct script access allowed');
//https://betterexplained.com/articles/how-to-optimize-your-site-with-gzip-compression/
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    ob_start("ob_gzhandler");
} else {
    ob_start();
}

class Pendaftaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');

        $this->load->helper(array('url', 'libs', 'form', 'alert'));
        $this->load->database();

        $this->load->libraries(array('alert', 'session', 'form_validation'));
    }

    public function cari_lembaga()
    {
        header('content-type: application/json');
        $term = $this->input->get('term');

        $this->db->select('nama_lembaga');
        $this->db->like('nama_lembaga', $term);
        $this->db->limit(10);
        $this->db->group_by('nama_lembaga');
        $res = $this->db->get('pendaftar');

        //[{"id":"Phylloscopus humei","label":"Hume`s Leaf Warbler","value":"Hume`s Leaf Warbler"},{"id":"Limosa haemastica","label":"Hudsonian Godwit","value":"Hudsonian Godwit"},{"id":"Alectoris chukar","label":"Chukar","value":"Chukar"}]

        $ret = "[";
        foreach ($res->result_array() as $row) {
            $ret .= "{";
            $ret .= '"id":' . '"' . $row['nama_lembaga'] . '",';
            $ret .= '"label":' . '"' . $row['nama_lembaga'] . '",';
            $ret .= '"value":' . '"' . strtoupper($row['nama_lembaga']) . '"';
            $ret .= "},";
        }

        $ret = substr($ret, 0, -1);
        $ret .= "]";

        echo $ret;
    }

    public function ubah_nik()
    {
        $slug_kategori = base64url_decode($this->uri->segment(3));

        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('email');

        redirect(site_url('pendaftaran/index/' . $slug_kategori), 'reload');
    }

    public function cek_kategori_qry_validation($kategori_id)
    {

        $result             = true;
        $cek_qry_validation = $this->db->get_where('kategori_qry_validation', array('kategori_id' => $kategori_id));

        if ($cek_qry_validation->num_rows() > 0) {
            foreach ($cek_qry_validation->result_array() as $validation) {

                $qry = $validation['qry'];
                $qry = str_replace(':kelas', $this->input->post('kelas'), $qry);
                $qry = str_replace(':semester', $this->input->post('semester'), $qry);

                $qry_exec = $this->db->query($qry)->row_array();

                if ($qry_exec['result'] === 'N') {
                    $this->alert->set('alert-danger', $validation['error_msg'], true);
                    $result = false;
                    break;
                }
            }
        }

        return $result;
    }

    public function validate_nik($string)
    {
        $cek = $this->db->get_where('pendaftar', array('nik' => $string, 'status_akhir' => 'diterima'));
        if ($cek->num_rows() > 0) {
            $this->alert->set('alert-danger', 'Anda telah menerima bantuan beasiswa tahun sebelumnya', true);
            return false;
        } else {
            $cek = $this->db->get_where('pendaftar', array('nik' => $string));
            if ($cek->num_rows() > 0) {
                $this->alert->set('alert-danger', 'NIK sudah terdaftar', true);
                return false;
            } else {

                //remove dots
                $nik = preg_replace('#[^\pL\pN/-]+#', '', $string);
                //dapatkan 4 digit pertama
                $kode_wil = substr($nik, 0, 4);

                $nik_jambi = array('1501', '1502', '1503', '1504', '1505', '1506', '1507', '1508', '1509', '1571', '1572');

                if (in_array($kode_wil, $nik_jambi)) {
                    return true;
                } else {
                    $this->alert->set('alert-danger', 'Maaf NIK anda bukan kode wilayah di Provinsi Jambi', true);
                    return false;
                }
            }
        }
    }

    public function validate_nidn($string)
    {
        if (trim($string) !== "") {
            $cek = $this->db->get_where('pendaftar', array('nidn' => $string));
            if ($cek->num_rows() > 0) {
                $this->alert->set('alert-danger', 'NIDN sudah terdaftar', true);
                return false;
            } else {
                if ($this->input->post('nidn')) {
                    $nidn = $this->input->post('nidn');
                    $this->session->set_userdata(array('nidn' => $nidn));

                    //https://api-frontend.kemdikbud.go.id/hit/1016038802

                    $url = 'https://api-frontend.kemdikbud.go.id/hit/' . $nidn;

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // tambahkan opsi ini

                    $headers = array(
                        'User-Agent: PostmanRuntime/7.31.3',
                        'Accept: */*',
                        'Postman-Token: ac8e840f-9e26-40de-8590-00182e726c9d',
                        'Host: api-frontend.kemdikbud.go.id',
                        'Accept-Encoding: gzip, deflate, br'
                    );
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    $data = curl_exec($ch);

                    curl_close($ch);

                    /**
                     *
                     *
                     * {"dosen":[
                     *              {
                     *                  "text":"ADE FITRI RAHMADANI, NIDN : 1016038802, PT : UNIVERSITAS BUNG HATTA, Prodi : PENDIDIKAN TEKNIK INFORMATIKA  KOMPUTER",
                     *                  "website-link":"/data_dosen/NUM5OURFMkEtM0JDMy00MjhELUJEOUQtRTBBQjMwQUZCOUQy"
                     *              }
                     *         ]
                     * }
                     */

                    if (str_contains($data, 'NIDN')) {
                        $dataJson = json_decode($data); //decoding data JSON
                        $txt      = $dataJson->dosen[0]->text;
                        $exp      = explode(",", $txt);

                        $nama  = $exp[0];
                        $pt    = explode(":", $exp[2])[1];
                        $prodi = explode(":", $exp[3])[1];

                        $this->session->set_userdata(array('nama' => $nama));
                        $this->session->set_userdata(array('pt_dinas' => $pt));
                        $this->session->set_userdata(array('prodi_dinas' => $prodi));
                        return true;
                    } else {
                        $this->alert->set('alert-danger', 'NIDN tidak terdaftar di PDDikti', true);
                        return false;
                    }
                }
            }
        }
    }

    public function index()
    {
        $this->load->library('recaptcha');

        $slug         = $this->uri->segment(3);
        $cek_kategori = $this->db->get_where('kategori', array('slug' => trim($slug)));

        if ($cek_kategori->num_rows() == 0) {
            redirect(site_url('web'), 'reload');
        }

        $data['detail'] = $cek_kategori->row_array();

        if (!empty($_POST)) {

            switch ($_POST['submit']) {

                case 'submit-nik':

                    $this->form_validation->set_rules('nik', 'NIK', 'trim|required|callback_validate_nik');
                    $this->form_validation->set_rules('nidn', 'NIDN', 'trim|callback_validate_nidn');

                    if ($this->form_validation->run() == true) {
                        $nik = $this->input->post('nik');
                        //phase one complate when nik in session
                        $this->session->set_userdata(array('nik' => $nik));

                        redirect(site_url('pendaftaran/index/' . $slug), 'reload');
                    } /*else {
                    $this->alert->set('alert-danger', 'NIK sudah terdaftar', true);
                    }*/

                    break;

                case 'daftar':
                    $captcha_answer = $this->input->post('g-recaptcha-response');
                    $response       = $this->recaptcha->verifyResponse($captcha_answer);

                    // $response = array('success' => true);

                    $level_penerima = $data['detail']['level_penerima'];
                    if ($level_penerima === 'pelajar') {

                        if ($response['success']) {

                            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
                            $this->form_validation->set_rules('alamat_rumah', 'Alamat rumah', 'trim|required');
                            $this->form_validation->set_rules('kota_lahir', 'Kota lahir', 'trim|required');
                            $this->form_validation->set_rules('tgl_lahir', 'Tanggal lahir', 'trim|required');
                            $this->form_validation->set_rules('jk', 'Jenis kelamin', 'required');
                            $this->form_validation->set_rules('no_hp', 'Nomor telephon', 'trim|required');
                            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[pendaftar.email]');
                            $this->form_validation->set_rules('nama_lembaga', 'Nama sekolah', 'trim|required');
                            $this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');
                            $this->form_validation->set_rules('semester', 'Semester', 'trim|required');

                            if ($this->form_validation->run() == true) {

                                //cek apakah ada qry_validation ?

                                if ($this->cek_kategori_qry_validation($data['detail']['id'])) {

                                    $password = generateRandomString(6);
                                    $input    = array(
                                        'kategori_id'  => $data['detail']['id'],
                                        'nik'          => $this->input->post('nik'),
                                        'password'     => md5($password),
                                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                                        'alamat_rumah' => $this->input->post('alamat_rumah'),
                                        'kota_lahir'   => $this->input->post('kota_lahir'),
                                        'tgl_lahir'    => $this->input->post('tgl_lahir'),
                                        'jk'           => $this->input->post('jk'),
                                        'no_hp'        => $this->input->post('no_hp'),
                                        'email'        => $this->input->post('email'),
                                        'nama_lembaga' => $this->input->post('nama_lembaga'),
                                        'kelas'        => $this->input->post('kelas'),
                                        'semester'     => $this->input->post('semester'),
                                    );

                                    $this->db->insert('pendaftar', $input);

                                    $message = "Berikut ini adalah informasi yang anda butuhkan untuk login <br />";
                                    $message .= "Username : (NIK anda)<br />";
                                    $message .= "Password : " . $password;
                                    $message .= "<hr />";
                                    $message .= "{timestamp:" . date("Y-m-d H:i:s") . "}";
                                    sendEmail($this->input->post('email'), 'Informasi Login ' . site_url(), $message, 'none');
                                    //sendWa($this->input->post('no_hp'),$message);

                                    //phase two complete when email in session
                                    $this->session->set_userdata(array('email' => $this->input->post('email')));

                                    redirect(site_url('pendaftaran/index/' . $slug), 'reload');
                                }
                            } else {
                                $this->alert->set('alert-danger', "Periksa kembali data yang anda masukkan", true);
                            }
                        } else {
                            $this->alert->set('alert-danger', 'Validasi reCaptcha Error', true);
                        }
                    } else {
                        //validasi mahasiswa atau dosen

                        if ($response['success']) {

                            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
                            $this->form_validation->set_rules('alamat_rumah', 'Alamat rumah', 'trim|required');
                            $this->form_validation->set_rules('kota_lahir', 'Kota lahir', 'trim|required');
                            $this->form_validation->set_rules('tgl_lahir', 'Tanggal lahir', 'trim|required');
                            $this->form_validation->set_rules('jk', 'Jenis kelamin', 'required');
                            $this->form_validation->set_rules('no_hp', 'Nomor telephon', 'trim|required|is_unique[pendaftar.no_hp]');
                            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[pendaftar.email]');
                            $this->form_validation->set_rules('nama_lembaga', 'Nama sekolah', 'trim|required');
                            $this->form_validation->set_rules('akreditasi', 'Akreditasi', 'trim|required');
                            $this->form_validation->set_rules('program_studi', 'Program studi', 'trim|required');

                            $this->form_validation->set_rules('jenis_jurusan', 'Jenis Jurusan', 'trim|required');

                            $this->form_validation->set_rules('semester', 'Semester', 'trim|required');
                            $this->form_validation->set_rules('ip_semester', 'IPK', 'trim|required');

                            if ($this->form_validation->run() == true) {

                                //cek apakah ada qry_validation ?

                                if ($this->cek_kategori_qry_validation($data['detail']['id'])) {

                                    $wil = explode(':', $this->input->post('wilayah'));

                                    $wil_id   = $wil[0];
                                    $wil_desa = $wil[1];
                                    $wil_kec  = $wil[2];
                                    $wil_kab  = $wil[3];

                                    $password = generateRandomString(6);
                                    $input    = array(
                                        'kategori_id'   => $data['detail']['id'],
                                        'nik'           => $this->input->post('nik'),
                                        'nidn'          => $this->input->post('nidn'),
                                        'password'      => md5($password),
                                        'nama_lengkap'  => $this->input->post('nama_lengkap'),

                                        'kelurahan_id'  => $wil_id,
                                        'kelurahan'     => $wil_desa,
                                        'kecamatan'     => $wil_kec,
                                        'kab_kota'      => $wil_kab,
                                        'alamat_rumah'  => $this->input->post('alamat_rumah'),

                                        'kota_lahir'    => $this->input->post('kota_lahir'),
                                        'tgl_lahir'     => $this->input->post('tgl_lahir'),
                                        'jk'            => $this->input->post('jk'),
                                        'no_hp'         => $this->input->post('no_hp'),
                                        'email'         => $this->input->post('email'),
                                        'nama_lembaga'  => $this->input->post('nama_lembaga'),
                                        'akreditasi'    => $this->input->post('akreditasi'),
                                        'program_studi' => $this->input->post('program_studi'),
                                        'jenis_jurusan' => $this->input->post('jenis_jurusan'),
                                        'semester'      => $this->input->post('semester'),
                                        'ip_semester'   => str_replace(',', '.', $this->input->post('ip_semester')),
                                    );

                                    $this->db->insert('pendaftar', $input);

                                    $message = "Berikut ini adalah informasi yang anda butuhkan untuk login <br />";
                                    $message .= "Username : (NIK / Email anda)<br />";
                                    $message .= "Password : " . $password;
                                    $message .= "<hr />";
                                    $message .= "{timestamp:" . date("Y-m-d H:i:s") . "}";
                                    sendEmail($this->input->post('email'), 'Informasi Login ' . site_url(), $message, 'none');

                                    $message = "Berikut ini adalah informasi yang anda butuhkan untuk login ";
                                    $message .= "Username : (NIK / Email anda) ";
                                    $message .= "Password : " . $password;
                                    sendWa($this->input->post('no_hp'), $message);

                                    //phase two complete when email in session
                                    $this->session->set_userdata(array('email' => $this->input->post('email')));

                                    redirect(site_url('pendaftaran/index/' . $slug), 'reload');
                                }
                            } else {
                                $this->alert->set('alert-danger', validation_errors(), true);
                            }
                        } else {
                            $this->alert->set('alert-danger', 'Validasi reCaptcha Error', true);
                        }
                    }

                    break;

                default:
                    break;
            }
        }

        $this->load->view('master', $data);
        // compress_output();
    }
}
