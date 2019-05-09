<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> item
            <small> import</small>
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
                <?php if(in_array('createProduct', $user_permission)): ?>
                    <a href="<?php echo base_url('entries/') ?>" class="btn btn-primary">List Entry</a>
                    <br /> <br />
                <?php endif; ?>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" action="<?php base_url('entries/create') ?>" method="post"
                          enctype="multipart/form-data">
                        <div class="box-body">
                            <?php echo validation_errors(); ?>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="product_name">Entry Date </label>
                                    <input data-type="date" type="text" class="form-control" id="entrydate"
                                           name="item_entrydate">
                                </div>

                                <div class="form-group">
                                    <label for="item_id" class="col-sm-5 control-label">select item</label>
                                    <select type="text" class="form-control" id="item_id" name="item_id">
                                        <option value="">choose one</option>
                                        <?php
                                        foreach ($items as $key=>$value) {
                                            $id = $items[$key]['ID'];
                                            $name = $items[$key]['name'];

                                            echo '<option value="' . $id . '">' . $name . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="item_quantity">Quantity </label>
                                    <input type="text" class="form-control" id="item_quantity" name="item_quantity"
                                           placeholder="Enter Quantity" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="item_average_price">unit price</label>
                                    <input type="number" step="0.001" class="form-control" id="item_average_price"
                                           name="item_average_price" placeholder="Average price" autocomplete="off"/>
                                </div>
                                <div class="form-group ">
                                    <label for="item_entry_remark">remark </label>
                                    <input type="text"  class="form-control" id="item_entry_remark"
                                           name="item_entry_remark" placeholder="some info about entry " autocomplete="off"/>
                                </div>
                                <input readonly id="subtotal" name="subtotal" type="number" step="0.0001">
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?php echo base_url('products/') ?>" class="btn btn-warning">Back</a>
                        </div>
                    </form>

                    <div class="bg-info"><strong>Total payment: ETB <span id="totalprice"> </span></strong></div>
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