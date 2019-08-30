<div class="card">
    <div class="card-header">
        <div class="card-title">
            Dokter Spesialis
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Specialist Name</th>
                    <th>Doctor Oncall 1</th>
                    <th>Doctor Oncall 2</th>
                    <th>Plasma Group</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($list_doctor_spesialist as $d_specialist) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $d_specialist->specialist_name; ?></td>
                        <td><?= $d_specialist->name; ?></td>
                        <td><?= $d_specialist->name; ?></td>
                        <td><?= $d_specialist->plasma_name; ?></td>
                        <td>
                            <a href="javascript:void(0);" class="e_d_specialist" data-id="<?= $d_specialist->id ?>" data-toggle="tooltip" data-placement="top" title="Edit Doctor Specialist">
                                <i class="align-middle" data-feather="edit"></i></a>
                            <a href="javascript:void(0);" class="d_d_specialist" data-id="<?= $d_specialist->id ?>" data-toggle="tooltip" data-placement="top" title="Delete Doctor Specialist">
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
        <button class='btn btn-primary btn-square t_d_specialist' data-id='0'>Add Specialist Doctor</button>
    </div>
</div>

<div class="modal fade" id="m_d_specialist" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_d_specialist" class="form-horizontal" method="post">
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
                        <label class="col-sm-4 control-label">Specialist Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-sm" name="specialist_name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">Doctor Name On Call-1</label>
                        <div class="col-sm-8">
                            <select name="doctor_oc_1" class="form-control input-sm custom-select">
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
                        <label class="col-sm-4 control-label">Doctor Name On Call-2</label>
                        <div class="col-sm-8">
                            <select name="doctor_oc_2" class="form-control input-sm custom-select">
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
                        <label class="col-sm-4 control-label">Plasma Group</label>
                        <div class="col-sm-4">
                            <select name="plasma_id" class="form-control input-sm custom-select">
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
                        <button type="submit" class="btn btn-primary btn-square" id="b_d_specialist">Simpan</button>
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
        var specialist_name = $('input:text[name=specialist_name]');
        var doctor_oc_1 = $('select[name=doctor_oc_1]');
        var doctor_oc_2 = $('select[name=doctor_oc_2]');
        var plasma_id = $('select[name=plasma_id]');

        $('#b_d_specialist').click(function(event) {
            var string = $("#f_d_specialist").serialize();

            if (specialist_name.val().length == 0) {
                specialist_name.focus();
                return false;
            }
            if (doctor_oc_1.val().length == 0) {
                doctor_oc_1.focus();
                return false;
            }
            if (doctor_oc_2.val().length == 0) {
                doctor_oc_2.focus();
                return false;
            }
            if (plasma_id.val().length == 0) {
                plasma_id.focus();
                return false;
            }
        });



        $(".t_d_specialist,.e_d_specialist").click(function() {
            var id = $(this).attr("data-id");
            var role_name = $(this).attr("data-role");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/specialist_doctor/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_d_specialist").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    specialist_name.val(data.specialist_name);
                    doctor_oc_1.val(data.doctor_oc_1);
                    doctor_oc_2.val(data.doctor_oc_2);
                    plasma_id.val(data.plasma_id);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_d_specialist").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Data yang akan dihd_specialistus  = ' + id + '?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>main/delete/specialist_doctor/" + id,
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
                $(".modal-title").text("Form Edit Specialist Doctor");
                $("#f_d_specialist").attr('action', '<?= base_url() ?>main/update/specialist_doctor');
            } else {
                $(".modal-title").text("Form Add Specialist Doctor ");
                $("#f_d_specialist").attr('action', '<?= base_url() ?>main/add/specialist_doctor');
            }
        }



    });
</script>