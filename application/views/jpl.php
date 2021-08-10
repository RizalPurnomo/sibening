<?php $this->load->view('header'); ?>


<script type="text/javascript">


</script>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0 text-dark"> Top Navigation <small>Example 3.0</small></h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Course</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                  <div class="card-header">
                      <h3 class="card-title">Enrolled Course</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>title</th>
                                <th>JPL</th>
                                <th style="width:21%">Hasil</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php for ($a = 0; $a < count($jpl); $a++) { ?>
                                  <tr>
                                      <td><?php echo $a + 1 ?></td>
                                      <td><?php echo $jpl[$a]['datecourse']; ?></td>
                                      <td><?php echo $jpl[$a]['title']; ?></td>
                                      <td><?php echo $jpl[$a]['jpl']; ?></td>
                                      <td>   
                                          <a class="btn btn-success btn-sm" href="#" title="Pre Test" >
                                            <b>Pre : <?php echo $jpl[$a]['pretest']; ?></b>
                                          </a>                                          
                                          <a class="btn btn-success btn-sm <?php echo $jpl[$a]['posttest']; ?>" href="#" title="Post Test" >
                                            <b>Post : <?php echo $jpl[$a]['posttest']; ?></b>
                                          </a> 
                                      </td>
                                  </tr>
                            <?php } ?>
                          </tbody>
                      </table>
                  </div>
                  <!-- /.card-body -->
              </div>

            </div>
          </div>
          
          <?php $this->load->view('courseInformation'); ?>

        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->



    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('footer'); ?>
