<div class="card">
    <div class="card-header">
        <div class="card-title">
            List Nurse Supervisor
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
                foreach ($list_nurse_spv as $nurse_spv) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $nurse_spv->name; ?></td>
                        <td><?= $nurse_spv->plasma_name; ?></td>
                        <td>
                            <a href="javascript:void(0);" class="e_nurse_spv" data-id="<?= $nurse_spv->id ?>" data-role="<?= $nurse_spv->name ?>" data-toggle="tooltip" data-placement="top" title="Edit nurse_spv">
                                <i class="align-middle" data-feather="edit"></i></a>
                            <a href="javascript:void(0);" class="d_nurse_spv" data-id="<?= $nurse_spv->id ?>" data-toggle="tooltip" data-placement="top" title="Delete nurse_spv">
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
        <button class='btn btn-primary btn-square t_nurse_spv' data-id='0'>Add Nurse SPV</button>
    </div>
</div>


<div class="modal fade" id="m_nurse_spv" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_nurse_spv" class="form-horizontal" method="post">
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
                                    <option value="<?= $nurse->id ?>"><?= $nurse->name ?></option>
                                <?php } ?>
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
                                    <option value="<?= $plasma->id ?>"><?= $plasma->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-square" id="b_nurse_spv">Simpan</button>
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

        $('#b_nurse_spv').click(function(event) {
            var string = $("#f_nurse_spv").serialize();

            if (nurse_id.val().length == 0) {
                nurse_id.focus();
                return false;
            }
            if (plasma_id.val().length == 0) {
                plasma_id.focus();
                return false;
            }
        });



        $(".t_nurse_spv,.e_nurse_spv").click(function() {
            var id = $(this).attr("data-id");
            var role_name = $(this).attr("data-role");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/nurse_spv/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_nurse_spv").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    nurse_id.val(data.nurse_id);
                    plasma_id.val(data.plasma_id);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_nurse_spv").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Ar you sure ?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>main/delete/nurse_spv/" + id,
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
                $(".modal-title").text("Form Edit Nurse SPV");
                $("#f_nurse_spv").attr('action', '<?= base_url() ?>main/update/nurse_spv');
            } else {
                $(".modal-title").text("Form Add Nurse SPV ");
                $("#f_nurse_spv").attr('action', '<?= base_url() ?>main/add/nurse_spv');
            }
        }



    });
</script>