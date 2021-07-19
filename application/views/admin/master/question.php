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
            <h1 class="m-0 text-dark">Question Add</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/course"><?php echo $this->uri->segment(2); ?></a></li>
                <li class="breadcrumb-item active"><?php echo $this->uri->segment(3); ?></li>
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
                            Import Question
                        </h3>
                        <div class="card-tools">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">

                            <h3><u>Import/Export using phpspreadsheet in codeigniter</u></h3>
                            <?php echo form_open_multipart('admin/course/importQuestion', array('name' => 'spreadsheet')); ?>
                            <table align="center" cellpadding="5">
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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Input Data Question <b><?php echo $question[0]['title']; ?></b>
                            <input type="hidden" class="form-control" id="idcourse" value="<?php echo $question[0]['idcourse']; ?>">
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <?php for ($a = 0; $a < 10; $a++) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#idquestion<?php echo $question[$a]['idquestion']; ?>" data-toggle="tab"><?php echo $a+1 ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <?php for ($a = 0; $a < 10; $a++) { ?>
                                <div class="chart tab-pane" id="idquestion<?php echo $question[$a]['idquestion']; ?>" style="position: relative; ">
                                    

                                    <div>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">
                                            <div class="card-body pad">
                                                Soal Nomor <?php echo $a+1; ?>
                                                <div class="mb-1">
                                                    <textarea class="textarea" id="question<?php echo $question[$a]['idquestion']; ?>" placeholder="Place some text here"
                                                            style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 5px;"><?php echo trim($question[$a]['question']) ; ?></textarea>
                                                </div>
                                            </div>
                                            </h3>
                                            <div class="timeline-body">
                                                <div class="form-group row">
                                                    <label for="inputPassword3" class="col-sm-1 col-form-label d-flex justify-content-center">A</label>
                                                    <div class="col-sm-11">
                                                        <textarea id="answer<?php echo $question[$a]['idquestion']; ?>a" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 5px;"><?php echo trim($question[$a]['pila']) ; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword3" class="col-sm-1 col-form-label d-flex justify-content-center" >B</label>
                                                    <div class="col-sm-11">
                                                        <textarea id="answer<?php echo $question[$a]['idquestion']; ?>b" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 5px;"><?php echo trim($question[$a]['pilb']) ; ?></textarea>
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <label for="inputPassword3" class="col-sm-1 col-form-label d-flex justify-content-center">C</label>
                                                    <div class="col-sm-11">
                                                        <textarea id="answer<?php echo $question[$a]['idquestion']; ?>c" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 5px;"><?php echo $question[$a]['pilc'] ; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword3" class="col-sm-1 col-form-label d-flex justify-content-center">D</label>
                                                    <div class="col-sm-11">
                                                        <textarea id="answer<?php echo $question[$a]['idquestion']; ?>d" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 5px;"><?php echo $question[$a]['pild'] ; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword3" class="col-sm-1 col-form-label d-flex justify-content-center">E</label>
                                                    <div class="col-sm-11">
                                                        <textarea id="answer<?php echo $question[$a]['idquestion']; ?>e" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 5px;"><?php echo $question[$a]['pile'] ; ?></textarea>
                                                    </div>
                                                </div> 
                                                <hr/>   
                                                <div class="form-group row">
                                                    <label for="inputPassword3" class="col-sm-1 col-form-label d-flex justify-content-center">Key</label>
                                                    <div class="col-sm-11">
                                                        <select id="key<?php echo $question[$a]['idquestion']; ?>" class="form-control select2" style="width: 100%;" id="key">
                                                            <option value="">-- Select Key --</option>
                                                            <option value="A" <?php echo $question[$a]['key'] == 'A' ? 'selected' : '' ?> >A</option>
                                                            <option value="B" <?php echo $question[$a]['key'] == 'B' ? 'selected' : '' ?>>B</option>
                                                            <option value="C" <?php echo $question[$a]['key'] == 'C' ? 'selected' : '' ?>>C</option>
                                                            <option value="D" <?php echo $question[$a]['key'] == 'D' ? 'selected' : '' ?>>D</option>
                                                            <option value="E" <?php echo $question[$a]['key'] == 'E' ? 'selected' : '' ?>>E</option>
                                                        </select>
                                                    </div>
                                                </div>                                        

                                            </div>
                                            <div class="card-footer">
                                                <button onclick="updateQuestion(<?php echo $question[$a]['idquestion']; ?>)" class="btn btn-info">Simpan Soal No <?php echo $a+1; ?></button>
                                            </div>
                                        </div>
                                        <br/>
                                    </div>


                                </div>
                            <?php } ?>
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
