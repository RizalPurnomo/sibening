<?php $this->load->view('header'); ?>

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
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
            <!-- The time line -->
            <div class="timeline">
                <!-- timeline time label -->
                <div class="time-label">
                    <span class="bg-red">Pre Test <?php echo $preTest[0]['title'] ?></span>
                </div>
                <div>

                    <?php if (!empty($preTest)) {
                    for ($a = 0; $a < count($preTest); $a++) { ?>
                        <i class="fas bg-blue"><?php echo $preTest[$a]['nomor']; ?></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header">
                                <?php echo $preTest[$a]['question'] ?>
                            </h3>
                            <div class="timeline-body">

                                <div class="form-group clearfix">
                                    <div class="icheck-success d-inline">
                                        <input type="radio" name="<?php echo $preTest[$a]['nomor']; ?>" id="<?php echo $preTest[$a]['nomor']; ?>pila"  <?php if($preTest[$a]['answer']=='A'){echo 'checked';}  ?> >
                                        <label for="<?php echo $preTest[$a]['nomor']; ?>pila">
                                            <?php echo $preTest[$a]['pila'] ?>
                                        </label>
                                    </div>
                                    <br/><br/>
                                    <div class="icheck-success d-inline">
                                        <input type="radio" name="<?php echo $preTest[$a]['nomor']; ?>" id="<?php echo $preTest[$a]['nomor']; ?>pilb" <?php if($preTest[$a]['answer']=='B'){echo 'checked';}  ?> >
                                        <label for="<?php echo $preTest[$a]['nomor']; ?>pilb">
                                            <?php echo $preTest[$a]['pilb'] ?>
                                        </label>
                                    </div>
                                    <br/><br/>
                                    <div class="icheck-success d-inline">
                                        <input type="radio" name="<?php echo $preTest[$a]['nomor']; ?>" id="<?php echo $preTest[$a]['nomor']; ?>pilc" <?php if($preTest[$a]['answer']=='C'){echo 'checked';}  ?> >
                                        <label for="<?php echo $preTest[$a]['nomor']; ?>pilc">
                                            <?php echo $preTest[$a]['pilc'] ?>
                                        </label>
                                    </div>
                                    <br/><br/>
                                    <div class="icheck-success d-inline">
                                        <input type="radio" name="<?php echo $preTest[$a]['nomor']; ?>" id="<?php echo $preTest[$a]['nomor']; ?>pild" <?php if($preTest[$a]['answer']=='D'){echo 'checked';}  ?> >
                                        <label for="<?php echo $preTest[$a]['nomor']; ?>pild">
                                            <?php echo $preTest[$a]['pild'] ?>
                                        </label>
                                    </div>
                                    <br/><br/>
                                    <div class="icheck-success d-inline">
                                        <input type="radio" name="<?php echo $preTest[$a]['nomor']; ?>" id="<?php echo $preTest[$a]['nomor']; ?>pile" <?php if($preTest[$a]['answer']=='E'){echo 'checked';}  ?> >
                                        <label for="<?php echo $preTest[$a]['nomor']; ?>pile">
                                            <?php echo $preTest[$a]['pile'] ?>
                                        </label>
                                    </div>                                                                                                                                                
                                </div>

                            </div>
                        </div>
                        <br/>
                    <?php }
                    } ?>


                </div>

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
