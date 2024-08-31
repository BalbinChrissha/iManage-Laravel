</head>

<body class="">
    <div style="width: 100%; background-color: #89BBEA; position: sticky; top: 0; z-index: 1;" class="sticky-top p-0">

        <nav class="navbar navbar-light bg-light navbar-expand-md">
            <div class="container-fluid"><a class="navbar-brand" href="/staff/dashboard">&nbsp;&nbsp;<img src="/images/IMANAGE3.png" width="50" height="50" alt=""></a><button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div id="navcol-1" class="collapse navbar-collapse text-center">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="/staff/dashboard">HOME</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#">REPORTS</a></li> -->
                        <li class="nav-item"><a class="nav-link" href="/sFilter/sFilterInventory">FILTER INVENTORY</a></li>
                        <li class="nav-item"><a class="nav-link" href="/staff/manage-faculty">MANAGE FACULTY IN CHARGE</a></li>
                        <li class="nav-item"><a class="nav-link" href="/staff/manageItem">INVENTORY</a></li>
                        <li class="nav-item"><a class="nav-link" href="/staff/transferItem">ITEM TRANSFER</a></li>
                        <li class="nav-item"><a class="nav-link dropdown-toggle" href="#" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">SETTINGS</a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <center><button type="button" class="col-8 btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropmema">
                                            PROFILE
                                        </button></center>
                                </li>
                                <li><a class="dropdown-item"  href="<?php echo e(url('logout')); ?>">
                                        <center>LOGOUT
                                    </a></center>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div style=" background-color: #89BBEA; height: 40px; padding: 8px;" class="col-11 mx-auto">
            <div class="row">
                <div class="col-6">
                    <i class="fa-solid fa-user"></i> Supply Office Staff &nbsp; <b>|</b>&nbsp; <b><?php echo e(Session::get('staffName')); ?></b>
                </div>
                <div class="col-6" align="right" ;>

                    <?php date_default_timezone_set('Asia/Manila');
                    echo date('D jS F Y'); ?>
                </div>
            </div>
        </div>
    </div>





 <?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/template/staffNavbar.blade.php ENDPATH**/ ?>