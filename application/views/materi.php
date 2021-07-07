<?php $this->load->view('header'); ?>

    <script type="text/javascript">
        function selesaimateri(){
            Swal.fire({
                title: 'Apakah anda ingin menyelesaikan materi ini?',
                showCancelButton: true,
                confirmButtonText: `Selesai`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>course/finishMateri/" + $("#idgetcourse").val(),
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
              <li class="breadcrumb-item active">Materi</li>
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

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                    <input type="hidden" id="idgetcourse" value="<?php echo $course[0]['idgetcourse']; ?>">
                    MATERI <?php echo $course[0]['title']; ?>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                    <div class="container">

                      <div class="card card-primary card-outline">
                        <div class="card-body">
                          <?php echo $course[0]['materi']; ?>
                        </div>
                      </div>

                        <footer>
                            <h3><?php echo $course[0]['title']; ?></h3>
                        </footer>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="#" class="btn btn-primary" onclick="selesaimateri()">Selesai</a>
                </div>
              </form>
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
