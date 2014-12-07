
var input = $('#user_typing_input');
var target_container = $('.target_text_container');
var form = $('#user_typing_form');
var timer = $('.timer');


function decrement_timer(time) {
	time = time - 1;
	timer.text(time);
	console.log("Time remaining: "+time);
	return time;
}


input.on('click', function() {
	var time_remaining = parseInt(timer.text()); 
	setInterval(function() {
		time_remaining = decrement_timer(time_remaining);
		time_remaining == 0 ? form.submit() : null;
	}, 1000);
	if (time_remaining == 0) {
		form.submit();
	}
});


input.on('input', function() {
	console.log( "Target: "+target_container.text());
    console.log( "Input: "+$(this).val());
    if ($(this).val() == target_container.text()) {
    	form.submit();
    }
});

if (input) {  
    console.log('OPEN');
} else {
    console.log('CLOSED');
}