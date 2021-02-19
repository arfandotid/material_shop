<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel', 'main');
        $this->load->model('TransaksiModel', 'transaksi');
        is_logged_in();

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['total_transaksi'] = $this->transaksi->getTotalTransaksi(date('Y-m'));

        $bln = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $data['tr'] = [];
        foreach ($bln as $b) {
            $date = date('Y-') . $b;
            $total = (int) $this->transaksi->chartTransaksi($date);
            $data['tr'][] = $total == null ? 0 : $total;
        }

        template_view('dashboard', $data);
    }

    private function _config()
    {
        $config['upload_path']      = './assets/img/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = '2048';
        $config['encrypt_name']     = TRUE;

        $this->load->library('upload', $config);
    }

    public function profile()
    {
        $where = ['idUser' => userdata()->idUser];

        $data['title'] = "My Profile";
        $data['user'] = $this->main->get_where('user', ['idUser' => userdata()->idUser]);

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('noTelp', 'Nomor Telepon', 'required|numeric|trim');

        $this->_config();
        if ($this->form_validation->run() == false) {
            template_view('profile', $data);
        } else {
            $input = $this->input->post(null, true);

            if (userdata()->username != $input['username']) {
                $cekuser = $this->main->cekUsername(userdata()->username, $input['username']);
                if ($cekuser > 0) {
                    setMsg('danger', "Username <strong>{$input['username']}</strong> sudah digunakan");
                    redirect('dashboard/profile');
                }
            }

            if (!empty($_FILES['foto']['name'])) {
                if ($this->upload->do_upload('foto')) {
                    if ($this->upload->data()) {
                        $input['foto'] = $this->upload->data('file_name');

                        $dir = FCPATH . 'assets/img/';
                        $oldfoto = $data['user']->foto;
                        if (file_exists($dir . $oldfoto) && $oldfoto != 'user.png') {
                            if (!unlink($dir . $oldfoto)) {
                                echo "gagal hapus foto";
                                die;
                            }
                        }
                    }
                } else {
                    if ($this->upload->display_errors()) {
                        setMsg('danger', $this->upload->display_errors('', ''));
                        redirect('dashboard/profile');
                    }
                }
            }

            $save = $this->main->update('user', $input, $where);
            if ($save) {
                msgBox('save');
            } else {
                msgBox('save', false);
            }
            redirect('dashboard');
        }
    }

    public function edit_password()
    {
        $data['title'] = "Ganti Password";
        $user = $this->main->get_where('user', ['idUser' => userdata()->idUser]);

        $this->form_validation->set_rules('oldpassword', 'Password Lama', 'required');
        $this->form_validation->set_rules('password', 'Password Baru', 'required|min_length[5]');
        $this->form_validation->set_rules('konfpassword', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() == false) {
            template_view('edit-password', $data);
        } else {
            $input = $this->input->post(null, true);

            if (password_verify($input['oldpassword'], $user->password)) {
                $update = [
                    'password' => password_hash($input['password'], PASSWORD_DEFAULT)
                ];
                $this->main->update('user', $update, ['idUser' => $user->idUser]);

                redirect('logout');
            } else {
                setMsg('danger', '<strong>Gagal!</strong> Password lama tidak sesuai.');
                redirect('dashboard/edit_password');
            }
        }
    }
}
