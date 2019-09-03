<div class="card">
    <div class="card-header">
        <div class="card-title">
            Data Pasien

            <button class='btn btn-primary btn-square t_pasien float-right' data-id='0'>Add pasiens</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th>ID Pasien</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Suku</th>
                    <th>Agama</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($list_pasien as $pasien) {
                    ?>
                    <tr>
                        <td><?= $pasien->idpasien ?> </td>
                        <td><?= $pasien->nama ?> </td>
                        <td><?= $pasien->tgl_lahir ?> </td>
                        <td><?= $pasien->alamat ?> </td>
                        <td><?= $pasien->sex == 'L' ? 'Laki- Laki' : 'Perempuan'; ?> </td>
                        <td><?= $pasien->suku ?> </td>
                        <td><?= $pasien->agama ?> </td>
                        <td>
                            <a href="javascript:void(0);" class="e_pasien" data-id="<?= $pasien->id ?>" data-role="<?= $pasien->nama ?>" data-toggle="tooltip" data-placement="top" title="Edit pasien">
                                <i class="align-middle" data-feather="edit"></i>
                            </a>
                            <a href="javascript:void(0);" class="d_pasien" data-id="<?= $pasien->id ?>" data-toggle="tooltip" data-placement="top" title="Delete pasien">
                                <i class="align-middle" data-feather="delete"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>

    </div>
    <div class="card-footer">
    </div>
</div>



<div class="modal fade" id="m_pasien" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_pasien" class="form-horizontal" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <input type="hidden" class="form-control input-sm" name="id" value="">
                        <label class="col-sm-3 control-label">ID Pasien</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="idpasien" value="">
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
                        <button type="submit" class="btn btn-primary btn-square" id="b_pasien">Simpan</button>
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

        $("input[name=\"tgl_lahir\"]").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            "locale": {
                "format": "YYYY/MM/DD",
                "separator": "-",
            }
        });

        var id = $('input:text[name=id]');
        var idpasien = $('input:text[name=idpasien]');
        var nama = $('input:text[name=nama]');
        var tgl_lahir = $('input:text[name=tgl_lahir]');
        var alamat = $('input:text[name=alamat]');
        var sex = $('select[name=sex]');
        var suku = $('select[name=suku]');
        var agama = $('select[name=agama]');

        $(".e_pasien").click(function() {
            $('input:text[name=idpasien]').attr('readonly', true);
        });

        $(".t_pasien").click(function() {
            $('input:text[name=idpasien]').attr('readonly', false);
        });

        $('#b_pasien').click(function(event) {
            var string = $("#f_pasien").serialize();

            if (nik.val().length == 0) {
                nik.focus();
                return false;
            }
            if (pasienname.val().length == 0) {
                pasienname.focus();
                return false;
            }
            if (pasien_group.val().length == 0) {
                pasien_group.focus();
                return false;
            }
        });


        $(".t_pasien, .e_pasien").click(function() {
            var id = $(this).attr("data-id");
            // var role_name = $(this).attr("data-role");
            $("#m_pasien").modal('show');
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>bsh/req_data/tblpasien/" + id,
                dataType: "JSON",
                success: function(data) {
                    // alert(data);
                    $('input:hidden[name=id]').val(data.id);
                    idpasien.val(data.idpasien);
                    nama.val(data.nama);
                    tgl_lahir.val(data.tgl_lahir);
                    alamat.val(data.alamat);
                    sex.val(data.sex);
                    suku.val(data.idsuku);
                    agama.val(data.idagama);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_pasien").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Apakah Anda Yakin Data Akan di hapus ? ');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>bsh/delete/tblpasien/" + id,
                    data: "id=" + id,
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        });

        //fungsi judul modal
        function judul(id) {
            if (id != 0) {
                $(".modal-title").text("Form Edit pasien");
                $("#f_pasien").attr('action', '<?= base_url() ?>bsh/update/tblpasien');
            } else {
                $(".modal-title").text("Form Add pasien ");
                $("#f_pasien").attr('action', '<?= base_url() ?>bsh/add/tblpasien');
            }
        }

        $('input[name=toggle_pasien]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).attr('id');
            var toggle = $(this).attr('data-toggle');
            var value = $(this).attr('value');
            // alert(id+'-'+value+'-'+toggle);
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '<?= base_url() ?>bsh/do_switch/pasien',
                data: {
                    mode: mode,
                    id: id,
                    value: value,
                    toggle: toggle
                },
                success: function(data) {
                    var data = eval(data);
                    location.reload();
                }
            });
        });


    });
</script>