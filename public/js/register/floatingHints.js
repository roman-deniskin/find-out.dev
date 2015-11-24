function displayHint(thisWrapper)
{
	$(thisWrapper).closest('.settingsBlock').find('.hint').css('display', 'block');
	$(thisWrapper).focusout(function(){
	$(thisWrapper).closest('.settingsBlock').find('.hint').css('display', 'none');
	})
};
function windowCase(thisWrapper)//Если клик на один из инпутов, вызываем функцию
{
	$('.hint').css('display', 'none');//На всякий случай скрываем все окна
	switch ($(thisWrapper).attr('name'))
	{
		case "login":
			displayHint(thisWrapper);
			break;
		case "password":
			displayHint(thisWrapper);
			break;
		case "name":
			displayHint(thisWrapper);
			break;
		case "surname":
			displayHint(thisWrapper);
			break;
		case "anonymNick":
			displayHint(thisWrapper);
			break;
	}
};
$('.inputRegisterField').bind({
	focus: function(){
		windowCase(this);
	}
});
