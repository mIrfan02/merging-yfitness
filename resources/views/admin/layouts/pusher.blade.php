<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
@if(Sentinel::check())
<script>

var user_id = "{{ Sentinel::getUser()->id }}";

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('9f8f059b91665e879a4c', {
  cluster: 'ap2'
});

var channel = pusher.subscribe('push-notification');
channel.bind('push-notification-event', function(data) {
	if (data.id == user_id) {
		//alert(JSON.stringify(data));
		toastr.options = {
		                  "positionClass": "toast-top-right"
		}
		toastr.warning('<a href="https://youtube.com">' + data.link + '</a>');
	}
});

var open_notification = pusher.subscribe('open-reminder');
open_notification.bind('open-reminder-event', function(data) {
	if (data.id == user_id) {
		//alert(JSON.stringify(data));
		toastr.options = {
		                  "positionClass": "toast-top-right"
		}
		toastr.warning(data.text);
	}
});

var course_logbook = pusher.subscribe('course-logbook');
course_logbook.bind('course-logbook-event', function(data) {
	if (data.id == user_id) {
		//alert(JSON.stringify(data));
		toastr.options = {
		                  "positionClass": "toast-top-right"
		}
		toastr.warning(data.text);
	}
});


</script>
@endif