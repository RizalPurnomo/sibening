<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script type="text/javascript">

</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Log Course</h1>
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
                            Log Course
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
                                            <th>Peserta</th>
                                            <th>Tgl Enroll</th>
                                            <th>Title</th>
                                            <th>JPL</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($peserta)) {
                                            for ($a = 0; $a < count($peserta); $a++) { ?>
                                                <?php $idpeserta = $peserta[$a]['idpeserta']; ?>
                                                <tr id="getcourse<?php echo $idpeserta; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td><?php echo $peserta[$a]['namapeserta'] ?></td>
                                                    <td><?php echo $peserta[$a]['datecourse'] ?></td>
                                                    <td><?php echo $peserta[$a]['title'] ?></td>
                                                    <td><?php echo $peserta[$a]['jpl'] ?></td>
                                                    <td>
                                                      <?php 
                                                        echo ucfirst($peserta[$a]['flag']);
                                                      ?>
                                                    </td>
                                                    
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                      <th>No</th>
                                      <th>Peserta</th>
                                      <th>Tgl Enroll</th>
                                      <th>Title</th>
                                      <th>JPL</th>
                                      <th>Status</th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>          
         
            <!-- Main row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->


  <?php $this->load->view('admin/footer'); ?>
