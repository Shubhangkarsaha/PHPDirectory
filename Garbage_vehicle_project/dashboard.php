<?php 
	$page_name = "Dashboard";
	include "includes/header.php";
//All status  0-Deleted,1-Active
?>

<section class="content-header">
      <h1>
        Dashboard
        <small>Control Panel For Classic Vehicle Management System</small>
      </h1>
	  <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
</ol>
</section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	  	 <!-- ./col 1 -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Add New Employee</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            <a href="emp_register.php" class="small-box-footer">Click Here For Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col 1 -->
		<!-- ./col 2 -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-violet">
            <div class="inner">
              <h3><?php echo row_count("select * from emp_master where emp_status > '0'");?></h3>

              <p>Employee List</p>
            </div>
            <div class="icon">
              <i class="fa fa-id-card-o"></i>
            </div>
            <a href="emp_list.php" class="small-box-footer">Click Here For Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		<!-- ./col 2 -->
		<!-- ./col 3 -->
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-lgreen">
            <div class="inner">
              <h3><?php echo row_count("select * from vehicle_master where vm_status > '0'");//0-Deleted,1-Active?></h3>

              <p>Vehicle List</p>
            </div>
            <div class="icon">
              <i class="fa fa-car"></i>
            </div>
            <a href="vehicle_list.php" class="small-box-footer">Click Here For Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		<!-- ./col 3 -->
        <!-- ./col 4 -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo row_count("select * from organization_master where om_status > '0' ");?></h3>

              <p>Organization List</p>
            </div>
            <div class="icon">
              <i class="fa fa-building-o"></i>
            </div>
            <a href="organization_list.php" class="small-box-footer">Click Here For Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col 4 -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
	     	  
	  
      <div class="row" >
        <!-- Left col -->
		<!--Calendar-->
        	
		 <!--Calendar-->
         <section class="col-lg-3 connectedSortable">
           
           <div class="box box-solid bg-blue-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle bg-blue-gradient" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                  </ul>
                </div>
                <!--<button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>-->
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-black">
              <div class="row">
                <div class="col-sm-6">
                  <!-- Progress bars -->
                  <div class="clearfix">
                    <span class="pull-left">Demo</span>
                    <small class="pull-right">90%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-blue" style="width: 90%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Demo</span>
                    <small class="pull-right">70%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-blue" style="width: 70%;"></div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                  <div class="clearfix">
                    <span class="pull-left">Demo</span>
                    <small class="pull-right">60%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-blue" style="width: 60%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Demo</span>
                    <small class="pull-right">40%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-blue" style="width: 40%;"></div>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
           
         </section>	
		 
	<!--Email start-->
	
		  <div class="col-md-5" style="height:395px;">
          <div class="box box-info bg-aqua-gradient">
            <div class="box-header bg-aqua-gradient">
              <i class="fa fa-envelope"></i>

              <span class="box-title"><strong>Quick Email</strong></span>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
			<form action="send_email_code.php" name="mail_form" method="post" enctype="multipart/form-data">
            <div class="box-body">
              
                <div class="form-group">
                  <input type="email" class="form-control" id="mail_to" name="mail_to" placeholder="Email to:" required />
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea  name="message" id="message" class="textarea" placeholder="Message"
                            style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              
            </div>
            <div class="box-footer clearfix bg-aqua-gradient">
              <button type="submit" class="pull-right btn btn-default" id="submit">Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
			</form>
          </div>
		  </div>
		<!--Email End-->
		
		<!--Vehicle Icon Section-->
		
		<div class="col-md-1">
          <!-- Info Boxes Style 2 -->
		  <a href="#">
          <div class="info-box bg-yellow" title="Auto">
            <span class="info-box-icon"><i class="fa fa-car"></i></span>
            <!-- /.info-box-content -->
          </div>
		  </a>
          <!-- /.info-box -->
		  <a href="#">
          <div class="info-box bg-green" title="Truck">
            <span class="info-box-icon"><i class="fa fa-truck"></i></span>
            <!-- /.info-box-content -->
          </div>
		  </a>
          <!-- /.info-box -->
		  <a href="#">
          <div class="info-box bg-red" title="Heavy Vehicle">
            <span class="info-box-icon"><i class="fa fa-bus"></i></span>
            <!-- /.info-box-content -->
          </div>
		  </a>
          <!-- /.info-box -->
		  <a href="#">
          <div class="info-box bg-aqua" title="LMV">
            <span class="info-box-icon"><i class="fa fa-taxi"></i></span>
            <!-- /.info-box-content -->
          </div>
		  </a>
          <!-- /.info-box -->
</div>
		  
		<!--Vehicle Icon End-->
		
		<!--Reminder Section-->
		
			<section class="col-lg-3 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <!-- /.nav-tabs-custom -->
          <!-- Chat box -->
          <!-- /.box (chat box) -->
          <!-- TO DO List -->
<div class="box box-primary">
            <div class="box-header bg-violet">
              <i class="ion ion-clipboard"></i>

           <span class="box-title" ><strong>Reminder</strong></span>

             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                <li>
                  <!-- drag handle -->
                  <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                  </span>
                  <!-- checkbox -->
                  <input type="checkbox" value="">
                  <!-- todo text -->
                  <span class="text">Design a nice theme</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Make the theme responsive</span>
                  <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Check your messages </span>
                  <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
				<li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right"> View All</button>
            </div>
          </div>
          <!-- /.box -->

          <!-- quick email widget -->
		</section>
		
		<!--Reminder End-->
		
		  
		
		  
		
    
	<div class="row-md-12">
        <a href="office_wise_vehicle_list.php?Office=1">
		<div class="col-md-2 col-sm-6 col-xs-12">
          <div class="info-box bg-violet">
            <span class="info-box-icon"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" ><strong>Head Office</strong></span>
              <span class="info-box-number"> Vehicles
				
			  </span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    Click Here
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		</a>
        <!-- /.col -->
		<a href="office_wise_vehicle_list.php?Office=2">
        <div class="col-md-2 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><strong>Borough - I</strong></span>
              <span class="info-box-number">Vehicles</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    Click Here
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		</a>
        <!-- /.col -->
		<a href="office_wise_vehicle_list.php?Office=3">
        <div class="col-md-2 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><strong>Borough - II</strong></span>
              <span class="info-box-number">Vehicles</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    Click Here
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		</a>
        <!-- /.col -->
		<a href="office_wise_vehicle_list.php?Office=4">
        <div class="col-md-2 col-sm-6 col-xs-12">
          <div class="info-box bg-orange">
            <span class="info-box-icon"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><strong>Borough - III</strong></span>
              <span class="info-box-number">Vehicles</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    Click Here
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		</a>
        <!-- /.col -->
		<a href="office_wise_vehicle_list.php?Office=5">
		<div class="col-lg-2 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><strong>Borough - IV</strong></span>
              <span class="info-box-number">Vehicles</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    Click Here
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		</a>
		<a href="office_wise_vehicle_list.php?Office=6">
        <div class="col-lg-2 col-sm-6 col-xs-12">
          <div class="info-box bg-lgreen">
            <span class="info-box-icon"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><strong>Borough - V</strong></span>
              <span class="info-box-number">Vehicles</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    Click Here
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		</a>
</div>
	  
	  
	  
	  
	  <div class="row-md-12">
	  	 <!-- ./col 1 -->
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Demo</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            <a href="#" class="small-box-footer">Click Here For Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col 1 -->
		<!-- ./col 2 -->
		
		<!-- ./col 1 -->
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Demo</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            <a href="#" class="small-box-footer">Click Here For Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col 1 -->
		<!-- ./col 2 -->
		
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>&nbsp;<?php //echo row_count("select * from emp_master where emp_status > '0'");?></h3>

              <p>Demo</p>
            </div>
            <div class="icon">
              <i class="fa fa-id-card-o"></i>
            </div>
            <a href="#" class="small-box-footer">Click Here For Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		<!-- ./col 2 -->
		<?php /*?><!-- ./col 3 -->
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-lgreen">
            <div class="inner">
              <h3><?php echo row_count("select * from vehicle_master where vm_status > '0'");//0-Deleted,1-Active?></h3>

              <p>Vehicle List</p>
            </div>
            <div class="icon">
              <i class="fa fa-car"></i>
            </div>
            <a href="#" class="small-box-footer">Click Here For Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		<!-- ./col 3 -->
        <!-- ./col 4 -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo row_count("select * from organization_master where om_status > '0' ");?></h3>

              <p>Organization List</p>
            </div>
            <div class="icon">
              <i class="fa fa-building-o"></i>
            </div>
            <a href="#" class="small-box-footer">Click Here For Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col 4 --><?php */?>
      </div>
	  <!-- /.row (main row) -->
	<?php /*?><div class="row" >
      
       <section class="col-lg-3 connectedSortable">
            
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">Verify 1</h3>
              <h5 class="widget-user-desc">&nbsp;</h5>
            </div>
            <div class="widget-user-image"><img class="img-circle" src="user_images/17.png" height="512" width="512" alt="User Avatar" /></div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php //echo scheme_limit(2);?></h5>
                    <span class="description-text">Accepted</span></div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php //echo scheme_expense(2);?></h5>
                    <span class="description-text">Pending</span></div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header"><?php //echo scheme_balance(2);?></h5>
                    <span class="description-text">Rejected</span></div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
                     
        </section>
        
       
        
       
        
       <section class="col-lg-3 connectedSortable">
            
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">Verify 2</h3>
              <h5 class="widget-user-desc">&nbsp;</h5>
            </div>
            <div class="widget-user-image"><img class="img-circle" src="user_images/17.png" height="512" width="512" alt="User Avatar" /></div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php //echo scheme_limit(2);?></h5>
                    <span class="description-text">Accepted</span></div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php //echo scheme_expense(2);?></h5>
                    <span class="description-text">Pending</span></div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header"><?php //echo scheme_balance(2);?></h5>
                    <span class="description-text">Rejected</span></div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
                     
        </section> 
		
		 <section class="col-lg-3 connectedSortable">
            
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">Expenses</h3>
              <h5 class="widget-user-desc">&nbsp;</h5>
            </div>
            <div class="widget-user-image"><img class="img-circle" src="user_images/17.png" height="512" width="512" alt="User Avatar" /></div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php //echo scheme_limit(2);?></h5>
                    <span class="description-text">Allt.</span></div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php //echo scheme_expense(2);?></h5>
                    <span class="description-text">Expn.</span></div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header"><?php //echo scheme_balance(2);?></h5>
                    <span class="description-text">Baln.</span></div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
                     
        </section>
        
       
        
       
        
       <section class="col-lg-3 connectedSortable">
            
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">Assets</h3>
              <h5 class="widget-user-desc">&nbsp;</h5>
            </div>
            <div class="widget-user-image"><img class="img-circle" src="user_images/17.png" alt="User Avatar" /></div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php //echo scheme_limit(2);?></h5>
                    <span class="description-text">Allt.</span></div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php //echo scheme_expense(2);?></h5>
                    <span class="description-text">Expn.</span></div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header"><?php //echo scheme_balance(2);?></h5>
                    <span class="description-text">Baln.</span></div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
                     
        </section> 
		
	
      
      </div><?php */?>
    
    </section>
	
    <!-- /.content -->
	<?php include "includes/footer.php";?>
 