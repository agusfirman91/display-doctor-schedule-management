    <div class="row mt-5">
        <div class="col-sm-3 text-left">
            <img src="<?= base_url('assets/images/uploads/'). $setting->image_display; ?>" alt="">
        </div>
        <div class="col-sm-6 text-center">
            <h2>
                <?= $enama->title; ?>
            </h2>
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
    </div>
    <div></div>
    <div class="row">
        <div class="col-sm-4">
            <div class="card mb-3">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $i = 1;
                        foreach($list_image as $img){
                        $item_class = ($i == 1) ? 'active' : '';
                        ?>
                        <div class="carousel-item <?= $item_class; ?> ">
                            <img class="d-block w-100" src="<?= base_url('assets/images/uploads/').$img->pic_name; ?>" alt="First slide">
                        </div>
                        <?php 
                        $i++;
                        } ?>
                    </div>
                </div>
                <div class="card-footer">
                    <h3 class="card-title text-center">Jam Berkunjung pasien rawat inap</h3>
                    <p>Siang :</p>
                    <p>Sore :</p>
                </div>
            </div>
        </div>

        <?php
        // $sql = "SELECT plasma_detail.dokter_jaga,karu,pj_shift,perawat
        // FROM plasma_detail JOIN plasma
        // ON plasma_detail.plasma_id = plasma.id
        // WHERE plasma.url='enama' ";
        // $data = $this->db->query($sql)->result_array();
        ?>
        <div class="col-sm-8">
            <div class="card text-white bg-danger mb-2">
                <div class="card-header">
                    <h5>PERAWAT YANG BERTUGAS</h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= $data['perawat']; ?></p>
                </div>
            </div>
            <div class="card text-white bg-danger mb-2">
                <div class="card-header">
                    <h5>Dokter Jaga</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
            <div class="card text-white bg-danger mb-2">
                <div class="card-header">
                    <h5>PJ Shift</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
            <div class="card text-white bg-danger mb-2">
                <div class="card-header">
                    <h5>KA. Ruangan</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
    </div>
    <style>
        .clock {
            width: 100px;
            margin: 0 auto;
            padding: 5px;
            border: 1px solid #333;
        }

        #Date {
            font-family: 'BebasNeueRegular', Arial, Helvetica, sans-serif;
            text-align: center;
            text-shadow: 0 0 5px #00c6ff;
        }

        ul {
            margin: 0 auto;
            padding: 0px;
            list-style: none;
            text-align: center;
        }

        ul li {
            color: red;
            display: inline;
            font-size: 2.2em;
            text-align: center;
            font-family: 'BebasNeueRegular', Arial, Helvetica, sans-serif;
        }

        #point {
            position: relative;
            -moz-animation: mymove 1s ease infinite;
            -webkit-animation: mymove 1s ease infinite;
            padding-left: 10px;
            padding-right: 10px;
        }

        @-webkit-keyframes mymove {
            0% {
                opacity: 1.0;
                text-shadow: 0 0 20px #00c6ff;
            }

            50% {
                opacity: 0;
                text-shadow: none;
            }

            100% {
                opacity: 1.0;
                text-shadow: 0 0 20px #00c6ff;
            }
        }


        @-moz-keyframes mymove {
            0% {
                opacity: 1.0;
                text-shadow: 0 0 20px #00c6ff;
            }

            50% {
                opacity: 0;
                text-shadow: none;
            }

            100% {
                opacity: 1.0;
                text-shadow: 0 0 20px #00c6ff;
            }
        }
    </style>

    <script>
        $(document).ready(function() {


            $('.carousel').carousel();
            // Create two variable with the names of the months and days in an array
            var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]

            // Create a newDate() object
            var newDate = new Date();
            // Extract the current date from Date object
            newDate.setDate(newDate.getDate());
            // Output the day, date, month and year    
            $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

            setInterval(function() {
                // Create a newDate() object and extract the seconds of the current time on the visitor's
                var seconds = new Date().getSeconds();
                // Add a leading zero to seconds value
                $("#sec").html((seconds < 10 ? "0" : "") + seconds);
            }, 1000);

            setInterval(function() {
                // Create a newDate() object and extract the minutes of the current time on the visitor's
                var minutes = new Date().getMinutes();
                // Add a leading zero to the minutes value
                $("#min").html((minutes < 10 ? "0" : "") + minutes);
            }, 1000);

            setInterval(function() {
                // Create a newDate() object and extract the hours of the current time on the visitor's
                var hours = new Date().getHours();
                // Add a leading zero to the hours value
                $("#hours").html((hours < 10 ? "0" : "") + hours);
            }, 1000);

        });
    </script> 