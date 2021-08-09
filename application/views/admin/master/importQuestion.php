<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    function updateQuestion(id) {
        var dataArray = {
            "question" : {
                "idcourse": $("#idcourse").val(),
                "question": $("#question" + id ).val(),
                "pila": $("#answer" + id + "a" ).val(),
                "pilb": $("#answer" + id + "b" ).val(),
                "pilc": $("#answer" + id + "c" ).val(),
                "pild": $("#answer" + id + "d" ).val(),
                "pile": $("#answer" + id + "e" ).val(),
                "key": $("#key" + id  ).val(),
            }
        }
        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('admin/course/updateQuestion/'); ?>' + id,
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500
                })
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
            <h1 class="m-0 text-dark">Import Question</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/course"><?php echo $this->uri->segment(1); ?></a></li>
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
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Download Template Question
                        </h3>
                        <div class="card-tools">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <?php echo form_open('admin/import/export'); ?>
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Pilih Courses</label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                    <select name='idcourse' class="form-control select2" style="width: 100%;">
                                                        <?php for ($i=0; $i < count($course) ; $i++) { ?>
                                                            <option value='<?php echo $course[$i]['idcourse'] ?>'><?php echo $course[$i]['title'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary">Download</button>
                                            <!-- <a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/import/export/'); ?>">
                                                <i class="fa fa-download">
                                                </i>
                                                Download
                                            </a>   -->
                                            <!-- <button onclick="savePeserta()" class="btn btn-info">Download</button> -->
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- ./card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->   

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Import Question
                        </h3>
                        <div class="card-tools">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">

                            <!-- <h3><u>Import Data Question</u></h3> -->
                            <?php echo form_open_multipart('admin/import/importQuestion', array('name' => 'spreadsheet')); ?>
                            <table cellpadding="5">
                                <tr>
                                    <td>File :</td>
                                    <td><input type="file" size="40px" name="upload_file" /></td>
                                    <td class="error"><?php echo form_error('name'); ?></td>
                                    <td colspan="5" align="center">
                                        <input type="submit" value="Import Question" />
                                    </td>
                                </tr>
                            </table>
                            <?php echo form_close(); ?>



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