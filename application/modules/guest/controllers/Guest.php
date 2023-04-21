<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Guest extends MX_Controller
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
    $this->load->model('Guest_model', 'guest_m');

    $level = $this->session->userdata('user_level');
    if ($level !== 'guest') {
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
    $this->breadcrumbs->push('Dashboard', '/guest');

    $data['page_name'] = 'beranda';
    $data['page_title'] = 'Beranda';
    $this->_page_output($data);
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
      $crud->order_by('nama', 'ASC');

      $crud->field_type('slug', 'hidden');

      $crud->display_as('tgl_buka', 'Dibuka');
      $crud->display_as('tgl_tutup', 'Ditutup');
      $crud->display_as('jml_penerima', 'Quota');
      $crud->display_as('ip_minimal', 'IPK Minimal');
      $crud->display_as('strict_ip_minimal', 'Keharusan IPK Minimal ?');
      $crud->display_as('set_jenis_dokumen', 'Dokumen yang dapat diunggah');

      $crud->required_fields(
        'level_penerima',
        'status_pendaftaran',
        'nama',
        'persyaratan',
        'tgl_buka',
        'tgl_tutup',
        'jml_penerima'
      );

      $crud->columns('nama', 'tgl_buka', 'tgl_tutup', 'jml_penerima', 'status', 'pendaftar');

      $crud->callback_column('pendaftar', function ($value, $row) {
        $this->db->where('kategori_id', $row->id);
        $count_pendaftar = $this->db->count_all_results('pendaftar');
        return '<a href="' . site_url('guest/pendaftar_ajax/' . $row->slug) . '">Lihat (' . $count_pendaftar . ' Pendaftar) </a>';
      });

      $crud->unset_delete();
      $crud->unset_edit();
      $crud->unset_add();


      $crud->callback_column('status', function ($value, $row) {
        if ($row->status_pendaftaran === 'tutup') {
          return '<span class="badge bg-danger">Tutup</span>';
        } else {
          return '<span class="badge bg-success">Buka</span>';
        }
        //return '<a href="' . site_url('guest/qry_validation/' . $row->id) .'">Manage</a>';
      });


      //tags
      $this->db->order_by('nama ASC');
      $dokuments = $this->db->get('jenis_dokumen');

      $set_jenis_dokumen = array();
      foreach ($dokuments->result_array() as $row) {
        $set_jenis_dokumen[$row['id']] = $row['nama'];
      }

      $this->breadcrumbs->push('Dashboard', '/guest');
      $this->breadcrumbs->push('Kategori Beasiswa', '/guest/kategori-beasiswa');

      $crud->field_type('set_jenis_dokumen', 'multiselect', $set_jenis_dokumen);

      $extra = array('page_title' => 'Kategori beasiswa');
      $output = $crud->render();

      $output = array_merge((array) $output, $extra);

      $this->_page_output($output);
    } catch (Exception $e) {
      show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
    }
  }



  public function pendaftar_ajax()
  {

    $slug = $this->uri->segment(3);
    $kat = $this->db->get_where('kategori', array('slug' => $slug));

    if ($kat->num_rows() == 0) {
      redirect(site_url('guest'), 'reload');
    }

    $kategori = $kat->row_array();
    $this->breadcrumbs->push('Dashboard', '/guest');
    $this->breadcrumbs->push('Kategori Beasiswa', '/guest/kategori-beasiswa');
    $this->breadcrumbs->push($kategori['nama'], '/guest/pendaftar/' . $slug);

    // echo $kategori['level_penerima'];
    if ($kategori['level_penerima'] === 'pelajar') {
      $data['page_name'] = 'pendaftar_pelajar_ajax';
      $data['page_title'] = 'Data Pendaftar';
    } else {

      $data['page_name'] = 'pendaftar_mahasiswa_ajax';
      $data['page_title'] = 'Data Pendaftar';
    }

    $this->_page_output($data);
  }

  function load_dokumen()
  {
    $pendaftar_id = $this->input->get('pendaftar_id');
    $slug = base64url_decode($this->input->get('slug'));

    // echo base64url_decode($slug);

    $dok = "<table class='table table-striped'>";
    $dok .= " <tbody>";
    $kategori = $this->db->get_where('kategori', array('slug' => $slug))->row_array();
    $jenis_dokumen = explode(',', $kategori['set_jenis_dokumen']);
    $i = 1;
    foreach ($jenis_dokumen as $jd) {

      $jenis_dokumen = jenis_dokumen($jd);

      if ($jenis_dokumen == '') continue;

      $dok .= " <tr id=\"tr_" .  $i . "\" data-bs-toggle=\"collapse\" data-bs-target=\"#r" . $i . "\">";
      $dok .= "   <td>" . $jenis_dokumen . "</td>";

      $cek = $this->db->get_where('dokumen_pendaftar', array('jenis_dokumen_id' => $jd, 'pendaftar_id' => $pendaftar_id));
      if ($cek->num_rows() > 0) {
        $dokumen_pendaftar = $cek->row_array();
        $dok .= "<td><a href='" . site_url('uploads/dokumen/' . $dokumen_pendaftar['file_dokumen']) . "'>Download</a></td>";
        $dok .= "<td id='td_" . $dokumen_pendaftar['id'] . "'>";
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
          redirect(site_url('guest/ganti-password'), 'reload');
        } else {
          $pass_baru = $this->input->post('pass_baru');
          $pass_ulangi = $this->input->post('pass_ulangi');

          if ($pass_baru !== $pass_ulangi) {
            $this->alert->set('alert-danger', 'Password baru & ulangan harus sama');
            redirect(site_url('guest/ganti-password'), 'reload');
          } else {
            $realname = $this->input->post('realname');
            $email = $this->input->post('email');

            $this->db->where('id', $user_id);
            $this->db->update('user', array('password' => md5($pass_ulangi)));

            $this->alert->set('alert-success', 'Password berhasil diupdate');
            redirect(site_url('guest/ganti-password'), 'reload');
          }
        }
      } else {
        $this->alert->set('alert-danger', 'Password Lama Salah');
        redirect(site_url('guest/ganti-password'), 'reload');
      }
    }


    $data['page_name'] = 'ganti_password';

    $this->breadcrumbs->push('Beranda', '/guest');
    $this->breadcrumbs->push('Ganti Password', '/guest/ganti_password');

    $data['page_title'] = 'Ganti Password';

    $this->_page_output($data);
  }
  //</profile>





}
