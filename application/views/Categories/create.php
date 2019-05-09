<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Category
            <small> Add new category </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">items import</li>
            
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
                <?php if(in_array('viewCatagory', $user_permission)): ?>
                    <a href="<?php echo base_url('category/') ?>" class="btn btn-primary">Category List</a>
                    <br /> <br />
                <?php endif; ?>

                <div class="box">
                    <!-- /.box-header -->
                    <form role="form" action="<?php base_url('Category/create') ?>" method="post"
                          enctype="multipart/form-data">
                        <div class="box-body">
                            <?php echo validation_errors(); ?>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="cat_name"> Name </label>
                                    <input  type="text" class="form-control" id="cat_name"
                                           name="cat_name" placeholder="Enter name of the category">
                                </div>

                                <div class="form-group">
                                    <label for="cat_desc" class="col-sm-5 control-label"> Description </label>
                                    <input  type="text"  class="text-left form-control" id="cat_desc" name="cat_desc" placeholder="Enter catagory description"/>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="cat_remark">Remark </label>
                                    <input type="text" class="form-control" id="cat_remark" name="cat_remark"
                                           placeholder="Enter category remark" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?php echo base_url('category/') ?>" class="btn btn-warning">Back</a>
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

<script type="text/javascript">
    $(document).ready(function () {
        $("input[data-type=date").datepicker({
            format:'yyyy-mm-dd',
            todayHighlight:true,
        });
        $('#item_average_price').on('change',function () {
            var average=$('#item_average_price').val();
            var quantity=$('#item_quantity').val();
            if(quantity==null)
            {
                alert('enter quantity');
            }else{
                $('#totalprice').html(average*quantity);
                $('#subtotal').attr('value',average*quantity);

            }
        })


    });
</script>