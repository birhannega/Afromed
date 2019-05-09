<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User
            <small>Profile <a href="<?php echo base_url('employee/edit/').$user_data['emp_user_id'];?>">edit</a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Profile </li>
        </ol>
    </section>

    <!-- Main content -->
    <section style="color:#800080" class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title text-capitalize">Profile
                            of <?php echo $user_data['emp_first_name'].'  '. $user_data['emp_middle_name']; ?> </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-condensed table-hovered">

                            <tr>
                                <th>USER ID</th>
                                <td><?php echo $user_data['emp_user_id']; ?></td>
                            </tr>
                            <tr>
                                <th>Full Name</th>
                                <td class="text-capitalize"><?php echo $user_data['emp_first_name'].' '.$user_data['emp_middle_name'].' '. $user_data['emp_last_name']; ?></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td class="text-capitalize">
                                    <?php echo ($user_data['emp_gender'] == 'Male') ? 'Male' : 'Female'; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Birth Date</th>
                                <td class="text-capitalize"><?php echo $user_data['emp_birth_date']; ?></td>
                            </tr>
                            <tr>
                                <th>Hire Date</th>
                                <td class="text-capitalize"><?php echo $user_data['emp_hire_date']; ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?php echo $user_data['emp_phone']; ?></td>
                            </tr>
                            <tr>
                                <th>Email address</th>
                                <td><?php echo $user_data['emp_email']; ?></td>
                            </tr>
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

 
