<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyakit extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    cekLogin();
    $this->load->model('Penyakit_model', 'penyakit');
    $this->load->library('form_validation');
  }

  // Halaman Penyakit
  public function index()
  {
    $data['judul'] = "Halaman Penyakit";
    $data['user'] = $this->db->get_where('tbl_user', [
      'username' => $this->session->userdata('username')
    ])->row_array();
    $data['tbl_penyakit'] = $this->penyakit->getAllPenyakit();
    $data['kode'] = $this->penyakit->KodePenyakit();

    $this->load->view('templates/Admin_header', $data);
    $this->load->view('templates/Admin_sidebar', $data);
    $this->load->view('templates/Admin_topbar');
    $this->load->view('admin/penyakit/index', $data);
    $this->load->view('templates/Admin_footer');
    $this->load->view('admin/penyakit/modal_tambah_penyakit', $data);
    $this->load->view('admin/penyakit/modal_ubah_penyakit');
  }

  // Tambah Penyakit
  public function tambah()
  {
    $data['tbl_penyakit'] = $this->db->get('tbl_penyakit')->result_array();
    $data['user'] = $this->db->get_where('tbl_user', [
      'username' => $this->session->userdata('username')
    ])->row_array();

    // cek jika ada gambar yang akan diupload
    $upload_image = $_FILES['gambar']['name'];
    if ($upload_image) {
      $config['allowed_types'] = 'jpg|png';
      $config['max_size']      = '4096';
      $config['upload_path'] = './assets/images/penyakit/';

      $this->load->library('upload', $config);
      if ($this->upload->do_upload('gambar')) {
        // $old_image = $data['tbl_penyakit']['gambar'];
        // if ($old_image != 'user.png') {
        //   unlink(FCPATH . '/assets/images/penyakit/' . $old_image);
        // }
        $new_image = $this->upload->data('file_name');
        $this->db->set('gambar', $new_image);
        // } else {
        //   echo $this->upload->dispay_errors();
        // }
      }
      $this->penyakit->tambahPenyakit();
      $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Penyakit Berhasil ditambahkan!</div>'); //buat pesan akun berhasil dibuat
      redirect('penyakit');
    }
  }

  // Ubah Penyakit
  public function ubahpenyakit()
  {
    $data['user'] = $this->db->get_where('tbl_user', [
      'username' => $this->session->userdata('username')
    ])->row_array();

    // cek jika ada gambar yang akan diupload
    $upload_image = $_FILES['gambar']['name'];
    if ($upload_image) {
      $config['allowed_types'] = 'jpg|png';
      $config['max_size']      = '4096';
      $config['upload_path'] = './assets/images/penyakit/';

      $this->load->library('upload', $config);
      if ($this->upload->do_upload('gambar')) {
        // $old_image = $data['tbl_penyakit']['gambar'];
        // if ($old_image != 'user.png') {
        //   unlink(FCPATH . '/assets/images/penyakit/' . $old_image);
        // }
        $new_image = $this->upload->data('file_name');
        // var_dump($new_image);
        // die;
        $this->db->set('gambar', $new_image);
        // } else {
        //   echo $this->upload->dispay_errors();
        // }

        $this->penyakit->ubahpenyakit();
        $this->session->set_flashdata('pesan', '<div class="alert alert-info" role="alert">Data Penyakit Berhasil diubah!</div>'); //buat pesan akun berhasil dibuat
        redirect('penyakit');
      }
    }
  }

  // Hapus Penyakit
  public function hapus($id)
  {
    $this->penyakit->hapusPenyakit($id);
    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data Penyakit Berhasil dihapus!</div>'); //buat pesan akun berhasil dibuat
    redirect('penyakit');
  }
}
