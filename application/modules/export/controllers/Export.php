<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Export extends MX_Controller
{


    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->database();
    }

    public function query($param,$tahun_aktif){

        $expParam = explode('/', base64url_decode($param));
        
        $file_type     = $expParam[0];
        $slug_kategori = $expParam[1];
        $range         = $expParam[2];

        switch ($file_type) {
            case 'pdf':
                $kategori = $this->db->get_where('kategori', array('slug' => $slug_kategori))->row_array();
                if ($range === 'semua') {
                    //semua
                    $recordset = null;

                    if ($kategori['level_penerima'] === 'pelajar') {
                        //pelajar
                        $this->db->select(
                            "nik,nama_lengkap,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
                            tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                            email,nama_lembaga AS `Nama Sekolah`,kelas,semester"
                        );

                        $this->db->where('status <>', 'ditolak');
                        $this->db->where('YEAR(created_at)', $tahun_aktif);

                        $this->db->order_by('nama_lengkap', 'ASC');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
                    } else {
                        //mahasiswa
                        $this->db->select(
                            "nik,nama_lengkap,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
                            tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                            email,nama_lembaga AS `Nama Universitas`,
                            program_studi,akreditasi,semester,ip_semester"
                        );

                        $this->db->where('status <>', 'ditolak');
                        $this->db->where('YEAR(created_at)', $tahun_aktif);

                        $this->db->order_by('ip_semester', 'DESC');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
                    }

                    //$ctlObj = modules::load('export/export/')->pdf('semua-' . $slug_kategori, $recordset);
                    $this->pdf('semua-' . $slug_kategori, $recordset);
                } else {
                    //terpilih
                    $recordset = null;

                    if ($kategori['level_penerima'] === 'pelajar') {
                        //pelajar
                        $this->db->select(
                            "nik,nama_lengkap,kab_kota,kecamatan,kelurahan, alamat_rumah,kota_lahir,
                            tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                            email,nama_lembaga AS `Nama Sekolah`,kelas,semester"
                        );

                        $this->db->order_by('nama_lengkap', 'ASC');
                        $this->db->where('status', 'diterima');
                        $this->db->where('YEAR(created_at)', $tahun_aktif);

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
                    } else {
                        //mahasiswa
                        $this->db->select(
                            "nik,nama_lengkap,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
                            tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                            email,nama_lembaga AS `Nama Universitas`,
                            program_studi,akreditasi,semester,ip_semester"
                        );

                        $this->db->where('status', 'diterima');
                        $this->db->where('YEAR(created_at)', $tahun_aktif);
                        $this->db->order_by('ip_semester', 'DESC');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
                    }

                    //$ctlObj = modules::load('export/export/')->pdf('terpilih-' . $slug_kategori, $recordset);
                    $this->pdf('terpilih-' . $slug_kategori, $recordset);
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
                            "nik,nama_lengkap,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
                            tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                            email,nama_lembaga AS `Nama Sekolah`,kelas,semester"
                        );

                        $this->db->where('status <>', 'ditolak');
                        $this->db->where('YEAR(created_at)', $tahun_aktif);
                        $this->db->order_by('nama_lengkap', 'ASC');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
                    } else {
                        //mahasiswa
                        $this->db->select(
                            "nik,nama_lengkap,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
                            tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                            email,nama_lembaga AS `Nama Universitas`,
                            program_studi,akreditasi,semester,ip_semester"
                        );

                        $this->db->where('status <>', 'ditolak');
                        $this->db->where('YEAR(created_at)', $tahun_aktif);
                        $this->db->order_by('ip_semester', 'DESC');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
                    }

                    //$ctlObj = modules::load('export/export/')->excel('semua-' . $slug_kategori, $recordset);
                    $this->excel('semua-' . $slug_kategori, $recordset);
                } else {
                    //terpilih
                    $recordset = null;

                    if ($kategori['level_penerima'] === 'pelajar') {
                        //pelajar
                        $this->db->select(
                            "nik,nama_lengkap,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
                            tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                            email,nama_lembaga AS `Nama Sekolah`,kelas,semester"
                        );

                        $this->db->where('YEAR(created_at)', $tahun_aktif);
                        $this->db->order_by('nama_lengkap', 'ASC');
                        $this->db->where('status', 'diterima');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
                    } else {
                        //mahasiswa
                        $this->db->select(
                            "nik,nama_lengkap,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
                            tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                            email,nama_lembaga AS `Nama Universitas`,
                            program_studi,akreditasi,semester,ip_semester"
                        );

                        $this->db->where('YEAR(created_at)', $tahun_aktif);
                        $this->db->where('status', 'diterima');
                        $this->db->order_by('ip_semester', 'DESC');

                        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
                    }

                    //$ctlObj = modules::load('export/export/')->excel('terpilih-' . $slug_kategori, $recordset);
                    $this->excel('terpilih-' . $slug_kategori, $recordset);
                }

                break;

            default:
                # code...
                break;
        }

    }

    public function pdf($fileName, $recordSet)
    {
        // error_reporting(E_ALL);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $data = array();

        $pdfFilePath = FCPATH . 'temp/' . $fileName . '-' . date('dMy') . '.pdf';

        //boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
        ini_set('memory_limit', '256M');
        // phpinfo();


        $data['rs'] = $recordSet;

        $html = $this->load->view('template_export_data', $data, true); // render the view into HTML
        //  $this->load->view('template_export_data', $data); // render the view into HTML
        // echo $pdfFilePath;
        // exit(0);


        $pdf = new \Mpdf\Mpdf();

        $pdf->AddPage('L', 'A4');
        $footer = '<table width="100%"><tr><td>{PAGENO}/{nbpg}</td></tr></table>';
        $pdf->SetHTMLFooter($footer);

        $css = 'table { border-collapse: collapse; } th, td { border: 1px solid black; padding: 5px; }';
        $pdf->WriteHTML('<style>' . $css . '</style>', \Mpdf\HTMLParserMode::HEADER_CSS);
        $pdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

        $pdf->Output($pdfFilePath, 'F');

        $this->load->helper('download');
        $data = file_get_contents($pdfFilePath);
        $name = $fileName . '_' . date('dMy') . '.pdf';

        @force_download($name, $data);
        error_reporting(E_ALL);
    }

    public function excel($fileName, $recordSet, $heightRow = 70)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if (!$recordSet) {
            return false;
        }

        // Starting the PhpSpreadsheet library
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $spreadsheet->getProperties()->setTitle('export')->setDescription('none');

        $worksheet = $spreadsheet->getActiveSheet();

        // Field names in the first row
        $fields = $recordSet->list_fields();
        $col = 1;
        foreach ($fields as $field) {
            $worksheet->setCellValueByColumnAndRow($col, 1, strtoupper(str_replace('_', ' ', $field)));
            $worksheet->getRowDimension(1)->setRowHeight(30);
            ++$col;
        }

        // Fetching the table data
        $row = 2;
        foreach ($recordSet->result() as $data) {
            $col = 1;
            foreach ($fields as $field) {
                $worksheet->setCellValueByColumnAndRow($col, $row, $data->$field);
                ++$col;
            }

            //set row height
            $worksheet->getRowDimension($row)->setRowHeight($heightRow);

            ++$row;
        }

        foreach (range('A', 'F') as $columnID) {
            $worksheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $num_rows = $recordSet->num_rows() + 1;

        foreach (range('A', 'F') as $columnID) {
            $worksheet->getStyle($columnID . '1:' . $columnID . $num_rows)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);

        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '-' . date('dMy') . '.xls"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        error_reporting(E_ALL);
    }
}
