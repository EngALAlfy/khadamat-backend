@extends('layouts.blank')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection
