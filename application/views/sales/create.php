<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sales management
            <small></small>
        </h1>
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
                <?php if (in_array('createProduct', $user_permission)): ?>
                    <a href="<?php echo base_url('sales/') ?>" class="btn btn-success">Sales</a>
                    <br/> <br/>
                <?php endif; ?>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Sell an item </h3>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" action="<?php echo base_url('sales/create') ?>" method="post" class="form-group">
                        <div class="box-body">
                            <?php echo validation_errors(); ?>
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="solditem" class="col-sm-5 control-label">choose item</label>
                                        <select type="text" class="form-control" id="solditem" name="solditem">
                                            <option value="">choose one</option>
                                            <?php
                                            foreach ($items as $key => $value) {
                                                $id = $items[$key]['ID'];
                                                $name = $items[$key]['name'];
                                                echo '<option value="' . $id . '">' . $name.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="soldprice" class="control-label">Unit Price </label>
                                        <input type="number" max=""  class="form-control" id="soldprice"
                                               name="soldprice"
                                               placeholder="Enter price " autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="soldquantity" class="control-label">Quantity </label>
                                        <input required type="number" min="1" max=""  class="form-control" id="soldquantity"
                                               name="soldquantity"
                                               placeholder="Enter qunatity " autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="sellpayment" class="control-label"> Payment Method </label>
                                        <select class="form-control" id="sellpayment"
                                                name="sellpayment"
                                                autocomplete="off" required>
                                            <option value="">choose one</option>
                                            <option value="cash">Cash</option>
                                            <option value="check">check</option>
                                            <option value="bankTransfer">Bank transfer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="buyerinfo" class="control-label"> Buyer info</label>
                                        <input type="text" class="form-control" name="buyerinfo" id="buyerinfo"
                                               placeholder="Enter some info about buyer ">
                                    </div>
                                    <div class="form-group">
                                        <label for="sale_remark" class="control-label">Remark</label>
                                        <input type="text" class="form-control" id="sale_remark" name="sale_remark"
                                               placeholder="Enter remark if any" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="<?php echo base_url('sales/') ?>" class="btn btn-warning">Back</a>
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
    var base_url = "<?php echo base_url(); ?>";
    var object;
    $('#solditem').on('change',function () {
      var item= $('#solditem option:selected').val();
       console.log($('#solditem option:selected').val());
        console.log($('#solditem option:selected').text());
        
        $.ajax({
            url: base_url + 'items/checkvailablity/' + item,
            dataType: "json",
            success: function (response) {
                console.log(response['name']);
                $('#soldprice').attr('value',response['UnitPrice'])
                $('#soldprice').attr('min',response['UnitPrice'])
                
                $('#soldquantity').attr('placeholder','Available in stock '+response['available'])
                $('#soldquantity').attr('max',response['available'])
                $('#soldquantity').attr('min',0)
                
            }
        });
    });
</script>