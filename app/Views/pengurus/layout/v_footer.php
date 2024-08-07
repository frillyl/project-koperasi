<footer class="main-footer text-sm">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2024 <a href="#">PRIMKOP DARMA PUTRA KUJANG I</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
<!-- Bootstrap4 Duallistbox -->
<script src="<?= base_url() ?>/public/template/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url() ?>/public/template/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>/public/template/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url() ?>/public/template/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?= base_url() ?>/public/template/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>/public/template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?= base_url() ?>/public/template/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="<?= base_url() ?>/public/template/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="<?= base_url() ?>/public/template/plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/public/template/dist/js/adminlte.min.js"></script>
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
    const menuLength = menuItem.length;

    for (let i = 0; i < menuLength; i++) {
        if (menuItem[i].href === currentLocation) {
            menuItem[i].classList.add("active");

            // Add active class to parent <li> if it's a sub menu item
            let parentLi = menuItem[i].closest('ul').previousElementSibling;
            if (parentLi && parentLi.tagName === 'A') {
                parentLi.classList.add("active");
            }
        }
    }
</script>

<script>
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
<script>
    $(document).ready(function() {
        $('button[name="cari"]').on('click', function() {
            cariData();
        });

        $(document).on('keypress', function(e) {
            if (e.which === 13) {
                cariData();
            }
        });

        function cariData() {
            var akun = $('select[name="akun"]').val();
            var bulan = $('select[name="bulan"]').val();

            $.ajax({
                url: '<?= base_url('pengurus/akuntansi/buku_besar/cariData'); ?>',
                method: 'POST',
                data: {
                    akun: akun,
                    bulan: bulan
                },
                success: function(response) {
                    $('tbody').html(response);
                }
            });
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('button[name="cari2"]').on('click', function() {
            cariDataBantu();
        });

        $(document).on('keypress', function(e) {
            if (e.which === 13) {
                cariDataBantu();
            }
        });

        function cariDataBantu() {
            var akun2 = $('select[name="akun2"]').val();
            var bulan2 = $('select[name="bulan2"]').val();

            $.ajax({
                url: '<?= base_url('pengurus/akuntansi/buku_pembantu/cariData'); ?>',
                method: 'POST',
                data: {
                    akun2: akun2,
                    bulan2: bulan2,
                },
                success: function(response) {
                    $('tbody').html(response);
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }
    });
</script>
<script>
    function showDetail(kd_penjualan) {
        $.ajax({
            url: '<?= base_url("pengurus/laporan/getDetailPenjualan") ?>',
            type: 'GET',
            data: {
                kd_penjualan: kd_penjualan
            },
            success: function(response) {
                var details = JSON.parse(response);
                var tableBody = $('#detailTableBody');
                tableBody.empty();
                details.forEach(function(detail) {
                    var row = '<tr>' +
                        '<td>' + detail.kd_barang + '</td>' +
                        '<td>' + detail.nm_barang + '</td>' +
                        '<td>' + detail.harga_jual + '</td>' +
                        '<td>' + detail.qty + '</td>' +
                        '<td>' + detail.total_harga + '</td>' +
                        '</tr>';
                    tableBody.append(row);
                });
            }
        });
    }

    function printData() {
        window.print();
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const anggotaSelect = document.getElementById('id_anggota');
        const jmlPinjamanInput = document.getElementById('jml_pinjaman');
        const tenorInput = document.getElementById('tenor');
        const bungaInput = document.getElementById('bunga');

        anggotaSelect.addEventListener('change', function() {
            const selectedAnggota = anggotaSelect.options[anggotaSelect.selectedIndex];
            const pangkatId = selectedAnggota.getAttribute('data-pangkat');

            // Dapatkan pangkat anggota
            fetch(`/pengurus/usipa/pangkat/getById/${pangkatId}`)
                .then(response => response.json())
                .then(data => {
                    let maxPinjaman = 0;

                    switch (data.golongan) {
                        case 'Perwira':
                            maxPinjaman = 10000000;
                            break;
                        case 'Bintara':
                            maxPinjaman = 7000000;
                            break;
                        case 'Tamtama':
                            maxPinjaman = 6000000;
                            break;
                        default:
                            maxPinjaman = 0;
                            break;
                    }

                    jmlPinjamanInput.setAttribute('max', maxPinjaman);
                });
        });

        jmlPinjamanInput.addEventListener('input', function() {
            calculateBunga();
        });

        tenorInput.addEventListener('input', function() {
            calculateBunga();
        });

        function calculateBunga() {
            const jmlPinjaman = parseFloat(jmlPinjamanInput.value) || 0;
            const tenor = parseFloat(tenorInput.value) || 0;
            const bunga = jmlPinjaman * tenor * 1.5 / 100;
            bungaInput.value = bunga.toFixed(2);
        }
    });
</script>
<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "paging": true,
            "responsive": true,
            "lengthChange": true,
            "ordering": true,
            "autoWidth": true,
            "ordering": true,
            "info": true,
            "buttons": [{
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ]
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
            format: 'YYYY-MM-DD'
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