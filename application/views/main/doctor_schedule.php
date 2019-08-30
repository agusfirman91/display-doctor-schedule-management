<div class="card">
    <div class="card-header">
        <div class="card-title">
            Jadwal Dokter
        </div>
    </div>
    <div class="card-body">
        <div class="row">
        <div class="table-responsive">
            <table class="table table-striped datatables-basic" style="width:100%">
                <thead>
                    <tr>
                        <th width="5%" >No</th>
                        <th>Nama Dokter</th>
                        <th>Ruang</th>
                        <th>Senin</th>
                        <th>Selasa</th>
                        <th>Rabu</th>
                        <th>Kamis</th>
                        <th>Jumat</th>
                        <th>Sabtu</th>
                        <th>Minggu</th>
                        <th width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($list_doctor_schedule as $schedule) {
                        ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $schedule->name; ?></td>
                            <td><?= $schedule->room_number; ?></td>
                            <td><?= $schedule->monday; ?></td>
                            <td><?= $schedule->tuesday; ?></td>
                            <td><?= $schedule->wednesday; ?></td>
                            <td><?= $schedule->thursday; ?></td>
                            <td><?= $schedule->friday; ?></td>
                            <td><?= $schedule->saturday; ?></td>
                            <td><?= $schedule->sunday; ?></td>
                            <td>
                                <a href="javascript:void(0);" class="e_schedule" data-id="<?= $schedule->id ?>" data-toggle="tooltip" data-placement="top" title="Edit schedule">
                                    <i class="align-middle" data-feather="edit"></i></a>
                                <a href="javascript:void(0);" class="d_schedule" data-id="<?= $schedule->id ?>" data-toggle="tooltip" data-placement="top" title="Delete schedule">
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
        </div>
    </div>
    <div class="card-footer">
        <button class='btn btn-primary btn-square t_schedule' data-id='0'>Add Schedule</button>
    </div>
</div>


<div class="modal fade btn-square" id="m_schedule" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_schedule" class="form-horizontal" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control input-sm" name="id" readonly>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Dokter</label>
                        <div class="col-sm-8">
                            <select name="doctor_id" class="form-control input-sm custom-select">
                                <option value="">== Please Select ==</option>
                                <?php
                                    foreach ($list_dokter as $dokter) {
                                ?>
                                <option value="<?= $dokter->id ?>"><?= $dokter->name ?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Ruang</label>
                        <div class="col-sm-4">
                            <select name="room_id" class="form-control input-sm custom-select">
                                <option value="">== Please Select ==</option>
                                <?php
                                    foreach ($list_room as $room) {
                                ?>
                                <option value="<?= $room->id?>"><?= $room->room_number?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Senin</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="monday" value="">
                        </div>
                        <label class="col-sm-2 control-label">Selasa</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="tuesday" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Rabu</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="wednesday" value="">
                        </div>
                        <label class="col-sm-2 control-label">Kamis</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="thursday" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Jumat</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="friday" value="">
                        </div>
                        <label class="col-sm-2 control-label">Sabtu</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="saturday" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Minggu</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="sunday" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-square" id="b_schedule">Simpan</button>
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
        var room_id = $('select[name=room_id]');
        var monday = $('input:text[name=monday]');
        var tuesday = $('input:text[name=tuesday]');
        var wednesday = $('input:text[name=wednesday]');
        var thursday = $('input:text[name=thursday]');
        var friday = $('input:text[name=friday]');
        var saturday = $('input:text[name=saturday]');
        var sunday = $('input:text[name=sunday]');

        $('#b_schedule').click(function(event) {
            var string = $("#f_schedule").serialize();

            if (doctor_name.val().length == 0) {
                doctor_name.focus();
                return false;
            }
            if (room_id.val().length == 0) {
                room_id.focus();
                return false;
            }
        });



        $(".t_schedule,.e_schedule").click(function() {
            var id = $(this).attr("data-id");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/doctor_schedule/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_schedule").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    // alert(data.doctor_id);

                    doctor_id.val(data.doctor_id);
                    room_id.val(data.room_id);
                    monday.val(data.monday);
                    tuesday.val(data.tuesday);
                    wednesday.val(data.wednesday);
                    thursday.val(data.thursday);
                    friday.val(data.friday);
                    saturday.val(data.saturday);
                    sunday.val(data.sunday);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_schedule").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Are you sure ?'+id);
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>main/delete/doctor_schedule/" + id,
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
                $(".modal-title").text("Form Edit schedule");
                $("#f_schedule").attr('action', '<?= base_url() ?>main/update/doctor_schedule');
            } else {
                $(".modal-title").text("Form Add schedule ");
                $("#f_schedule").attr('action', '<?= base_url() ?>main/add/doctor_schedule');
            }
        }



    });
</script>

<style>
</style>