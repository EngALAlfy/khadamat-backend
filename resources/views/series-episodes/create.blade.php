@extends('layouts.admin_panel')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">{{ __('create series episode') }}</span>

                    </div>

                    <div class="card-body">

                        @include('.includes.status')

                        <form enctype="multipart/form-data" action="{{Route('admin.series-episodes.store' , $series->id)}}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="order">{{__('order')}}</label>
                                <input name="order" type="number" class="form-control" id="order"
                                       placeholder="{{__('Enter order')}}">
                            </div>


                            <div class="form-group">
                                <label for="name">{{__('name')}}</label>
                                <input name="name" type="text" class="form-control" id="name"
                                       placeholder="{{__('Enter name')}}">
                            </div>
                             <div class="form-group">
                                <label for="description">{{__('Description')}}</label>
                                <textarea name="desc" type="text" class="form-control" id="description"
                                          rows="5"></textarea>
                            </div>


                            <div class="form-group">
                                <label for="image">{{__('Image')}}</label>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">{{__('choose image')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="file">{{__('File')}}</label>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="file">
                                    <label class="custom-file-label" for="file">{{__('choose file')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="url">{{__('url')}}</label>
                                <input name="url" type="text" class="form-control" id="url"
                                       placeholder="{{__('Enter url')}}">
                            </div>


                            <button type="submit" class="btn btn-primary">{{__('save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
