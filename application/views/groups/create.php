<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update user permission
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
            <li class="active"> Roles</li>
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
                    <form role="form" action="<?php base_url('groups/create') ?>" method="post">
                        <div class="box-body">
                            <?php echo validation_errors(); ?>
                            <div class="form-group">
                                <label for="group_name">User Role </label>
                                <input type="text" class="form-control" id="group_name" name="group_name">
                            </div>
                            <div class="form-group">
                                <label for="permission"> Check all Permissions</label>
                                <table name="tblpermissions" id="tblpermissions" class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Create</th>
                                        <th>Update</th>
                                        <th>View</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Items</td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="createitem" class="minimal">
                                        </td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="updateitem" class="minimal">
                                        </td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="viewitem" class="minimal">
                                        </td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="deleteitem" class="minimal"></td>
                                    </tr>
                                    <tr>
                                        <td>Profile</td>
                                        <td>
                                            <input type="checkbox" name="permission[]" id="permission"
                                                   value="createProfile" class="minimal">
                                        </td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="editProfile" class="minimal">
                                        </td>
                                        <td>
                                            <input type="checkbox" name="permission[]" id="permission"
                                                   value="viewProfile" class="minimal">
                                        </td>
                                        <td>
                                            <input type="checkbox" name="permission[]" id="permission"
                                                   value="deleteProfile" class="minimal">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Category</td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="createCatagory" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="updateCatagory" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="viewCategory"
                                                   class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="deleteCatagory" class="minimal"></td>
                                    </tr>
                                    <tr>
                                        <td>User</td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="createUser" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="updateUSer" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="viewUSer"
                                                   class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="deleteUser" class="minimal"></td>
                                    </tr>
                                    <tr>
                                        <td>Employee</td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="createEmployee" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="updateEmployee" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="viewEmployee"
                                                   class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="deleteEmployee" class="minimal"></td>
                                    </tr>
                                    <tr>
                                        <td>Credit</td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="createCredit" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="updateCredit" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="viewCredit"
                                                   class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="deleteCredit" class="minimal"></td>
                                    </tr>
                                    <tr>
                                        <td>Sales</td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="createSales" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="updateSales" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="viewSales"
                                                   class="minimal"></td>
                                        <td>
                                            <input type="checkbox" name="permission[]" id="permission"
                                                   value="deleteSales" class="minimal">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Groups</td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="createGroup" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="updateGroup" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="viewGroup"
                                                   class="minimal"></td>
                                        <td>
                                            <input type="checkbox" name="permission[]" id="permission"
                                                   value="deleteGroup" class="minimal">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?php echo base_url('groups/') ?>" class="btn btn-warning">Back</a>
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

    $('input[type="checkbox"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
</script>
