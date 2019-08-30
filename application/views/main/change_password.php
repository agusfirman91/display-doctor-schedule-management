<div class="card">
    <div class="card-body">
        <h5 class="card-title">Password</h5>
        <form action="<?=  base_url('main/change-password')?>" method="post">
            <div class="form-group">
                <label for="inputPasswordCurrent">Current password</label>
                <input type="password" class="form-control" name="inputPasswordCurrent">
                <span class="text-danger"><?php echo form_error('inputPasswordCurrent'); ?></span>
            </div>
            <div class="form-group">
                <label for="inputPasswordNew">New password</label>
                <input type="password" class="form-control" name="inputPasswordNew">
                <span class="text-danger"><?php echo form_error('inputPasswordNew'); ?></span>
            </div>
            <div class="form-group">
                <label for="inputPasswordNew2">Verify password</label>
                <input type="password" class="form-control" name="inputPasswordNew2">
                <span class="text-danger"><?php echo form_error('inputPasswordNew2'); ?></span>
            </div>
            <button type="submit" class="btn btn-primary btn-square">Save changes</button>
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