<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DMCA APP</title>


	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" rel="stylesheet" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	
	@include('flash::message')	

	@include('partials.nav')

	<div class="container">
		@yield('content')	
	</div>

	<div class="flash" style="width: 200px; position: absolute; right: 20px; bottom: 20px; padding: 1em; display: none; background: #009EC0; color: white; border-radius: 3px;">
		
		Updated!
	</div>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>
	
	<script type="text/javascript">
		(function() {
    
		    var o = $({});

		    $.subscribe = function() {

		        o.on.apply(o, arguments);

		    };

		    $.unsubscribe = function() {

		        o.off.apply(o, arguments);

		    };

		    $.publish = function() {

		        o.trigger.apply(o, arguments);
		        
		    };

		})();

		(function() {
		    
		    $.subscribe('form.submitted', function() {

		        $('.flash').fadeIn(500).delay(1000).fadeOut(500);
		    });

		})();

		(function() {
		    
		    var submitAjaxRequest = function(e) {

		    	var form = $(this);
		    	var method = form.find('input[name="_method"]').val() || 'POST';

		    	$.ajax({
		    		type: method,
		    		url: form.prop('action'),
		    		data: form.serialize(),
		    		success: function() {
		    			$.publish('form.submitted', form);
		    		}
		    	});	

		    	e.preventDefault();

		    };

		    //Form marked with data-remote attribute will be submited via ajax
		    $('form[data-remote]').on('submit', submitAjaxRequest);


		    // The "data-click-submits-form" attribute immidiately submits the form on change
		    $('*[data-click-submits-form]').on('change', function() {

		    	$(this).closest('form').submit();
		    });

		})();
	</script>

	@yield('footer')
	
</body>
</html>
