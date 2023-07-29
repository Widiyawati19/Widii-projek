<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosa extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Diagnosa_model', 'DM');
    $this->load->model('Laporan_model', 'ML');
  }

  public function hasil()
  {
    $this->DM->kosongTmpGejala();
    $this->DM->kosongTmpFinal();
    $this->DM->insertTmpGejala();

    $tmpGejala = $this->DM->insertTmpFinal();
    $this->db->insert_batch('tmp_final', $tmpGejala);

    // Proses Perhitungan
    $probP1 = $this->DM->ProbP1();
    echo 'Nilai Prob P1 =' . $probP1 . '<br>';
    $probP2 = $this->DM->ProbP2();
    echo 'Nilai Prob P2 =' . $probP2 . '<br>';
    $probP3 = $this->DM->ProbP3();
    echo 'Nilai Prob P3 =' . $probP3 . '<br>';
    $probP4 = $this->DM->ProbP4();
    echo 'Nilai Prob P4 =' . $probP4 . '<br>';
    $probP5 = $this->DM->ProbP5();
    echo 'Nilai Prob P5 =' . $probP5 . '<br><br>';

    // Testing Hasil Perhitungan Bayes Tiap Penyakit
    $data = [
      'P1' => $probP1,
      'P2' => $probP2,
      'P3' => $probP3,
      'P4' => $probP4,
      'P5' => $probP5
    ];
    $jmlProb = array_sum($data);
    echo 'Jumlah Probabilitas =' . $jmlProb . '<br><br>';

    $P1 = ($probP1 / $jmlProb) . '<br>';
    echo 'Nilai Perhitungan Bayes P1 =' .  $P1 . '<br>';
    $P2 = ($probP2 / $jmlProb) . '<br>';
    echo 'Nilai Perhitungan Bayes P2 =' . $P2 . '<br>';
    $P3 = ($probP3 / $jmlProb) . '<br>';
    echo 'Nilai Perhitungan Bayes P3 =' . $P3 . '<br>';
    $P4 = ($probP4 / $jmlProb) . '<br>';
    echo 'Nilai Perhitungan Bayes P4 =' . $P4 . '<br>';
    $P5 = ($probP5 / $jmlProb) . '<br>';
    echo 'Nilai Perhitungan Bayes P5 =' . $P5 . '<br>';



    $this->DM->hasilProbP1($P1);
    $this->DM->hasilProbP2($P2);
    $this->DM->hasilProbP3($P3);
    $this->DM->hasilProbP4($P4);
    $this->DM->hasilProbP5($P5);

    //insert hasil dari diagnosa
    $this->DM->insertHasil();
    redirect('member/hasil_diagnosa');
  }
}
