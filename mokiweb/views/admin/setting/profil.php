<?php
$admin= $this->Mauth->akunadmin($this->session->userdata('id_admin')); foreach($admin->result() as $r);

?>
<div class="row">
   <div class="col-md-6">
      <div class="card card-info">
         <div class="card-header with-border">
            <h3 class="card-title"><b><i class="fa fa-user"></i> Profil Saya</b></h3>
         </div>
         <form action="<?php echo base_url('admin/prosesprofil') ?>" method="post">
         <div class="card-body table-responsive">
            <div class="form-group">
               <label for="">Nama</label>
               <input type="text" name="nama_admin" id="" class="form-control" value="<?php echo $r->nama_admin; ?>">
            </div>
            <div class="form-group">
               <label for="">Username</label>
               <input type="text" name="username_admin" id="" class="form-control" value="<?php echo $r->username_admin; ?>">
            </div>
            <p>*Kosongi Password Bila Tidak Mengganti</p>
            <div class="form-group">
               <label for="">Password</label>
               <input type="password" name="password_admin" id="" class="form-control">
            </div>
            <div class="form-group">
               <label for="">Ulangi Password</label>
               <input type="password" name="ulangi_password" id="" class="form-control">
            </div>
         </div>
         <div class="card-footer">
            <button class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
         </div>
         </form>
      </div>
   </div>
</div>
<?php if($this->session->flashdata('msg')=='simpan'){ ?>
<script>
   iziToast.show({timeout:5000,color:'green',title: 'Berhasil Disimpan',position: 'topRight',pauseOnHover: true,transitionIn: false});
</script>
<?php } ?>
<?php if($this->session->flashdata('msg')=='edit'){ ?>
<script>
   iziToast.show({timeout:5000,color:'blue',title: 'Berhasil Diedit',position: 'topRight',pauseOnHover: true,transitionIn: false});
</script>
<?php } ?>
<?php if($this->session->flashdata('msg')=='passsalah'){ ?>
<script>
   iziToast.show({timeout:5000,color:'red',title: 'Password Salah',position: 'topRight',pauseOnHover: true,transitionIn: false});
</script>
<?php } ?>
<?php if($this->session->flashdata('msg')=='formatsalah'){ ?>
<script>
   iziToast.show({timeout:5000,color:'red',title: 'Gagal Menyimpan',position: 'topRight',pauseOnHover: true,transitionIn: false});
</script>
<?php } ?>