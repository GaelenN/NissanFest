var $ = jQuery;
$( document ).ready(function() {
	$('input[type="email"]').keyup(function() {
		$('input[name="url_add"]').val('email='+$(this).val());
	});
	$('input').blur(function() {
		required(this);
	});
	$('#media .radio input').change(function() {
		if($(this).val() === 'yes') {
			$('input[name="link"]').parent().show();
		} else {
			$('input[name="link"]').parent().hide();
		}
		
	});
});
function toggleNav() {
	$('#nav-menu').toggleClass('open');
}
function addDriver() {
	var drivers = $('.driver').length;
	$html = '';
	$html += '<div class="driver">';
	$html += '<h3 class="driver-title">Driver #'+ (drivers+1) +'</h3>';
	$html += '<li>';
	$html += '<label for="title">Name</label>';
	$html += '<input type="text" value="" name="name['+ (drivers) +']" />';
	$html += '</li>';
	$html += '<li id="year">';
	$html += '<label for="year">Year:</label>';
	$html += '<input type="text" value="" name="year['+ (drivers) +']" />';
	$html += '</li>';
	$html += '<li id="make">';
	$html += '<label for="make">Make:</label>';
	$html += '<input type="text" value="" name="make['+ (drivers) +']" />';
	$html += '</li>';
	$html += '<li id="model">';
	$html += '<label for="model">Model:</label>';
	$html += '<input type="text" value="" name="model['+ (drivers) +']" />';
	$html += '</li>';
	$html += '<li id="shirt">';
	$html += '<label for="title">Tshirt Size</label>';
	$html += '<select name="tshirt['+ (drivers) +']">';
	$html += '<option selected hidden>- Select Shirt Size -</option>';
	$html += '<option value="s">Small</option>';
	$html += '<option value="m">Medium</option>';
	$html += '<option value="l">Large</option>';
	$html += '<option value="xl">X-Large</option>';
	$html += '<option value="xxl">XX-Large</option>';
	$html += '<option value="xxxl">XXX-Large</option>';
	$html += '</select>';
	$html += '</li>';
	$html += '<li id="email">';
	$html += '<label for="title">Email</label>';
	$html += '<input type="email" value="" name="email['+ (drivers) +']" />';
	$html += '</li>';
	$html += '</div>';
	$('.driver').last().after($html);
	if(drivers > 2) {
		$('.modal .adddriver').hide();
	}
}
function register(form) {
	var amount = '';
	var item_name = '';
	var item_number = '';
	if(form === 'car-show') {
		amount = '40.00';
		item_name = 'NissanFest Car Show';
		item_number = 'NFCS2019';
	}
	if(form === 'autox') {
		amount = '60.00';
		item_name = 'NissanFest Autox';
		item_number = 'NFAX2019';
	}
	$('.overlay').addClass('open');
	$('.modal').delay( 1800 ).addClass('open');
	$('input[name="cat"]').val(form);
	$('input[name="amount"]').val(amount);
	$('input[name="item_name"]').val(item_name);
	$('input[name="item_number"]').val(item_number);
	$('form[name="new_entrant"]').attr("id",form);
	$('#form-title').text(form.replace("-", " "));
	modalCenter();
}
function modalCenter() {
	var windowHeight = $(window).height();
	var windowWidth = $(window).width();
	var boxHeight = $('.modal').outerHeight( true );
	var boxWidth = $('.modal').outerWidth( true );
	$('.modal').css({
		'left' : ((windowWidth - boxWidth)/2),
		'right' : ((windowWidth - boxWidth)/2),
		'top' : ((windowHeight - boxHeight)/2),
		'bottom' : ((windowHeight - boxHeight)/2)
	});
}
function modalClose() {
	$('.modal').removeClass('open');
	$('.modal').attr('style','');
	$('.overlay').delay( 1800 ).removeClass('open');
}
function required(elem) {
	var name = $(elem).attr('name');
	var errormsg = 'This field is required';
	var error = '<span class="error">'+ errormsg +'</span>';
	if($(elem).attr('required') && !$(elem).parent().hasClass('er') && !$(elem).val()) {
		$(elem).after(error);
		$(elem).parent().addClass('er');
	} else {
		$(elem).parent().find('.error').remove();
		$(elem).parent().removeClass('er');
	}
}
function checkform(event) {
	var form = event.target.closest('form');
	var formName = $(form).attr('name');
	var emptyInputs = $('form[name="' + formName + '"] input').attr('required',true).filter(':visible').filter(function() { 
		return $(this).val() == ''; 
	});
    if (emptyInputs.length === 0) {
		$('form[name="' + formName + '"]').submit();
	} 
	$(emptyInputs).each(function() {
		required($(this));
	}) ;
}