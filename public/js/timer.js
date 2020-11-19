<script type="text/javascript">
     function animation(span) {
         span.className = "turn";
         setTimeout(function () {
             span.className = ""
         }, 700);
     }
 
     function Countdown() {
   
         setInterval(function () {
 
            var hari    = document.getElementById("days");
            var jam     = document.getElementById("hours");
            var menit   = document.getElementById("minutes");
            var detik   = document.getElementById("seconds");
               
            var deadline    = new Date("Okt 25, 2020 23:59:59");
            var waktu       = new Date();
            var distance    = deadline - waktu;
               
            var days    = Math.floor((distance / (1000*60*60*24)));
            var hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
               
            if (days < 10)
            {
               days = '0' + days;
            }
            if (hours < 10)
            {
               hours = '0' + hours;
            }
            if (minutes < 10)
            {
               minutes = '0' + minutes;
            }
            if (seconds < 10)
            {
               seconds = '0' + seconds;
            }
 
            hari.innerHTML    = days;
            jam.innerHTML     = hours;
            menit.innerHTML   = minutes;
            detik.innerHTML   = seconds;
            //animation
            animation(detik);
            if (seconds == 0) animation(menit);
            if (minutes == 0) animation(jam);
            if (hours == 0) animation(hari);
 
         }, 1000);
     }
 
     Countdown();
 
</script>