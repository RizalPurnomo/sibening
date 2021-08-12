<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script type="text/javascript">

  function showModal(idgetcourse){
    // alert(idgetcourse);
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>course/hasil/" + idgetcourse,
      success: function(result) {
        nilaiPre = 0;
        nilaiPost = 0;
        arr = JSON.parse(result);
        // console.log(arr);
        txt = "";
        txt += `                  
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
                    if(arr[x]['benar']=="n"){salahPre='bgcolor="red"';}else{nilaiPre++;}
                    if(arr[x]['benarpost']=="n"){salahPost='bgcolor="red"';}else{nilaiPost++;}
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
        txt += `
          <b>Pre Test : ${nilaiPre}</b> <br/>
          <b>Post Test : ${nilaiPost}</b>
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Report Detail - <?php echo $peserta[0]['nama_pegawai'] ?></h1>
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
            <div class="col-lg-8">
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
                                <th>Action</th>
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
                                              $getJPL = $getJPL + $getcourse[$a]['jpl'];
                                              if($getcourse[$a]['flag']=="pre"){
                                                $pre = "";
                                                $materi = "disabled";
                                                $post = "disabled";
                                                $finish = "d-none";
                                              }else if($getcourse[$a]['flag']=="materi"){ 
                                                $pre = "";
                                                $materi = "";
                                                $post = "disabled";
                                                $finish = "d-none";
                                              }else if($getcourse[$a]['flag']=="post"){
                                                $pre = "";
                                                $materi = "";
                                                $post = "";
                                                $finish = "d-none";
                                              }else if($getcourse[$a]['flag']=="finish"){
                                                $pre = "d-none";
                                                $materi = "d-none";
                                                $post = "d-none";
                                                $finish = "";
                                                $enrollFinished++;
                                                $JPLFinished = $JPLFinished + $getcourse[$a]['jpl'] ;
                                              }


                                          ?>
                                          <a class="btn btn-info btn-sm <?php echo $pre; ?>" href="<?php echo base_url('admin/report/preTest/') . $getcourse[$a]['idgetcourse']; ?>">
                                              <i class="fas fa-pencil-alt">
                                              </i>
                                              Pre
                                          </a>    
                                          <a class="btn btn-info btn-sm <?php echo $post; ?>" href="<?php echo base_url('admin/report/postTest/') . $getcourse[$a]['idgetcourse']; ?>">
                                              <i class="fas fa-pencil-alt">
                                              </i>
                                              Post
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
                      <h3 class="card-title">Competency</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>title</th>
                                <th>Instance</th>
                                <th>Files</th>
                                <th>JPL Approved</th>
                                <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php for ($a = 0; $a < count($competency); $a++) { ?>
                                  <tr>
                                        <td><?php echo $a + 1 ?></td>
                                        <td><?php echo $competency[$a]['date'] ?></td>
                                        <td><?php echo $competency[$a]['title'] ?></td>
                                        <td><?php echo $competency[$a]['instance'] ?></td>
                                        <td><a href="<?php echo base_url('uploads/competency/') . $competency[$a]['files'] ; ?>" target="_blank" ><?php echo $competency[$a]['files']; ?></a></td>
                                        <td><?php echo $competency[$a]['jplapproved'] ?></td>
                                        <td>
                                            <?php 
                                                $id = $competency[$a]['idcompetency'];
                                                $linkDelete ="javascript:deleteData($id)";
                                                $linkEdit ="javascript:editData($id)";
                                                $pending = "
                                                    <a class='btn btn-info btn-sm disabled' href='$linkEdit'>
                                                        <i class='fas fa-pencil-alt'>
                                                        </i>
                                                        Edit
                                                    </a>   
                                                    <a class='btn btn-danger btn-sm disabled' href='$linkDelete'>
                                                        <i class='fas fa-trash'>
                                                        </i>
                                                        Delete
                                                    </a>        
                                                ";    

                                                $approved = ' 
                                                    <button class="btn btn-success btn-sm disabled">
                                                        <i class="fa fa-check">
                                                        </i>
                                                        Approved
                                                    </button>        
                                                '; 
                                                
                                                
                                                $reject = ' 
                                                    <button class="btn btn-danger btn-sm disabled">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        </i>
                                                        Rejected
                                                    </button>        
                                                ';                                                  
                                                
                                                if($competency[$a]['statuscompetency']=='pending'){
                                                    echo $pending;
                                                }else if($competency[$a]['statuscompetency']=='approved'){
                                                    echo $approved;
                                                }else{
                                                    echo $reject;
                                                }
                                            
                                            ?>
                                        </td>
                                  </tr>
                            <?php } ?>
                          </tbody>
                      </table>
                  </div>
                  <!-- /.card-body -->
              </div>                
          
              
            </div>
            <?php $this->load->view('admin/report/courseInformationAdmin'); ?>
            <!-- /.col-md-6 -->
              <!-- <div class="col-lg-4">
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
                                    if($enrolled<1){
                                      $percentageFinishEnroll=0;  
                                    }else{
                                      $percentageFinishEnroll = ($enrollFinished/$enrolled)*100;
                                    }
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
                                </center>                                
                              </td>
                            </tr>
                          </table>
                        </div>
                      
                      </div>
                  </div>
              </div> -->
            <!-- /.col-md-6 -->
          </div>

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

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->


  <?php $this->load->view('admin/footer'); ?>
