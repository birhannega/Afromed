<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit category
         
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> </a></li>
            <li class="active">edit</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <?php
    
        if(isset($entry_data)&& !empty($entry_data)) {
            foreach ($entry_data as $value) {
                $entry_data = array(
                    'cat_id' => $value->cat_id,
                    'cat_name' => $value->cat_name,
                    'cat_desc' => $value->cat_desc,
                    'cat_created_by' => $value->cat_created_by,
                    'cat_created_date' => $value->cat_created_date,
                    'cat_remark' => $value->cat_remark,
                );
                ?>
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


                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    <h5 class="text-uppercase"> edit category #<?php echo $value->cat_id ?></h5>

                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <form role="form" action="<?php base_url('category/update') ?>" method="post"
                                  enctype="multipart/form-data">
                                <div class="box-body">
                            
                                    <?php echo validation_errors(); ?>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="cat_name">Name </label>
                                            <input type="text" class="form-control" id="cat_name"
                                                   name="cat_name" value="<?= $entry_data['cat_name'] ?>">
                                        </div>


                                        <div class="form-group">
                                            <label for="cat_desc">Description </label>
                                            <input type="text" class="form-control" id="item_quantity" name="cat_desc"
                                                   placeholder="Enter Description"
                                                   value="<?= $entry_data['cat_desc'] ?>"
                                                   autocomplete="off"/>
                                        </div>


                                        <div class="form-group ">
                                            <label for="cat_remark">remark </label>
                                            <input type="text" class="form-control" id="cat_remark"
                                                   value="<?= $entry_data['cat_remark'] ?>"
                                                   name="cat_remark" placeholder="some info about entry "
                                                   autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <a href="<?php echo base_url('products/') ?>" class="btn btn-warning">Back</a>
                                </div>
                            </form>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- col-md-12 -->
                </div>
                <!-- /.row -->
                <?php
            }
        }
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

    $(document).ready(function () {
        $("input[data-type=date").datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#item_quantity').on('click', function () {
            var average = $('#item_average_price').val();
            var quantity = $('#item_quantity').val();
            if (quantity == null) {
                alert('enter quantity');
            } else {
                $('#totalprice').html(average * quantity);
                $('#subtotal').attr('value', average * quantity);

            }
        });
        $('#item_average_price').on('click', function () {
            var average = $('#item_average_price').val();
            var quantity = $('#item_quantity').val();
            if (quantity == null) {
                alert('enter quantity');
            } else {
                $('#totalprice').html(average * quantity);
                $('#subtotal').attr('value', average * quantity);

            }
        });
    });
</script>