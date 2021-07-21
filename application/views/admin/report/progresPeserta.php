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
            <h1 class="m-0 text-dark">Report</h1>
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
                            Progress Global
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <div class="row invoice-info">
                              <?php 
                                $totalPeserta = count($peserta);
                                $targetJPL = $totalPeserta * 20;
                                $jplFinish = $getJplFinish[0]['jplFinish'];
                                $percentageGlobal = round(($jplFinish / $targetJPL )*100); 
                              ?>
                              <address>
                                Total Peserta <br>
                                Target JPL Selesai <br>
                                JPL Finish <br>
                              </address>
                              <address>
                                 : <?php echo $totalPeserta; ?><br>
                                 : <?php echo $targetJPL; ?><br>
                                 : <?php echo $jplFinish; ?><br>
                              </address>
                            </div>
                            <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: <?php echo $percentageGlobal; ?>%">
                              </div>
                            </div>
                            <?php echo $percentageGlobal; ?>% Complete
                        </div>

                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div> 

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Progress Peserta
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="box-body table-responsive">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Peserta</th>
                                            <th>Course Progress</th>
                                            <th>Course Finish</th>
                                            <th>JPL Finish</th>
                                            <th>Precentage</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($progress)) {
                                            for ($a = 0; $a < count($progress); $a++) { ?>
                                                <?php $idpeserta = $progress[$a]['idpeserta']; ?>
                                                <tr id="progress<?php echo $idpeserta; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td><?php echo $progress[$a]['namapeserta'] ?></td>
                                                    <td><?php echo $progress[$a]['progres'] ?></td>
                                                    <td><?php echo $progress[$a]['finish'] ?></td>
                                                    <td><?php echo $progress[$a]['jplfinish'] ?></td>
                                                    <?php 
                                                      $jplFinish = $progress[$a]['jplfinish'];
                                                      $targetJPL = 20;
                                                      $percentage = ($jplFinish/$targetJPL)*100;
                                                    ?>
                                                    <td>
                                                      <div class="progress progress-sm">
                                                        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: <?php echo $percentage; ?>%">
                                                        </div>
                                                      </div>
                                                      <small>
                                                          <?php echo $percentage; ?>% Complete
                                                      </small>                                                      
                                                    </td>
                                                    <td>
                                                      <a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/report/progresDetail/') . $progress[$a]['idpeserta']; ?>">
                                                          <i class="fas fa-folder">
                                                          </i>
                                                          Detail
                                                      </a>                                                      
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                      <th>No</th>
                                      <th>Peserta</th>
                                      <th>Course Progress</th>
                                      <th>Course Finish</th>
                                      <th>JPL Finish</th>
                                      <th>Precentage</th>
                                      <th>Aksi</th>
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
