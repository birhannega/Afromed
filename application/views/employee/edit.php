

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Manage user
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> </a></li>
        <li class="active">User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">edit</h3>
            </div>
            <form role="form" action="<?php base_url('users/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>


                <div class="form-group">
                  <label for="fname">first name</label>
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name"
                         value="<?php echo $user_data['emp_first_name'] ?>" autocomplete="off">
                </div>
                  <div class="form-group">
                      <label for="mnmae">middle name</label>
                      <input type="text" class="form-control" id="mname" name="mname" placeholder="middle Name"
                             value="<?php echo $user_data['emp_middle_name'] ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="lname">Last name</label>
                      <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name"
                             value="<?php echo $user_data['emp_last_name'] ?>" autocomplete="off">
                  </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                         value="<?php echo $user_data['emp_email'] ?>" autocomplete="off">
                </div>

                  <div class="form-group">
                      <label for="salary">salary</label>
                      <input type="text" class="form-control" id="salary" name="salary"
                             placeholder="salary"
                             autocomplete="off"
                             value="<?php echo $user_data['emp_salary'] ?>">
                  </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"
                         value="<?php echo $user_data['emp_phone'] ?>" autocomplete="off">
                </div>
                  <div class="form-group">
                      <label for="phone">Hired Date</label>
                      <input type="text" class="form-control datepicker" id="hdate" name="hdate" placeholder="hdate"
                             value="<?php echo $user_data['emp_hire_date'] ?>" autocomplete="off">
                  </div>

                <div class="form-group">
                  <label for="gender">Gender</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" id="male" value="1" <?php if($user_data['emp_gender'] == 1) {
                        echo "checked";
                      } ?>>
                      Male
                    </label>
                    <label>
                      <input type="radio" name="gender" id="female" value="2" <?php if($user_data['emp_gender'] == 2) {
                        echo "checked";
                      } ?>>
                      Female
                    </label>
                  </div>
                </div>


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('employees/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
      $('.datepicker').datepicker({
          todayHighlight:true,
          format:'yyyy-mm-dd'
      });
  </script>

