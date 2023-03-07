<?php

defined('BASEPATH') or exit('No direct script access allowed');
//https://betterexplained.com/articles/how-to-optimize-your-site-with-gzip-compression/
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();

class Web extends CI_Controller
{
    private $data = array();

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');

        $this->load->helper(array('url', 'libs','form','alert'));
        $this->load->database();

        $this->load->libraries(array('session','form_validation','alert'));
        // $this->load->model('Web_model', 'web_m');

    }

    // public function test_email(){
    //   send_email('kirana.avalokiteshvara@gmail.com','reset password','test','none');
    // }

    public function cek_hasil(){
      header('content-type: application/json');

      $nik = $this->input->post('nik');

      $this->db->select('a.nik,a.nama_lengkap,b.nama AS kategori,a.status,a.status_akhir');
      $this->db->join('kategori b','a.kategori_id = b.id','left');
      $cek = $this->db->get_where('pendaftar a',array('a.nik' => $nik));

      if($cek->num_rows() > 0){
        $pendaftar = $cek->row_array();
        $status = $pendaftar['status'];
        if( $status === 'pending'){
          echo json_encode( array('alert_class' => 'alert-info','msg' => 'Berkas anda sedang diproses'));
        }elseif ($status === 'diterima') {
          $status_akhir = $pendaftar['status_akhir'];

          $msg = '<table>';
          $msg = '<tr><td>Nama</td><td>' . $pendaftar['nama_lengkap'] .'</td></tr>';
          $msg .= '<tr><td>Kategori</td><td>' . $pendaftar['kategori']  .'</td></tr>';
          $msg .= '<tr><td>Tahap Uji Bahan</td><td>' . strtoupper($status) .'</td></tr>';
          $msg .= '<tr><td>Tahap Uji Akhir</td><td>' . strtoupper($status_akhir) .' </td></tr>';
          $msg .= '</table>';
          echo json_encode(
            array(
              'alert_class' => 'alert-success',
              'msg'         => $msg )
          );
        }else{
          echo json_encode( array('alert_class' => 'alert-warning','msg' => '<strong>Maaf&nbsp;' . $pendaftar['nama_lengkap'] .'</strong>, Berkas anda dinyatakan <strong>TIDAK</strong> lolos uji bahan'));
        }

      }else{
        echo json_encode( array('alert_class' => 'alert-danger','msg' => 'NIK tidak ditemukan! Mohon periksa kembali NIK yang anda masukkan'));
      }


    }

    public function index()
    {
      $this->load->library('recaptcha');

      if(!empty($_POST)){

        switch ($_POST['submit']) {

          case 'login':
            $captcha_answer = $this->input->post('g-recaptcha-response');
            $response       = $this->recaptcha->verifyResponse($captcha_answer);

            // if ($response['success']) {
              $this->form_validation->set_rules('username', 'NIK / Email', 'required');
              $this->form_validation->set_rules('password', 'Password', 'required');

              if ($this->form_validation->run() == true) {

                $username = $this->input->post('username');
                $password = md5($this->input->post('password'));

                $this->db->where('password',$password);
                $this->db->group_start();
                $this->db->where('nik',$username);
                $this->db->or_where('email',$username);
                $this->db->group_end();
                $cek = $this->db->get('pendaftar');

                if($cek->num_rows() > 0){
                  $pendaftar = $cek->row_array();

                  $this->session->set_userdata(
                    array(
                      'user_id'           => $pendaftar['id'],
                      'user_kategori_id'  => $pendaftar['kategori_id'],
                      'user_nik'          => $pendaftar['nik'],
                      'user_email'        => $pendaftar['email'],
                      'user_nama_lengkap' => $pendaftar['nama_lengkap'],
                      'user_level'        => 'peserta'
                    )
                  );

                  redirect(site_url('peserta'),'reload');
                }else{
                  $this->alert->set('alert-danger', "User tidak ditemukan! Periksa kembali Email atau NIK dan Password yang anda masukkan" , false);
                }
              }else{
                $this->alert->set('alert-danger', "Periksa kembali data yang anda masukkan" , false);
              }
            // }else{
            //   $this->alert->set('alert-danger', 'Validasi reCaptcha Error' , false);
            // }

            redirect(site_url('web'),'reload');

            break;

          case 'reset-password':

            $email = $this->input->post('email');
            $cek = $this->db->get_where('pendaftar',array('email' => $email));
            if($cek->num_rows() > 0){

              // $token_reset_password = generate_uuid();
              //
              // $this->db->where('email',$email);
              // $this->db->update('pendaftar',array('token_reset_password' => $token_reset_password ));

              //function send_email($recipient_email_address,$subject,$message,$attachment){
              // $message = "Seseorang telah melakukan permintaan reset password akun anda <br />";
              // $message .= "Jika anda tidak merasa melakukan hal ini, jangan hiraukan permintaan ini<br />";
              // $message .= "Klik <a href='" . site_url('web/reset-password/' . $token_reset_password) . "'>disini</a> jika anda ingin mereset password anda";
              $new_pass = generateRandomString(6);

              $this->db->where('email',$email);
              $this->db->update('pendaftar',array('password' => md5($new_pass)));

              $message = "Berikut ini adalah password anda yang baru : " . $new_pass;

              $message .= "<hr />";
              $message .= "{timestamp:" .  date("Y-m-d H:i:s") . "}";
              send_email($email,'reset password',$message,'none');
              // echo "<script>alert('Silahkan buka email anda untuk langkah selanjutnya');</script>";
              $this->alert->set('alert-success', 'Silahkan cek email untuk langkah selanjutnya' , false);
            }

            redirect(site_url('web'),'reload');

            break;
        }

        // var_dump($response);
      }

      $data['faqs'] = $this->db->get('faq');
      $data['rundown'] = $this->db->get_where('web_content',array('judul' => 'rundown'))->row_array();
      $data['juknis'] = $this->db->get_where('web_content',array('judul' => 'juknis'))->row_array();

      $data['kategori'] =  $this->db->get('kategori');
      $this->session->unset_userdata('nik');
      $this->session->unset_userdata('email');
      $this->load->view('web/master.php',$data);
      // compress_output();
    }


    public function reset_password(){
      $token_reset_password = $this->uri->segment(3);

      //cek apakah token valid
      $cek = $this->db->get_where('pendaftar',array('token_reset_password' => $token_reset_password));
      if($cek->num_rows() == 0){
        echo '<script>
                alert("Token tidak valid!");
                window.location = "' . site_url('web') . '";
              </script>';
      }

      if(!empty($_POST)){
        $this->form_validation->set_rules('new_pass', 'Password baru', 'required');
        $this->form_validation->set_rules('repeat_pass', 'Password ulangi', 'required|matches[new_pass]');

        if ($this->form_validation->run() == true) {
          $new_password = $this->input->post('new_pass');
          $this->db->where('token_reset_password',$token_reset_password);
          $this->db->update('pendaftar',array('password' => md5($new_password),'token_reset_password' => generate_uuid()));
          echo '<script>
                  alert("Password berhasil dirubah. Silahkan melakukan login dengan password yang baru");
                  window.location = "' . site_url('web') . '";
                </script>';
        }else{
          echo "<script>alert('Password tidak sama!');</script>";
        }
      }

      $this->load->view('reset_password');
    }



}
