$('#entryButton').bind({
	click: function() {
		var openWindow = $('.entryContainer').is(':visible');
		if (openWindow == false) {
			$('.entryContainer').css('display', 'inline-block');
		}
		else {
			$('.entryContainer').css('display', 'none');
		}
	}
});