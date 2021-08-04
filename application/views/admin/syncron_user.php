<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script type="text/javascript">
    function selectData(id) {
        let idData = $("#" + id + " td")[1].innerHTML;
        console.log(idData);
        $.ajax({
            success: function(html) {
                var url = "<?php echo base_url(); ?>admin/peserta/edit/" + idData;
                window.location.href = url;
            }
        });
    }

    function deleteData(id) {
        let idData = $("#" + id + " td")[1].innerHTML;
        Swal.fire({
            title: 'Apakah yakin data akan di hapus?',
            showCancelButton: true,
            confirmButtonText: `Delete`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>admin/peserta/delete/" + idData,
                    success: function(html) {
                        console.log(html);
                        var url = "<?php echo base_url(); ?>admin/peserta/";
                        window.location.href = url;
                    }
                })
            } else {
                return;
            }
        })
    }
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Peserta</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin"><?php echo $this->uri->segment(1); ?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->uri->segment(2); ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <a href="<?php echo base_url(); ?>admin/peserta/add" class="btn btn-app">
                                <i class="fas fa-user"></i> Tambah User
                            </a> -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="box-body table-responsive">
                                <?php echo form_open('admin/syncron/saveSyncronUser'); ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Username</th>
                                            <th>banned</th>
                                            <th>nama_lengkap</th>
                                            <th>nip</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            for ($a = 0; $a < count($server); $a++) { 
                                                $id="";
                                                $email="";
                                                $pass="";
                                                $username="";
                                                $banned="";
                                                $nama_lengkap="";
                                                $nip="";
                                        ?>
                                                <tr>
                                                    <td rowspan="2" style='text-align: center; vertical-align: middle;'><?php echo $a + 1 ?></td>
                                                    <td <?php 
                                                            if($a < count($lokal)){
                                                                $newRowId = $lokal[$a]['id'];
                                                            }
                                                            if ($server[$a]['id']!= $newRowId) {
                                                                $id = "bgcolor='red'";
                                                                echo $id;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="id[]" type="hidden" value="<?php echo $server[$a]['id'] ?>"/>
                                                        <?php echo $server[$a]['id'] ?>
                                                    </td>

                                                    <td <?php 
                                                            if($a < count($lokal)){
                                                                $newRowEmail = $lokal[$a]['email'];
                                                            }                                                    
                                                            if ($server[$a]['email']!=$newRowEmail) {
                                                                $email = "bgcolor='red'";
                                                                echo $email;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="email[]" type="hidden" value="<?php echo $server[$a]['email'] ?>"/>
                                                        <?php echo $server[$a]['email'] ?>
                                                    </td>

                                                    <td <?php 
                                                            if($a < count($lokal)){
                                                                $newRowPass = $lokal[$a]['pass'];
                                                            } 
                                                            if ($server[$a]['pass']!=$newRowPass) {
                                                                $pass = "bgcolor='red'";
                                                                echo $pass;

                                                            }
                                                        ?> 
                                                    >
                                                        <input name="pass[]" type="hidden" value="<?php echo $server[$a]['pass'] ?>"/>
                                                        <?php echo $server[$a]['pass'] ?>
                                                    </td>    

                                                    <td <?php 
                                                            if($a < count($lokal)){
                                                                $newRowUsername = $lokal[$a]['username'];
                                                            }                                                     
                                                            if ($server[$a]['username']!=$newRowUsername) {
                                                                $username = "bgcolor='red'";
                                                                echo $username;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="username[]" type="hidden" value="<?php echo $server[$a]['username'] ?>"/>
                                                        <?php echo $server[$a]['username'] ?>
                                                    </td> 

                                                    <td <?php 
                                                            if($a < count($lokal)){
                                                                $newRowBanned = $lokal[$a]['banned'];
                                                            }                                                     
                                                            if ($server[$a]['banned']!=$newRowBanned) {
                                                                $banned = "bgcolor='red'";
                                                                echo $banned;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="banned[]" type="hidden" value="<?php echo $server[$a]['banned'] ?>"/>
                                                        <?php echo $server[$a]['banned'] ?>
                                                    </td> 

                                                    <td <?php 
                                                            if($a < count($lokal)){
                                                                $newRowNama = $lokal[$a]['nama_lengkap'];
                                                            }                                                     
                                                            if ($server[$a]['nama_lengkap']!=$newRowNama) {
                                                                $nama_lengkap = "bgcolor='red'";
                                                                echo $nama_lengkap;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="nama_lengkap[]" type="hidden" value="<?php echo $server[$a]['nama_lengkap'] ?>"/>
                                                        <?php echo $server[$a]['nama_lengkap'] ?>
                                                    </td> 

                                                    <td <?php 
                                                            if($a < count($lokal)){
                                                                $newRowNIP = $lokal[$a]['nip'];
                                                            }                                                     
                                                            if ($server[$a]['nip']!=$newRowNIP) {
                                                                $nip = "bgcolor='red'";
                                                                echo $nip;
                                                            }
                                                        ?> 
                                                    >
                                                        <input name="nip[]" type="hidden" value="<?php echo $server[$a]['nip'] ?>"/>
                                                        <?php echo $server[$a]['nip'] ?>
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <?php if($a < count($lokal)){ ?>
                                                        <td <?php echo $id; ?> ><?php echo $lokal[$a]['id'] ?></td>
                                                        <td <?php echo $email; ?> ><?php echo $lokal[$a]['email'] ?></td>
                                                        <td <?php echo $pass; ?> ><?php echo $lokal[$a]['pass'] ?></td>
                                                        <td <?php echo $username; ?>><?php echo $lokal[$a]['username'] ?></td>
                                                        <td <?php echo $banned; ?>><?php echo $lokal[$a]['banned'] ?></td>
                                                        <td <?php echo $nama_lengkap; ?>><?php echo $lokal[$a]['nama_lengkap'] ?></td>
                                                        <td <?php echo $nip; ?>><?php echo $lokal[$a]['nip'] ?></td>
                                                    <?php } ?>
                                                </tr>   
                                        <?php
                                            } 
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Id</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Username</th>
                                            <th>banned</th>
                                            <th>nama_lengkap</th>
                                            <th>nip</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>                        

                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>
        <!-- /.row -->
        <!-- Main row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php $this->load->view('admin/footer'); ?>
