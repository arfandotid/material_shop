<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel', 'main');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
    }

    public function index()
    {
        if ($this->session->has_userdata('user')) {
            redirect('dashboard');
        }

        $data['title'] = "Login";

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('login', $data);
        } else {
            $input = $this->input->post(null, true);
            $user = $input['username'];
            $pass = $input['password'];

            $cek = $this->main->get_where('user', ['username' => $user]);
            if ($cek) {
                $password = $cek->password;

                if (password_verify($pass, $password)) {
                    $this->session->set_userdata('user', $cek->idUser);
                    redirect('dashboard');
                } else {
                    setMsg("danger", "Password salah!");
                    redirect('auth');
                }
            } else {
                setMsg('danger', 'Username tidak ditemukan');
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect('auth');
    }
}
