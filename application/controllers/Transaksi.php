<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_role(['administrator', 'petugas']);

        $this->load->model('MainModel', 'main');
        $this->load->model('TransaksiModel', 'transaksi');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
    }

    public function index()
    {
        $data['title'] = "Transaksi";
        $data['transaksi'] = $this->transaksi->getTransaksi();

        template_view('transaksi/index', $data);
    }

    public function detail($id)
    {
        $data['title'] = "Transaksi";
        $data['idTransaksi'] = $id;
        $data['transaksi'] = $this->transaksi->getTransaksi($id);
        $data['detail'] = $this->transaksi->getDetailTransaksi($id);

        template_view('transaksi/detail', $data);
    }

    public function hapus($id)
    {
        $where = ['idTransaksi' => $id];
        $del = $this->main->delete('transaksi', $where);
        if ($del) {
            msgBox('delete');
        } else {
            msgBox('delete', false);
        }
        redirect('transaksi');
    }

    public function add()
    {
        $data['title'] = "Transaksi";
        $idUser = userdata()->idUser;
        $idTransaksi = generate_id("T", "transaksi", "idTransaksi", date('ymd'), 3);

        $data['keranjang'] = $this->transaksi->getKeranjang(['idUser' => $idUser]);
        $data['total_harga'] = $this->transaksi->getTotalKeranjang(['idUser' => $idUser]);

        $this->form_validation->set_rules('namaPelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('alamatPelanggan', 'Alamat Pelanggan', 'required');
        $this->form_validation->set_rules('uangBayar', 'Uang Bayar', 'required|numeric');

        if ($this->form_validation->run() == false) {
            template_view('transaksi/keranjang', $data);
        } else {
            // Data Tabel Transaksi
            $input = $this->input->post(null, true);
            $input['tanggal'] = date('Y-m-d');
            $input['idUser'] = $idUser;
            $input['idTransaksi'] = $idTransaksi;
            $input['kembalian'] = $input['uangBayar'] - $data['total_harga'];

            // Data Detail Transaksi
            $data_detail = [];
            $i = 0;
            foreach ($data['keranjang'] as $k) {
                $data_detail[$i]['idTransaksi'] = $idTransaksi;
                $data_detail[$i]['kdBarang']    = $k->kdBarang;
                $data_detail[$i]['qty']         = $k->qty;
                $data_detail[$i]['subtotal']    = $k->harga * $k->qty;
                $i++;
            }

            if ($input['uangBayar'] >= $data['total_harga']) {
                // Simpan transaksi
                $this->main->insert('transaksi', $input);
                // Simpan detail transaksi
                $this->main->insert_batch('transaksi_detail', $data_detail);
                // bersihkan keranjang
                $this->main->delete('keranjang', ['idUser' => $idUser]);

                msgBox('save');
                redirect('transaksi/detail/' . $idTransaksi);
            } else {
                setMsg('danger', 'Uang bayar tidak cukup.');
                redirect('transaksi/add');
            }
        }
    }

    public function add_item()
    {
        $data['title'] = "Transaksi";
        $idUser = userdata()->idUser;

        $data['barang'] = $this->transaksi->getBarang();

        $this->form_validation->set_rules('kdBarang', 'Kode Barang', 'required|trim');
        $this->form_validation->set_rules('qty', 'Jumlah Beli', 'required|numeric');

        if ($this->form_validation->run() == false) {
            template_view('transaksi/add_item', $data);
        } else {
            $input = $this->input->post(null, true);
            $input['noItem'] = time();
            $input['idUser'] = $idUser;

            // Cek stok
            $stok = $this->main->get_where('barang', ['kdBarang' => $input['kdBarang']])->stok;
            if ($stok >= $input['qty']) {
                $cekItem = $this->transaksi->cekItem(['idUser' => $idUser, 'kdBarang' => $input['kdBarang']]);

                if ($cekItem > 0) {
                    $this->transaksi->updateQtyKeranjang($input['qty'], ['idUser' => $idUser, 'kdBarang' => $input['kdBarang']]);
                } else {
                    $this->main->insert('keranjang', $input);
                    redirect('transaksi/add');
                }
            } else {
                setMsg('danger', "Maaf stok yang tersedia hanya {$stok}");
                template_view('transaksi/add_item', $data);
            }
        }
    }

    public function delete_item($noItem)
    {
        $id = encode_php_tags($noItem);
        $this->main->delete('keranjang', ['noItem' => $id]);

        redirect('transaksi/add');
    }

    public function cetak_detail($getId)
    {
        $this->load->library('Dompdf_gen');

        $id = encode_php_tags($getId);
        $where = ['idKategori' => $id];

        $data['transaksi'] = $this->transaksi->getTransaksi($id);
        $data['detail'] = $this->transaksi->getDetailTransaksi($id);

        $this->load->view('transaksi/cetak_detail', $data);

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();

        ob_end_clean();
        $this->dompdf->stream("detail_transaksi_" . time() . ".pdf", array('Attachment' => 0));
    }
}
