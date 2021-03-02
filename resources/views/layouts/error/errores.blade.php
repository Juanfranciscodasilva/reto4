@if($errors->any())
    <div class="mt-4 error2 text-center" role="alert">
        <div class="alert p-1 alert-danger">
            @foreach($errors->all() as $error)
                <span>{{ $error }}</span>
                <br />
            @endforeach
        </div>
    </div>
    <div class="col-12">
@else
    <div class="col-12 mt-4">
@endif
