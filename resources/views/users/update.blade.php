@extends('layouts.admin_panel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">{{ __('update user') }} : {{$user->name}}</span>
                    </div>

                    <div class="card-body">
                        @include('.includes.status')

                        <form enctype="multipart/form-data" action="{{Route('admin.users.update' , $user)}}"
                              method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input name="name" type="text" value="{{$user->name}}" class="form-control" id="name"
                                       placeholder="{{__('Enter Name')}}">
                            </div>
                            <div class="form-group">
                                <label for="points">{{__('Points')}}</label>
                                <input name="points" type="text" value="{{$user->points}}" class="form-control"
                                       id="points" placeholder="{{__('Enter Points')}}">
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('Photo')}}</label>
                                <div class="custom-file">
                                    <input type="file" name="photo" class="custom-file-input" id="photo">
                                    <label class="custom-file-label" for="photo">{{__('choose photo')}}</label>
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
