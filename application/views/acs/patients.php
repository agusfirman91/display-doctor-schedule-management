<div class="card">
    <div class="card-header">
        <div class="card-title">
            List Patients
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="table" style="width:100%">
            <!-- datatables-basic -->
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>RM</th>
                    <th>NO Registrasi</th>
                    <th>Nama Pasien</th>
                    <th>Kelas</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Suku</th>
                    <th>Agama</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <button class='btn btn-primary btn-square t_patient' data-id='0'>Add Patient</button>
    </div>
</div>


<div class="modal fade" id="m_patient" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_patient" class="form-horizontal" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group row">
                            <input type="hidden" class="form-control input-sm" name="id" value="">
                            <label class="col-sm-3 control-label">Rekam Medis</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control input-sm" name="no_rm" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="nama" value="">
                            </div>
                        </div>
                        <div class="form-group row" id="form-pasword">
                            <label class="col-sm-3 control-label">Alamat</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="alamat" value="">
                            </div>
                        </div>
                        <div class="form-group row" id="form-pasword">
                            <label class="col-sm-3 control-label">Tgl Lahir</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control input-sm datepicker" name="tgl_lahir" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Jenis Kelamin</label>
                            <div class="col-sm-4">
                                <select name="sex" class="form-control input-sm">
                                    <option value="">== Please Select ==</option>
                                    <option value="L">Laki- laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Suku</label>
                            <div class="col-sm-4">
                                <select name="suku" class="form-control input-sm">
                                    <option value="">== Please Select ==</option>
                                    <?php
                                    foreach ($list_suku as $suku) {
                                        ?>
                                        <option value="<?= $suku->idsuku ?>"><?= $suku->suku ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Agama</label>
                            <div class="col-sm-4">
                                <select name="agama" class="form-control input-sm">
                                    <option value="">== Please Select ==</option>
                                    <?php
                                    foreach ($list_agama as $agama) {
                                        ?>
                                        <option value="<?= $agama->idagama ?>"><?= $agama->agama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-square" id="b_patient">Simpan</button>
                            <button type="button" class="btn btn-danger btn-square" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
        </form>
    </div>
</div>


<?php
$pesan = $this->session->userdata('message');
if ($pesan) {
    echo "<script>
    $(document).ready(function() {
        toastr.info('$pesan', 'Information', {timeOut: 3000});
    });
    </script>";
}
?>

<script>
    $(document).ready(function() {
        var table;
        var id = $('input:text[name=id]');
        var no_rm = $('input:text[name=no_rm]');
        var nama = $('input:text[name=nama]');
        var tgl_lahir = $('input:text[name=tgl_lahir]');
        var alamat = $('input:text[name=alamat]');
        var sex = $('select[name=sex]');
        var suku = $('select[name=suku]');
        var agama = $('select[name=agama]');

        // var metrics_data_table = $("#table").DataTable({
        //     'processing': true,
        //     'serverSide': true,
        //     'lengthChange': false,
        //     'ajax': {
        //         'url': "< base_url('acs/ajax_list') ?>",
        //         'type': 'POST',
        //         'data': {
        //             'form_filter': $(".javascript__datatables_display__form :input").serialize(),
        //             'csrfmiddlewaretoken': $('.javascript__data_tables_display__csrf_token').val()
        //         },
        //     },
        //     // 'columns': datatable_settings.columns,
        //     // 'order': datatable_settings.order,
        //     "columnDefs": [{
        //         "targets": [-1], //last column
        //         "orderable": false, //set not orderable
        //     }, ],
        //     // 'createdRow': datatable_settings.createdRow,
        //     'initComplete': function() {
        //         $("#table").fadeIn();
        //         var api = this.api();

        //         new $.fn.dataTable.Buttons(api, {
        //             'buttons': [
        //                 'colvis',
        //             ]
        //         });
        //         new $.fn.dataTable.Buttons(api, {
        //             'buttons': [
        //                 'copy',
        //                 'csv',
        //                 'excel',
        //                 {
        //                     'extend': 'pdfHtml5',
        //                     'orientation': 'landscape',
        //                     'pageSize': 'LETTER',
        //                     'exportOptions': {
        //                         'columns': ':visible'
        //                     },
        //                     'action': function(e, dt, button, config) {
        //                         // Add code to make changes to table here
        //                         metrics_data_table.settings().page.len(-1);
        //                         metrics_data_table.settings().drawCallback = function(settings) {
        //                             // Call the original action function afterwards to
        //                             // continue the action.
        //                             // Otherwise you're just overriding it completely.
        //                             $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
        //                         }
        //                         metrics_data_table.draw();
        //                     }
        //                 }
        //             ]
        //         });
        //     }
        // });
        // $.ajax({
        //     "url": url,
        //     "type": "POST",
        //     success: function(data) {
        //         // alert(data);
        //         console.log(data);
        //     }
        // });

        var url = "<?= base_url('acs/ajax_list') ?>";
        table = $('#table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": url,
                "type": "POST"
            },
            dom: 'Bfrtip',
            buttons: [
                'excel', 'colvis', 'print'
            ],

            "columnDefs": [{
                "targets": [-1], //last column
                "orderable": false, //set not orderable
            }, ],
        });

        $("input[name=\"tgl_lahir\"]").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            "locale": {
                "format": "YYYY/MM/DD",
                "separator": "-",
            }
        });



        $(".e_patient").click(function() {
            $('input:text[name=no_rm]').attr('readonly', true);
        });

        $(".t_patient").click(function() {
            $('input:text[name=no_rm]').attr('readonly', false);
        });

        $('#b_patient').click(function(event) {
            var string = $("#f_patient").serialize();

            if (nik.val().length == 0) {
                nik.focus();
                return false;
            }
            if (patientname.val().length == 0) {
                patientname.focus();
                return false;
            }
            if (patient_group.val().length == 0) {
                patient_group.focus();
                return false;
            }
        });


        $(".t_patient").click(function() {
            var id = $(this).attr("data-id");
            // var role_name = $(this).attr("data-role");
            $("#m_patient").modal('show');
            judul(id);
        });

    });


    function edit_patient(id) {
        judul(id);
        $.ajax({
            type: "GET",
            url: "<?php echo base_url() ?>acs/req_data/tblpasien/" + id,
            dataType: "JSON",
            success: function(data) {
                $('input:hidden[name=id]').val(data.id);
                no_rm.val(data.no_rm);
                nama.val(data.nama);
                tgl_lahir.val(data.tgl_lahir);
                alamat.val(data.alamat);
                sex.val(data.sex);
                suku.val(data.idsuku);
                agama.val(data.idagama);
                $("#m_patient").modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_patient(id) {
        var pilih = confirm('Apakah Anda Yakin Data Akan di hapus ? ');
        if (pilih == true) {
            $.ajax({
                type: "GET",
                url: "<?= base_url() ?>acs/delete/tblpasien/" + id,
                data: "id=" + id,
                success: function(data) {
                    location.reload();
                }
            });
        }
    }

    //fungsi judul modal
    function judul(id) {
        if (id != 0) {
            $(".modal-title").text("Form Edit patient");
            $("#f_patient").attr('action', '<?= base_url() ?>acs/update/tblpasien');
        } else {
            $(".modal-title").text("Form Add patient ");
            $("#f_patient").attr('action', '<?= base_url() ?>acs/add/tblpasien');
        }
    }
</script>