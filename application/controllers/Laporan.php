<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_role(['administrator', 'kepala toko']);

        $this->load->model('TransaksiModel', 'transaksi');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
    }

    public function index()
    {
        $data['title'] = "Laporan";

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi');

        if ($this->form_validation->run() == false) {
            template_view('laporan/index', $data);
        } else {
            $input  = $this->input->post(null, true);
            $tgl    = explode(' - ', $input['tanggal']);
            $tgl1   = date('Y-m-d', strtotime($tgl[0]));
            $tgl2   = date('Y-m-d', strtotime(end($tgl)));

            $this->cetak_transaksi($tgl1, $tgl2);
        }
    }

    public function cetak_transaksi($tgl1, $tgl2)
    {
        $this->load->library('Dompdf_gen');

        $data['tanggal'] = indo_date($tgl1) . " s/d " . indo_date($tgl2);
        $data['transaksi'] = $this->transaksi->getLaporanTransaksi($tgl1, $tgl2);
        $data['jumlah'] = count((array) $data['transaksi']);
        $data['total'] = $this->transaksi->getTotalTransaksi(null, [$tgl1, $tgl2]);
        $this->load->view('laporan/laporan_transaksi', $data);

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();

        ob_end_clean();
        $this->dompdf->stream("laporan_transaksi_" . time() . ".pdf", array('Attachment' => 0));
    }
}
