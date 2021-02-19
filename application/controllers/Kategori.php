<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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
        $data['title'] = "Kategori";
        $data['kategori'] = $this->main->get('kategori');

        template_view('kategori/index', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('namaKategori', 'Nama Kategori', 'required|trim');
    }

    public function add()
    {
        $data['title'] = "Kategori";

        $this->_validasi();
        if ($this->form_validation->run() == false) {
            template_view('kategori/add', $data);
        } else {
            $input = $this->input->post(null, true);

            $save = $this->main->insert('kategori', $input);
            if ($save) {
                msgBox('save');
                redirect('kategori');
            } else {
                msgBox('save', false);
                redirect('kategori/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $where = ['idKategori' => $id];

        $data['title'] = 'Kategori';
        $data['kategori'] = $this->main->get_where('kategori', $where);

        $this->_validasi();
        if ($this->form_validation->run() == false) {
            template_view('kategori/edit', $data);
        } else {
            $input = $this->input->post(null, true);

            $edit = $this->main->update('kategori', $input, $where);
            if ($edit) {
                msgBox('edit');
                redirect('kategori');
            } else {
                msgBox('edit', false);
                redirect('kategori/edit/' . $id);
            }
        }
    }

    public function hapus($getId)
    {
        $id = encode_php_tags($getId);
        $where = ['idKategori' => $id];

        $cekKategori = count((array) $this->main->get_where('barang', $where));

        if ($cekKategori > 0) {
            msgBox('delete', false);
            setMsg('danger', '<strong>Gagal!</strong> Data telah digunakan barang, silahkan hapus barang terlebih dahulu.');
        } else {
            $del = $this->main->delete('kategori', $where);
            if ($del) {
                msgBox('delete');
                redirect('kategori');
            } else {
                msgBox('delete', false);
                redirect('kategori/add');
            }
        }

        redirect('kategori');
    }
}
