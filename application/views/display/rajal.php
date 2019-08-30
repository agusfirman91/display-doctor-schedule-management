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
                    <li id="hours">10</li>
                    <li id="point">:</li>
                    <li id="min">13</li>
                    <li id="point">:</li>
                    <li id="sec">03</li>
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
            <table class="table table-lg table-striped table-bordered" style="font-size: 1.5rem;">
                <thead class="bg-danger text-white">
                    <tr>
                        <th>Ruang</th>
                        <th>Dokter</th>
                        <th>Jam Praktek</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    function v_doctor($doctor_id)
                    {
                        $ci = &get_instance();
                        $data = $ci->db->query("SELECT name from doctor where id= '" . $doctor_id . "' ")->row();
                        $v_doctor = $data->name;
                        return $v_doctor;
                    }
                    foreach ($rajal as $rj) {
                        ?>
                    <tr>
                        <td class="font-weight-bold"><?= $rj->room_number; ?></td>
                        <td class="font-weight-bold"><?= v_doctor($rj->doctor_id); ?></td>
                        <td class="font-weight-bold"><?= $rj->c_day; ?></td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>