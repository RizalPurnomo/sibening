<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style type="text/css">
    #divTglAvailable ul{
        list-style: none;
        width: 500px; 
    }

    #divTglAvailable ul li{ 
        width: 100%;
        height: 40px;
        line-height: 40px;
        padding: 0 5px;
        position: relative;
        display: block;
        margin: 5px 0;
        border: 1px solid #000000;
        /* box-shadow: -3px 6px 4px #222; */
    }
    #divTglAvailable ul li span{
        position: absolute;
        top: 0;
        right: 0;
        width: 50px;
        text-align: center;
        background: #e00;
        cursor: pointer;
    }
</style>

<script type="text/javascript">
    const jadwalAvailable = [];
    window.onload = function test(){
        //set JadwalAvailable saat di load
        a = document.getElementById('tglArray').value;
        tglArray = a.split(",");
        for (let i = 0; i < tglArray.length; i++) {
            jadwalAvailable.push(tglArray[i]);
        }
        
    }

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
        var dateTime = year + '/' + month + '/' + day ;
        return dateTime;
    }    

    function lengkapiData(){
        Swal.fire({
            icon: 'warning',
            text: 'Harap Melengkapi Data!',
        })
        return;        
    }

    function addJadwal(){    
        tanggal = getDateTime(new Date($("#datepicker").val()));
        if(jadwalAvailable.includes(tanggal)){
            alert("Tanggal ini sudah di daftarkan");
            return;
        }else{
            jadwalAvailable.push(tanggal);
        }
        // console.log(jadwalAvailable);
        getJadwal(tanggal);

    }


    function getJadwal(tanggal){
        const ul = document.getElementById('ulDiv');
        
        const li = document.createElement('li');
        const text = document.createTextNode(tanggal);
        const span = document.createElement('span');
        span.setAttribute('onclick','hapus()');
        
        const textClose = document.createTextNode('x');

        ul.appendChild(li);
            li.appendChild(text);
                li.appendChild(span);
                    span.appendChild(textClose);       
    }    

    function hapus() {
        $('#divTglAvailable ul li').click(function () {
            $('#divTglAvailable ul li').removeClass('selected');
            $(this).addClass('selected');
            $('#divTglAvailable ul li.selected').remove();
            tanggal = $(this).text().substr(0,10); 
            
            //remove array jadwalAvailable
            const index = jadwalAvailable.indexOf(tanggal);
            if (index > -1) {
                jadwalAvailable.splice(index, 1);
            }
        });

    }      

    async function updateCourse() {
    if ($("#kategori").val() == "" || $("#title").val() == "" ) {
        lengkapiData();
    }

    if($("#fileupload").val()==""){
            if($("#chkTraining").is(':checked')){
                if ($("#trainer").val() == "" || $("#maxpeserta").val() == "" || jadwalAvailable.toString() == "" ) {
                    lengkapiData();
                }
                var dataArray = {
                    "course": {
                        "title": $("#title").val(),
                        "jpl": $("#jpl").val(),
                        "materi": $("#materi").val(),
                        "idkategori" : $("#kategori").val(),
                        "tglavailablepraktek" : jadwalAvailable.toString(),
                        "trainer" : $("#trainer").val(),
                        "maxpeserta" : $("#maxPeserta").val()
                    }
                }                

            }else{
                var dataArray = {
                    "course": {
                        "title": $("#title").val(),
                        "jpl": $("#jpl").val(),
                        "materi": $("#materi").val(),
                        "idkategori" : $("#kategori").val(),
                        "tglavailablepraktek" : "",
                        "trainer" : "",
                        "maxpeserta" : ""
                    }
                }                
            }
    }else{
        upload =fileupload.files[0].name;
        let formData = new FormData(); 
        formData.append("file", fileupload.files[0]);
        await fetch('upload', {
            method: "POST", 
            body: formData
        });  
        if($("#chkTraining").is(':checked')){
            if ($("#trainer").val() == "" || $("#maxpeserta").val() == "" || jadwalAvailable.toString() == "" ) {
                lengkapiData();
            }                
            var dataArray = {
                "course": {
                    "title": $("#title").val(),
                    "jpl": $("#jpl").val(),
                    "materi": $("#materi").val(),
                    "idkategori" : $("#kategori").val(),
                    "tglavailablepraktek" : jadwalAvailable.toString(),
                    "trainer" : $("#trainer").val(),
                    "maxpeserta" : $("#maxPeserta").val(),                    
                    "filemateri" : upload
                }
            }                
        }else{
            var dataArray = {
                "course": {
                    "title": $("#title").val(),
                    "jpl": $("#jpl").val(),
                    "materi": $("#materi").val(),
                    "idkategori" : $("#kategori").val(),  
                    "tglavailablepraktek" : "",
                    "trainer" : "",
                    "maxpeserta" : "",              
                    "filemateri" : upload
                }
            }                   
             
        }
    }

    console.log(dataArray);
    // return;
    $.ajax({
        type: "POST",
        data: dataArray,
        url: '<?php echo base_url('admin/course/updateCourse/'); ?>' + $("#idcourse").val(),
        success: function(result) {
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil Disimpan',
                showConfirmButton: false,
                timer: 1500
            })

            // console.log(result);
            window.location = "<?php echo base_url(); ?>admin/course";
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
            <h1 class="m-0 text-dark">Course Edit</h1>
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
                        Input Data Course
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Id Course</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="idcourse" placeholder="Id Course" value="<?php echo $course[0]['idcourse']; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" id="kategori">
                                        <option value="">-- Select Category--</option>
                                        <?php for ($a = 0; $a < count($kategori); $a++) {  ?>
                                            <option value="<?php echo $kategori[$a]['idkategori'] ?>" <?php echo ($kategori[$a]['idkategori'] == $course[0]['idkategori'] ?  'selected' : '') ?> >
                                                <?php echo $kategori[$a]['kategori']  ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" placeholder="Title" value="<?php echo $course[0]['title']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">JPL</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jpl" placeholder="JPL" value="<?php echo $course[0]['jpl']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Materi
                                            </h3>
                                            <!-- tools box -->
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                                        title="Collapse">
                                                <i class="fas fa-minus"></i></button>
                                            </div>
                                            <!-- /. tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body pad">
                                            <div class="mb-3">
                                                <textarea class="textarea" id="materi" placeholder="Place some text here"
                                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $course[0]['materi']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="container-fluid">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label class="col-sm-2 col-form-label">File</label>
                                                        <div class="col-sm-10">
                                                            <input id="fileupload" type="file" name="fileupload" /> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="<?php echo base_url('uploads/') . $course[0]['filemateri'] ; ?>" target="_blank" ><?php echo $course[0]['filemateri']; ?></a>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>                                      
                                    </div>
                                </div>                                
                            </div>       
                            
                            <div class="card">
                                <div class="card-header">
                                    <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button> -->
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="chkTraining" data-toggle='collapse' data-target='#praktek' <?php if($course[0]['tglavailablepraktek']==""){ echo '';}else{echo 'checked'; } ?> >
                                            <label for="chkTraining" class="custom-control-label">Training</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="praktek" class="<?php if($course[0]['tglavailablepraktek']==""){ echo 'collapse';}else{echo 'collapse show'; } ?>" >
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Trainer</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="trainer" placeholder="Nama Trainer" value="<?php echo $course[0]['trainer']; ?>" checked > 
                                            </div>
                                        </div>                          
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tanggal</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="datepicker">
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <button class="btn btn-info" onclick="addJadwal()">+</button>
                                            </div>
                                        </div>   

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <input type="hidden" class="form-control" id="tglArray" placeholder="Tanggal Praktek Array" value="<?php echo $course[0]['tglavailablepraktek']; ?>" > 
                                                <div id="divTglAvailable">
                                                    <ul id="ulDiv">
                                                        <?php 
                                                            if($course[0]['tglavailablepraktek']!=""){
                                                                $arr = explode(",",$course[0]['tglavailablepraktek']);
                                                                for ($i=0; $i < count($arr) ; $i++) { 
                                                                    echo "<li class='$i'>$arr[$i]<span onclick='hapus()'>X</span></li>";
                                                                }
                                                            }
                                                        ?>
                                                    </ul>
                                                </div>                                                
                                                <!-- <div id="divTglAvailable">
                                                    <ul>

                                                    </ul>
                                                </div> -->
                                            </div>
                                        </div>   

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Jumlah Peserta</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="maxPeserta" placeholder="Max Peserta Per Hari" value="<?php echo $course[0]['maxpeserta']; ?>" >
                                            </div>
                                        </div> 
                                    </div>         
                                </div>    
                            </div> 

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button onclick="updateCourse()" class="btn btn-info">Update</button>
                            <!-- <button class="btn btn-default float-right">Cancel</button> -->
                        </div>
                        <!-- /.card-footer -->
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


