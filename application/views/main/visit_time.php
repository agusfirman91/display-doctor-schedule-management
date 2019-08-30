<div class="card">
    <div class="card-header">
        <div class="card-title">
            Jadwal Jam Besuk
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped datatables-basic" style="width:100%">
            <thead>
                <tr>
                    <th width="5%" >No</th>
                    <th>Plasma</th>
                    <th>Siang</th>
                    <th>Sore</th>
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($list_visit as $visit) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $visit->name; ?></td>
                        <td><?= $visit->noon; ?></td>
                        <td><?= $visit->afternoon; ?></td>
                        <td>
                            <a href="javascript:void(0);" class="e_visit" data-id="<?= $visit->id ?>" data-toggle="tooltip" data-placement="top" title="Edit visit">
                                <i class="align-middle" data-feather="edit"></i></a>
                            <a href="javascript:void(0);" class="d_visit" data-id="<?= $visit->id ?>" data-toggle="tooltip" data-placement="top" title="Delete visit">
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
        <button class='btn btn-primary btn-square t_visit' data-id='0'>Add visit</button>
    </div>
</div>


<div class="modal fade btn-square" id="m_visit" role="dialog">
    <div class="modal-dialog modal-sg">
        <form id="f_visit" class="form-horizontal" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control input-sm" name="id" readonly>
                    <div class="form-group row" id="plasma-id">
                        <label class="col-sm-3 control-label">Plasma</label>
                        <div class="col-sm-6">
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
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Siang</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control input-sm" name="noon" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Sore</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control input-sm" name="afternoon" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-square" id="b_visit">Simpan</button>
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
        var plasma_id = $('select[name=plasma_id]');
        var noon = $('input:text[name=noon]');
        var afternoon = $('input:text[name=afternoon]');

        $('#b_visit').click(function(event) {
            var string = $("#f_visit").serialize();

            if (doctor_name.val().length == 0) {
                doctor_name.focus();
                return false;
            }
            if (plasma_id.val().length == 0) {
                plasma_id.focus();
                return false;
            }
        });



        $(".t_visit,.e_visit").click(function() {
            var id = $(this).attr("data-id");
            judul(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>main/req_data/visit_time/" + id,
                dataType: "JSON",
                success: function(data) {
                    $("#m_visit").modal('show');
                    $('input:hidden[name=id]').val(data.id);
                    // alert(data.id);
                    if(data.id != 0){
                        $('#plasma-id').hide();
                        plasma_id.val(data.plasma_id);
                        noon.val(data.noon);
                        afternoon.val(data.afternoon);
                    }else{
                        $('#plasma-id').show();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });


        $(".d_visit").click(function() {
            var id = $(this).attr("data-id");
            var pilih = confirm('Are you sure ?'+id);
            if (pilih == true) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url() ?>main/delete/visit_time/" + id,
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
                $(".modal-title").text("Form Edit visit");
                $("#f_visit").attr('action', '<?= base_url() ?>main/update/visit_time');
            } else {
                $(".modal-title").text("Form Add visit ");
                $("#f_visit").attr('action', '<?= base_url() ?>main/add/visit_time');
            }
        }



    });
</script>

<style>
</style>