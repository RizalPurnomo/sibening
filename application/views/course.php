<?php $this->load->view('header'); ?>


<script type="text/javascript">

  function deleteData(idgetcourse){
    Swal.fire({
          title: 'Apakah akan menghapus enroll ini?',
          showCancelButton: true,
          confirmButtonText: `hapus`,
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>course/deleteCourse/" + idgetcourse,
                  success: function(html) {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Berhasil Dihapus',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    var url = "<?php echo base_url(); ?>course/";
                    window.location.href = url;
                  }
              })
          } else {
              return;
          }
    })
  }

  function selectedCourse(idcourse){

    Swal.fire({
          title: 'Apakah akan mendaftar di enroll ini?',
          showCancelButton: true,
          confirmButtonText: `Daftar`,
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>course/enrollCourse/" + idcourse,
                  success: function(html) {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Berhasil Ditambahkan',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    var url = "<?php echo base_url(); ?>course/";
                    window.location.href = url;
                  }
              })
          } else {
              return;
          }
    })
  }

  function showModal(idgetcourse){
    // alert(idgetcourse);
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>course/hasil/" + idgetcourse,
      success: function(result) {
        arr = JSON.parse(result);
        console.log(arr);
        txt = "";
        txt = `                  
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Question</th>
                        <th>Key</th>
                        <th>Pre Test</th>
                        <th>Post Test</th>
                    </tr>
                </thead>
                <tbody>`
                  for (x in arr) {
                    salahPre = "";
                    salahPost = "";
                    if(arr[x]['benar']=="n"){salahPre='bgcolor="red"';}
                    if(arr[x]['benarpost']=="n"){salahPost='bgcolor="red"';}
                    txt +=`<tr>
                              <td>${(parseInt(x) + parseInt(1))} </td> 
                              <td>${arr[x]['question']}</td>
                              <td>${arr[x]['key']}</td>
                              <td ${salahPre}>${arr[x]['answer']}</td>
                              <td ${salahPost}>${arr[x]['answerpost']}</td>
                          </tr>`;
                  }
                `</tbody>
              </table>
                `;
        document.getElementById("divModal").innerHTML = txt;
      }
    })
    $('#modal-lg').modal('show'); 
  }
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
                              <!-- <th>Id Get Course</th> -->
                              <th>Date</th>
                              <th>title</th>
                              <th>JPL</th>
                              <th style="width:21%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $enrolled = count($getcourse);
                          $enrollFinished = 0;
                          $JPLFinished = 0;
                          $getJPL = 0;
                          $targetJPL = 20;
                        ?>
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
                                            $delete = "";
                                            $getJPL = $getJPL + $getcourse[$a]['jpl'];
                                            if($getcourse[$a]['flag']=="pre"){
                                              $pre = "";
                                              $materi = "disabled";
                                              $post = "disabled";
                                              $finish = "d-none";
                                              $delete = "";
                                            }else if($getcourse[$a]['flag']=="materi"){ 
                                              $pre = "";
                                              $materi = "";
                                              $post = "disabled";
                                              $finish = "d-none";
                                              $delete = "disabled";
                                            }else if($getcourse[$a]['flag']=="post"){
                                              $pre = "";
                                              $materi = "";
                                              $post = "";
                                              $finish = "d-none";
                                              $delete = "disabled";
                                            }else if($getcourse[$a]['flag']=="finish"){
                                              $pre = "d-none";
                                              $materi = "d-none";
                                              $post = "d-none";
                                              $finish = "";
                                              $delete = "d-none";
                                              $enrollFinished++;
                                              $JPLFinished = $JPLFinished + $getcourse[$a]['jpl'] ;
                                            }


                                        ?>
                                        <!-- <?php print_r($getcourse[$a]); ?> -->
                                        <a class="btn btn-info btn-sm <?php echo $pre; ?>" href="<?php echo base_url('course/preTest/') . $getcourse[$a]['idgetcourse']; ?>" title="Pre" >
                                          <i class="fas fa-pencil-alt">
                                          </i>
                                          <!-- Pre -->
                                        </a>   
                                        <a class="btn btn-primary btn-sm <?php echo $materi; ?>" href="<?php echo base_url('course/materi/') . $getcourse[$a]['idgetcourse']; ?>" title="Materi" >
                                          <i class="fas fa-folder">
                                          </i>
                                          <!-- Materi -->
                                        </a>    
                                        <a class="btn btn-info btn-sm <?php echo $post; ?>" href="<?php echo base_url('course/postTest/') . $getcourse[$a]['idgetcourse']; ?>" title="Post" >
                                          <i class="fas fa-pencil-alt">
                                          </i>
                                          <!-- Post -->
                                        </a>    
                                        <a class="btn btn-danger btn-sm <?php echo $delete; ?>" href="javascript:deleteData('<?php echo $getcourse[$a]['idgetcourse']; ?>')" title="Delete" >
                                          <i class="fas fa-trash">
                                          </i>
                                          <!-- Delete -->
                                        </a>                                          
                                        <a class="btn btn-success btn-sm <?php echo $finish; ?>" href="javascript:showModal('<?php echo $getcourse[$a]['idgetcourse']; ?>')">
                                          <i class="fa fa-check">
                                          </i>
                                          Hasil
                                        </a>  
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
                <div class="card-body  table-responsive">
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
                                <?php 
                                  // $idcourse = $course[$a]['idcourse']; 
                                  $courses = "";
                                  $jumCourse = 0;
                                  for ($i = 0; $i < count($getcourse); $i++) {
                                    if($course[$a]['idcourse']==$getcourse[$i]['idcourse']){
                                      $jumCourse++;
                                    }
                                  }

                                  if($jumCourse<1){
                                    $courses = "";
                                  }else{
                                    $courses = "disabled";
                                  }

                                ?>
                                <tr id="course<?php echo $course[$a]['idcourse']; ?>">
                                    <td><?php echo $a + 1 ?></td>
                                    <!-- <td><?php echo $course[$a]['idcourses'] ?></td> -->
                                    <td><?php echo $course[$a]['kategori'] ?></td>
                                    <td><?php echo $course[$a]['title'] ?></td>
                                    <td><?php echo $course[$a]['jpl'] ?></td>
                                    <td>
                                      <a class="btn btn-primary btn-sm <?php echo $courses; ?>" href="javascript:selectedCourse('<?php echo $course[$a]['idcourses']; ?>')">
                                          <i class="fa fa-plus">
                                          </i>
                                          Enroll
                                      </a>                                       
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
                    <center><h5>Course Information</h5></center>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <table width=100% border="0">
                        <tr>
                          <td width=50%>
                            <center>
                              Finish VS Enrolled
                              <?php 
                                $percentageFinishEnroll = ($enrollFinished/$enrolled)*100;
                              ?>
                              <div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: <?php echo $percentageFinishEnroll; ?>%">
                                </div>
                              </div>
                              <small>
                                <?php echo $enrollFinished; ?> / <?php echo $enrolled; ?>
                              </small>                                   
                            </center>                                
                          </td>
                          <td width=50%>
                            <center>
                              Get JPL VS Target
                              <?php 
                                $percentageJplTarget = ($getJPL/$targetJPL)*100;
                              ?>
                              <div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: <?php echo $percentageJplTarget; ?>%">
                                </div>
                              </div>
                              <small>
                                <?php echo $getJPL; ?> / <?php echo $targetJPL; ?>
                              </small>                                                                     
                            </center>                                
                          </td>
                        </tr>
                        <tr>
                          <td width=50%>
                            <center>
                              Precentage JPL
                              <?php 
                                $percentage = ($JPLFinished/$targetJPL)*100;
                              ?>
                              <div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: <?php echo $percentage; ?>%">
                                </div>
                              </div>
                              <small>
                                  <?php echo $percentage; ?>% Complete
                              </small>                                 
                            </center>                                
                          </td>
                          <td width=50%>
                            <center>
                              JPL Finish <br/>
                              <span class="badge badge-success"><?php echo $JPLFinished; ?></span>
                              <!-- <h1><?php echo $JPLFinished; ?></h1> -->
                            </center>                                
                          </td>
                        </tr>
                      </table>
                    </div>
                  
                  </div>
              </div>
            </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hasil Test</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="box-body table-responsive">
                <div id="divModal">

                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>



    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('footer'); ?>
