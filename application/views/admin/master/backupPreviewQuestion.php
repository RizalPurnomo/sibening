<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script type="text/javascript">


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

            <div class="card-body">
                <div class="box-body table-responsive">
                    <?php echo form_open('barang/saveInventarisBatch'); ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Question</th>
                                <th>Pil A</th>
                                <th>Pil B</th>
                                <th>Pil C</th>
                                <th>Pil D</th>
                                <th>Pil E</th>
                                <th>Key</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $jum = count($question);
                            if (!empty($question)) {
                                for ($a = 0; $a < $jum; $a++) { ?>
                                    <tr>
                                        <td><?php echo $a + 1 ?></td>
                                        <td><input name="question[]" value="<?php echo $question[$a]['0']; ?>"></td>
                                        <td><input name="pila[]" value="<?php echo $question[$a]['1']; ?>"></td>
                                        <td><input name="pilb[]" value="<?php echo $question[$a]['2']; ?>"></td>
                                        <td><input name="pilc[]" value="<?php echo $question[$a]['3']; ?>"></td>
                                        <td><input name="pild[]" value="<?php echo $question[$a]['4']; ?>"></td>
                                        <td><input name="pile[]" value="<?php echo $question[$a]['5']; ?>"></td>
                                        <td><input name="key[]" value="<?php echo $question[$a]['6']; ?>"></td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Question</th>
                                <th>Pil A</th>
                                <th>Pil B</th>
                                <th>Pil C</th>
                                <th>Pil D</th>
                                <th>Pil E</th>
                                <th>Key</th>
                            </tr>

                        </tfoot>
                    </table>

                </div>

            </div>

            <!-- /.row -->
            <!-- Main row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php $this->load->view('admin/footer'); ?>
