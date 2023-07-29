<!-- Modal Edit -->
<?php foreach ($tbl_penyakit as $penyakit) : ?>
  <div class="modal fade ubahPenyakit<?= $penyakit['id_penyakit']; ?>" tabindex="-1" role="dialog" aria-labelledby="forModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="apasih">Ubah Penyakit</h5>
        </div>

        <?= form_open_multipart('penyakit/ubahPenyakit'); ?>
        <input type="hidden" name="id" value="<?= $penyakit['id_penyakit']; ?>">
        <div class="modal-body">
          <!-- <div class="form-group">
            <label for="kode">Kode Penyakit</label>
            <input type="text" class="form-control" id="kode" name="kode" value="<?= $penyakit['kode_penyakit']; ?>" readonly>
          </div> -->
          <div class="form-group">
            <label for="nama">Nama Penyakit</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $penyakit['nama_penyakit']; ?>">
          </div>
          <!-- <div class="form-group">
            <label for="probabilitas">Nilai Probabilitas</label>
            <input type="text" class="form-control" id="probabilitas" name="probabilitas" value="<?= $penyakit['probabilitas']; ?>">
          </div> -->
          <div class="form-group">
            <label for="gambar">Gambar</label>
            <img style="margin-bottom: 10px; width: 100px;" src=" <?= base_url('assets/images/[penyakit]/') . $penyakit['gambar']; ?>">
            <input type="file" class="form-control" id="gambar" name="gambar" value="<?= $penyakit['gambar']; ?>"><?= $penyakit['gambar']; ?>"
          </div>
          <div class="form-group">
            <label for="solusi">Solusi</label>
            <textarea id="solusi" class="form-control" name="solusi"><?= $penyakit['solusi']; ?></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-round btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>