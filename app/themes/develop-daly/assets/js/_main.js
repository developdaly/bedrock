// Modified http://paulirish.com/2009/markup-based-unobtrusive-comprehensive-dom-ready-execution/
// Only fires on body class (working off strictly WordPress body_class)

var ExampleSite = {
  // All pages
  common: {
    init: function() {

		function equalHeights (element1, element2) {
			var height;
		
			if (element1.outerHeight() > element2.outerHeight())
			{
				height = element1.outerHeight();
				element2.css('height', height);
			}
			else {
				height = element2.outerHeight();
				element1.css('height', height);
			}
		}
				
		equalHeights($('.content'), $('.sidebar') );

		
		// Check if the cookie is set
		if( $.cookie('ShowSidebar') ) {

			if($.cookie('ShowSidebar') === 'null') {
				$('.sidebar').hide( 'fast' );
				$('body').removeClass('sidebar-open');
	
			} else {
				$('.sidebar').show( 'fast' );
				$('body').addClass('sidebar-open');
			}
		} else {
			
			// Set the cookie for the sidebar to open
			$.cookie('ShowSidebar', 'Yes');

			// ... and then open it
			$('.sidebar').show( 'fast' );
			$('body').addClass('sidebar-open');
		}
		
		$('#sidebar-toggle').click(function() {
						
			if($.cookie('ShowSidebar') === 'Yes') {
				$('.sidebar').show( 'fast' );
				$(this).html('&#9668;'); // left
				$('body').removeClass('sidebar-open');
				$.cookie('ShowSidebar', null);
			} else {
				$('.sidebar').hide( 'fast' );
				$(this).html('&#9658;'); // left
				$('body').addClass('sidebar-open');
				$.cookie('ShowSidebar', 'Yes');
			}
		},
		function() {
			if($.cookie('ShowSidebar') === 'Yes') {
				// Sidebar is open, so close it
				$('.sidebar').hide( 'fast' );
				$(this).html('&#9668;'); // right
				$('body').removeClass('sidebar-open');
				$.cookie('ShowSidebar', null);
			} else {
				$('.sidebar').show( 'fast' );
				$(this).html('&#9658;'); // left
				$('body').addClass('sidebar-open');
				$.cookie('ShowSidebar', 'Yes');
			}
		});
	
    },
    finalize: function() { }
  },
  // Home page
  home: {
    init: function() {
      // JS here
    }
  },
  // About page
  about: {
    init: function() {
      // JS here
    }
  }
};

var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = ExampleSite;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {

    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });

    UTIL.fire('common', 'finalize');
  }
};

$(document).ready(UTIL.loadEvents);