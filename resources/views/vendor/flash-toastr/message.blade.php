 @if(Session::has('flash_notification'))
 <!-- Pull in jQuery from CDN if not already loaded -->
<script>window.jQuery || document.write("<script src='//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'><\/script>")</script>
 <!-- Pull in Toastr CSS and JS from CDN to be always up2date -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	 <script>
	    $('document').ready(function(){
            toastr.options = {
                      "closeButton": false,
                      "debug": false,
                      "positionClass": "toast-bottom-full-width",
                      "onclick": null,
                      "showDuration": "300",
                      "hideDuration": "1000",
                      "timeOut": "5000",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                  }
	    // toastr.options = $.parseJSON('{!!json_encode(config('flash-toastr.options'), JSON_UNESCAPED_SLASHES)!!}');
	    @foreach (session('flash_notification', collect())->toArray() as $message)
			toastr["{!! $message['level'] !!}"]("{!! $message['message'] !!}", "{!! $message['title'] !!}");
		@endforeach
	    });
	</script>
{{ Session::forget('flash_notification') }}
@endif

