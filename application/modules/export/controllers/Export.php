<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Export extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->database();
    }

    // public function query($param, $tahun_aktif)
    // {

    //     $expParam = explode('/', base64url_decode($param));

    //     $file_type     = $expParam[0];
    //     $slug_kategori = $expParam[1];
    //     $range         = $expParam[2];

    //     switch ($file_type) {
    //         case 'pdf':
    //             $kategori = $this->db->get_where('kategori', array('slug' => $slug_kategori))->row_array();
    //             if ($range === 'semua') {
    //                 //semua
    //                 $recordset = null;

    //                 if ($kategori['level_penerima'] === 'pelajar') {
    //                     //pelajar
    //                     $this->db->select(
    //                         "nik,UPPER(nama_lengkap) AS `Nama lengkap`,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
    //                         tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
    //                         email,nama_lembaga AS `Nama Sekolah`,kelas,semester"
    //                     );

    //                     $this->db->where('status <>', 'ditolak');
    //                     $this->db->where('YEAR(created_at)', $tahun_aktif);

    //                     $this->db->order_by('nama_lengkap', 'ASC');

    //                     $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
    //                 } else {
    //                     //mahasiswa & Dosen
    //                     if ($kategori['level_penerima'] === 'mahasiswa') {
    //                         $this->db->select(
    //                             "nik,nokk,UPPER(nama_lengkap) AS `Nama lengkap`,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
    //                             tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
    //                             email,nama_lembaga AS `Nama Universitas`,
    //                             program_studi,akreditasi,semester,ip_semester"
    //                         );
    //                     } else {
    //                         $this->db->select(
    //                             "nik,nokk,nidn,UPPER(nama_lengkap) AS `Nama lengkap`,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
    //                             tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
    //                             email,nama_lembaga AS `Nama Universitas`,
    //                             program_studi,akreditasi,semester,ip_semester"
    //                         );
    //                     }

    //                     $this->db->where('status <>', 'ditolak');
    //                     $this->db->where('YEAR(created_at)', $tahun_aktif);

    //                     $this->db->order_by('ip_semester', 'DESC');

    //                     $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
    //                 }

    //                 //$ctlObj = modules::load('export/export/')->pdf('semua-' . $slug_kategori, $recordset);
    //                 $header = 'Data Semua Pendaftar ' . $kategori['nama'] . ' Tahun ' . $tahun_aktif;
    //                 $this->pdf('semua-' . $slug_kategori, $recordset, $header);
    //             } else {
    //                 //terpilih
    //                 $recordset = null;

    //                 if ($kategori['level_penerima'] === 'pelajar') {
    //                     //pelajar
    //                     $this->db->select(
    //                         "nik,UPPER(nama_lengkap) AS `Nama lengkap`,kab_kota,kecamatan,kelurahan, alamat_rumah,kota_lahir,
    //                         tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
    //                         email,nama_lembaga AS `Nama Sekolah`,kelas,semester"
    //                     );

    //                     $this->db->order_by('nama_lengkap', 'ASC');
    //                     $this->db->where('status', 'diterima');
    //                     $this->db->where('YEAR(created_at)', $tahun_aktif);

    //                     $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
    //                 } else {
    //                     //mahasiswa
    //                     if ($kategori['level_penerima'] === 'mahasiswa') {
    //                         $this->db->select(
    //                             "nik,nokk,UPPER(nama_lengkap) AS `Nama lengkap`,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
    //                             tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
    //                             email,nama_lembaga AS `Nama Universitas`,
    //                             program_studi,akreditasi,semester,ip_semester"
    //                         );
    //                     } else {
    //                         $this->db->select(
    //                             "nik,nokk,nidn,UPPER(nama_lengkap) AS `Nama lengkap`,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
    //                             tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
    //                             email,nama_lembaga AS `Nama Universitas`,
    //                             program_studi,akreditasi,semester,ip_semester"
    //                         );
    //                     }

    //                     $this->db->where('status', 'diterima');
    //                     $this->db->where('YEAR(created_at)', $tahun_aktif);
    //                     $this->db->order_by('ip_semester', 'DESC');

    //                     $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
    //                 }

    //                 //$ctlObj = modules::load('export/export/')->pdf('terpilih-' . $slug_kategori, $recordset);
    //                 $header = 'Data Pendaftar Diterima ' . $kategori['nama'] . ' Tahun ' . $tahun_aktif;
    //                 $this->pdf('terpilih-' . $slug_kategori, $recordset, $header);
    //             }

    //             break;

    //         case 'excel':
    //             $kategori = $this->db->get_where('kategori', array('slug' => $slug_kategori))->row_array();
    //             if ($range === 'semua') {
    //                 //semua
    //                 $recordset = null;

    //                 if ($kategori['level_penerima'] === 'pelajar') {
    //                     //pelajar
    //                     $this->db->select(
    //                         "nik,UPPER(nama_lengkap) AS `Nama lengkap`,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
    //                         tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
    //                         email,nama_lembaga AS `Nama Sekolah`,kelas,semester"
    //                     );

    //                     $this->db->where('status <>', 'ditolak');
    //                     $this->db->where('YEAR(created_at)', $tahun_aktif);
    //                     $this->db->order_by('nama_lengkap', 'ASC');

    //                     $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
    //                 } else {
    //                     //mahasiswa
    //                     if ($kategori['level_penerima'] === 'mahasiswa') {
    //                         $this->db->select(
    //                             "nik,nokk,UPPER(nama_lengkap) AS `Nama lengkap`,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
    //                             tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
    //                             email,nama_lembaga AS `Nama Universitas`,
    //                             program_studi,akreditasi,semester,ip_semester"
    //                         );
    //                     } else {
    //                         $this->db->select(
    //                             "nik,nokk,nidn,UPPER(nama_lengkap) AS `Nama lengkap`,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
    //                             tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
    //                             email,nama_lembaga AS `Nama Universitas`,
    //                             program_studi,akreditasi,semester,ip_semester"
    //                         );
    //                     }

    //                     $this->db->where('status <>', 'ditolak');
    //                     $this->db->where('YEAR(created_at)', $tahun_aktif);
    //                     $this->db->order_by('ip_semester', 'DESC');

    //                     $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
    //                 }

    //                 //$ctlObj = modules::load('export/export/')->excel('semua-' . $slug_kategori, $recordset);
    //                 $this->excel('semua-' . $slug_kategori, $recordset);
    //             } else {
    //                 //terpilih
    //                 $recordset = null;

    //                 if ($kategori['level_penerima'] === 'pelajar') {
    //                     //pelajar
    //                     $this->db->select(
    //                         "nik,UPPER(nama_lengkap) AS `Nama lengkap`,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
    //                         tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
    //                         email,nama_lembaga AS `Nama Sekolah`,kelas,semester"
    //                     );

    //                     $this->db->where('YEAR(created_at)', $tahun_aktif);
    //                     $this->db->order_by('nama_lengkap', 'ASC');
    //                     $this->db->where('status', 'diterima');

    //                     $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
    //                 } else {
    //                     //mahasiswa
    //                     if ($kategori['level_penerima'] === 'mahasiswa') {
    //                         $this->db->select(
    //                             "nik,nokk,UPPER(nama_lengkap) AS `Nama lengkap`,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
    //                             tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
    //                             email,nama_lembaga AS `Nama Universitas`,
    //                             program_studi,akreditasi,semester,ip_semester"
    //                         );
    //                     } else {
    //                         $this->db->select(
    //                             "nik,nokk,nidn,UPPER(nama_lengkap) AS `Nama lengkap`,kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
    //                             tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
    //                             email,nama_lembaga AS `Nama Universitas`,
    //                             program_studi,akreditasi,semester,ip_semester"
    //                         );
    //                     }

    //                     $this->db->where('YEAR(created_at)', $tahun_aktif);
    //                     $this->db->where('status', 'diterima');
    //                     $this->db->order_by('ip_semester', 'DESC');

    //                     $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));
    //                 }

    //                 //$ctlObj = modules::load('export/export/')->excel('terpilih-' . $slug_kategori, $recordset);
    //                 $this->excel('terpilih-' . $slug_kategori, $recordset);
    //             }

    //             break;

    //         default:
    //             # code...
    //             break;
    //     }
    // }

    public function query($param, $tahun_aktif)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $expParam = explode('/', base64url_decode($param));

        $file_type     = $expParam[0];
        $slug_kategori = $expParam[1];
        $range         = $expParam[2];

        $kategori  = $this->db->get_where('kategori', array('slug' => $slug_kategori))->row_array();
        $recordset = null;

        $level_penenerima = $kategori['level_penerima'];
        if ($level_penenerima === 'pelajar') {
            //pelajar
            $this->db->select(
                "nik,UPPER(nama_lengkap) AS `Nama lengkap`,kab_kota,
                kecamatan,kelurahan,alamat_rumah,kota_lahir,
                tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                email,nama_lembaga AS `Nama Sekolah`,kelas,semester"
            );
        } elseif ($level_penenerima === 'mahasiswa') {
            //mahasiswa
            $this->db->select(
                "nik,nokk AS `No. KK`,UPPER(nama_lengkap) AS `Nama lengkap`,
                 kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
                 tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                 email,nama_lembaga AS `Nama Universitas`,
                 program_studi,akreditasi,semester,ip_semester AS `IPK`,
                 (SELECT IF(
                    IFNULL(SUM(bobot),0) = 4,'Internasional',
                    IF(IFNULL(SUM(bobot),0) = 3,'Nasional','Tidak ada' )
                 ) FROM dokumen_pendaftar WHERE pendaftar_id = pendaftar.id) AS `Sertifikat`,
                 (SELECT COUNT(*) FROM penerima_sebelumnya WHERE nik = pendaftar.nik) AS status_penerima_sebelumnya ",
                false
            );
        } else {
            $this->db->select(
                "nik,nokk AS `No. KK`,nidn,UPPER(nama_lengkap) AS `Nama lengkap`,
                 kab_kota,kecamatan,kelurahan,alamat_rumah,kota_lahir,
                tgl_lahir,jk AS jenis_kelamin,no_hp AS `Nomor HP`,
                email,nama_lembaga AS `Nama Universitas`,
                program_studi,akreditasi,semester,ip_semester AS `IPK`,
                (SELECT IF(
                    IFNULL(SUM(bobot),0) = 4,'Internasional',
                    IF(IFNULL(SUM(bobot),0) = 3,'Nasional','Tidak ada' )
                 ) FROM dokumen_pendaftar WHERE pendaftar_id = pendaftar.id) AS `Sertifikat`,
                 (SELECT COUNT(*) FROM penerima_sebelumnya WHERE nik = pendaftar.nik) AS status_penerima_sebelumnya",
                false
            );
        }


        if ($range === 'semua') {
            $this->db->where('YEAR(created_at)', $tahun_aktif);
            if ($kategori['level_penerima'] === 'pelajar') {
                $this->db->where('status <>', 'ditolak');
            }
            // $this->db->order_by('nama_lengkap', 'ASC');
            $header = 'Data Semua Pendaftar ' . $kategori['nama'] . ' Tahun ' . $tahun_aktif;
        } else {
            $this->db->where('YEAR(created_at)', $tahun_aktif);
            $this->db->where('status', 'diterima');
            // $this->db->order_by('ip_semester', 'DESC');
            $header = 'Data Pendaftar Diterima ' . $kategori['nama'] . ' Tahun ' . $tahun_aktif;
        }


        $query_sort_order = explode(",", $kategori['query_sort_order']);
        $count_sort_order = count(array_filter($query_sort_order, 'strlen'));
        if ($count_sort_order > 0) {

            if (in_array('ipk', $query_sort_order)) {
                $this->db->order_by('pendaftar.ip_semester', 'DESC');
            }

            if (in_array('bobot', $query_sort_order)) {
                $this->db->order_by('(SELECT SUM(bobot) FROM dokumen_pendaftar WHERE pendaftar_id = pendaftar.id)', 'DESC');
            }

            if (in_array('created_at', $query_sort_order)) {
                $this->db->order_by('pendaftar.created_at', 'DESC');
            }
        }


        $recordset = $this->db->get_where('pendaftar', array('kategori_id' => $kategori['id']));

        if ($file_type === 'pdf') {
            $this->pdf($range . '-' . $slug_kategori, $recordset, $header);
        } elseif ($file_type === 'excel') {
            $this->excel($range . '-' . $slug_kategori, $recordset, 20, $header);
        }

        error_reporting(E_ALL);
    }

    // public function pdf($fileName, $recordSet, $header = "")
    // {
    //     // error_reporting(E_ALL);
    //     error_reporting(E_ALL);
    //     ini_set('display_errors', 1);

    //     $data = array();

    //     $pdfFilePath = FCPATH . 'temp/' . $fileName . '-' . date('dMy') . '.pdf';

    //     //boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
    //     ini_set("pcre.backtrack_limit", "5000000");
    //     ini_set('memory_limit', '256M');

    //     $data['rs']     = $recordSet;
    //     $data['header'] = $header;

    //     $html = $this->load->view('template_export_data', $data, true); // render the view into HTML

    //     $pdf = new \Mpdf\Mpdf([
    //         'mode'        => 'utf-8',
    //         'format'      => [210, 330],
    //         'orientation' => 'L',
    //     ]);

    //     $pdf->AddPage();

    //     $footer = '<table width="100%"><tr><td>Halaman {PAGENO}/{nbpg}</td></tr></table>';
    //     $pdf->SetHTMLFooter($footer);

    //     $css = 'table { width: 100%; border-collapse: collapse; } th, td { border: 0px solid black; padding: 0; }';

    //     $pdf->WriteHTML('<style>' . $css . '</style>', \Mpdf\HTMLParserMode::HEADER_CSS);
    //     $pdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

    //     $pdf->Output($pdfFilePath, 'F');

    //     $this->load->helper('download');
    //     $data = file_get_contents($pdfFilePath);
    //     $name = $fileName . '_' . date('dMy') . '.pdf';

    //     @force_download($name, $data);
    //     error_reporting(E_ALL);
    // }

    public function pdf($fileName, $recordSet, $header = "")
    {
        set_time_limit(60);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $data        = array();
        $pdfFilePath = FCPATH . 'temp/' . $fileName . '-' . date('dMy') . '.pdf';
        ini_set("pcre.backtrack_limit", "5000000");
        ini_set('memory_limit', '512M'); // Increased memory limit
        $data['rs']     = $recordSet;
        $data['header'] = $header;
        $html           = $this->load->view('template_export_data', $data, true);
        // echo $html;
        // exit(0);
        $pdf            = new \Mpdf\Mpdf([
            'mode'        => 'utf-8',
            'format'      => [210, 330],
            'orientation' => 'L',
        ]);
        $pdf->AddPage();
        $footer = '<table width="100%"><tr><td>Halaman {PAGENO}/{nbpg}</td></tr></table>';
        $pdf->SetHTMLFooter($footer);
        $css = 'table { width: 100%; border-collapse: collapse; } th, td { border: 0px solid black; padding: 0; }';
        $pdf->WriteHTML('<style>' . $css . '</style>', \Mpdf\HTMLParserMode::HEADER_CSS);
        $pdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        $pdf->Output($pdfFilePath, 'F');
        $this->load->helper('download');
        force_download($pdfFilePath, null); // Removed file_get_contents and directly force download
        // error_reporting(E_ALL);
    }

    // public function excel($fileName, $recordSet, $heightRow, $headerText)
    // {
    //     error_reporting(E_ALL);
    //     ini_set('display_errors', 1);

    //     if (!$recordSet) {
    //         return false;
    //     }

    //     // Starting the PhpSpreadsheet library
    //     $spreadsheet = new Spreadsheet();
    //     $spreadsheet->getProperties()->setTitle('export')->setDescription('none');

    //     $worksheet = $spreadsheet->getActiveSheet();

    //     // Set header text

    //     $worksheet->mergeCells('A1:R1'); // Merge cells for the header
    //     $worksheet->setCellValue('A1', $headerText);
    //     $worksheet->getStyle('A1')->getFont()->setBold(true);
    //     $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    //     // Field names in the second row
    //     $fields = $recordSet->list_fields();
    //     $col    = 1;
    //     foreach ($fields as $field) {
    //         $worksheet->setCellValueByColumnAndRow($col, 2, strtoupper(str_replace('_', ' ', $field)));
    //         ++$col;
    //     }

    //     // Fetching the table data
    //     $row = 3;
    //     foreach ($recordSet->result() as $data) {
    //         $col = 1;
    //         foreach ($fields as $field) {
    //             $worksheet->setCellValueByColumnAndRow($col, $row, $data->$field);
    //             ++$col;
    //         }

    //         // Set row height
    //         $worksheet->getRowDimension($row)->setRowHeight($heightRow);

    //         ++$row;
    //     }

    //     // Adjust column width based on content
    //     foreach ($spreadsheet->getActiveSheet()->getColumnIterator() as $column) {
    //         $columnIndex = $column->getColumnIndex();
    //         $spreadsheet->getActiveSheet()->getColumnDimension($columnIndex)->setAutoSize(true);
    //     }

    //     $writer = new Xls($spreadsheet);

    //     // Sending headers to force the user to download the file
    //     header('Content-Type: application/vnd.ms-excel');
    //     header('Content-Disposition: attachment;filename="' . $fileName . '-' . date('dMy') . '.xls"');
    //     header('Cache-Control: max-age=0');

    //     $writer->save('php://output');
    //     error_reporting(E_ALL);
    // }

    public function excel($fileName, $recordSet, $heightRow, $headerText)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if (!$recordSet) {
            return false;
        }

        // Starting the PhpSpreadsheet library
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setTitle('export')->setDescription('none');

        $worksheet = $spreadsheet->getActiveSheet();

        // Set header text
        $worksheet->mergeCells('A1:R1'); // Merge cells for the header
        $worksheet->setCellValue('A1', $headerText);
        $worksheet->getStyle('A1')->getFont()->setBold(true);
        $worksheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Field names in the second row
        $fields = $recordSet->list_fields();
        $col = 1;
        $row = 2; // Row number for field names
        foreach ($fields as $field) {
            if($field == 'status_penerima_sebelumnya') continue;

            $cellCoordinate = Coordinate::stringFromColumnIndex($col) . $row; // Generate the coordinate
            $worksheet->setCellValue($cellCoordinate, strtoupper(str_replace('_', ' ', $field))); // Set the cell value
            $worksheet->getStyle($cellCoordinate)->getFont()->setBold(true); // Set bold font for field names
            ++$col;
        }

        // Fetching the table data
        $row = 3; // Starting row for table data
        foreach ($recordSet->result() as $data) {

            $col = 1;
            foreach ($fields as $field) {
                if($field == 'status_penerima_sebelumnya') continue;
                
                $cellCoordinate = Coordinate::stringFromColumnIndex($col) . $row; // Generate the coordinate
                $cellValue = $data->$field; // Get the cell value

                $cell = $worksheet->setCellValue($cellCoordinate, $cellValue); // Set the cell value
                if ($data->status_penerima_sebelumnya == 1) {
                     // Apply strikethrough if the cell value is 1 and the field is "status_penerima_sebelumnya"
                    $cell->getStyle($cellCoordinate)->getFont()->setStrikethrough(true);
                }
                ++$col;
            }           
            // Set row height
            $worksheet->getRowDimension($row)->setRowHeight($heightRow);

            ++$row;
        }

        // Adjust column width based on content
        foreach ($spreadsheet->getActiveSheet()->getColumnIterator() as $column) {
            $columnIndex = $column->getColumnIndex();
            $spreadsheet->getActiveSheet()->getColumnDimension($columnIndex)->setAutoSize(true);
        }

        $writer = new Xls($spreadsheet);

        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '-' . date('dMy') . '.xls"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        error_reporting(E_ALL);
    }
}
