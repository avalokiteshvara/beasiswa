<?php defined('BASEPATH') or exit('No direct script access allowed');

use BarcodeBakery\Barcode\BCGcode39;
use BarcodeBakery\Common\BCGColor;
use BarcodeBakery\Common\BCGDrawing;
use BarcodeBakery\Common\BCGFontFile;
use PHPMailer\PHPMailer\PHPMailer;

function get_settings($collumn, $title)
{
    $CI = &get_instance();

    $result  = "";
    $setting = $CI->db->get_where('settings', array('title' => $title))->row();

    if ($collumn === 'show') {
        $result_array = explode(';', $setting->show);
        $result       = $result_array[1];
    } elseif ($collumn === 'value-option') {
        $result_array = explode(';', $setting->value);
        $result       = $result_array[1];
    } else {
        $result = $setting->value;
    }

    return $result;
}

function jenis_dokumen($id)
{
    $CI = &get_instance();
    $jd = $CI->db->get_where('jenis_dokumen', array('id' => $id))->row_array();
    return $jd['nama'];
}

function generate_barcode($file_name, $barcode_text, $scale = 2, $fontsize = 18, $thickness = 30)
{
    $font       = new BCGFontFile(APPPATH . 'libraries/font/Arial.ttf', $fontsize);
    $colorBlack = new BCGColor(0, 0, 0);
    $colorWhite = new BCGColor(255, 255, 255);

    // Barcode Part
    $code = new BCGcode39();
    $code->setScale($scale);
    $code->setThickness($thickness);
    $code->setForegroundColor($colorBlack);
    $code->setBackgroundColor($colorWhite);
    $code->setFont($font);
    $code->setChecksum(false);
    $code->parse($barcode_text);

    // Drawing Part
    $drawing = new BCGDrawing($code, $colorWhite);

    // header('Content-Type: image/png');

    $filename_barcode = FCPATH . 'uploads/barcode/' . $file_name . '.png';

    $drawing->finish(BCGDrawing::IMG_FORMAT_PNG, $filename_barcode);

    // var_dump($drawing);
    return $file_name . '.png';
}

function bukti_dapat_beasiswa($pendaftar_id, $download = false)
{
    // var_dump($dp);
    require APPPATH . '/third_party/phpword/PHPWord.php';

    $ci = &get_instance();
    /*get information*/
    $ci->db->select(
        "b.nama AS kategori_beasiswa,
     b.template_lulus,
     a.nik AS nomor_identitas,
     CONCAT(b.prefix_registrasi,'-',LPAD(a.no_urut_group,3,'0')) AS nomor_registrasi,
     a.nama_lengkap"
    );

    $ci->db->join('kategori b', 'a.kategori_id = b.id', 'left');
    $cek = $ci->db->get_where('pendaftar a', array('a.id' => $pendaftar_id));
    if ($cek->num_rows() == 0) {
        redirect(site_url('web'), 'reload');
    }

    $pendaftar = $cek->row_array();

    $template = FCPATH . "uploads/" . $pendaftar['template_lulus'];

    $PHPWord  = new PHPWord();
    $document = $PHPWord->loadTemplate($template);

    $document->setValue('NOMOR_REGISTRASI', $pendaftar['nomor_registrasi']);
    $document->setValue('NAMA', strtoupper($pendaftar['nama_lengkap']));
    $document->setValue('JENJANG', $pendaftar['kategori_beasiswa']);

    $barcode_file = generate_barcode($pendaftar['nomor_identitas'], $pendaftar['nomor_identitas']);

    $barcode = array(
        array(
            'img'  => FCPATH . "uploads/barcode/" . $barcode_file,
            'size' => array(150, 40),
        ),
    );

    $document->replaceStrToImg('BARCODE', $barcode);

    $file_save_path = FCPATH . "uploads/" . $pendaftar['nomor_identitas'] . '-bukti_lolos.docx';
    $document->save($file_save_path);

    if ($download) {
        $ci->load->helper('download');
        $data = file_get_contents($file_save_path); // Read the file's contents
        $name = $pendaftar['nomor_identitas'] . '-bukti_lolos.docx';

        force_download($name, $data);
    } else {
        return $file_save_path;
    }
}

function instrumen_verifikasi($pendaftar_id, $download = false)
{
    // var_dump($dp);
    require APPPATH . '/third_party/phpword/PHPWord.php';
    $template = FCPATH . "uploads/instrumen_penilaian_tahap1.docx";

    $PHPWord  = new PHPWord();
    $document = $PHPWord->loadTemplate($template);

    $ci = &get_instance();
    /*get information*/
    $ci->db->select(
        "b.nama AS kategori_beasiswa,
        CONCAT(b.prefix_registrasi,'-',LPAD(a.no_urut_group,3,'0')) AS nomor_registrasi,
        a.nik AS nomor_identitas,
        a.nama_lengkap"
    );

    $ci->db->join('kategori b', 'a.kategori_id = b.id', 'left');
    $cek = $ci->db->get_where('pendaftar a', array('a.id' => $pendaftar_id));
    if ($cek->num_rows() == 0) {
        redirect(site_url('web'), 'reload');
    }

    $pendaftar = $cek->row_array();

    $document->setValue('NOMOR_REGISTRASI', $pendaftar['nomor_registrasi']);
    $document->setValue('NAMA', strtoupper($pendaftar['nama_lengkap']));
    $document->setValue('KATEGORI_BEASISWA', $pendaftar['kategori_beasiswa']);

    $barcode_file = generate_barcode($pendaftar['nomor_identitas'], $pendaftar['nomor_identitas']);

    $barcode = array(
        array(
            'img'  => FCPATH . "uploads/barcode/" . $barcode_file,
            'size' => array(250, 100),
        ),
    );

    $document->replaceStrToImg('BARCODE', $barcode);

    $file_save_path = FCPATH . "uploads/" . $pendaftar['nomor_identitas'] . '-instrumen_verifikasi.docx';
    $document->save($file_save_path);

    if ($download) {
        $ci->load->helper('download');
        $data = file_get_contents($file_save_path); // Read the file's contents
        $name = $pendaftar['nomor_identitas'] . '-instrumen_verifikasi.docx';

        force_download($name, $data);
    } else {
        return $file_save_path;
    }
}

//<generate_tanda_bukti_pendaftaran>
function bukti_pendaftaran($pendaftar_id, $download = false)
{
    // var_dump($dp);
    require APPPATH . '/third_party/phpword/PHPWord.php';
    $template = FCPATH . "uploads/tanda_bukti_pendaftaran.docx";

    $PHPWord  = new PHPWord();
    $document = $PHPWord->loadTemplate($template);

    $ci = &get_instance();
    /*get information*/
    $ci->db->select(
        "b.nama AS kategori_beasiswa,
     CONCAT(b.prefix_registrasi,'-',LPAD(a.no_urut_group,3,'0')) AS nomor_registrasi,
     a.nik AS nomor_identitas,
     a.nama_lengkap,
     CONCAT(a.kota_lahir, ' , ', a.tgl_lahir) AS tempat_tgl_lahir,
     a.jk AS jenis_kelamin,
     DATE_FORMAT(a.created_at,'%d-%m-%Y / %H:%i:%s') AS tgl_jam_daftar,
     a.file_foto AS foto"
    );

    $ci->db->join('kategori b', 'a.kategori_id = b.id', 'left');
    $cek = $ci->db->get_where('pendaftar a', array('a.id' => $pendaftar_id));
    if ($cek->num_rows() == 0) {
        redirect(site_url('web'), 'reload');
    }

    $pendaftar = $cek->row_array();

    // $dp = array(
    //
    //   'kategori_beasiswa' => $pendaftar['kategori_beasiswa'],
    //   'nomor_registrasi'  => $pendaftar['nomor_registrasi'],
    //   'nomor_identitas'   => $pendaftar['nomor_identitas'],
    //   'nama_lengkap'      => $pendaftar['nama_lengkap'],
    //   'tempat_tgl_lahir'  => $pendaftar['tempat_tgl_lahir'],
    //   'jenis_kelamin'     => $pendaftar['jenis_kelamin'],
    //   'tgl_jam_daftar'    => $pendaftar['tgl_jam_daftar'],
    //   'foto'              => $pendaftar['foto'],
    //
    // );

    $document->setValue('NOMOR_REGISTRASI', $pendaftar['nomor_registrasi']);
    $document->setValue('NOMOR_IDENTITAS', $pendaftar['nomor_identitas']);
    $document->setValue('NAMA', strtoupper($pendaftar['nama_lengkap']));
    $document->setValue('TEMPAT_TGL_LAHIR', $pendaftar['tempat_tgl_lahir']);
    $document->setValue('JENIS_KELAMIN', strtoupper($pendaftar['jenis_kelamin']));
    $document->setValue('TGL_JAM_DAFTAR', $pendaftar['tgl_jam_daftar']);
    $document->setValue('KATEGORI_BEASISWA', $pendaftar['kategori_beasiswa']);

    $lokasi_foto = FCPATH . "uploads/foto/" . $pendaftar['foto'];

    $barcode_file = generate_barcode($pendaftar['nomor_identitas'], $pendaftar['nomor_identitas']);

    //echo $lokasi_foto;
    $foto = array(
        array(
            'img'  => $lokasi_foto,
            'size' => array(151, 227),
        ),
    );

    $barcode = array(
        array(
            'img'  => FCPATH . "uploads/barcode/" . $barcode_file,
            'size' => array(250, 100),
        ),
    );

    $document->replaceStrToImg('FOTO', $foto);
    $document->replaceStrToImg('BARCODE', $barcode);

    $file_save_path = FCPATH . "uploads/" . $pendaftar['nomor_identitas'] . '-bukti_pendaftaran.docx';
    $document->save($file_save_path);

    if ($download) {
        $ci->load->helper('download');
        $data = file_get_contents($file_save_path); // Read the file's contents
        $name = $pendaftar['nomor_identitas'] . '-bukti_pendaftaran.docx';

        force_download($name, $data);
    } else {
        return $file_save_path;
    }
}
//</generate_tanda_bukti_pendaftaran>

function terbilang($x)
{
    $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    if ($x < 12) {
        return " " . $abil[$x];
    } elseif ($x < 20) {
        return Terbilang($x - 10) . "belas";
    } elseif ($x < 100) {
        return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
    } elseif ($x < 200) {
        return " seratus" . Terbilang($x - 100);
    } elseif ($x < 1000) {
        return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
    } elseif ($x < 2000) {
        return " seribu" . Terbilang($x - 1000);
    } elseif ($x < 1000000) {
        return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
    } elseif ($x < 1000000000) {
        return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
    }
}

https: //www.codexworld.com/how-to/validate-date-input-string-in-php/#:~:text=The%20validateDate()%20function%20checks,%24date%20%E2%80%93%20Required.
function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

function generate_uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

function slugify($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

function unslugify($text)
{
    // replace - with space
    $text = str_replace('-', ' ', $text);

    // capitalize each word
    $text = ucwords($text);

    return $text;
}

//https://www.geeksforgeeks.org/generating-otp-one-time-password-in-php/
function generateNumericOTP($n = 10)
{
    // Take a generator string which consist of
    // all numeric digits
    $generator = "1357902468";

    // Iterate for n-times and pick a single character
    // from generator and append it to $result

    // Login for generating a random character from generator
    //     ---generate a random number
    //     ---take modulus of same with length of generator (say i)
    //     ---append the character at place (i) from generator to result

    $result = "";

    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand() % (strlen($generator))), 1);
    }

    // Return result
    return $result;
}

function generateRandomString($length = 10)
{
    $characters       = '23456789abcdefghjkmnpqrstwxyz';
    $charactersLength = strlen($characters);
    $randomString     = '';
    for ($i = 0; $i < $length; ++$i) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

if (!function_exists('base64url_encode')) {
    function base64url_encode($data, $pad = null)
    {
        $data = str_replace(array('+', '/'), array('-', '_'), base64_encode($data));
        if (!$pad) {
            $data = rtrim($data, '=');
        }
        return $data;
    }
}

if (!function_exists('base64url_decode')) {
    function base64url_decode($data)
    {
        return base64_decode(str_replace(array('-', '_'), array('+', '/'), $data));
    }
}

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */

if (!function_exists('file_pathinfo')) {
    function file_pathinfo($filePath)
    {
        $fileParts = pathinfo($filePath);

        if (!isset($fileParts['filename'])) {
            $fileParts['filename'] = substr($fileParts['basename'], 0, strrpos($fileParts['basename'], '.'));
        }

        return $fileParts;
    }
}

if (!function_exists('username_from_email')) {
    function username_from_email($emailaddress)
    {
        $parts = explode("@", $emailaddress);
        return '<strong>' . $parts[0] . '</strong>';
    }
}

if (!function_exists('relative_time')) {
    function relative_time($date)
    {
        $date = substr($date, 0, 10);
        if (preg_match('/\d{4}-\d{2}-\d{2}/', $date)) {
            $date_array = preg_split('/[-\.\/ ]/', $date);
            return date('j M Y', mktime(0, 0, 0, $date_array[1], $date_array[2], $date_array[0]));
        } elseif (empty($date)) {
            return '';
        }
    }
}

if (!function_exists('is_valid_email')) {
    function is_valid_email($emailaddress)
    {
        $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

        if (preg_match($pattern, $emailaddress) === 1) {
            // emailaddress is valid
            return true;
        }

        return false;
    }
}

if (!function_exists('remove_time_from_datetime')) {
    function remove_time_from_datetime($datetime)
    {
        $ex = explode(' ', $datetime);
        return $ex[0];
    }
}

if (!function_exists('nicetime')) {
    function nicetime($date)
    {
        if (empty($date)) {
            return 'tidak ada tanggal yang dimasukkan';
        }

        $periods = array('detik', 'menit', 'jam', 'hari', 'minggu', 'bulan', 'tahun', 'dekade');
        $lengths = array('60', '60', '24', '7', '4.35', '12', '10');

        $now       = time();
        $unix_date = strtotime($date);

        // check validity of date
        if (empty($unix_date)) {
            return 'Bad date';
        }

        // is it future date or past date
        if ($now > $unix_date) {
            $difference = $now - $unix_date;
            $tense      = 'yang lalu';
        } else {
            $difference = $unix_date - $now;
            $tense      = 'dari sekarang';
        }

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; ++$j) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        return "$difference $periods[$j] {$tense}";
    }
}

if (!function_exists('format_rupiah')) {
    function format_rupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('get_settings')) {
    function get_settings($title)
    {
        $CI = &get_instance();

        $result  = "";
        $setting = $CI->db->get_where('settings', array('title' => $title))->row();
        if ($setting->tipe === 'options') {
            $result_array = explode(';', $setting->value);
            $result       = $result_array[1];
        } else {
            $result = $setting->value;
        }

        return $result;
    }
}

function filterHtml($input)
{
    // Remove HTML comments, but not SSI
    $input = preg_replace('/<!--[^#](.*?)-->/s', '', $input);

    // The content inside these tags will be spared:
    $doNotCompressTags = ['script', 'pre', 'textarea'];
    $matches           = [];

    foreach ($doNotCompressTags as $tag) {
        $regex = "!<{$tag}[^>]*?>.*?</{$tag}>!is";

        // It is assumed that this placeholder could not appear organically in your
        // output. If it can, you may have an XSS problem.
        $placeholder = "@@<'-placeholder-$tag'>@@";

        // Replace all the tags (including their content) with a placeholder, and keep their contents for later.
        $input = preg_replace_callback(
            $regex,
            function ($match) use ($tag, &$matches, $placeholder) {
                $matches[$tag][] = $match[0];
                return $placeholder;
            },
            $input
        );
    }

    // Remove whitespace (spaces, newlines and tabs)
    $input = trim(preg_replace('/[ \n\t]+/m', ' ', $input));

    // Iterate the blocks we replaced with placeholders beforehand, and replace the placeholders
    // with the original content.
    foreach ($matches as $tag => $blocks) {
        $placeholder       = "@@<'-placeholder-$tag'>@@";
        $placeholderLength = strlen($placeholder);
        $position          = 0;

        foreach ($blocks as $block) {
            $position = strpos($input, $placeholder, $position);
            if ($position === false) {
                throw new \RuntimeException ("Found too many placeholders of type $tag in input string");
            }
            $input = substr_replace($input, $block, $position, $placeholderLength);
        }
    }

    return $input;
}

if (!function_exists('compress_output')) {
    //http://jeromejaglale.com/doc/php/codeigniter_compress_html
    //http://stackoverflow.com/questions/5312349/minifying-final-html-output-using-regular-expressions-with-codeigniter
    function compress_output()
    {
        $CI = &get_instance();

        $buffer = $CI->output->get_output();
        /*$re = '%# Collapse whitespace everywhere but in blacklisted elements.
        (?>             # Match all whitespans other than single space.
        [^\S ]\s*     # Either one [\t\r\n\f\v] and zero or more ws,
        | \s{2,}        # or two or more consecutive-any-whitespace.
        ) # Note: The remaining regex consumes no text at all...
        (?=             # Ensure we are not in a blacklist tag.
        [^<]*+        # Either zero or more non-"<" {normal*}
        (?:           # Begin {(special normal*)*} construct
        <           # or a < starting a non-blacklist tag.
        (?!/?(?:textarea|pre|script)\b)
        [^<]*+      # more non-"<" {normal*}
        )*+           # Finish "unrolling-the-loop"
        (?:           # Begin alternation group.
        <           # Either a blacklist start tag.
        (?>textarea|pre|script)\b
        | \z          # or end of file.
        )             # End alternation group.
        )  # If we made it here, we are not in a blacklist tag.
        %Six'; */

        // $buffer = preg_replace($re, " ", $buffer);
        $buffer = filterHtml($buffer);

        $CI->output->set_output($buffer);
        // $CI->output->_display();
    }
}

if (!function_exists('limit_text')) {
    function limit_text($string, $limit)
    {
        $string = strip_tags($string);

        if (strlen($string) > $limit) {
            $stringCut = substr($string, 0, $limit);

            $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . ' ... ';
        }

        return $string;
    }
}

if (!function_exists('hide_email')) {
    function hide_email($email)
    {
        return substr($email, 0, 3) . '****' . substr($email, strpos($email, '@'));
    }
}

if (!function_exists('hide_nik')) {
    function hide_nik($nik)
    {
        return substr($nik, 8, 8) . '********';
    }
}

if (!function_exists('load_image')) {
    function load_image($image_path, $width, $height, $zoom = 1, $crop = 1)
    {
        if (is_file($image_path)) {
            $c = new \CoffeeCode\Cropper\Cropper ("./cache");
            return $c->make($image_path, $width, $height);

            //return site_url('thumb?src=' . site_url($image_path) . '&size=' . $width . 'x' . $height . '&zoom=' . $zoom . '&crop=' . $crop);
        } else {
            return 'https://placehold.co/' . $width . 'x' . $height;
        }
    }
}

if (!function_exists('convert_sql_date_to_date')) {
    function convert_sql_date_to_date($date, $php_date_format = 'd/m/Y')
    {
        //2017-05-17
        //17/05/2017
        $date = substr($date, 0, 10);

        if (!empty($date) && $date != '0000-00-00' && $date != '1970-01-01') {
            list($year, $month, $day) = explode('-', $date);
            $date                     = date($php_date_format, mktime(0, 0, 0, $month, $day, $year));
        } else {
            $date = '';
        }

        return $date;
    }
}

if (!function_exists('convert_date_to_sql_date')) {
    function convert_date_to_sql_date($date, $php_date_format = '')
    {
        $date = substr($date, 0, 10);
        if (preg_match('/\d{4}-\d{2}-\d{2}/', $date)) {
            //If it's already a sql-date don't convert it!
            return $date;
        } elseif (empty($date)) {
            return '';
        }

        $date_array = preg_split('/[-\.\/ ]/', $date);
        if ($php_date_format == 'd/m/Y') {
            $sql_date = date('Y-m-d', mktime(0, 0, 0, $date_array[1], $date_array[0], $date_array[2]));
        } elseif ($php_date_format == 'm/d/Y') {
            $sql_date = date('Y-m-d', mktime(0, 0, 0, $date_array[0], $date_array[1], $date_array[2]));
        } else {
            $sql_date = $date;
        }

        return $sql_date;
    }
}

if (!function_exists('get_comment_reply_count')) {
    function get_comment_reply_count($comment_id)
    {
        $CI = &get_instance();

        $num = $CI->db->get_where('pertanyaan_tanggapan', array('id_pertanyaan' => $comment_id, 'tampil' => 'Y'))->num_rows();
        return $num;
    }
}

if (!function_exists('sendWa')) {
    function sendWa($jid, $msg)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://whatsva.id/api/sendMessageText');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"instance_key": "' . $_ENV['WHATSVA_INSTANCE_KEY'] . '", "jid": "' . $jid . '", "message": "' . $msg . '"}');

        $headers   = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        echo $result;
    }
}

function fullNameToFirstName($fullName, $checkFirstNameLength=TRUE)
{
	// Split out name so we can quickly grab the first name part
	$nameParts = explode(' ', $fullName);
	$firstName = $nameParts[0];

	// If the first part of the name is a prefix, then find the name differently
	if(in_array(strtolower($firstName), array('mr', 'ms', 'mrs', 'miss', 'dr'))) {
		if($nameParts[2]!='') {
			// E.g. Mr James Smith -> James
			$firstName = $nameParts[1];
		} else {
			// e.g. Mr Smith (no first name given)
			$firstName = $fullName;
		}
	}

	// make sure the first name is not just "J", e.g. "J Smith" or "Mr J Smith" or even "Mr J. Smith"
	if($checkFirstNameLength && strlen($firstName)<3) {
		$firstName = $fullName;
	}
	return $firstName;
}

function sendEmail($recipient, $subject, $content)
{
        $api_token  = $_ENV['MAILKETING_API_TOKEN'];
        $from_name  = 'Admin Beasiswa'; //nama pengirim
        $from_email = 'beasiswakesraprovjambi@gmail.com'; //email pengirim
        
        $params     = [
            'from_name'  => $from_name,
            'from_email' => $from_email,
            'recipient'  => $recipient,
            'subject'    => $subject,
            'content'    => $content,           
            'api_token'  => $api_token,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.mailketing.co.id/api/v1/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        print_r($output);
        curl_close($ch);
    
}

// function sendEmail($recipientEmailAddress, $subject, $message, $attachment = 'none')
// {
//     $provider = new Google([
//         'clientId'     => $_ENV['GOOGLE_CLIENTID'],
//         'clientSecret' => $_ENV['GOOGLE_CLIENTSECRET'],
//         'redirectUri'  => 'https://example.com/callback-url',
//     ]);

//     $mail = new PHPMailer(true);
//     $mail->isSMTP();
//     $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
//     $mail->SMTPAuth = true;
//     //to view proper logging details for success and error messages
//     // $mail->SMTPDebug = 1;
//     // $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
//     $mail->Username = $_ENV['GMAIL_USER'];   //email
//     $mail->Password = $_ENV['GMAIL_APP_PASSWORD'];   //16 character obtained from app password created
//     $mail->Port = 465;                    //SMTP port
//     $mail->SMTPSecure = "ssl";

//     //sender information
//     $mail->setFrom($_ENV['GMAIL_USER'], 'Admin');

//     //receiver email address and name
//     $mail->addAddress($recipientEmailAddress, $recipientEmailAddress);
//     if ($attachment !== 'none') {
//         $mail->AddAttachment($attachment);
//     }

//     // Add cc or bcc
//     // $mail->addCC('email@mail.com');
//     // $mail->addBCC('user@mail.com');

//     $mail->isHTML(true);

//     $mail->Subject = $subject;
//     $mail->Body    = $message;

//     // Send mail
//     if (!$mail->send()) {
//         echo 'Email not sent an error was encountered: ' . $mail->ErrorInfo;
//     } else {
//         //echo 'Message has been sent.';
//     }

//     $mail->smtpClose();
// }

// function sendEmail($recipientEmailAddress, $subject, $message, $attachment)
// {
//     $CI = &get_instance();
//     $CI->load->library('My_PHPMailer');

//     $mail = new PHPMailer();

//     // $mail->SMTPDebug = 3;

//     $mail->isSMTP();
//     $mail->Host       = 'smtp.gmail.com';
//     $mail->Port       = 587;
//     $mail->SMTPSecure = 'tls';
//     $mail->SMTPAuth   = true;

//     $mail->Username = $CI->config->item('mail_Username');
//     $mail->Password = $CI->config->item('mail_Password');
//     $mail->setFrom($CI->config->item('mail_Username'), $CI->config->item('mail_setFrom'));
//     $mail->addReplyTo($CI->config->item('mail_Username'), $CI->config->item('mail_setFrom'));
//     $mail->addAddress($recipientEmailAddress, preg_replace('/@.*?$/', '', $recipientEmailAddress));
//     if ($attachment !== 'none') {$mail->AddAttachment($attachment);}
//     $mail->Subject = $subject;
//     $mail->msgHTML($message);

//     if (!$mail->send()) {
//         //return false;
//         //echo 'Message could not be sent.';
//         echo 'Mailer Error: <pre>' . $mail->ErrorInfo . '</pre>';
//         //exit(0);
//     }

//     //return true;
// }
