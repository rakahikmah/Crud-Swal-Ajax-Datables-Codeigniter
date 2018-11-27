<!-- Modal untuk tambah data mahasiswa -->
<div class="modal fade" id="tambahmahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formtambahdatamhs">
        <div class="form-group row">
            <label for="inputnama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" placeholder="nama" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="alamat" placeholder="alamat" required>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Tambah Data Mahasiswa</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal untuk edit data mahasiswa -->
<div class="modal fade" id="editmahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="formdatamahasiswa">
      
       </div>
    </div>
  </div>
</div>

<script>
      $(document).ready(function () {
        // ini adalah fungsi untuk mengambil data mahasiswa dan di  incluce ke dalam datatable
          var datamahasiswa = $('#datamahasiswa').DataTable({
                  "processing": true,
                  "ajax": "<?=base_url("index.php/home/datamahasiswa")?>",
                  stateSave: true,
                  "order": []
          })
            
          // fungsi untuk menambah data  
          // pilih selector dari yang id formtambahdatamhs  
          $('#formtambahdatamhs').on('submit', function () {
            var nama = $('#nama').val(); // diambil dari id nama yang ada diform modal
            var alamat = $('#alamat').val(); // diambil dari id alamat yanag ada di form modal 

            $.ajax({
              type: "post",
              url: "<?=base_url('index.php/home/tambahmhs')?>",
              beforeSend :function () {
                swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                      swal.showLoading()
                    }
                  })      
                },
              data: {nama:nama,alamat:alamat}, // ambil datanya dari form yang ada di variabel
              dataType: "JSON",
              success: function (data) {
                datamahasiswa.ajax.reload(null,false);
                swal({
                    type: 'success',
                    title: 'Tambah Mahasiswa',
                    text: 'Anda Berhasil Menambah Mahasiswa'
                  })
                  // bersihkan form pada modal
                  $('#tambahmahasiswa').modal('hide');
                  // tutup modal
                  $('#nama').val('');
                  $('#alamat').val('');
                
              }
            })
            return false;
          });
          // fungsi untuk edit data
          //pilih selector dari table id datamahasiswa dengan class .ubah-mahasiswa
          $('#datamahasiswa').on('click','.ubah-mahasiswa', function () {
            // ambil element id pada saat klik ubah
            var id =  $(this).data('id');
            
            $.ajax({
              type: "post",
              url: "<?=base_url('index.php/home/formedit')?>",
              beforeSend :function () {
                swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                      swal.showLoading()
                    }
                  })      
                },
              data: {id:id},
              success: function (data) {
                swal.close();
                $('#editmahasiswa').modal('show');
                $('#formdatamahasiswa').html(data);
                
                // proses untuk mengubah data
                $('#formubahdatamhs').on('submit', function () {
                    var editnama = $('#editnama').val(); // diambil dari id nama yang ada diform modal
                    var editalamat = $('#editalamat').val(); // diambil dari id alamat yanag ada di form modal 
                    var id = $('#idmhs').val(); //diambil dari id yang ada di form modal
                    $.ajax({
                      type: "post",
                      url: "<?=base_url('index.php/home/ubahmahasiswa')?>",
                      beforeSend :function () {
                        swal({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                              swal.showLoading()
                            }
                          })      
                        },
                      data: {editnama:editnama,editalamat:editalamat,id:id}, // ambil datanya dari form yang ada di variabel
                      
                      success: function (data) {
                        datamahasiswa.ajax.reload(null,false);
                        swal({
                            type: 'success',
                            title: 'Update Mahasiswa',
                            text: 'Anda Berhasil Mengubah Data Mahasiswa'
                          })
                          // bersihkan form pada modal
                          $('#editmahasiswa').modal('hide');
                      }
                    })
                    return false;
                  });
              }
            });
          });
          // fungsi untuk hapus data
          //pilih selector dari table id datamahasiswa dengan class .hapus-mahasiswa
          $('#datamahasiswa').on('click','.hapus-mahasiswa', function () {
            var id =  $(this).data('id');
            swal({
                title: 'Konfirmasi',
                text: "Anda ingin menghapus ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  $.ajax({
                    url:"<?=base_url('index.php/home/hapusmahasiswa')?>",  
                    method:"post",
                    beforeSend :function () {
                    swal({
                        title: 'Menunggu',
                        html: 'Memproses data',
                        onOpen: () => {
                          swal.showLoading()
                        }
                      })      
                    },    
                    data:{id:id},
                    success:function(data){
                      swal(
                        'Hapus',
                        'Berhasil Terhapus',
                        'success'
                      )
                      datamahasiswa.ajax.reload(null, false)
                    }
                  })
              } else if (result.dismiss === swal.DismissReason.cancel) {
                  swal(
                    'Batal',
                    'Anda membatalkan penghapusan',
                    'error'
                  )
                }
              })
            });

      });
</script>
