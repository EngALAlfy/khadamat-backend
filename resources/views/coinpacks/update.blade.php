@extends('layouts.admin_panel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">{{ __('update coin pack') }} : {{$coinPack->name}}</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form enctype="multipart/form-data" action="{{Route('admin.coinpacks.update' , $coinPack)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input name="name" type="text" value="{{$coinPack->name}}" class="form-control" id="name" placeholder="{{__('Enter Name')}}" >
                            </div>
                            <div class="form-group">
                                <label for="count">{{__('Count')}}</label>
                                <input name="count" min="0" type="number" value="{{$coinPack->count}}"  class="form-control" id="count"
                                       placeholder="{{__('Enter Count')}}">
                            </div>
                            <div class="form-group">
                                <label for="price">{{__('Price')}}</label>
                                <input name="price" min="0" type="number" step="0.01" value="{{$coinPack->price}}"  class="form-control" id="price"
                                       placeholder="{{__('Enter Price')}}">
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