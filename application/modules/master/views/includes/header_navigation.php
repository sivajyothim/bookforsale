<ul class="navbar-nav mt-2 mt-lg-0 mx-0 mx-lg-2 " style="color:#fff;">
    <li class="nav-item">
        <a href="<?php echo ADMIN_LINK; ?>" class="nav-link">
            Dashboard
        </a>
    </li>
   <!--Client section start -->
    <li class="nav-item dropdown">
        <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user-circle-o"></i>&nbsp;&nbsp;Clients
        </a>
        <div class="dropdown-menu mt-2 text-color" role="menu">
            <a href="<?php echo ADMIN_LINK . 'add/client'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Create New Clinet" data-placement="right">
                <i class="fa fa-plus-circle"></i>
                New Client
            </a>
            <a href="<?php echo ADMIN_LINK . 'client'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage Clients" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Manage Clients
            </a>
        </div>
    </li>
    <!--Client section end -->
    <!--Projects section start -->
    <li class="nav-item dropdown">
        <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-building-o"></i>&nbsp;&nbsp;Projects
        </a>
        <div class="dropdown-menu mt-2 text-color" role="menu">
            <a href="<?php echo ADMIN_LINK . 'add/project'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Create New project" data-placement="right">
                <i class="fa fa-plus-circle"></i>
                Create Project
            </a>
            <a href="<?php echo ADMIN_LINK . 'projects'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage project" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Manage Projects
            </a>



        </div>
    </li>
    <!--Projects section end -->

    <!--Projects section start -->
    <li class="nav-item dropdown">
        <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-clipboard "></i>&nbsp;&nbsp;Work Order
        </a>
        <div class="dropdown-menu mt-2 text-color" role="menu">
            <a href="<?php echo ADMIN_LINK . 'add/workorder'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Create New workorder" data-placement="right">
                <i class="fa fa-plus-circle"></i>
                New Work Order
            </a>
            <a href="<?php echo ADMIN_LINK . 'workrorders'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage Workorders" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Manage Work Orders
            </a>
            <a href="<?php echo ADMIN_LINK; ?>Workorder/worklocation" class="dropdown-item" data-toggle="tooltip" data-title="Work Locations" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Work Location
            </a>
             <a href="<?php echo ADMIN_LINK; ?>Project/blocks" class="dropdown-item" data-toggle="tooltip" data-title="Assign Blocks / Towers" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Manage Blocks / Towers
            </a>
        </div>
    </li>
    <!--Projects section end -->
    <!--Sub contractors section start -->
    <li class="nav-item dropdown">
        <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user-plus "></i>&nbsp;&nbsp;Sub Contractors
        </a>
        <div class="dropdown-menu mt-2 text-color" role="menu">
            <a href="<?php echo ADMIN_LINK . 'Contractors/create'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Add new sub contractor" data-placement="right">
                <i class="fa fa-plus-circle"></i>
                New Sub Contractor
            </a>
            <a href="<?php echo ADMIN_LINK . 'Contractors'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage sub contractors" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Manage Sub Contractors
            </a>
             <a href="<?php echo ADMIN_LINK . 'Contractors/vendorworkorders'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage sub contractors" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Work Order List
             </a>

            <a href="<?php echo ADMIN_LINK . 'Contractors/createvendorworkorder'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage sub contractors" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Create New Work Order
            </a>
        </div>
    </li>
    <!--Sub contractors section end -->
     <!--Site Settings section start -->
    <li class="nav-item dropdown">
        <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-cog "></i>&nbsp;&nbsp;Settings
        </a>
        <div class="dropdown-menu mt-2 text-color" role="menu">
            <a href="<?php echo ADMIN_LINK . 'Settings/tax'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage sub contractors" data-placement="right">
                <i class="fa fa-rupee"></i>
                Tax Details
            </a>
            <a href="<?php echo ADMIN_LINK . 'Settings/worktype'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage sub contractors" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Manage Work Type
            </a>
            <a href="<?php echo ADMIN_LINK . 'Settings/hsncodes'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage HSN" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Manage HSN
            </a>

            <a href="<?php echo ADMIN_LINK . 'Settings/units'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage Units" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Manage Units
            </a>
            <a href="<?php echo ADMIN_LINK . 'Settings/designations'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage Designations" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Manage Designations
            </a>
            <a href="<?php echo ADMIN_LINK . 'Settings/staff'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage Designations" data-placement="right">
                <i class="fa fa-user-circle"></i>
                Manage Staff
            </a>
        </div>
    </li>
    <!--Site Settings section end -->
     <!--Stores section start -->
    <li class="nav-item dropdown">
        <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-"></i>&nbsp;&nbsp;Stores
        </a>
        <div class="dropdown-menu mt-2 text-color" role="menu">
            <a href="<?php echo ADMIN_LINK . 'Store'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage Stores" data-placement="right">
                <i class="fa fa-plus-circle"></i>
               Manage Stores
            </a>
            <a href="<?php echo ADMIN_LINK . 'Store/itemcategories'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage Items" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Manage Categories
            </a>
             <a href="<?php echo ADMIN_LINK . 'Store/items'; ?>" class="dropdown-item" data-toggle="tooltip" data-title="Manage Items" data-placement="right">
                <i class="fa fa-ellipsis-h"></i>
                Manage Items
            </a>
        </div>
    </li>
    <!--Accounts section end -->
    <li class="nav-item dropdown">
        <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-"></i>&nbsp;&nbsp;Accounts
        </a>
        <div class="dropdown-menu mt-2 text-color" role="menu">
            <a href="javascript:void(0)" onclick="alert('Coming Soon.')" class="dropdown-item" data-toggle="tooltip" data-title="Manage Stores" data-placement="right">
                <i class="fa fa-plus-circle"></i>
               Manage Accounts
            </a>

        </div>
    </li>
</ul>
