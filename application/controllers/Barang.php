<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Barang extends CI_Controller
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
        $data['title'] = "Barang";
        $data['barang'] = $this->main->get('barang');

        template_view('barang/index', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('namaBarang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('idKategori', 'Kategori', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric|trim');
        $this->form_validation->set_rules('harga', 'harga', 'required|numeric|trim');
    }

    public function add()
    {
        $kdBarang = generate_id("B", "barang", "kdBarang", date('y'));

        $data['title'] = "Barang";
        $data['kategori'] = $this->main->get('kategori');
        $data['kdBarang'] = $kdBarang;

        $this->_validasi();
        if ($this->form_validation->run() == false) {
            template_view('barang/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $input['kdBarang'] = $kdBarang;

            $save = $this->main->insert('barang', $input);
            if ($save) {
                msgBox('save');
                redirect('barang');
            } else {
                msgBox('save', false);
                redirect('barang/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $where = ['kdBarang' => $id];

        $data['title'] = "Barang";
        $data['kategori'] = $this->main->get('kategori');
        $data['barang'] = $this->main->get_where('barang', $where);
        $data['kdBarang'] = $id;

        $this->_validasi();
        if ($this->form_validation->run() == false) {
            template_view('barang/edit', $data);
        } else {
            $input = $this->input->post(null, true);

            $edit = $this->main->update('barang', $input, $where);
            if ($edit) {
                msgBox('edit');
                redirect('barang');
            } else {
                msgBox('edit', false);
                redirect('barang/edit/' . $id);
            }
        }
    }

    public function hapus($getId)
    {
        $id = encode_php_tags($getId);
        $where = ['kdBarang' => $id];

        $transaksi = count((array) $this->main->get_where('transaksi_detail', $where));
        $keranjang = count((array) $this->main->get_where('keranjang', $where));

        if ($keranjang > 0 || $transaksi > 0) {
            setMsg('danger', '<strong>Gagal!</strong> Data telah digunakan transaksi, silahkan hapus transaksi terlebih dahulu.');
        } else {
            msgBox('delete');
            $this->main->delete('barang', $where);
        }
        redirect('barang');
    }

    public function tambah_stok()
    {
        $input = $this->input->post(null, true);

        $this->main->updateStok($input['kdBarang'], $input['stok']);

        setMsg('success', '<strong>Berhasil!</strong> Stok berhasil diupdate.');
        redirect('barang');
    }
}
