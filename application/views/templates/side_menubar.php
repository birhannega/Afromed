<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            <li id="dashboardMainMenu">
                <a href="<?php echo base_url('dashboard') ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard </span>
                </a>
            </li>
            <!--            Start Stock Item mangement -->
            <?php if (in_array('createitem', $user_permission) ||
                in_array('updateitem', $user_permission) ||
                in_array('viewitem', $user_permission) ||
                in_array('deleteitem', $user_permission)): ?>
                <li class="treeview" id="mainOrdersNav">
                    <a href="#">
                        <i class="fa fa-list-alt"></i>
                        <span> Inventory</span>
                        <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if (in_array('createitem', $user_permission)): ?>
                            <li id="addOrderNav"><a href="<?php echo base_url('items/create') ?>"><i
                                            class="fa fa-circle-o"></i> Add item </a></li>
                        <?php endif; ?>
                        <?php if (in_array('updateitem', $user_permission) ||
                            in_array('viewitem', $user_permission) ||
                            in_array('deleteitem', $user_permission)): ?>
                            <li id="manageOrdersNav"><a href="<?php echo base_url('items') ?>"><i
                                            class="fa fa-circle-o"></i> manage item</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <!--  End Stock Item mangement -->


            <!--            Start  Item entry -->
            <?php if (in_array('createitem', $user_permission) ||
                in_array('updateitem', $user_permission) ||
                in_array('viewitem', $user_permission) ||
                in_array('deleteitem', $user_permission)): ?>
                <li class="treeview" id="mainProductNav">
                    <a href="">
                        <i class="fa fa-arrow-down"></i>
                        <span>Item Entries</span>
                        <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if (in_array('createitem', $user_permission)): ?>
                            <li id="addProductNav"><a href="<?php echo base_url('entries/create') ?>"><i
                                            class="fa fa-circle-o"></i>New Entry</a></li>
                        <?php endif; ?>
                        <?php if (in_array('updateitem', $user_permission) ||
                            in_array('viewitem', $user_permission) ||
                            in_array('deleteitem', $user_permission)): ?>
                            <li id="manageProductNav"><a href="<?php echo base_url('entries') ?>"><i
                                            class="fa fa-circle-o"></i> Manage Entry</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <li class="treeview" id="mainProductNav">
                <a href="#">
                    <i class="fa fa-credit-card-alt"></i>
                    <span>Sales</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <?php if (in_array('createSales', $user_permission)): ?>
                        <li id="addProductNav"><a href="<?php echo base_url('sales/create') ?>"><i
                                        class="fa fa-circle-o"></i> new sale </a></li>
                    <?php endif; ?>
                    <?php if (in_array('updateSales', $user_permission) ||
                        in_array('viewSales', $user_permission) ||
                        in_array('deleteSales', $user_permission)): ?>
                        <li id="manageProductNav"><a href="<?php echo base_url('sales') ?>"><i
                                        class="fa fa-circle-o"></i> Manage sells</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <!--    end  sales mangement -->
            <li class="treeview" id="mainGroupNav">
                <a href="#">
                    <i class="fa fa-credit-card"></i>
                    <span>Credit </span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <?php if (in_array('createCredit', $user_permission)): ?>
                        <li id="addGroupNav"><a href="<?php echo base_url('credits/create') ?>"><i
                                        class="fa fa-circle-o"></i> Give Credit</a></li>
                    <?php endif; ?>
                    <?php if (in_array('updateCredit', $user_permission) ||
                        in_array('viewCredit', $user_permission) ||
                        in_array('deleteCredit', $user_permission)): ?>
                        <li id="manageGroupNav"><a href="<?php echo base_url('Credits') ?>"><i
                                        class="fa fa-circle-o"></i>Manage Credits
                            </a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <li class="treeview" id="mainGroupNav">
                <a href="#">
                    <i class="fa fa-cart-plus"></i>
                    <span>Category </span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <?php if (in_array('createCatagory', $user_permission)): ?>
                        <li id="addGroupNav"><a href="<?php echo base_url('Category/create') ?>"><i
                                        class="fa fa-circle-o"></i> Create category</a></li>
                    <?php endif; ?>
                    <?php if (in_array('updateCatagory', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                        <li id="manageGroupNav"><a href="<?php echo base_url('category') ?>"><i
                                        class="fa fa-circle-o"></i>edit category
                            </a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php if ($user_permission): ?>
            <?php if (in_array('createUser', $user_permission) || in_array('updateUser', $user_permission)
                || in_array('viewUser', $user_permission) ||
                in_array('deleteUser', $user_permission)): ?>
                <li class="treeview" id="mainUserNav">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>Users </span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if (in_array('createUser', $user_permission)): ?>
                            <li id="createUserNav"><a href="<?php echo base_url('users/create') ?>"><i
                                            class="fa fa-circle-o"></i> Create user</a></li>
                        <?php endif; ?>
                        
                        <?php if (in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                            <li id="manageUserNav"><a href="<?php echo base_url('users') ?>"><i
                                            class="fa fa-circle-o"></i>Manage Users</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if ($user_permission): ?>
                <?php if (in_array('createUser', $user_permission) ||
                    in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                    <li class="treeview" id="mainUserNav">
                        <a href="#">
                            <i class="fa fa-user-plus"></i>
                            <span>Employee </span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php if (in_array('createEmployee', $user_permission)): ?>
                                <li id="createUserNav"><a href="<?php echo base_url('employee/create') ?>"><i
                                                class="fa fa-circle-o"></i> New employee</a></li>
                            <?php endif; ?>
                            
                            <?php if (in_array('updateEmployee', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                                <li id="manageUserNav"><a href="<?php echo base_url('users') ?>"><i
                                                class="fa fa-circle-o"></i>Manage Employees</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <!-- <li class="header">Settings</li> -->
            <?php endif; ?>
            <!--            User Group management settings-->
            <?php if ($user_permission): ?>
                <?php if (
                    in_array('createGroup', $user_permission)
                    || in_array('updateGroup', $user_permission)
                    || in_array('viewGroup', $user_permission)
                    || in_array('deleteGroup', $user_permission)):
                    ?>
                    <li class="treeview" id="mainUserNav">
                        <a href="#">
                            <i class="fa fa-user-plus"></i>
                            <span>User Admin </span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php if (in_array('createGroup', $user_permission)): ?>
                                <li id="createUserNav"><a href="<?php echo base_url('groups/create') ?>">
                                        <i class="fa fa-circle-o"></i> New Group</a></li>
                            <?php endif; ?>
                            
                            <?php if (in_array('updateGroup', $user_permission)
                                || in_array('viewGroup', $user_permission)
                                || in_array('deleteGroup', $user_permission)): ?>
                                <li id="manageUserNav"><a href="<?php echo base_url('groups') ?>"><i
                                                class="fa fa-circle-o"></i>Manage Groups</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <!-- <li class="header">Settings</li> -->
            <?php endif; ?>
            <!-- <li class="header">Settings</li> --
            <?php endif; ?>
            <!-- user permission info -->
            <li><a href="<?php echo base_url('zekah') ?>"><i class="fa fa-calculator"></i> <span>Zekah</span></a>
            <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span>Log out</span></a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>