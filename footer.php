<footer>
	<div class="container">
	<div class="copyright">
		<div align="right">
			<text>copyright stuff</text>
		</div>
	</div>
	</div>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!--Bootstrap JS-->
<script src="js/bootstrap.js"></script>
<!--Custom JS-->
<script src="js/js.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
<!-- Calendar -->

<script>
$(document).ready(function() {
  // page is now ready, initialize the calendar...
  // options and github  - http://fullcalendar.io/

$('#calendar').fullCalendar({
    dayClick: function() {
       
    }
});

});

</script>
<script src='http://fullcalendar.io/js/fullcalendar-2.2.3/lib/moment.min.js'></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.2.3/fullcalendar.min.js'></script>

<script>
    $(function() {
        $('.sidebar').matchHeight({
            target: $('.main-content-wrapper')
        });
    });
</script>
</body>
</html>