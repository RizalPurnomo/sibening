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
                            <a href="<?php echo base_url(); ?>admin/peserta/add" class="btn btn-app">
                                <i class="fas fa-user"></i> Tambah User
                            </a>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th  style="display:none;">Id User</th>
                                            <th>Email</th>
                                            <th>Nama Peserta</th>
                                            <th>Last Login</th>
                                            <th style="width:15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($peserta)) {
                                            for ($a = 0; $a < count($peserta); $a++) { ?>
                                                <?php $idpeserta = $peserta[$a]['idpeserta']; ?>
                                                <tr id="peserta<?php echo $idpeserta; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td  style="display:none;"><?php echo $idpeserta ?></td>
                                                    <td><?php echo $peserta[$a]['email'] ?></td>
                                                    <td><?php echo $peserta[$a]['namapeserta'] ?></td>
                                                    <td><?php echo $peserta[$a]['lastlogin'] ?></td>
                                                    <td>
                                                        <a class="btn btn-large btn-primary" href="javascript:selectData('peserta<?php echo $peserta[$a]['idpeserta']; ?>')">Edit</a>
                                                        | <a class="btn btn-large btn-danger" href="javascript:deleteData('peserta<?php echo $peserta[$a]['idpeserta']; ?>')">Delete</a>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th  style="display:none;">Id User</th>
                                            <th>Email</th>
                                            <th>Nama Peserta</th>
                                            <th>Last Login</th>
                                            <th style="width:15%">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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
