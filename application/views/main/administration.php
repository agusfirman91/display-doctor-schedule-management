<div class="card">
    <div class="card-header">
        <div class="card-title">
            List Administration
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($list_admin as $administration) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $administration->name; ?></td>
                        <td><?= $administration->plasma_name; ?></td>
                        <td>
                            <a href="javascript:void(0);" class="e_administration" data-id="<?= $administration->id ?>" data-role="<?= $administration->name ?>" data-toggle="tooltip" data-placement="top" title="Edit administration">
                                <i class="align-middle" data-feather="edit"></i></a>
                            <a href="javascript:void(0);" class="d_administration" data-id="<?= $administration->id ?>" data-toggle="tooltip" data-placement="top" title="Delete administration">
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
        <button class='btn btn-primary btn-square t_administration' data-id='0'>Add </button>
    </div>
</div>


<div class="modal fade" id="m_administration" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_administration" class="form-horizontal" method="post">
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
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-sm" name="name" value="">
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
                        <button type="submit" class="btn btn-primary btn-square" id="b_administration">Simpan</button>
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
        var name = $('input:text[name=name]');
        var plasma_id = $('select[name=plasma_id]');

        $('#b_administration').click(function(event) {
            var string = $("#f_administration").serialize();

            if (name.val().length == 0) {
                name.focus();
                return false;
            }
        });



        $(".t_administration,.e_administration").click(function() {
            var id = $(this).attr("data-id");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/administration/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_administration").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    name.val(data.name);
                    plasma_id.val(data.plasma_id);
                    // alert(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_administration").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Ar you sure ?');
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>main/delete/administration/" + id,
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
                $(".modal-title").text("Form Edit administration");
                $("#f_administration").attr('action', '<?= base_url() ?>main/update/administration');
            } else {
                $(".modal-title").text("Form Add administration ");
                $("#f_administration").attr('action', '<?= base_url() ?>main/add/administration');
            }
        }



    });
</script>