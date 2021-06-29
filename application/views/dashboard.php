<?php $this->load->view('header'); ?>

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
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Enrolled Course</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <!-- <th>Id Get Course</th> -->
                            <th>Date</th>
                            <th>title</th>
                            <th>JPL</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($getcourse)) {
                            for ($a = 0; $a < count($getcourse); $a++) { ?>
                                <?php $idgetcourse = $getcourse[$a]['idgetcourse']; ?>
                                <tr id="getcourse<?php echo $idgetcourse; ?>">
                                    <td><?php echo $a + 1 ?></td>
                                    <!-- <td><?php echo $getcourse[$a]['idgetcourse'] ?></td> -->
                                    <td><?php echo $getcourse[$a]['datecourse'] ?></td>
                                    <td><?php echo $getcourse[$a]['title'] ?></td>
                                    <td><?php echo $getcourse[$a]['jpl'] ?></td>
                                    <td>
                                        <?php 
                                            $pre = "";
                                            $materi = "";
                                            $post = "";
                                            if($getcourse[$a]['flag']=="pre"){
                                              $pre = "";
                                              $materi = "disabled";
                                              $post = "disabled";
                                              $finish = "d-none";
                                            }else if($getcourse[$a]['flag']=="materi"){ 
                                              $pre = "disabled";
                                              $materi = "";
                                              $post = "disabled";
                                              $finish = "d-none";
                                            }else if($getcourse[$a]['flag']=="post"){
                                              $pre = "disabled";
                                              $materi = "disabled";
                                              $post = "";
                                              $finish = "d-none";
                                            }else if($getcourse[$a]['flag']=="finish"){
                                              $pre = "d-none";
                                              $materi = "d-none";
                                              $post = "d-none";
                                              $finish = "";
                                            }

                                        ?>
                                        <!-- <?php print_r($getcourse[$a]); ?> -->
                                        <a class="btn btn-large btn-primary <?php echo $pre; ?>" href="course/preTest/<?php echo $getcourse[$a]['idgetcourse']; ?>">Pre</a>
                                        <a class="btn btn-large btn-primary <?php echo $materi; ?>" href="javascript:deleteData('aset<?php echo $getcourse[$a]['idgetcourse']; ?>')">Materi</a>
                                        <a class="btn btn-large btn-primary <?php echo $post; ?>" href="javascript:deleteData('aset<?php echo $getcourse[$a]['idgetcourse']; ?>')">Post</a>
                                        <a class="btn btn-large btn-danger <?php echo $finish; ?>" href="javascript:deleteData('aset<?php echo $getcourse[$a]['idgetcourse']; ?>')">hapus</a>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <br/>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Available Course</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example3" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <!-- <th>Id Course</th> -->
                            <th>Kategori</th>
                            <th>title</th>
                            <th>JPL</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($course)) {
                            for ($a = 0; $a < count($course); $a++) { ?>
                                <?php $idcourse = $course[$a]['idcourse']; ?>
                                <tr id="course<?php echo $idcourse; ?>">
                                    <td><?php echo $a + 1 ?></td>
                                    <!-- <td><?php echo $course[$a]['idcourse'] ?></td> -->
                                    <td><?php echo $course[$a]['kategori'] ?></td>
                                    <td><?php echo $course[$a]['title'] ?></td>
                                    <td><?php echo $course[$a]['jpl'] ?></td>
                                    <td>
                                        <a class="btn btn-large btn-primary" href="javascript:selectData('aset<?php echo $course[$a]['idcourse']; ?>')">Enroll</a>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

            </div>
            
          </div>
          <!-- /.col-md-6 -->
            <div class="col-lg-3">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Course Information</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            Precentage JPL
                            <h1>10%</h1>
                        </div>
                        <div class="col-lg-6">
                            Finish VS Enrolled
                            <h1>1 / 2</h1>
                        </div>                        
                        <!-- <div class = "vertical"></div> -->
                    </div>
                </div>
            </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('footer'); ?>
