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
        nilaiPre = 0;
        nilaiPost = 0;        
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
            
          </div>
          
          <?php $this->load->view('courseInformation'); ?>

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
