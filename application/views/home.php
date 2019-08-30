<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header" style="color:#fff;">Welcome to
            <small>Display Schedule Apps</small>
        </h1>
    </div>
</div>
<!-- /.row -->
<!-- Projects Row -->
<div class="row">
    <?php
    $background = array('light-red', 'bg-danger', 'bg-primary', 'bg-success', 'bg-danger', 'bg-warning', 'green', 'light-orange', 'purple', 'blue');
    $no = 0;
    foreach ($plasma as $pl) {
        ?>
        <div class="col-lg-3 col-md-6 col-sm-6 portfolio-item">
            <div class="menu-item <?= $background[$no] ?>" style="height:150px;">
                <a href="<?php echo base_url('display/') . $pl->url ?>" target="blank">
                    <i class="fa fa-television" aria-hidden="true"></i>
                    <p style="text-align:left;font-size:24px;padding-left:5px;">Display <?= $pl->name ?></p>
                </a>
            </div>
        </div>
        <?php $no++;
    } ?>
    <div class="col-lg-3 col-md-3 col-sm-6 portfolio-item">
        <div class="menu-item burlywood" style="height:150px;">
            <a href="#myModal" class="trigger-btn" data-toggle="modal">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                <p style="text-align:left;font-size:24px;padding-left:5px;">Login Apps</p>
            </a>
        </div>
    </div>
</div>


<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sign In</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>login" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Username" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$pesan = $this->session->userdata('message');
if ($pesan) {
    echo "<script>alert('$pesan');</script>";
}
?>
<style>
    body {
        background: url('assets/images/background.jpg') no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-position: 50% 50%;
        padding-top: 70px;
        font-family: 'Open Sans', sans-serif;
        outline: 0;
    }

    .portfolio-item {
        margin-bottom: 25px;
    }

    footer {
        margin: 50px 0;
    }

    .burlywood {
        background: #DEB887;
    }

    .dark-grey {
        background: #A9A9A9;
    }

    i {
        margin-left: 20px;
    }

    .modal-login {
        width: 450px;
    }

    .modal-login .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
    }

    .modal-login .modal-header {
        border-bottom: none;
        position: relative;
        justify-content: center;
    }

    .modal-login .close {
        position: absolute;
        top: -10px;
        right: -10px;
    }

    .modal-login h4 {
        color: #636363;
        text-align: center;
        font-size: 26px;
        margin-top: 0;
    }

    .modal-login .modal-content {
        color: #999;
        border-radius: 1px;
        margin-bottom: 15px;
        background: #fff;
        border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 25px;
    }

    .modal-login .form-group {
        margin-bottom: 20px;
    }

    .modal-login label {
        font-weight: normal;
        font-size: 13px;
    }

    .modal-login .form-control {
        min-height: 38px;
        padding-left: 5px;
        box-shadow: none !important;
        border-width: 0 0 1px 0;
        border-radius: 0;
    }

    .modal-login .form-control:focus {
        border-color: #ccc;
    }

    .modal-login .input-group-addon {
        max-width: 60px;
        text-align: center;
        background: none;
        border-width: 0 0 1px 0;
        padding-left: 5px;
        border-radius: 0;
    }

    .modal-login .btn {
        font-size: 16px;
        font-weight: bold;
        background: #19aa8d;
        border-radius: 3px;
        border: none;
        min-width: 140px;
        outline: none !important;
    }

    .modal-login .btn:hover,
    .modal-login .btn:focus {
        background: #179b81;
    }

    .modal-login .hint-text {
        text-align: center;
        padding-top: 5px;
        font-size: 13px;
    }

    .modal-login .modal-footer {
        color: #999;
        border-color: #dee4e7;
        text-align: center;
        margin: 0 -25px -25px;
        font-size: 13px;
        justify-content: center;
    }

    .modal-login a {
        color: #fff;
        text-decoration: underline;
    }

    .modal-login a:hover {
        text-decoration: none;
    }

    .modal-login a {
        color: #19aa8d;
        text-decoration: none;
    }

    .modal-login a:hover {
        text-decoration: underline;
    }

    .modal-login .fa {
        font-size: 21px;
    }
</style>