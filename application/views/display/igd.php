<?php

$pesan = $this->session->userdata('message');
if ($pesan) {
    echo "<script>
    $(document).ready(function() {
       alert('ok');
    });
    </script>";
    // echo 'OK';
}
?>
<div class="row mt-5">
    <nav class="navbar col-12">
        <div class="col-sm-3 text-left">
            <img src="<?= base_url('assets/images/uploads/') . $setting->image_display; ?>" alt="" style="width:100px;height:100px">
        </div>
        <div class="col-sm-6 text-center">
            <h1>
                <?= $display[0]->title; ?>
            </h1>
        </div>
        <div class="col-sm-3">
            <div id="Date">Monday 14 January 2013</div>
            <ul>
                <li class="font-digital" id="hours">00</li>
                <li class="font-digital" id="point">:</li>
                <li class="font-digital" id="min">00</li>
                <li class="font-digital" id="point">:</li>
                <li class="font-digital" id="sec">00</li>
            </ul>
        </div>
    </nav>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card mb-3">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $i = 1;
                    foreach ($images as $img) {
                        $item_class = ($i == 1) ? 'active' : '';
                        ?>
                    <div class="carousel-item <?= $item_class; ?> ">
                        <img class="d-block w-100" src="<?= base_url('assets/images/uploads/') . $img->pic_name; ?>" alt="First slide">
                    </div>
                    <?php
                        $i++;
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <table class="table table-sm table-striped table-bordered">
            <thead class="bg-danger text-white">
                <tr>
                    <th>No</th>
                    <th>Dokter Spesialis</th>
                    <th>ON Call-1</th>
                    <th>ON Call-2</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                function v_doctor($doctor_id)
                {
                    $ci = &get_instance();

                    $data = $ci->db->query("SELECT name from doctor where id= '" . $doctor_id . "' ")->row();
                    if ($data) {
                        $v_doctor = $data->name;
                    } else {
                        $v_doctor = '-';
                    }
                    return $v_doctor;
                }
                foreach ($list_igd as $igd) { ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $igd->specialist_name; ?></td>
                    <td><?= v_doctor($igd->doctor_oc_1); ?></td>
                    <td><?= v_doctor($igd->doctor_oc_2); ?></td>
                </tr>
                <?php
                    $no++;
                } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <table class="table table-sm table-striped table-bordered">
            <thead class="bg-danger text-white">
                <tr>
                    <th>Dokter Jaga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_doctor_of_duty as $dod) { ?>
                <tr>
                    <td><?= $dod->doctor_name; ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-sm table-striped table-bordered">
            <thead class="bg-danger text-white">
                <tr>
                    <th>Perawat Jaga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_nurse as $nurse) { ?>
                <tr>
                    <td><?= $nurse->nurse_name; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>