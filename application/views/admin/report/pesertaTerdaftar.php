<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script type="text/javascript">

function showModal(idgetcourse){
    // alert(idgetcourse);
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>course/hasil/" + idgetcourse,
      success: function(result) {
        arr = JSON.parse(result);
        console.log(arr);
        txt = "";
        txt = `<div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Peserta</label>
                    <label class="col-sm-9 col-form-label">: ${arr[0]['namapeserta']}</label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Judul</label>
                    <label class="col-sm-9 col-form-label">: ${arr[0]['title']}</label>
                </div>                
              </div>                  
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
                    salah = "";
                    if(arr[x]['benar']=="n"){salah='bgcolor="red"';}
                    txt +=`<tr>
                              <td>${(parseInt(x) + parseInt(1))} </td> 
                              <td>${arr[x]['question']}</td>
                              <td>${arr[x]['key']}</td>
                              <td ${salah}>${arr[x]['answer']}</td>
                              <td>${arr[x]['answerpost']}</td>
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Peserta Terdaftar</h1>
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
                            Peserta Terdaftar
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
                                                <?php $idgetcourse = $peserta[$a]['idgetcourse']; ?>
                                                <tr id="getcourse<?php echo $idgetcourse; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td><?php echo $peserta[$a]['namapeserta'] ?></td>
                                                    <td><?php echo $peserta[$a]['datecourse'] ?></td>
                                                    <td><?php echo $peserta[$a]['title'] ?></td>
                                                    <td><?php echo $peserta[$a]['jpl'] ?></td>
                                                    <td>
                                                      <?php 
                                                        if($peserta[$a]['flag']=="finish"){ //<?php echo $course[$a]['idcourses'];
                                                          echo "<a class='btn btn-large btn-success' href='javascript:showModal(" . $peserta[$a]['idgetcourse'] .")'>" . $peserta[$a]['flag'] . "</a>";    
                                                        }else{
                                                          echo $peserta[$a]['flag'];
                                                        }
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
            <!-- /.row -->
         
            <!-- Main row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

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
  <!-- /.content-wrapper -->


  <?php $this->load->view('admin/footer'); ?>
