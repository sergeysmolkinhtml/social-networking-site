@if(Session::has('info'))
    <div class="alert alert-info" role="alert">
        {{\Illuminate\Support\Facades\Session::get('info')}}
    </div>

@endif


