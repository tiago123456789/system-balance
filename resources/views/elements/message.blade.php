@if(count($errors->all()) > 0)
    <div class="alert alert-danger col-lg-12">
        @foreach($errors->all() as $error)
            <strong>{{$error}}</strong>
        @endforeach
    </div>
@endif