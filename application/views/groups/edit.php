<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit permission
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> </a></li>
            <li><a href="<?php echo base_url('groups/') ?>"></a></li>
            <li class="active">Edit Permission</li>
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
                        <h3 class="box-title">Edit</h3>
                    </div>
                    <form role="form" action="<?php base_url('groups/update') ?>" method="post">
                        <div class="box-body">
                            
                            <?php echo validation_errors(); ?>
                            <div class="form-group">
                                <label for="group_name">User Group</label>
                                <input type="text" class="form-control" id="group_name" name="group_name"
                                       placeholder="USer group" value="<?php echo $group_data['group_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="permission">Permissions</label>
                                
                                <?php $serialize_permission = unserialize($group_data['permission']);?>

                                <table class="table table-responsive">
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
                                                <?php if (in_array('createitem', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="createitem" class="minimal">
                                        </td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('updateitem', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="updateitem" class="minimal">
                                        </td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('viewitem', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="viewitem" class="minimal">
                                        </td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('deleteitem', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="deleteitem" class="minimal"></td>
                                    </tr>


                                    <tr>
                                        <td>Profile</td>
                                        <td>
                                            <input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('createProfile', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="createProfile" class="minimal">
                                        </td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('editProfile', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="editProfile" class="minimal">
                                        </td>
                                        <td>
                                            <input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('viewProfile', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="viewProfile" class="minimal">
                                        </td>
                                        <td>
                                            <input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('deleteProfile', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="deleteProfile" class="minimal">
                                        </td>
                                    </tr>
<!--                                    <tr>-->
<!--                                        <td>Lookups</td>-->
<!--                                        <td>-->
<!--                                            <input type="checkbox" name="permission[]" id="permission"-->
<!--                                                --><?php //if (in_array('addLookup', $serialize_permission)): ?>
<!--                                                    checked="checked"-->
<!--                                                --><?php //endif; ?>
<!--                                                   value="addLookup" class="minimal">-->
<!--                                        </td>-->
<!--                                        <td><input type="checkbox" name="permission[]" id="permission"-->
<!--                                                --><?php //if (in_array('updateLookup', $serialize_permission)): ?>
<!--                                                    checked="checked"-->
<!--                                                --><?php //endif; ?>
<!--                                                   value="updateLookup" class="minimal"></td>-->
<!--                                        <td>-->
<!--                                            <input type="checkbox" name="permission[]" id="permission"-->
<!--                                                --><?php //if (in_array('viewLookup', $serialize_permission)): ?>
<!--                                                    checked="checked"-->
<!--                                                --><?php //endif; ?>
<!--                                                   value="viewLookup" class="minimal">-->
<!--                                        </td>-->
<!--                                        <td>-->
<!--                                            <input type="checkbox" name="permission[]" id="permission"-->
<!--                                                --><?php //if (in_array('deleteLookup', $serialize_permission)): ?>
<!--                                                    checked="checked"-->
<!--                                                --><?php //endif; ?>
<!--                                                   value="deleteLookup" class="minimal">-->
<!--                                        </td>-->
<!--                                    </tr>-->

                                    <tr>
                                        <td>Category</td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('createCatagory', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="createCatagory" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('updateCatagory', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="updateCatagory" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('viewCategory', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="viewCategory"
                                                   class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('deleteCatagory', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="deleteCatagory" class="minimal"></td>
                                    </tr>
                                    <tr>
                                        <td>User</td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('createUser', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="createUser" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('updateUSer', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="updateUSer" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('viewUSer', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="viewUSer"
                                                   class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('deleteUser', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="deleteUser" class="minimal"></td>
                                    </tr>
                                    <tr>
                                        <td>Employee</td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('createEmployee', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="createEmployee" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('updateEmployee', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="updateEmployee" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('viewEmployee', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="viewEmployee"
                                                   class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('deleteEmployee', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="deleteEmployee" class="minimal"></td>
                                    </tr>
                                    <tr>
                                        <td>Credit</td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('createCredit', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="createCredit" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('updateCredit', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="updateCredit" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                   value="viewCredit"
                                                <?php if (in_array('viewCredit', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('deleteCredit', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="deleteCredit" class="minimal"></td>
                                    </tr>
                                    <tr>
                                        <td>Sales</td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('createSales', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="createSales" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('updateSales', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="updateSales" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('viewSales', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="viewSales"
                                                   class="minimal"></td>
                                        <td>
                                            <input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('deleteSales', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="deleteSales" class="minimal">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Groups</td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('createGroup', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="createGroup" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('updateGroup', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="updateGroup" class="minimal"></td>
                                        <td><input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('viewGroup', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="viewGroup"
                                                   class="minimal"></td>
                                        <td>
                                            <input type="checkbox" name="permission[]" id="permission"
                                                <?php if (in_array('deleteGroup', $serialize_permission)): ?>
                                                    checked="checked"
                                                <?php endif; ?>
                                                   value="deleteGroup" class="minimal">
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update Changes</button>
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
    $(document).ready(function () {
        $("#mainGroupNav").addClass('active');
        $("#manageGroupNav").addClass('active');

        $('input[type="checkbox"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    });
</script>
