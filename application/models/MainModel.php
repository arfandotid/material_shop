<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainModel extends CI_Model
{

    public function get($table)
    {
        return $this->db->get($table)->result();
    }

    public function get_where($table, $where)
    {
        $query = $this->db->get_where($table, $where);

        if ($query->num_rows() > 1) {
            return $query->result();
        } else {
            return $query->row();
        }
    }

    public function insert($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function insert_batch($table, $data)
    {
        return $this->db->insert_batch($table, $data);
    }

    public function update($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function generateId($prefix = null, $table = null, $field = null)
    {
        $this->db->select_max($field);
        $this->db->like($field, $prefix, 'after');
        return $this->db->get($table)->row_array()[$field];
    }

    public function newUserId()
    {
        $this->db->select_max('idUser');
        $this->db->like('idUser', 'U', 'after');
        $lastId = $this->db->get('user')->row_array()['idUser'];

        $noUrut = (int) substr($lastId, -3, 3);
        $noUrut += 1;

        $newId = 'U' . sprintf('%03s', $noUrut);
        return $newId;
    }

    public function updateStok($kdBarang, $stok)
    {
        $where = ['kdBarang' => $kdBarang];
        $getStok = $this->db->get_where('barang', $where)->row()->stok;
        $jumlahStok = (int) $getStok + (int) $stok;

        $this->db->update('barang', ['stok' => $jumlahStok], $where);
    }

    public function cekUsername($oldusername, $newusername)
    {
        $this->db->where_not_in('username', $oldusername);
        $this->db->where('username', $newusername);
        return $this->db->get('user')->num_rows();
    }
}
