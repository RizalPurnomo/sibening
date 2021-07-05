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
              <li class="breadcrumb-item"><a href="#">Course</a></li>
              <li class="breadcrumb-item active">PreTest</li>
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
          <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                <center><h5>Course Information</h5></center>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <center>
                        Finish VS Enrolled
                        <h1><?php echo $enrollFinished; ?> / <?php echo $enrolled; ?></h1>
                        </center>
                    </div>
                    <div class="col-lg-6">
                        <center>
                        Get JPL VS Target
                        <h1><?php echo $getJPL; ?> / <?php echo $targetJPL; ?> </h1>
                        </center>
                    </div>                        
                    <!-- <div class = "vertical"></div> -->
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <center>
                        Precentage JPL
                        <h1><?php echo ($JPLFinished/$targetJPL)*100 ?>%</h1>
                        </center>
                    </div>
                    <div class="col-lg-6">
                        <center>
                        JPL Finish
                        <h1><?php echo $JPLFinished; ?></h1>
                        </center>
                    </div>                        
                    <!-- <div class = "vertical"></div> -->
                </div>                    
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('footer'); ?>
