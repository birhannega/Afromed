

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage item information
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
        
        <div class="box">
          <div class="box-header">
              <h3 class="box-title">Edit item #<?php echo $item_data['itm_id'] ?></h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('items/update') ?>" method="post" class="form-group">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class=" col-xs-12 pull pull-left">

                  <div class="form-group">
                    <label for="itemname" class="col-sm-5 control-label">Item name</label>
                      <input type="text" class="form-control" id="itemname" name="itemname"
                             placeholder="Enter item name "
                             value="<?php echo  $item_data['itm_name'] ?>" autocomplete="off"/>

                  </div>
                
                 <div class="form-group">
                    <label for="Price" class="col-sm-5 control-label">Current Price</label>
                      <input type="number" class="form-control" id="price"
                             name="price" placeholder="Enter current price"
                             value="<?php echo $item_data['itm_minimum_price'] ?>" autocomplete="off"/>
                  </div>
                    <div class="form-group">
                        <label for="itemcategory" class="col-sm-5 control-label">choose category</label>
                        <select type="text" class="form-control" id="itemcategory" name="itemcategory">
                            <option value="<?php echo !empty($item_data['itm_cat_id'])?$item_data['itm_cat_id']:''?>">
                                <?php echo $item_data['itm_cat_name']?$item_data['itm_cat_name']:'choose one'?>
                            </option>
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
                    <label for="item_remark" class=" control-label">Item remark</label>
                      <input type="text" class="form-control" id="item_remark"
                             name="item_remark" placeholder="Enter item remark"
                             value="<?php echo $item_data['item_remark'] ?>" autocomplete="off">
                  </div>
                </div>
                </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
