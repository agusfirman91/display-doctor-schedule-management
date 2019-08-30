</div>
</body>
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
        font-size: 1.2em;
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
        font-size: 3.2em;
        text-align: center;
        font-family: digital;
    }

    @font-face {
        font-family: digital;
        src: url('../assets/fonts/digital-7.woff');

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
<script src="<?= base_url() . 'assets/js/bootstrap.min.js' ?>"></script>

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

</html>