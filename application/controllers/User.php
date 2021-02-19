<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_role(['administrator']);

        $this->load->model('MainModel', 'main');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
    }

    public function index()
    {
        $data['title'] = "User";
        $data['user'] = $this->main->get('user');

        template_view('user/index', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|trim|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|trim');
        $this->form_validation->set_rules('konfpass', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('noTelp', 'Nomor Telepon', 'required|numeric|trim');
        $this->form_validation->set_rules('level', 'Level', 'required');
    }

    private function _config()
    {
        $config['upload_path']      = './assets/img/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = '2048';
        $config['encrypt_name']     = TRUE;

        $this->load->library('upload', $config);
    }

    public function add()
    {
        $data['title'] = "User";
        $data['idUser'] = $this->main->newUserId();

        $this->_config();
        $this->_validasi();
        if ($this->form_validation->run() == false || $this->upload->do_upload('foto') == false) {
            if ($this->upload->display_errors()) {
                setMsg('danger', $this->upload->display_errors('', ''));
            }
            template_view('user/add', $data);
        } else {
            $input = $this->input->post(null, true);
            unset($input['konfpass']);
            $input['idUser'] = $data['idUser'];
            $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
            $input['foto'] = $this->upload->data('file_name');

            $save = $this->main->insert('user', $input);
            if ($save) {
                msgBox('save');
            } else {
                msgBox('save', false);
            }
            redirect('user');
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $where = ['idUser' => $id];

        $data['title'] = "User";
        $data['user'] = $this->main->get_where('user', $where);
        $username = $data['user']->username;

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('noTelp', 'Nomor Telepon', 'required|numeric|trim');

        $this->_config();
        if ($this->form_validation->run() == false) {
            template_view('user/edit', $data);
        } else {
            $input = $this->input->post(null, true);

            if ($username != $input['username']) {
                $cekuser = $this->main->cekUsername($username, $input['username']);
                if ($cekuser > 0) {
                    setMsg('danger', "Username <strong>{$input['username']}</strong> sudah digunakan");
                    redirect('user/edit/' . $id);
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
                        redirect('user/edit/' . $id);
                    }
                }
            }

            $edit = $this->main->update('user', $input, $where);
            if ($edit) {
                msgBox('edit');
                redirect('user');
            } else {
                msgBox('edit', false);
                redirect('user/edit' . $id);
            }
        }
    }

    public function hapus($getId)
    {
        $id = encode_php_tags($getId);
        $where = ['idUser' => $id];

        $user = $this->main->get_where('user', $where);

        if ($user->foto != 'user.png') {
            if (unlink(FCPATH . 'assets/img/' . $user->foto)) {
                $this->main->delete('user', $where);
            } else {
                echo "gagal hapus foto";
                die;
            }
        } else {
            $this->main->delete('user', $where);
        }

        msgBox('delete');
        redirect('user');
    }
}
