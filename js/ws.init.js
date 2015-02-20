(function ($) {
	$(function () {
		$('#msg').focus();
		
		var ws = new WebSocket('ws://localhost:8123');
		ws.onopen = function () {
			console.log('opened!');
		};
		
		ws.onmessage = function(msg) {
			$('#chat').append(msg.data + '<br>');
		};
		
		$('form').on('submit', function () {
			ws.send($('#msg').val());
			$('#msg').val('');
		});
		
	});
})(window.jQuery);
