@extends('layouts.admin_panel')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">{{ __('new page') }}</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form enctype="multipart/form-data" action="{{Route('admin.pages.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <select name="name" class="custom-select" id="name" >
                                    <option value="privacy">{{__('privacy')}}</option>
                                    <option value="about">{{__('about')}}</option>
                                    <option value="terms">{{__('terms')}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="content">Example textarea</label>
                                <textarea class="form-control" id="content" name="content" rows="10"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="{{ asset('js/pages/pages.js') }}"></script>

@endsection
