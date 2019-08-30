<div class="card">
    <div class="card-header">
        <div class="card-title">
            List PJ Shift
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Group Plasma</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($list_pic_nurse as $pic_nurse) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $pic_nurse->name; ?></td>
                        <td><?= $pic_nurse->plasma_name; ?></td>
                        <td>
                            <a href="javascript:void(0);" class="e_pic_nurse" data-id="<?= $pic_nurse->id ?>" data-role="<?= $pic_nurse->name ?>"data-toggle="tooltip" data-placement="top" title="Edit pic_nurse">
                                <i class="align-middle" data-feather="edit"></i></a>
                            <a href="javascript:void(0);" class="d_pic_nurse" data-id="<?= $pic_nurse->id ?>" data-toggle="tooltip" data-placement="top" title="Delete pic_nurse">
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
        <button class='btn btn-primary btn-square t_pic_nurse' data-id='0'>Add PIC Nurse</button>
    </div>
</div>


<div class="modal fade" id="m_pic_nurse" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_pic_nurse" class="form-horizontal" method="post">
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
                        <label class="col-sm-3 control-label">Nurse Name</label>
                        <div class="col-sm-8">
                            <select name="nurse_id" class="form-control input-sm custom-select">
                                <option value="">== Please Select ==</option>
                                <?php
                                    foreach ($list_nurse as $nurse) {
                                ?>
                                <option value="<?= $nurse->id?>"><?= $nurse->name?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Plasma Group</label>
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
                        <button type="submit" class="btn btn-primary btn-square" id="b_pic_nurse">Simpan</button>
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
        var nurse_id = $('select[name=nurse_id]');
        var plasma_id = $('select[name=plasma_id]');

        $('#b_pic_nurse').click(function(event) {
            var string = $("#f_pic_nurse").serialize();

            if (nurse_id.val().length == 0) {
                nurse_id.focus();
                return false;
            }
            if (plasma_id.val().length == 0) {
                plasma_id.focus();
                return false;
            }
        });



        $(".t_pic_nurse,.e_pic_nurse").click(function() {
            var id = $(this).attr("data-id");
            var role_name = $(this).attr("data-role");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/pic_nurse/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_pic_nurse").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    nurse_id.val(data.nurse_id);
                    plasma_id.val(data.plasma_id);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_pic_nurse").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Ar you sure ?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>main/delete/pic_nurse/" + id,
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
                $(".modal-title").text("Form Edit Nurse PIC");
                $("#f_pic_nurse").attr('action', '<?= base_url() ?>main/update/pic_nurse');
            } else {
                $(".modal-title").text("Form Add Nurse PIC ");
                $("#f_pic_nurse").attr('action', '<?= base_url() ?>main/add/pic_nurse');
            }
        }



    });
</script>