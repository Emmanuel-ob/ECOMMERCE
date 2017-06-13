<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<section>
<form method="post" action="/cart/image_save" enctype="multipart/form-data">
<div>
<input type="file" name="image" id="image"><br>
{{ csrf_field() }}
<!-- <input type="hidden" value="{{ Session::token()}}"> -->
<input type="hidden" name="firstName" value="obute" >
<input type="submit" name="SUBMIT">
</div>
</form>
</section>


@if (Storage::disk('local')->has('obute'. '-'. 2 . '.jpg'))
	<section>
       <div>
       	<img src="/cart/image_get/{{ 'obute' . '-'. '2' . '.jpg' }}" height="200" width="400">
       	<!-- <img src="asset('images/'.$post->image) }}" height="200" width="400"> -->
       </div>
    </section>
@endif

</body>
</html>

