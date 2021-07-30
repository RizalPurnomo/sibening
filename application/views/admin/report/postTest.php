<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

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
                <div class="col-md-12">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                            <input type="hidden" id="idgetcourse" value="<?php echo $idgetcourse; ?>">
                            PRE TEST <?php echo $postTest[0]['title']; ?>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="card-body">
                                <!-- The time line -->
                                <div class="timeline">
                                    <?php if (!empty($postTest)) {
                                    for ($a = 0; $a < count($postTest); $a++) { ?>
                                            <div>
                                            <i class="fas bg-blue"><?php echo $a +1 ; ?></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header">
                                                    <input type="hidden" id="soal<?php echo $a +1 ; ?>" value="<?php echo $postTest[$a]['idsoal'] ?>">
                                                    <label> <?php echo $postTest[$a]['question'] ?> </label>
                                                </h3>
                                                <div class="timeline-body">

                                                    <div class="form-group clearfix">
                                                        <div class="icheck-success d-inline">
                                                            <input value="A" type="radio" name="<?php echo $a +1 ; ?>" id="<?php echo $a +1 ; ?>pila" <?php if($postTest[$a]['answerpost']=='A'){echo 'checked';}  ?> >
                                                            <label for="<?php echo $a +1 ; ?>pila">
                                                                <?php echo $postTest[$a]['pila'] ?>
                                                            </label>
                                                        </div>
                                                        <br/><br/>
                                                        <div class="icheck-success d-inline">
                                                            <input value="B" type="radio" name="<?php echo $a +1 ; ?>" id="<?php echo $a +1 ; ?>pilb" <?php if($postTest[$a]['answerpost']=='B'){echo 'checked';}  ?> >
                                                            <label for="<?php echo $a +1 ; ?>pilb">
                                                                <?php echo $postTest[$a]['pilb'] ?>
                                                            </label>
                                                        </div>
                                                        <br/><br/>
                                                        <div class="icheck-success d-inline">
                                                            <input value="C" type="radio" name="<?php echo $a +1 ; ?>" id="<?php echo $a +1 ; ?>pilc" <?php if($postTest[$a]['answerpost']=='C'){echo 'checked';}  ?> >
                                                            <label for="<?php echo $a +1 ; ?>pilc">
                                                                <?php echo $postTest[$a]['pilc'] ?>
                                                            </label>
                                                        </div>
                                                        <br/><br/>
                                                        <div class="icheck-success d-inline">
                                                            <input value="D" type="radio" name="<?php echo $a +1 ; ?>" id="<?php echo $a +1 ; ?>pild"  <?php if($postTest[$a]['answerpost']=='D'){echo 'checked';}  ?> >
                                                            <label for="<?php echo $a +1 ; ?>pild">
                                                                <?php echo $postTest[$a]['pild'] ?>
                                                            </label>
                                                        </div>
                                                        <br/><br/>
                                                        <div class="icheck-success d-inline">
                                                            <input value="E" type="radio" name="<?php echo $a +1 ; ?>" id="<?php echo $a +1 ; ?>pile"  <?php if($postTest[$a]['answerpost']=='E'){echo 'checked';}  ?> >
                                                            <label for="<?php echo $a +1 ; ?>pile">
                                                                <?php echo $postTest[$a]['pile'] ?>
                                                            </label>
                                                        </div>                                                                                                                                                
                                                    </div>

                                                </div>
                                            </div>
                                            <br/>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                            <!-- <a href="#" class="btn btn-primary" onclick="simpanpostTest()">Simpan</a> -->
                            </div>
                        </form>
                    </div>          

                </div>
                <!-- /.col -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->


  <?php $this->load->view('admin/footer'); ?>
