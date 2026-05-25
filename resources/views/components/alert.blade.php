@if (session('success'))
<div class="alert alert-success" role="alert">
    {{session('success')}}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{session('error')}}
</div>
@endif

@if ($errors->any())
@foreach ($errors->all() as $errors)
<div class="alert alert-danger" role="alert">
    {{$errors}}
</div>
@endforeach
@endif