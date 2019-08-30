<div class="card">
    <div class="card-header">
        <div class="card-title">
            Ruang Dokter
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th width="5%" >No</th>
                    <th>No Ruangan</th>
                    <th>Description</th>
                    <th>Plasma Group</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($list_room as $room) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $room->room_number; ?></td>
                        <td><?= $room->description; ?></td>
                        <td><?= $room->plasma_name; ?></td>
                        <td>
                            <a href="javascript:void(0);" class="e_room" data-id="<?= $room->id ?>" data-toggle="tooltip" data-placement="top" title="Edit Room">
                                <i class="align-middle" data-feather="edit"></i></a>
                            <a href="javascript:void(0);" class="d_room" data-id="<?= $room->id ?>" data-toggle="tooltip" data-placement="top" title="Delete Room">
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
        <button class='btn btn-primary btn-square t_room' data-id='0'>Add Room</button>
    </div>
</div>


<div class="modal fade" id="m_room" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_room" class="form-horizontal" method="post">
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
                        <label class="col-sm-3 control-label">Room Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-sm" name="room_number" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Plasma</label>
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
                    </div><div class="form-group row">
                        <input type="hidden" class="form-control input-sm" name="id" value="">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-8">
                            <textarea name="description"  class="form-control input-sm" cols="3" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-square" id="b_room">Simpan</button>
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
        var room_number = $('input:text[name=room_number]');
        var description = $('textarea[name=description]');
        var plasma_id = $('select[name=plasma_id]');

        $('#b_room').click(function(event) {
            var string = $("#f_room").serialize();

            if (room_number.val().length == 0) {
                room_number.focus();
                return false;
            }
            if (plasma_id.val().length == 0) {
                plasma_id.focus();
                return false;
            }
        });



        $(".t_room,.e_room").click(function() {
            var id = $(this).attr("data-id");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/doctor_room/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_room").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    room_number.val(data.room_number);
                    description.val(data.description);
                    plasma_id.val(data.plasma_id);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error data');
                }
            });
        });


        $(".d_room").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Are you sure ?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>main/delete/doctor_room/" + id,
                    data: "id=" + id,
                    success: function(data) {
                        location.reload();
                    },
                    error: function(){
                        toastr.info('Data gagal dihapus atau ruangan sedang dipakai', 'Information', {timeOut: 3000});
                        // alert('Error');
                    }
                });
            }
        });

        //fungsi judul modal
        function judul(id) {
            if (id != 0) {
                $(".modal-title").text("Form Edit Room");
                $("#f_room").attr('action', '<?= base_url() ?>main/update/doctor_room');
            } else {
                $(".modal-title").text("Form Add Room ");
                $("#f_room").attr('action', '<?= base_url() ?>main/add/doctor_room');
            }
        }



    });
</script>