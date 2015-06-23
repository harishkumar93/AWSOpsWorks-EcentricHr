$(function()
{
	var ticker = function()
	{
		setTimeout(function(){
			$('#ticker li:first').animate( {marginTop: '-120px'}, 800, function()
			{
				$(this).detach().appendTo('ul#ticker').removeAttr('style');	
			});
			ticker();
		}, 8000);
	};
	ticker();
});





$(function()
{
	var ticker1 = function()
	{
		setTimeout(function(){
			$('#ticker1 li:first').animate( {marginTop: '-120px'}, 800, function()
			{
				$(this).detach().appendTo('ul#ticker1').removeAttr('style');	
			});
			ticker1();
		}, 8000);
	};
	ticker1();
});