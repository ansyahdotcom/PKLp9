<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMAN 8 Surakarta | PILKETOS</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- style CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- My CSS -->
    <link href="<?= base_url(); ?>/assets/css/style.css" rel="stylesheet">
    <!-- Summernote -->
    <link href="<?= base_url(); ?>/assets/vendor/summernote/summernote-bs4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?= $this->include('layout/sidebar_admin'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?= $this->include('layout/navbar_admin'); ?>
                <?= $this->renderSection('content'); ?>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PILKETOS SMAN 8 Surakarta 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
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
            <!-- Reset Modal -->
            <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Reset Vote</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Apakah Anda ingin menghapus hasil voting?</div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Batal</button>
                            <a class="btn btn-danger" href="<?= base_url(); ?>/reset">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vote Modal -->
            <div class="modal fade" id="voteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Vote</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Apakah Anda yakin ingin vote kandidat ini??</div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Tidak</button>
                            <a class="btn btn-success" href="<?= base_url(); ?>/vote">Vote</a>
                        </div>
                    </div>
                </div>
            </div>
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

    <!-- Summernote -->
    <script src="<?= base_url(); ?>/assets/vendor/summernote/summernote-bs4.min.js"></script>

    <script type="text/javascript">
        function getValue1(ketua) {
            if (ketua != '') {
                $("select[name=wakil] option[value='" + ketua + "']").hide();
                $("select[name=wakil] option[value!='" + ketua + "']").show();
            }
        }
    </script>

    <script type="text/javascript">
        function getValue2(wakil) {
            if (wakil != '') {
                $("select[name=ketua] option[value='" + wakil + "']").hide();
                $("select[name=ketua] option[value!='" + wakil + "']").show();
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-ubahpsw').click(function() {
                $('.btn-ubahpsw').prop('hidden', true);
                $('.btn-batalpsw').prop('hidden', false);
                $('.psw').prop('hidden', false);
                $('.psw1').prop('hidden', false);
            });

            $('.btn-batalpsw').click(function() {
                $('.btn-ubahpsw').prop('hidden', false);
                $('.btn-batalpsw').prop('hidden', true);
                $('.psw').prop('hidden', true);
                $('.psw1').prop('hidden', true);
            });
        });
    </script>

    <!-- Image Preview -->
    <script>
        function previewImg() {
            const foto = document.querySelector('#foto');
            const fotoName = document.querySelector('#foto').value;
            const imgPreview = document.querySelector('.img-preview');

            fotoName.textContent = foto.files[0].name;

            const fileFoto = new FileReader();
            fileFoto.readAsDataURL(foto.files[0]);

            fileFoto.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>

    <script>
        $(function() {
            //Add text editor
            $('.summernote').summernote({
                height: 150
            })
        })
    </script>

</body>

</html>