<form id="formubahdatamhs" method="post">
        <div class="form-group row">
            <label for="inputnama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="editnama" value="<?=$datapermahasiswa['nama_mahasiswa']?>" placeholder="editnama" required>
            <input type="hidden" name="id" id="idmhs" value="<?=$datapermahasiswa['id']?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="editalamat" value="<?=$datapermahasiswa['alamat']?>" placeholder="editalamat" required>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Ubah Data Mahasiswa</button>
      </div>
</form>