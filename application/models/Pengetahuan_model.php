<?php

class Pengetahuan_model extends CI_model
{
  // Menampilkan seluruh isi tabel Pengetahuan
  public function getAllPengetahuan()
  {
    // menampilkan seluruh data gejala yang ada di tabel gejala.
    $queryRule = "SELECT `tbl_pengetahuan`.`id`,`tbl_penyakit`.`kode_penyakit`,`tbl_penyakit`.`nama_penyakit`,`tbl_gejala`.`kode_gejala`,`tbl_gejala`.`nama_gejala`,`tbl_pengetahuan`.`probabilitas`
    FROM `tbl_penyakit` JOIN `tbl_pengetahuan` 
    ON `tbl_penyakit`.`id_penyakit` = `tbl_pengetahuan`.`id_penyakit`
    JOIN `tbl_gejala` 
    ON `tbl_pengetahuan`.`id_gejala` = `tbl_gejala`.`id_gejala`
                        ";
    return $this->db->query($queryRule)->result_array();

    //return $this->db->get('tbl_pengetahuan')->result_array();
  }

  // Menampilkan seluruh isi tabel Gejala
  public function getAllGejala()
  {
    // menampilkan seluruh data gejala yang ada di tabel gejala.
    return $this->db->get('tbl_gejala')->result_array();
  }

  // Menampilkan seluruh isi tabel Kerusakan
  public function getAllPenyakit()
  {
    // menampilkan seluruh data kerusakan yang ada di tabel kerusakan.
    return $this->db->get('tbl_penyakit')->result_array();
  }

  // CRUD PENGETAHUAN
  // Tambah Data Pengetahuan
  public function tambahPengetahuan()
  {
    $data = [
      "id_penyakit" => $this->input->post('penyakit', true,),
      "id_gejala" => $this->input->post('gejala'),
      "probabilitas" => $this->input->post('probabilitas')
    ];
    $this->db->insert('tbl_pengetahuan', $data);
  }

  // Ubah Data Pengetahuan
  public function ubahPengetahuan()
  {
    $id = $this->input->post('id');
    $data = [
      "id_penyakit" => $this->input->post('penyakit'),
      "id_gejala" => $this->input->post('gejala'),
      "probabilitas" => $this->input->post('probabilitas')
    ];
    $this->db->where('id', $id);
    $this->db->update('tbl_pengetahuan', $data);
  }
  // Hapus Data Pengetahuan
  public function hapus($id)
  {
    $this->db->delete('tbl_pengetahuan', ['id' => $id]);
  }
  // END CRUD PENGETAHUAN
}
