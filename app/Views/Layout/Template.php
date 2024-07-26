<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Pengajuan Pembelian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <!-- Dropify css -->
    <link href="<?=base_url('template/Admin/plugins/dropify/dropify.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="<?=base_url('template/Admin/vertical/assets/css/bootstrap.min.css'); ?>" rel="stylesheet"
        type="text/css" />
    <link href="<?=base_url('template/Admin/vertical/assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('template/Admin/vertical/assets/css/theme.min.css'); ?>" rel="stylesheet" type="text/css" />

    <!-- Plugins css -->
    <link href="<?= base_url('template/Admin/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css');?>"
        rel="stylesheet" type="text/css" />
    <link href="<?= base_url('template/Admin/plugins/daterangepicker/daterangepicker.css');?>" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url('template/Admin/plugins/select2/select2.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('template/Admin/plugins/switchery/switchery.min.css');?>" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url('template/Admin/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css');?>"
        rel="stylesheet" type="text/css" />
    <link href="<?= base_url('template/Admin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css');?>"
        rel="stylesheet" type="text/css" />

    <!-- Plugins css table -->
    <link href="<?=base_url('template/Admin/plugins/datatables/dataTables.bootstrap4.css'); ?>" rel="stylesheet"
        type="text/css" />
    <link href="<?=base_url('template/Admin/plugins/datatables/responsive.bootstrap4.css'); ?>" rel="stylesheet"
        type="text/css" />
    <link href="<?=base_url('template/Admin/plugins/datatables/buttons.bootstrap4.css'); ?>" rel="stylesheet"
        type="text/css" />
    <link href="<?=base_url('template/Admin/plugins/datatables/select.bootstrap4.css'); ?>" rel="stylesheet"
        type="text/css" />



</head>

<body>
    <!-- start foot -->

    <!-- Begin page -->
    <div id="layout-wrapper">
        <div class="header-border"></div>
        <header id="page-topbar">
            <div class="navbar-header">

                <div class="d-flex align-items-left">
                    <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>


                </div>

                <div class="d-flex align-items-center">

                    <div class="dropdown d-inline-block ml-2">
                        <button type="button" class="btn header-item waves-effect" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="<?=base_url('foto_profil/'.user()->foto_user); ?>" alt="" class="rounded-circle"
                                style="width:50px; height:50px; border:solid green">
                            <span class="d-none d-sm-inline-block ml-1"><?=user()->nama_lengkap ?></span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="<?=base_url('logout'); ?>">
                                <span>Logout</span>
                                <span>
                                    <span class="badge badge-pill badge-warning"></span>
                                </span>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <div class="navbar-brand-box">
                    <a href="#" class="logo">
                    
                        <span>
                          Pengajuan
                        </span>
                    </a>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="<?=base_url('/');?>" class="waves-effect"><i
                                    class="mdi mdi-account"></i><span>Profil</span></a>
                        </li>

                        <!-- User  -->

                        <?php if(in_groups('user')) :?>
                        <li>
                            <a href="<?=base_url('/user'); ?>" class="waves-effect"><i
                                    class="mdi mdi-spa-outline"></i><span>Pengajuan Pembelian</span></a>
                        </li>
                        <li>
                            <a href="<?=base_url('/user/status'); ?>" class="waves-effect"><i
                                    class="mdi mdi-progress-check"></i><span>Status Pengajuan</span></a>
                        </li>
                        <?php endif ; ?>
                        <!-- Akhir User  -->



                        <!-- Admin  -->
                        <?php if(in_groups('admin')): ?>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                    class="mdi mdi-account-key-outline"></i><span>Super Admin </span></a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li>
                                    <a href="<?=base_url('/admin') ; ?>" class="waves-effect"><i
                                            class="mdi mdi-database-check"></i><span>Master
                                            Data</span></a>
                                </li>

                               
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                    class="mdi mdi-thumbs-up-down"></i><span>Permintaan </span></a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li>
                                    <a href="<?=base_url('/admin/permintaan_admin'); ?>" class="waves-effect"><i
                                            class="mdi mdi-spa-outline"></i><span>Pengajuan </span></a>
                                </li>

                                <li>
                                    <a href="<?=base_url('/admin/status_admin'); ?>" class="waves-effect"><i
                                            class="mdi mdi-progress-check"></i><span>Status pengajuan</span></a>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <?php endif; ?>

                        <!-- Akhir Admin  -->


                        <!--finance -->
                        <?php if(in_groups('finance')): ?>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                    class="mdi mdi-file-document-box-search"></i><span>Aktivitas </span></a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li>
                                    <a href="/finance" class="waves-effect"><i class="mdi mdi-feature-search"></i><span
                                            class="badge badge-pill badge-primary float-right"></span><span>Data
                                            Pengajuan
                                        </span></a>
                                </li>
                                <li>
                                    <a href="/finance/history" class="waves-effect"><i class="mdi mdi-file"></i><span
                                            class="badge badge-pill badge-primary float-right"></span><span>Arsip</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                    class="mdi mdi-thumbs-up-down"></i><span>Permintaan</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?=base_url('/finance/permintaan_finance') ?>"><i
                                            class="mdi mdi-spa-outline"></i>Pengajuan</a>
                                </li>
                                <li><a href="<?=base_url('/finance/status_finance') ?>"><i
                                            class="mdi mdi-progress-check"></i> Status pengajuan</a>
                                </li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <!--akhir finance -->


                        <!--Direktur -->
                        <?php if(in_groups('direktur')): ?>
                           
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                    class="mdi mdi-file-document-box-search"></i><span>Aktivitas</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>

                                    <a href="/manager" class="waves-effect"><i class="mdi mdi-feature-search"></i><span
                                            class="badge badge-pill badge-primary float-right"></span><span>Data Pengajuan
                                        </span></a>
                                </li>

                                <li>
                                    <a href="/manager/history_manager" class="waves-effect"><i
                                            class="mdi mdi-file"></i><span
                                            class="badge badge-pill badge-primary float-right"></span><span>Arsip</span></a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                    class="mdi mdi-thumbs-up-down"></i><span>Permintaan</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?=base_url('/manager/permintaan_manager') ?>"><i
                                            class="mdi mdi-spa-outline"></i>Pengajuan</a>
                                </li>
                                <li><a href="<?=base_url('/manager/manager_status') ?>"><i
                                            class="mdi mdi-progress-check"></i> Status pembelian</a>
                                </li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <!--akhir Direktur-->



                        <li>
                            <a href="<?=base_url('logout');?>" class="waves-effect"><i
                                    class="mdi mdi-logout"></i><span>Keluar</span></a>
                        </li>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->







        <?php $this->renderSection('konten'); ?>







        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                      Copyright &copy Yayasan Niru Daya Nusantara
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                           2024
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>


    <!-- jQuery  -->
    <script src="<?=base_url('template/Admin/vertical/assets/js/jquery.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/vertical/assets/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/vertical/assets/js/metismenu.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/vertical/assets/js/waves.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/vertical/assets/js/simplebar.min.js'); ?>"></script>

    <!-- App js -->
    <script src="<?=base_url('template/Admin/vertical/assets/js/theme.js'); ?>"></script>


    <!--dropify-->
    <script src="<?= base_url('template/Admin/plugins/dropify/dropify.min.js')?>"></script>

    <!-- Init js-->
    <script src="<?= base_url('template/Admin/vertical/assets/pages/fileuploads-demo.js')?>"></script>


    <!-- Plugins js -->
    <script src="<?=base_url('template/Admin/plugins/autonumeric/autoNumeric-min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/moment/moment.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/select2/select2.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/switchery/switchery.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js'); ?>">
    </script>

    <!-- Custom Js -->
    <script src="<?=base_url('template/Admin/vertical/assets/pages/advanced-plugins-demo.js'); ?>"></script>

    <!-- third party js -->
    <script src="<?=base_url('template/Admin/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/datatables/dataTables.bootstrap4.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/datatables/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/datatables/responsive.bootstrap4.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/datatables/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/datatables/buttons.bootstrap4.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/datatables/buttons.html5.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/datatables/buttons.flash.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/datatables/buttons.print.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/datatables/dataTables.keyTable.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/datatables/dataTables.select.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/datatables/pdfmake.min.js'); ?>"></script>
    <script src="<?=base_url('template/Admin/plugins/datatables/vfs_fonts.js'); ?>"></script>
    <!-- third party js ends -->
    <!-- Datatables init -->
    <script src="<?=base_url('template/Admin/vertical/assets/pages/datatables-demo.js'); ?>"></script>



    
   


</body>

</html>