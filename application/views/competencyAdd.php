<?php $this->load->view('header'); ?>


<script type="text/javascript">

    function getDateTime($tgl) {
        if ($tgl == "now") {
            var now = new Date();
        } else {
            var now = $tgl;
        }
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var day = now.getDate();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        if (month.toString().length == 1) {
            var month = '0' + month;
        }
        if (day.toString().length == 1) {
            var day = '0' + day;
        }
        if (hour.toString().length == 1) {
            var hour = '0' + hour;
        }
        if (minute.toString().length == 1) {
            var minute = '0' + minute;
        }
        if (second.toString().length == 1) {
            var second = '0' + second;
        }
        var dateTime = year + '/' + month + '/' + day + ' ' + hour + ':' + minute + ':' + second;
        return dateTime;
    }

    async function saveCompetency() {
        let today = new Date(),
            curr_hour = today.getHours(),
            curr_min = today.getMinutes(),
            curr_sec = today.getSeconds();

        tanggal = getDateTime(new Date($("#datepicker").val() + " " + curr_hour + ":" + curr_min + ":" + curr_sec));


        if ($("#datepicker").val() == "" || $("#instance").val() == "" || $("#title").val() == "" || $("#jpl").val() == "" ) {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }
        if($("#fileupload").val()==""){
            var dataArray = {
                "competency": {
                    "nip": $("#nip").val(),
                    "date": tanggal,
                    "title": $("#title").val(),
                    "instance" : $("#instance").val(),
                    "jplrequest" : $("#jplReq").val(),
                    "statuscompetency" : 'pending'
                }
            }            
        }else{
            upload = $("#nama").val() + " - " + fileupload.files[0].name;
            let formData = new FormData(); 
            formData.append("file", fileupload.files[0]);
            await fetch('upload', {
                method: "POST", 
                body: formData
            });       
            var dataArray = {
                "competency": {
                    "nip": $("#nip").val(),
                    "date": tanggal,
                    "title": $("#title").val(),
                    "instance" : $("#instance").val(),
                    "jplrequest" : $("#jplReq").val(),
                    "files" : upload,
                    "statuscompetency" : 'pending'
                }
            }              
        }
        // return;


        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('competency/saveData'); ?>',
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500
                })

                console.log(result);
                window.location = "<?php echo base_url(); ?>competency";
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
              <li class="breadcrumb-item active">Competency Add</li>
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
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3>Competency Add</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="nama" placeholder="Nama" value="<?php echo $this->session->userdata('nama_lengkap'); ?>">
                            <input type="hidden" class="form-control" id="nip" placeholder="NIP" value="<?php echo $this->session->userdata('nip'); ?>">
                            <input type="text" class="form-control" id="title" placeholder="Title">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Instance</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="instance" placeholder="Instance">
                        </div>
                    </div>                                        
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">JPL Request</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jplReq" placeholder="JPL Request">
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker">
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Upload</label>
                        <div class="col-sm-10">
                            <input  id="fileupload" type="file" size="40px" name="fileupload" />
                        </div>
                    </div>  
                                     
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button onclick="saveCompetency()" class="btn btn-info">Simpan</button>
                </div>                  
              </div>

            </div>
          </div>
          
          <?php $this->load->view('courseInformation'); ?>

        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->



    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('footer'); ?>
