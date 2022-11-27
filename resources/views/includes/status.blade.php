
@if (session('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('status') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('error') }}
    </div>
@endif
