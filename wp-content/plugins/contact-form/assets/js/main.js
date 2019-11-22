(function($){

	$(function(){
		$('.js--contact-form').submit(function(e){
			e.preventDefault();

			let action = $(this).attr('action');
			let data = $(this).serializeArray();

			$.post(action, data).done(function(response) {
				if(response.success) {
					alert("Message sent");
				}  else {
					alert(response.data.message);
				}
			})
			.fail(function() {
				alert('Something went wrong. Try later');
			})
		});
	});

})(jQuery);
