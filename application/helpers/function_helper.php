<?php
function template_view($view, $data)
{
    $ci = get_instance();
    $ci->load->view('templates/header', $data);
    $ci->load->view('templates/topnav');
    $ci->load->view('templates/sidenav');
    $ci->load->view($view);
    $ci->load->view('templates/footer');
}

function open_dropdown($view = [], $classname)
{
    $ci = get_instance();
    $page = $ci->uri->segment(1);
    if (in_array($page, $view)) {
        return $classname;
    }
}

function generate_id($char = "", $table = "", $field = "", $date = "", $digit = 5)
{
    $ci = get_instance();

    $prefix = $char . $date;
    $lastId = $ci->main->generateId($prefix, $table, $field);
    $noUrut = (int) substr($lastId, -$digit, $digit);
    $noUrut += 1;

    $newId = $char . $date . sprintf("%0{$digit}s", $noUrut);
    return $newId;
}

function total_harga($idTransaksi)
{
    $ci = get_instance();

    return 1;
    // Query total harga
}

function format_uang($number = 0, $acc = true)
{
    if ($acc) $acc = "Rp. ";
    return $acc . number_format($number, 0, ',', '.');
}

function setMsg($type, $msg)
{
    $ci = get_instance();
    $text = "";
    $text .= "<div class='alert alert-{$type}' alert-dismissible fade show' role='alert'>";
    $text .= $msg;
    $text .= "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    $text .= "</div>";
    return $ci->session->set_flashdata('msg', $text);
}

function msgBox($msg = "save", $success = true)
{
    switch ($msg) {
        case "save":
            $pesan = $success ? "Data berhasil disimpan!" : "Gagal menyimpan data!";
            break;
        case "edit":
            $pesan = $success ? "Data berhasil diedit!" : "Gagal mengedit data!";
            break;
        case "delete":
            $pesan = $success ? "Data berhasil dihapus!" : "Gagal menghapus data!";
            break;
        default:
            $pesan = "";
            break;
    }
    $title = $success ? "Berhasil!" : "Gagal!";
    $type = $success ? "success" : "error";
    $alert = "
        <script type='text/javascript'>
        $(document).ready(function() {
            Swal.fire(
                '{$title}',
                '{$pesan}',
                '{$type}'
            );
        });
        </script>
    ";
    $ci = get_instance();
    return $ci->session->set_flashdata('pesan', $alert);
}


function userdata()
{
    $ci = get_instance();
    $ci->load->model('MainModel', 'main');

    $idUser = $ci->session->userdata('user');
    return $ci->main->get_where('user', ['idUser' => $idUser]);
}

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->has_userdata('user')) {
        redirect('auth');
    }
}

function custom_date($format, $date)
{
    return date($format, strtotime($date));
}

function indo_date($date, $print_day = false)
{
    $day        = [1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    $month      = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $split      = explode('-', $date);
    $nice_date  = $split[2] . ' ' . $month[(int) $split[1]] . ' ' . $split[0];

    if ($print_day) {
        $num = date('N', strtotime($date));
        return $day[$num] . ', ' . $nice_date;
    }
    return $nice_date;
}

function is_role($level = [])
{
    if (!in_array(userdata()->level, $level)) {
        show_404();
    }
}

function menu_role($level = [])
{
    return in_array(userdata()->level, $level);
}
