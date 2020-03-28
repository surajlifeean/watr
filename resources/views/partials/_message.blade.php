@if(Session::has('success'))
	<div class="alert alert-success" role="alert" style="
    margin-bottom: 0px;">
	<strong>Success:</strong>{{Session::get('success')}}
	</div>
@endif

@if(Session::has('error'))
	<div class="alert alert-danger" role="alert" style="
    margin-bottom: 0px;">
	{{Session::get('error')}}
	</div>
@endif

<script type="text/javascript">
	
 setTimeout(function() {
        $('.alert').remove();
    }, 8000);
</script>