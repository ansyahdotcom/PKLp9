<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <title>SMAN 8 Surakarta | Pemilihan OSIS</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- style CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css">
    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- My CSS -->
    <link href="<?= base_url(); ?>/assets/css/style.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?= $this->include('layout/sidebar_user'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?= $this->include('layout/navbar_user'); ?>
                <?= $this->renderSection('content'); ?>
            </div>
            <!-- End of Main Content -->

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Apakah Anda ingin logout?</div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Batal</button>
                            <a class="btn btn-danger" href="<?= base_url(); ?>/logout">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Pemilos SMAN 8 Surakarta 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>/assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url(); ?>/assets/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url(); ?>/assets/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    
    <script src="<?= base_url(); ?>/assets/js/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/swal.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url(); ?>/assets/js/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });

        $('#datatable').on('click', '.hapus_crud', function() {
            var id = $(this).data('id');
            var link = $(this).data('link');
            var nama = $(this).data('nama');

            swal({
                title: 'Perhatian!',
                text: "Yakin akan menghapus data " + nama + " ?",
                icon: 'warning',

                buttons: {
                    cancel: {
                        visible: true,
                        text: 'Tidak',
                        className: 'btn btn-danger'
                    },
                    confirm: {
                        text: 'Ya',
                        className: 'btn btn-success'
                    }
                }
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = "<?= base_url('') ?>" + link + id;
                } else {
                    swal.close();
                }
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#password2').keyup(function() {
                var pw1 = $('#password1').val();
                var pw2 = $('#password2').val();
                if (pw2 != pw1) {
                    // $('#iconerror').addClass('fas fa-times text-danger');
                    $('#showerror').html('Password tidak sama');
                    $('#showerror').css('color', 'red');
                    $('#submit').attr('disabled', true);
                    return false;
                } else {
                    $('#showerror').html('Password sama');
                    $('#showerror').css('color', 'green');
                    $('#submit').attr('disabled', false);
                    return false;
                }
            });
        });
    </script>
</body>

</html>