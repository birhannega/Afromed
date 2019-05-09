<link rel="stylesheet" type="text/css/style.css">

<style>

    @keyframes slider {
        0% {
            left: 0;
        }
        2% {
            left: 0;
        }
        7% {
            left: -100;
        }
        20% {
            left: -100;
        }
        25% {
            left: -100;
        }
        45% {
            left: -200;
        }
        50% {
            left: -200;
        }
        60% {
            left: -300;
        }
        70% {
            left: -300;
        }
        75% {
            left: -300;
        }
        80% {
            left: -400;
        }
        95% {
            left: -400;
        }
        100% {
            left: -400;
        }

    }

    #slider {
        overflow: hidden;
    }

    #slider figure img {
        width: 25%;
    }


</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>KASS stock</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="panel panel-default">
            <div class="panel-heading">Kass house hold materials</div>
            <div class="panel-body">
                <!-- Small boxes (Stat box) -->

                <?php
                $is_admin=true;
                
                if ($is_admin == true): ?>

                    <div class="row">

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?php echo $total_items ?> </h3>
                                    <p>Items </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url('items/') ?>" class="small-box-footer"> view all <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-orange">
                                <div class="inner">
                                    <h3><?php echo $total_categories; ?>  </h3>

                                    <p>Categories </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url('sales/') ?>" class="small-box-footer"> view all <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-fuchsia-active">
                                <div class="inner">
                                    <h3> 0<?php // echo $total_products ?></h3>

                                    <p>Items </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url('products/') ?>" class="small-box-footer"> view all <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3> 0 <span class="fa fa-shopping-cart"></span><?php //echo $total_products ?></h3>

                                    <p>sales today </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url('sales/') ?>" class="small-box-footer"> view all <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>


                    </div>
                    <!-- /.row -->
                <?php endif; ?>

<div class="col-lg-12">
    <div class="col-lg-8">
        <div class="row">
        <table class="table table-bordered">
            <thead>
            <th>#</th>
            <th>Item</th>
            <th>Qunatity</th>
            <th>Unit Price</th>
            <th>Total gross income</th>
            </thead>
            <tbody>

            </tbody>
        </table>
        </div>
    </div>
    <div class="col-lg-4 pull-right">
        <div class="row">
            <div class="calendar" id="calendar"></div>
        </div>
    </div>
</div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        $("#dashboardMainMenu").addClass('active');
        $('#calendar').datepicker({
            todayHighlight:true
        });
    });
</script>


</body>
</html>