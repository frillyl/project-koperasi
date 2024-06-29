<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> | <?= $sub ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/b820f0911a.js" crossorigin="anonymous"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/template/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/template/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="<?= base_url() ?>/public/template/index3.html" class="navbar-brand">
                    <img src="<?= base_url() ?>/public/assets/images/logo_primkopad.png" alt="Logo Primkopad" class="brand-image img-circle">
                    <span class="brand-text font-weight-light"><strong>PRIMKOP DARMA PUTRA KUJANG I</strong></span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">

                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="btn btn-sm btn-block btn-primary" role="button" href="<?= base_url('pengurus/dashboard') ?>" role="button"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                    </li>
                    <li class="nav-item ml-2">
                        <a class="btn btn-sm btn-block btn-danger" role="button" href="<?= base_url('pengurus/logout') ?>" role="button"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card mt-1">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Kode Penjualan</label>
                                            <label class="form-control text-danger"><?= $kd_penjualan ?></label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <label class="form-control"><?= date('d M Y') ?></label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Jam</label>
                                            <label class="form-control"><span id="realTimeClock"></span></label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Pembeli</label>
                                            <select name="id_anggota" id="id_anggota" class="form-control select2bs4 select2-hidden-accessible" id="id_anggota" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option value="">-- Pilih Pembeli --</option>
                                                <?php foreach ($anggota as $key => $value) { ?>
                                                    <option value="<?= $value['id_anggota'] ?>"><strong><?= $value['nm_anggota'] ?></strong></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Kasir</label>
                                            <label class="form-control text-primary"><?= session('nm_pengurus') ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-7 -->
                    <div class="col-lg-5">
                        <div class="card mt-2">
                            <div class="card-body bg-black color-palette text-right">
                                <label class="display-4 text-green" id="grandTotal">Rp 0,-</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-5 -->

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <?php echo form_open('pengurus/transaksi/penjualan/tambah_barang', ['id' => 'addItemForm', 'method' => 'post']) ?>
                                        <div class="row">
                                            <div class="col-2 input-group">
                                                <input name="kd_barang" class="form-control" id="kd_barang" placeholder="Kode Barang" autocomplete="off">
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-primary">
                                                        <i class="fa-solid fa-magnifying-glass"></i>
                                                    </button>
                                                    <button class="btn btn-danger">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <div class="col-3">
                                                <input name="nm_barang" class="form-control" placeholder="Nama Barang" readonly>
                                            </div>
                                            <div class="col-1">
                                                <input name="jenis_barang" class="form-control" placeholder="Jenis Barang" readonly>
                                            </div>
                                            <div class="col-1">
                                                <input name="satuan" class="form-control" placeholder="Satuan" readonly>
                                            </div>
                                            <div class="col-1">
                                                <input name="harga_jual" class="form-control" placeholder="Harga" readonly>
                                            </div>
                                            <div class="col-1">
                                                <input type="number" min="1" value="1" name="qty" class="form-control" id="qty" placeholder="QTY">
                                            </div>
                                            <div class="col-3">
                                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cart-plus"></i> Tambah</button>
                                                <button type="reset" class="btn btn-warning"><i class="fa-solid fa-rotate"></i> Kosongkan</button>
                                                <button type="button" class="btn btn-success" id="btnPembayaran" data-toggle="modal" data-target="#bayar"><i class="fa-solid fa-cash-register"></i> Pembayaran</button>
                                            </div>
                                        </div>
                                        <?php echo form_close() ?>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Jenis Barang</th>
                                                    <th>Harga</th>
                                                    <th width="100px">Qty</th>
                                                    <th>Total Harga</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.content -->

            <!-- Modal Bayar -->
            <div class="modal fade" id="bayar">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Pembayaran</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="paymentForm">
                                <input name="kd_penjualan" id="kd_penjualan" value="<?= $kd_penjualan ?>" hidden>
                                <input name="tgl_penjualan" id="tgl_penjualan" value="<?= date('Y-m-d') ?>" hidden>
                                <input name="jam" id="jam" hidden>
                                <input name="id_pengurus" id="id_pengurus" value="<?= session('id') ?>" hidden>
                                <label for="grand_total">Grand Total</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" name="grand_total" class="form-control" id="grand_total" placeholder="0,-" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dibayar">Dibayar</label>
                                    <input type="text" name="dibayar" class="form-control" id="dibayar" placeholder="Dibayar">
                                </div>
                                <div class="form-group">
                                    <label for="kembalian">Kembalian</label>
                                    <input type="text" name="kembalian" class="form-control" id="kembalian" placeholder="Kembalian" readonly>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Bayar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/public/template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/public/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url() ?>/public/template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/public/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/public/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/public/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/public/template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>/public/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/public/template/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url() ?>/public/template/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>/public/template/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>/public/template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>/public/template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>/public/template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url() ?>/public/template/plugins/select2/js/select2.full.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/public/template/dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom JavaScript -->
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>

    <script type="text/javascript">
        const currentLocation = location.href;
        const menuItem = document.querySelectorAll('li a');
        const menuLength = menuItem.length
        for (let i = 0; i < menuLength; i++) {
            if (menuItem[i].href === currentLocation) {
                menuItem[i].className = "nav-link active"
            }
        }
    </script>

    <script type="text/javascript">
        function bacaGambar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#gambar_load').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#preview_gambar').change(function() {
            bacaGambar(this);
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#kd_barang').focus();
            $('#kd_barang').keydown(function(e) {
                let kd_barang = $('#kd_barang').val();
                if (e.keyCode == 13) {
                    e.preventDefault();
                    if (kd_barang.length == '') {
                        Swal.fire({
                            text: "Kode Barang Belum Dimasukkan!",
                            icon: "warning"
                        });
                    } else {
                        CekBarang();
                    }
                }
            });
            TambahItem();
            Pembayaran();
        });

        function CekBarang() {
            $.ajax({
                type: "POST",
                url: "<?= base_url('pengurus/transaksi/penjualan/cek_barang') ?>",
                data: {
                    kd_barang: $('#kd_barang').val()
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.nm_barang == '') {
                        Swal.fire({
                            text: "Kode Barang Tidak Terdaftar!",
                            icon: "warning"
                        });
                    } else {
                        $('[name="nm_barang"]').val(response.nm_barang);
                        $('[name="jenis_barang"]').val(response.jenis_barang);
                        $('[name="satuan"]').val(response.satuan);
                        $('[name="harga_jual"]').val(response.harga_jual);
                        $('#qty').focus();
                    }
                }
            });
        }

        function TambahItem() {
            let totalKeseluruhan = 0

            $('#addItemForm').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('pengurus/transaksi/penjualan/tambah_barang') ?>",
                    data: formData,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.status === 'error') {
                            Swal.fire({
                                text: response.message,
                                icon: "error"
                            });
                        } else {
                            let data = response.data;
                            let jenisBarangText = '';
                            if (data.jenis_barang == 1) {
                                jenisBarangText = 'Barang Koperasi';
                            } else if (data.jenis_barang == 2) {
                                jenisBarangText = 'Barang Konsinyasi';
                            }

                            let newRow = `<tr>
                                            <td>${data.kd_barang}</td>
                                            <td>${data.nm_barang}</td>
                                            <td>${jenisBarangText}</td>
                                            <td>${formatNumber(data.harga_jual)}</td>
                                            <td>${data.qty}</td>
                                            <td class="item-total-harga">${formatNumber(data.total_harga)}</td>
                                            <td>
                                                <a class="btn btn-sm btn-danger delete-item"><i class="fa-solid fa-xmark"></i></a>
                                            </td>
                                        </tr>`;
                            $('table tbody').append(newRow);

                            totalKeseluruhan += parseInt(data.total_harga);
                            $('#grandTotal').text('Rp ' + formatNumber(totalKeseluruhan) + ',-');
                            $('#grand_total').val(totalKeseluruhan);

                            $('#addItemForm')[0].reset();
                            $('#kd_barang').focus();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + " - " + error);
                        Swal.fire({
                            text: "Terjadi kesalahan saat menambahkan barang!",
                            icon: "error"
                        });
                    }
                });
            });

            $(document).on('click', '.delete-item', function() {
                let itemTotalHarga = parseFloat($(this).closest('tr').find('.item-total-harga').text().replace(/\D/g, ''));
                totalKeseluruhan -= itemTotalHarga;
                $('#grandTotal').text('Rp ' + formatNumber(totalKeseluruhan) + ',-');

                $(this).closest('tr').remove();
            });
        }

        function Pembayaran() {
            document.addEventListener('keydown', function(event) {
                if (event.key === 'F8') {
                    $('#bayar').modal('show');
                    $('#dibayar').focus();
                }
            });

            $('.btn-success[data-target="#bayar"]').on('click', function() {
                $('#bayar').modal('show');
                $('#dibayar').focus();
            });

            $('#dibayar').on('input', function() {
                let inputVal = $(this).val();
                let numericVal = inputVal.replace(/\D/g, '');
                let formattedVal = formatNumber(numericVal);
                $(this).val(formattedVal);
                updateKembalian();
            });

            $('#paymentForm').on('submit', function(e) {
                e.preventDefault();

                var now = new Date();
                var jam = now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds();
                $('#jam').val(jam);

                var formData = $(this).serializeArray();

                var id_anggota = $('#id_anggota').val();
                formData.push({
                    name: 'id_anggota',
                    value: id_anggota
                });

                formData.push({
                    name: 'grand_total',
                    value: parseFloat($('#grand_total').val().replace(/\D/g, ''))
                });
                formData.push({
                    name: 'dibayar',
                    value: parseFloat($('#dibayar').val().replace(/\D/g, ''))
                });
                formData.push({
                    name: 'kembalian',
                    value: parseFloat($('#kembalian').val().replace(/\D/g, ''))
                });

                var tableData = {};
                $('table tbody tr').each(function() {
                    var kd_barang = $(this).find('td:eq(0)').text().trim();
                    var harga_jual = $(this).find('td:eq(3)').text().trim().replace(/\D/g, '');
                    var qty = $(this).find('td:eq(4)').text().trim();
                    var total_harga = $(this).find('td:eq(5)').text().trim().replace(/\D/g, '');

                    if (kd_barang !== "" && harga_jual !== "" && qty !== "" && total_harga !== "") {
                        // Memastikan kd_barang hanya dimasukkan satu kali
                        if (!tableData[kd_barang]) {
                            tableData[kd_barang] = {
                                kd_barang: kd_barang,
                                harga_jual: harga_jual,
                                qty: qty,
                                total_harga: total_harga
                            };
                        }
                    }
                });
                var dataArray = Object.values(tableData);
                let validItems = dataArray.filter(isValidItem);

                // Log data for debugging
                console.log('Form Data:', formData);
                console.log('Table Data:', tableData);
                console.log('Valid Items:', validItems);

                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('pengurus/transaksi/penjualan/simpan') ?>',
                    dataType: 'JSON',
                    data: {
                        form: formData,
                        items: validItems
                    },
                    success: function(response) {
                        alert('Data berhasil disimpan!');
                        // Optionally, you can redirect or clear the form here
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan saat menyimpan data!');
                        console.log('Error:', error);
                    }
                });
            });
        }

        function isValidItem(item) {
            return (
                item.kd_barang.trim().startsWith("BRG") &&
                item.harga_jual.trim() !== "" &&
                item.qty.trim() !== "" &&
                item.total_harga.trim() !== ""
            );
        }

        function formatNumber(num) {
            return parseInt(num).toLocaleString('id-ID');
        }

        function updateKembalian() {
            let grandTotal = parseInt($('#grand_total').val().replace(/\D/g, ''));
            let dibayar = parseInt($('#dibayar').val().replace(/\D/g, ''));
            let kembalian = dibayar - grandTotal;

            $('#kembalian').val(formatNumber(kembalian));

            if (kembalian < 0) {
                $('#kembalian').addClass('is-invalid');
            } else {
                $('#kembalian').removeClass('is-invalid');
            }
        }
    </script>
    <script>
        function updateTime() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            const currentTime = `${hours}:${minutes}:${seconds}`;

            document.getElementById('realTimeClock').textContent = currentTime;
        }

        // Update the time every second
        setInterval(updateTime, 1000);

        // Initial call to display the time immediately on page load
        updateTime();
    </script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {
                'placeholder': 'mm/dd/yyyy'
            })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });

            //Date and time picker
            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            )

            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })

            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            })

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

        })
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "/target-url", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() {
                myDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true)
        }
        // DropzoneJS Demo Code End
    </script>
</body>

</html>