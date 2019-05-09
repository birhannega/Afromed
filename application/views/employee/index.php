

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employee management
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Employees </a></li>
        <li class="active"></li>
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
          
          <?php if(in_array('createUser', $user_permission)): ?>
            <a href="<?php echo base_url('employee/create') ?>" class="btn btn-primary">Add Employee</a>
            <br /> <br />
          <?php endif; ?>
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Users List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="userTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Full name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Salary</th>
                  <?php if(in_array('updateEmployee', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                  <th>Action</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php if($user_data): ?>                  
                    <?php foreach ($user_data as $k => $v): ?>
                      <tr>
                        <td class="text-capitalize"><?php echo  $v['user_info']['emp_first_name'] .' '. $v['user_info']['emp_middle_name'].' '. $v['user_info']['emp_last_name']; ?></td>
                          <td><?php echo $v['user_info']['emp_email']; ?></td>
                          <td><?php echo $v['user_info']['emp_phone']; ?></td>
                          <td><?php echo $v['user_info']['emp_salary']; ?></td>
                        <?php if(in_array('updateEmployee', $user_permission) || in_array('deleteEmployee', $user_permission)|| in_array('ViewEmployee', $user_permission)): ?>

                        <td>
                          <?php if(in_array('viewEmployee', $user_permission)): ?>
                            <a href="<?php echo base_url('employee/show/'.$v['user_info']['emp_user_id']) ?>" class="btn btn-default"><i class="fa fa-eye"></i></a>
                          <?php endif; ?>
                            <?php if(in_array('updateEmployee', $user_permission)): ?>
                            <a href="<?php echo base_url('employee/edit/'.$v['user_info']['emp_user_id']) ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                          <?php endif; ?>
                          <?php if(in_array('deleteEmployee', $user_permission)): ?>
                            <a href="<?php echo base_url('employee/delete/'.$v['user_info']['emp_user_id']) ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
                          <?php endif; ?>
                        </td>
                      <?php endif; ?>
                      </tr>
                    <?php endforeach ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
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
    $(document).ready(function() {
      $('#userTable').DataTable();
    });
  </script>
