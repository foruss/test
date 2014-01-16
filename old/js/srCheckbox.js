$(document).ready(function(){
	$('input:checkbox').each(function(){
			$(this).addClass('hiddenCheckbox').wrap('<span></span>');
			var $wrapper = $(this).parent();
			$wrapper.prepend('<a href="#" class="newCheckbox"></a>');
			/* Click Handler */
			$(this).siblings('a.newCheckbox').click(function(){
				var $a = $(this);
				var input = $a.siblings('input')[0];
				if (input.checked===true){
					input.checked = false;
					$a.removeClass('newCheckboxChecked');
				}
				else {
					input.checked = true;
					$a.addClass('newCheckboxChecked');
				}
				return false;
			});
			/* set the default state */
			if ($(this).checked){$('a.newCheckbox', $wrapper).addClass('newCheckboxChecked');}
	});
});