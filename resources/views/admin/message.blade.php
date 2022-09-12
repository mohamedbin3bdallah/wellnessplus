@if (Session::has('success'))
<div class="col-md-6 mx-auto animated fadeInDown alert alert-success" role="alert">
    {{Session::get('success')}}
</div>
@endif

@if (Session::has('delete'))
<div class="col-md-6 animated fadeInDown alert alert-danger" role="alert">
    {{Session::get('delete')}}
</div>
@endif
@if (Session::has('error'))
<div class=" col-md-6 animated fadeInDown alert alert-danger" role="alert">
    {{Session::get('error')}}
</div>
@endif
