<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h4>
           <a href="<?php echo base_url('items')?>"><button class="btn btn-success">List</button></a>

            Items managment
            <small>Create</small>
        </h4>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> </a></li>
            <li class="active"></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12 col-xs-12">

                <div id="messages"></div>

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
                <?php if(in_array('createProduct', $user_permission)): ?>
                    <a href="<?php echo base_url('items/') ?>" class="btn btn-success"> <span class="fa fa-list-alt"></span> List</a>
                    <br /> <br />
                <?php endif; ?>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add new item </h3>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" action="<?php echo base_url('items/create') ?>" method="post" class="form-group">
                        <div class="box-body">
                                <?php echo validation_errors(); ?>

                                    <div class="form-group">
                                        <label for="itemname" class="control-label">Item name</label>
                                        <input type="text" class="form-control" id="itemname" name="itemname"
                                               placeholder="Enter name of the item" autocomplete="off"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="itemcategory" class="col-sm-5 control-label">choose category</label>
                                        <select type="text" class="form-control" id="itemcategory" name="itemcategory">
                                            <option value="">choose one</option>
                                            <?php
                                            foreach ($category_data as $key=>$value) {
                                                $id = $category_data[$key]['cat_id'];
                                                $name = $category_data[$key]['cat_name'];

                                                echo '<option value="' . $id . '">' . $name . '</option>';
                                            }
                                            ?>

                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="itemprice" class="control-label">Current Price </label>
                                        <input type="number" step="0.001" class="form-control" id="itemprice"
                                               name="itemprice"
                                               placeholder="Enter item price " autocomplete="off">
                                    </div>

                                <div class="form-group">
                                    <label for="itemremark" class="control-label">Item remark</label>
                                    <input type="text" class="form-control" id="item_remark" name="item_remark"
                                           placeholder="Enter remark if any" autocomplete="off">

                                </div>
                            </div>
                </div>
            <!-- /.box-body -->
            <div class="box-footer">

                <button type="submit" class="btn btn-primary">Create</button>
                <a href="<?php echo base_url('items/') ?>" class="btn btn-warning">Back</a>
            </div>
            </form>
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