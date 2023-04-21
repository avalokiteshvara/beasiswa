<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Questions extends MX_Controller
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
    

    $level             = $this->session->userdata('user_level');
    $this->tahun_aktif = get_settings('small-text', 'tahun_aktif');

    if ($level !== 'questions') {
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

  
  public function index()
  {
    $this->breadcrumbs->push('Dashboard', '/questions');

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
        $select .= '  $.post( "' . site_url('questions/change-question-visible') . '", { id: "' . $row->id . '", tampil: this.value , isreply: "Y"} );';
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

  public function daftar()
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
        $select .= '  $.post( "' . site_url('questions/change-question-visible') . '", { id: "' . $row->id . '", tampil: this.value , isreply : "N" } );';
        $select .= '});';
        $select .= '</script>';

        return $select;
      });

      $crud->callback_column('topik', function ($value, $row) {
        return '<a href="' . site_url('questions/question-detail/' . $row->id) . '">' . limit_text($value, 50) . '</a>';
      });

      $crud->unset_add();

      $this->breadcrumbs->push('Dashboard', '/questions');
      $this->breadcrumbs->push('Data Pertanyaan', '/questions/pertanyaan');

      $extra  = array('page_title' => 'Data Pertanyaan');
      $output = $crud->render();

      $output = array_merge((array) $output, $extra);

      $this->_page_output($output);
    } catch (\Exception $e) {
      show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
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
          redirect(site_url('questions/ganti-password'), 'reload');
        } else {
          $pass_baru   = $this->input->post('pass_baru');
          $pass_ulangi = $this->input->post('pass_ulangi');

          if ($pass_baru !== $pass_ulangi) {
            $this->alert->set('alert-danger', 'Password baru & ulangan harus sama');
            redirect(site_url('questions/ganti-password'), 'reload');
          } else {
            $realname = $this->input->post('realname');
            $email    = $this->input->post('email');

            $this->db->where('id', $user_id);
            $this->db->update('user', array('password' => md5($pass_ulangi)));

            $this->alert->set('alert-success', 'Password berhasil diupdate');
            redirect(site_url('questions/ganti-password'), 'reload');
          }
        }
      } else {
        $this->alert->set('alert-danger', 'Password Lama Salah');
        redirect(site_url('questions/ganti-password'), 'reload');
      }
    }

    $data['page_name'] = 'ganti_password';

    $this->breadcrumbs->push('Beranda', '/questions');
    $this->breadcrumbs->push('Ganti Password', '/questions/ganti_password');

    $data['page_title'] = 'Ganti Password';

    $this->_page_output($data);
  }
  //</profile>

  
}
