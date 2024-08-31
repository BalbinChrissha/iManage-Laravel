<body class="">
    <div style="width: 100%; background-color: #89BBEA; position: sticky; top: 0; z-index: 1;" class="sticky-top p-0">

        <nav class="navbar navbar-light bg-light navbar-expand-md">
            <div class="container-fluid"><a class="navbar-brand" href="/faculty/dashboard"> <img src="/images/IMANAGE3.png" width="50" height="50" alt=""></a><button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div id="navcol-1" class="collapse navbar-collapse text-center">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="/faculty/dashboard">HOME</a></li>
                        <li class="nav-item"><a class="nav-link" href="/fFilter/filterInventory">FILTER INVENTORY</a></li>
                        <li class="nav-item"><a class="nav-link" href="/fFilter/facultyReport">REPORTS</a></li>
                        <li class="nav-item"><a class="nav-link" href="/faculty/monthlyReport">MONTHLY REPORTS</a></li>
                        <li class="nav-item"><a class="nav-link dropdown-toggle" href="#" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">SETTINGS</a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <center><button type="button" class="col-8 btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropmema">
                                            PROFILE
                                        </button></center>
                                </li>
                                <li><a class="dropdown-item" href="{{url('logout')}}">
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
                    <i class="fa-solid fa-user"></i> Faculty &nbsp; <b>|</b>&nbsp; <b>{{ Session::get('facultyName') }}</b>
                </div>
                <div class="col-6" align="right" ;>

                    <?php date_default_timezone_set('Asia/Manila');
                    echo date('D jS F Y'); ?>
                </div>
            </div>
        </div>
    </div>




