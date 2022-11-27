@extends('layouts.admin_panel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">{{ __('new series category') }}</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form enctype="multipart/form-data" action="{{Route('admin.series-categories.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="{{__('Enter Name')}}" >
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('Image')}}</label>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">{{__('choose image')}}</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
