<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pemilos | <?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- style CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- Summer Note -->
    <link rel="stylesheet" href="/assets/vendor/summernote/summernote-bs4.min.css">

    <!-- Select Picker -->
    <link rel="stylesheet" href="/assets/vendor/selectpicker/dist/css/bootstrap-select.min.css">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- My CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- Cropper -->
    <link rel="stylesheet" href="/assets/vendor/cropper/cropper.min.css">

    <!-- JQuery UI -->
    <link rel="stylesheet" href="/assets/vendor/jquery-ui/jquery-ui.min.css">

    <!-- Datepicker -->
    <link rel="stylesheet" href="/assets/vendor/datepicker/datepicker.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?= $this->include('layout/sidebar_admin'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?= $this->include('layout/navbar'); ?>
                <?= $this->renderSection('content'); ?>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Pemilos SMAN 4 Surakarta 2021</span>
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
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <a class="btn btn-danger" href="/logout">Logout</a>
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
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/assets/js/demo/chart-area-demo.js"></script>
    <script src="/assets/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendor/sweetalert/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/assets/js/demo/datatables-demo.js"></script>

    <!-- Summer Note -->
    <script src="/assets/vendor/summernote/summernote-bs4.min.js"></script>
    <script>
        // $('#visi').summernote({
        //     placeholder: 'visi kandidat',
        //     tabsize: 2,
        //     height: 100
        // });

        // $('#misi').summernote({
        //     placeholder: 'misi kandidat',
        //     tabsize: 2,
        //     height: 100
        // });
    </script>

    <!-- Select Picker -->
    <script src="/assets/vendor/selectpicker/dist/js/bootstrap-select.min.js"></script>
    <script src="/assets/vendor/selectpicker/dist/js/defaults-*.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.selectpicker').selectpicker();
            $('select[name=ketua]').selectpicker('val', +$('#old_ketua').val());
            $('select[name=wakil]').selectpicker('val', +$('#old_wakil').val());
            $('.selectpicker').selectpicker('refresh');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.selectpicker').selectpicker();
            $('select[name=periode1]').selectpicker('val', +$('input[name=activePeriode]').val());
            $('.selectpicker').selectpicker('refresh');
        });
    </script>

    <script>
        $(document).ready(function() {
            setInterval(function() {
                $('.selectpicker').selectpicker();
                const periode = $('select[name=periode1]').val();
                $('.btn-addData').attr('href', '/kandidat/addKandidat/' + periode);
                $('.selectpicker').selectpicker('refresh');
            }, 500);
        });
    </script>

    <script>
        // Hapus User
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
                    window.location.href = "<?= base_url() ?>" + link + id;
                } else {
                    swal.close();
                }
            });

        });
        // Hapus Kelas
        $(document).ready(function() {
            $('#datatable').DataTable();
        });

        $('#datatable').on('click', '.hapus_kelas', function() {
            var id = $(this).data('id');
            var link = $(this).data('link');
            var kelas = $(this).data('kelas');

            swal({
                title: 'Perhatian!',
                text: "Yakin akan menghapus data " + kelas + " ?",
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
                    window.location.href = "<?= base_url() ?>" + link + id;
                } else {
                    swal.close();
                }
            });

        });
    </script>

    <!-- Cropper -->
    <script src="/assets/vendor/cropper/cropper.min.js"></script>

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

    <!-- JQuery UI -->
    <script src="/assets/vendor/jquery-ui/jquery-ui.min.js"></script>

    <!-- Datepicker -->
    <script src="/assets/vendor/datepicker/bootstrap-datepicker.js"></script>
</body>

</html>