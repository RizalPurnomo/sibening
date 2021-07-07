<?php $this->load->view('header'); ?>

<script type="text/javascript">
  function simpanPreTest(){
    if(!$('input[name="1"]:checked').val() || !$('input[name="2"]:checked').val() || !$('input[name="3"]:checked').val() || !$('input[name="4"]:checked').val() || !$('input[name="5"]:checked').val() || !$('input[name="6"]:checked').val() ){
      alert("Ada yang belum dijawab, silahkan diisi terlebih dahulu");
      return;
    }

    var dataArray = {
      "question": {
              'soal1': $("#soal1").val(),
              'soal2': $("#soal2").val(),
              'soal3': $("#soal3").val(),
              'soal4': $("#soal4").val(),
              'soal5': $("#soal5").val(),
              'soal6': $("#soal6").val(),
              'soal7': $("#soal7").val(),
              'soal8': $("#soal8").val(),
              'soal9': $("#soal9").val(),
              'soal10': $("#soal10").val()
      },
      "answer": {
            'no1': $('input[name="1"]:checked').val(),
            'no2': $('input[name="2"]:checked').val(),
            'no3': $('input[name="3"]:checked').val(),
            'no4': $('input[name="4"]:checked').val(),
            'no5': $('input[name="5"]:checked').val(),
            'no6': $('input[name="6"]:checked').val(),
            'no7': $('input[name="7"]:checked').val(),
            'no8': $('input[name="8"]:checked').val(),
            'no9': $('input[name="9"]:checked').val(),
            'no10': $('input[name="10"]:checked').val()

      }
    }
    // console.log(dataArray);

    $.ajax({
        type: "POST",
        data: dataArray,
        url: '<?php echo base_url('course/saveUpdateData/'); ?>' + $("#idgetcourse").val() ,
        success: function(result) {
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil Disimpan',
                showConfirmButton: false,
                timer: 1500
            })
            console.log(result);
            window.location = "<?php echo base_url(); ?>course";
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
              <li class="breadcrumb-item active">PreTest</li>
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
                  <input type="hidden" id="idgetcourse" value="<?php echo $idgetcourse; ?>">
                  PRE TEST <?php echo $preTest[0]['title']; ?>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <!-- The time line -->
                  <div class="timeline">
                    <?php if (!empty($preTest)) {
                      for ($a = 0; $a < count($preTest); $a++) { ?>
                            <div>
                              <i class="fas bg-blue"><?php echo $a +1 ; ?></i>
                              <div class="timeline-item">
                                  <h3 class="timeline-header">
                                    <input type="hidden" id="soal<?php echo $a +1 ; ?>" value="<?php echo $preTest[$a]['idsoal'] ?>">
                                    <label> <?php echo $preTest[$a]['question'] ?> </label>
                                  </h3>
                                  <div class="timeline-body">

                                      <div class="form-group clearfix">
                                          <div class="icheck-success d-inline">
                                              <input value="A" type="radio" name="<?php echo $a +1 ; ?>" id="<?php echo $a +1 ; ?>pila" <?php if($preTest[$a]['answer']=='A'){echo 'checked';}  ?> >
                                              <label for="<?php echo $a +1 ; ?>pila">
                                                  <?php echo $preTest[$a]['pila'] ?>
                                              </label>
                                          </div>
                                          <br/><br/>
                                          <div class="icheck-success d-inline">
                                              <input value="B" type="radio" name="<?php echo $a +1 ; ?>" id="<?php echo $a +1 ; ?>pilb" <?php if($preTest[$a]['answer']=='B'){echo 'checked';}  ?> >
                                              <label for="<?php echo $a +1 ; ?>pilb">
                                                  <?php echo $preTest[$a]['pilb'] ?>
                                              </label>
                                          </div>
                                          <br/><br/>
                                          <div class="icheck-success d-inline">
                                              <input value="C" type="radio" name="<?php echo $a +1 ; ?>" id="<?php echo $a +1 ; ?>pilc" <?php if($preTest[$a]['answer']=='C'){echo 'checked';}  ?> >
                                              <label for="<?php echo $a +1 ; ?>pilc">
                                                  <?php echo $preTest[$a]['pilc'] ?>
                                              </label>
                                          </div>
                                          <br/><br/>
                                          <div class="icheck-success d-inline">
                                              <input value="D" type="radio" name="<?php echo $a +1 ; ?>" id="<?php echo $a +1 ; ?>pild"  <?php if($preTest[$a]['answer']=='D'){echo 'checked';}  ?> >
                                              <label for="<?php echo $a +1 ; ?>pild">
                                                  <?php echo $preTest[$a]['pild'] ?>
                                              </label>
                                          </div>
                                          <br/><br/>
                                          <div class="icheck-success d-inline">
                                              <input value="E" type="radio" name="<?php echo $a +1 ; ?>" id="<?php echo $a +1 ; ?>pile"  <?php if($preTest[$a]['answer']=='E'){echo 'checked';}  ?> >
                                              <label for="<?php echo $a +1 ; ?>pile">
                                                  <?php echo $preTest[$a]['pile'] ?>
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
                  <a href="#" class="btn btn-primary" onclick="simpanPreTest()">Simpan</a>
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
