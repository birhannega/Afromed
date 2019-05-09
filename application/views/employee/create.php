<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Register employee
            <small>Add new employee </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('users')?>"><i class="fa fa-dashboard"></i> <?php echo $this->uri->segment(2)?> </a></li>
            <li class="active"></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php elseif ($this->session->flashdata('error')): ?>
                    <div class="alert alert-error alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <form role="form" action="<?php base_url('users/create') ?>" method="post">
                        <div class="box-body">
                            <?php echo validation_errors(); ?>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="fname">First name</label>
                                    <input type="text" class="form-control" id="fname" name="fname"
                                           placeholder="First name"
                                           required="required"
                                           autocomplete="off"
                                           value="<?php echo set_value('fname')?>">
                                </div>
                                <div class="form-group">
                                    <label for="mname">Middle name</label>
                                    <input type="text" class="form-control" id="mname" name="mname"
                                           placeholder="First name"
                                           required="required"
                                           autocomplete="off"
                                           value="<?php echo set_value('mname')?>">
                                </div>

                                <div class="form-group">
                                    <label for="lname">Last name</label>
                                    <input type="text" class="form-control" id="lname" name="lname"
                                           placeholder="Last name"
                                           required="required"
                                           autocomplete="off" value="<?php echo set_value('lname')?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                           autocomplete="off"
                                           required="required"
                                           value="<?php echo set_value('email')?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"
                                           autocomplete="off"
                                           required="required"
                                           value="<?php echo set_value('phone')?>">
                                </div>
                                <div class="form-group">
                                    <label for="salary">salary</label>
                                    <input type="text" class="form-control" id="salary" name="salary"
                                           placeholder="salary"
                                           autocomplete="off"
                                           required="required"
                                           value="<?php echo set_value('salary')?>">
                                </div>
                                <div class="form-group">
                                    <label for="hdate">Hire Date</label>
                                    <input type="text" class="form-control datepicker" id="hdate" name="hdate"
                                           placeholder="hiredate"
                                           autocomplete="off"
                                           required="required"
                                           value="<?php echo set_value('hdate')?>">
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" id="male" value="male">
                                            Male
                                        </label>
                                        <label>
                                            <input type="radio" name="gender" id="female" value="female">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?php echo base_url('employee/') ?>" class="btn btn-warning">Back</a>
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