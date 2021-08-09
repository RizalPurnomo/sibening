          <!-- /.col-md-6 -->
          <div class="col-lg-4">
              <div class="card card-primary card-outline">
                  <div class="card-header">
                    <center><h5>Course Information</h5></center>
                  </div>
                  <div class="card-body">
                    <div>
                      <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-info-circle" aria-hidden="true"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Finish VS Enrolled</span>
                          <span class="info-box-number">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: <?php echo $percentageFinishEnroll ?>%">
                                </div>
                            </div>
                            <span class="info-box-number">
                              <span class="badge badge-success"><?php echo $finishCourse; ?> / <?php echo $enrolledCourse; ?></span>
                            </span>
                          </span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>

                    <div>
                      <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-info-circle" aria-hidden="true"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Get JPL VS Target </span>
                          <span class="info-box-number">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: <?php echo $percentageJplTarget ?>%">
                                </div>
                            </div>
                            <span class="info-box-number">
                              <span class="badge badge-success"><?php echo $getJPL; ?> / <?php echo $targetJPL; ?></span>
                            </span>
                          </span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>   
                    
                    <div>
                      <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-info-circle" aria-hidden="true"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Precentage JPL</span>
                          <span class="info-box-number">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: <?php echo $percentage; ?>%">
                                </div>
                            </div>
                            <span class="info-box-number">
                              <span class="badge badge-success"><?php echo $percentage; ?>% Complete</span>
                            </span>
                          </span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>   
                    
                    <div>
                      <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-info-circle" aria-hidden="true"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">JPL Finish</span>
                          <span class="info-box-number">
                            <span class="badge badge-success"><?php echo $finishJPL; ?></span>
                          </span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>                       

                    <!-- <div class="row">
                      <table border="0">
                        <tr>
                          <td>
                            <center>
                              Finish VS Enrolled    
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: 50%">
                                    </div>
                                </div>
                                <small>
                                    1 / 2
                                </small>                                                             
                            </center>                                
                          </td>
                          <td>
                            <center>
                              Get JPL VS Target   
                              <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: 15%">
                                    </div>
                                </div>
                                <small>
                                    3 / 20
                                </small>                                                                                                
                            </center>                                
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <center>
                              Precentage JPL  
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: 5%">
                                    </div>
                                </div>
                                <small>
                                    5% Complete
                                </small>                                                             
                            </center>                                
                          </td>
                          <td>
                            <center>
                              JPL Finish <br/>
                              <span class="badge badge-success">1</span>
                            </center>                                
                          </td>
                        </tr>
                      </table>
                    </div> -->
                  
                  </div>
              </div>
            </div>
          <!-- /.col-md-6 -->