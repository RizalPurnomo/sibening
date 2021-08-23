<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script type="text/javascript">
    function selectData(id) {
        let idData = $("#" + id + " td")[1].innerHTML;
        // console.log(idData);
        $.ajax({
            success: function(html) {
                var url = "<?php echo base_url(); ?>admin/course/edit/" + idData;
                window.location.href = url;
            }
        });
    }

    function deleteData(id) {
        let idData = $("#" + id + " td")[1].innerHTML;
        // let lokasiFile = $("#" + id + " td")[2].innerHTML

        Swal.fire({
            title: 'Apakah yakin data akan di hapus?',
            showCancelButton: true,
            confirmButtonText: `Delete`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>admin/course/delete/" + idData,
                    success: function(html) {
                        if(html=="true"){
                            // fs.unlink(lokasiFile); 
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil Dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            window.location.href = "<?php echo base_url(); ?>admin/course/";
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Data Gagal Disimpan karena data relasi sudah terisi',
                                showConfirmButton: false,
                                timer: 1500
                            })                            
                        }
                        // console.log(html);
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Course</h1>
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
                            <a href="<?php echo base_url(); ?>admin/course/add" class="btn btn-app">
                                <i class="fas fa-user"></i> Tambah Course
                            </a>
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
                                            <th style="display:none;">Id Course</th>
                                            <th>Kategory</th>
                                            <th>Title</th>
                                            <th>JPL</th>
                                            <th>File Materi</th>
                                            <th>Trainer</th>
                                            <th>Tgl Available</th>
                                            <th>Max Peserta</th>
                                            <th style="width:15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($course)) {
                                            for ($a = 0; $a < count($course); $a++) { ?>
                                                <?php $idcourse = $course[$a]['idcourse']; ?>
                                                <tr id="course<?php echo $idcourse; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td style="display:none;"><?php echo $idcourse ?></td>
                                                    <td><?php echo $course[$a]['kategori'] ?></td>
                                                    <td><?php echo $course[$a]['title'] ?></td>
                                                    <td><?php echo $course[$a]['jpl'] ?></td>
                                                    <td><a href="<?php echo base_url('uploads/materi/') . $course[$a]['filemateri'] ; ?>" target="_blank" ><?php echo $course[$a]['filemateri']; ?></a></td>
                                                    <td><?php echo $course[$a]['trainer'] ?></td>
                                                    <td><?php echo $course[$a]['tglavailablepraktek'] ?></td>
                                                    <td><?php echo $course[$a]['maxpeserta'] ?></td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/course/question/') . $course[$a]['idcourse']; ?>">
                                                            <i class="fas fa-folder">
                                                            </i>
                                                            Question
                                                        </a>
                                                        <a class="btn btn-info btn-sm" href="javascript:selectData('course<?php echo $course[$a]['idcourse']; ?>')">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                            Edit
                                                        </a>   
                                                        <a class="btn btn-danger btn-sm" href="javascript:deleteData('course<?php echo $course[$a]['idcourse']; ?>')">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                            Delete
                                                        </a>                                                                                                                                                                        
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <th>No</th>
                                        <th style="display:none;">Id Course</th>
                                        <th>Kategory</th>
                                        <th>Title</th>
                                        <th>JPL</th>
                                        <th>File Materi</th>
                                        <th>Trainer</th>
                                        <th>Tgl Available</th>
                                        <th>Max Peserta</th>                                        
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
            <!-- /.row -->
            <!-- Main row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php $this->load->view('admin/footer'); ?>
