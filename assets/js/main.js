// Plugins

require(['fitvid'], function() {
    $(function() {
        $('.video-wrapper').fitVids();
    });
});

require(['hippify']);

require(['magnific'], function() {
	$('.magnific-img').magnificPopup({
		type: 'image'
	});
	$('.open-popup-link').magnificPopup({
		type:'inline',
		midClick: true
	});
});


// Modules

require(['lib/modules/forms'], function(forms) {
    forms.formValidate('form');
});

require(['lib/modules/mobileNav'], function(mobileNav) {
    mobileNav.init();
});


// General

require(['functions'], function() {
    $(function() {

        $(window).resize(function(){
            clearStyles('.nav-collapse');
        });

    });
});