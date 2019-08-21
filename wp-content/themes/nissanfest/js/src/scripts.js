var $ = jQuery;
$( document ).ready(function() {
    $('input[name="previous"]').click( function() {
        if( $(this).val() === 'yes' ) {
            $('.coverage label, .coverage input').show();
        } else {
            $('.coverage label, .coverage input').hide();
        }
    });
    $('input').blur( function() {
        if( $(this).prop('required',true) ) {
            if( $(this).val() === '' ) {
                $(this).parent().append('<span class="error">'+$(this).data('error')+'</span>')
            } else {
                $(this).parent().find('.error').remove()
            }
        }
    });
    $('input[type="url"]').blur( function() {
        if( validURL( $(this).val() ) ) {
            $(this).parent().find('.error').remove()
        } else {
            $(this).parent().append('<span class="error">Please enter a Valid URL</span>')
        }
    });
    $('.vendor input:radio, .vendor input:checkbox').change( function() {
        var total = [];
        $('.vendor input:checked').each( function() {
            total.push( $(this).data('cost') );
        } );
        $('.total').text( '$'+ eval( total.join('+') ) );
        $('input[name="price"]').val( eval( total.join('+') ) );
    });
    $("a").on('click', function(event) {
        if (this.hash !== "") {
          event.preventDefault();
          var hash = this.hash;
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){
            window.location.hash = hash;
          });
        } 
      });
});
function validURL(str) {
    var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
      '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
      '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
      '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
      '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
      '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return !!pattern.test(str);
  }
function toggleNav() {
	$('#nav-menu').toggleClass('open');
}
function registerForm( event ) {
    event.preventDefault();
    $.ajax({
        type : "POST",
        dataType : "json",
        url : '/wp-content/themes/nissanfest/actions/register.php',
        data : $(event.target).serialize(),
        success: function(data) {
            $(event.target).addClass('success');
            document.cookie = data.cat +"="+ data.postID;
            document.cookie = "expires="+ data.expiry;
            document.cookie = "path=/";
            location.reload();
        },
    }); 
}
function paymentForm( event ) {
    event.preventDefault();
    $.ajax({
        type : "POST",
        dataType : "json",
        url : '/wp-content/themes/nissanfest/actions/payment.php',
        data : $(event.target).serialize(),
        success: function(data) {
            location.reload();
        },
   }); 
}
function approve( event ) {
    event.preventDefault();
    $.ajax({
        type : "POST",
        dataType : "json",
        url : '/wp-content/themes/nissanfest/actions/approve.php',
        data : $(event.target).serialize(),
        success: function(data) {
            location.reload();
        },
    }); 
}
function denied( event ) {
    event.preventDefault();
    $.ajax({
        type : "POST",
        dataType : "json",
        url : '/wp-content/themes/nissanfest/actions/denied.php',
        data : $(event.target).serialize(),
        success: function(data) {
            location.reload();
        },
    }); 
}