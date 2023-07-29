<?php

class Penyakit_model extends CI_model
{
  public function KodePenyakit()
  {
    // Membuat kode gejala menjadi generate AI (Auto Increment)
    $query = $this->db->query("select max(kode_penyakit) as max_id from tbl_penyakit");
    $rows = $query->row();
    $kode = $rows->max_id;
    $noUrut = (int) substr($kode, 1, 2);
    $noUrut++;
    $char = "P";
    $kode = $char . sprintf("%02s", $noUrut);
    return $kode;
  }

  // CRUD PENYAKIT
  // menampilkan seluruh data kerusakan yang ada di tabel penyakit.
  public function getAllPenyakit()
  {
    return $this->db->get('tbl_penyakit')->result_array();
  }

  // Tambah data Penyakit
  public function tambahPenyakit()
  {
    $data = [
      // Data yang ada di modal
      'kode_penyakit' => $this->KodePenyakit(),
      'nama_penyakit' => $this->input->post('nama', true),
      'probabilitas' => $this->input->post('probabilitas', true),
      'solusi' => $this->input->post('solusi', true)
    ];
    $this->db->insert('tbl_penyakit', $data);
  }

  // Ubah Data Penyakit
  public function ubahPenyakit()
  {
    $id = $this->input->post('id');
    // Mengubah data gejala
    $data = [
      "kode_penyakit" => $this->input->post('kode', true),
      "nama_penyakit" => $this->input->post('nama', true),
      "probabilitas" => $this->input->post('probabilitas', true),
      "solusi" => $this->input->post('solusi', true)
    ];
    $this->db->where('id_penyakit', $id);
    $this->db->update('tbl_penyakit', $data);
  }

  // Hapus Data Penyakit
  public function hapusPenyakit($id)
  {
    $this->db->delete('tbl_penyakit', ['id_penyakit' => $id]);
  }
  // END CRUD PENYAKIT
}
