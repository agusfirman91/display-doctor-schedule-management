<div class="card">
    <div class="card-header">
        <div class="card-title">
            Data Dokter Jaga
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Dokter</th>
                    <th>Group Plasma</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($list_duty_doctor as $dokter) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $dokter->name; ?></td>
                        <td><?= $dokter->plasma_name; ?></td>
                        <td>
                            <a href="javascript:void(0);" class="e_dokter" data-id="<?= $dokter->id ?>" data-role="<?= $dokter->name ?>"data-toggle="tooltip" data-placement="top" title="Edit dokter">
                                <i class="align-middle" data-feather="edit"></i></a>
                            <a href="javascript:void(0);" class="d_dokter" data-id="<?= $dokter->id ?>" data-toggle="tooltip" data-placement="top" title="Delete dokter">
                                <i class="align-middle" data-feather="delete"></i></a>
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
        <button class='btn btn-primary btn-square t_dokter' data-id='0'>Add Doctor</button>
    </div>
</div>


<div class="modal fade" id="m_dokter" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_dokter" class="form-horizontal" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control input-sm" name="id" readonly>
                    <div class="form-group row">
                        <input type="hidden" class="form-control input-sm" name="id" value="">
                        <label class="col-sm-3 control-label">Doctor Name</label>
                        <div class="col-sm-8">
                            <select name="doctor_id" class="form-control input-sm">
                                <option value="">== Please Select ==</option>
                                <?php
                                    foreach ($list_doctor as $doctor) {
                                ?>
                                <option value="<?= $doctor->id?>"><?= $doctor->name?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Plasma Group</label>
                        <div class="col-sm-4">
                            <select name="plasma_id" class="form-control input-sm">
                                <option value="">== Please Select ==</option>
                                <?php
                                    foreach ($list_plasma as $plasma) {
                                ?>
                                <option value="<?= $plasma->id?>"><?= $plasma->name?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-square" id="b_dokter">Simpan</button>
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
        var doctor_id = $('select[name=doctor_id]');
        var plasma_id = $('select[name=plasma_id]');

        $('#b_dokter').click(function(event) {
            var string = $("#f_dokter").serialize();

            if (doctor_id.val().length == 0) {
                doctor_id.focus();
                return false;
            }
            if (plasma_id.val().length == 0) {
                plasma_id.focus();
                return false;
            }
        });



        $(".t_dokter,.e_dokter").click(function() {
            var id = $(this).attr("data-id");
            var role_name = $(this).attr("data-role");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/doctor_of_duty/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_dokter").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    doctor_id.val(data.doctor_id);
                    plasma_id.val(data.plasma_id);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_dokter").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Data yang akan dihdokterus  = ' + id + '?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>main/delete/doctor_of_duty/" + id,
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
                $(".modal-title").text("Form Edit Dokter");
                $("#f_dokter").attr('action', '<?= base_url() ?>main/update/doctor_of_duty');
            } else {
                $(".modal-title").text("Form Add Dokter ");
                $("#f_dokter").attr('action', '<?= base_url() ?>main/add/doctor_of_duty');
            }
        }



    });
</script>