<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="{{ asset('site/js/jquery.mask.min.js') }}"></script>

<script src="{{ asset('site/js/main.js') }}"></script>

<script src="{{ asset('site/js/validators.js') }}"></script>


<script src="{{ asset('site/js/main-alpha.js') }}"></script>
<script src="{{ asset('site/js/main-bravo.js') }}"></script>
<script src="{{ asset('site/js/main-charlie.js') }}"></script>
<script src="{{ asset('site/js/main-delta.js') }}"></script>
<script src="{{ asset('site/js/main-tango.js') }}"></script>

<?php 
$template_id = (request()->template->id ?? 0);
?>
@if(in_array(Request::url(), [route('logo'), route('logo-tshirt', ['template'=>$template_id]), route('create-template')]))
	<script src="{{ asset('site/js/draw/fabric.js') }}"></script>
	<script src="{{ asset('site/js/picker/jqueryUI-custom.js') }}"></script>
	<script src="{{ asset('site/js/picker/jqPlugins/colorpicker/js/colorpicker.js') }}"></script>
	<script src="{{ asset('site/js/picker/jquery.gradientPicker.js') }}"></script>
	<script src="{{ asset('site/js/draw/app.js') }}"></script>
   	<script src="{{ asset('site/js/draw/templates.js') }}"></script>	
	<script src="{{ asset('site/js/draw/http.js') }}"></script>
	<!-- <script src="{{ asset('site/js/draw/data.js') }}"></script> -->
	<script src="{{ asset('site/js/draw/fonts.js') }}"></script>
	<script src="{{ asset('site/js/draw/fontfaceobserver.js') }}"></script>
	<script src="{{ asset('site/js/draw/download.js') }}"></script>
	<script src="{{ asset('site/js/draw/UI.js') }}"></script>
@endif



<script src="{{ asset('site/js/blog.js') }}"></script>
@yield('js')
