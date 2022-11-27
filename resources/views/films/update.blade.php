@extends('layouts.admin_panel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">{{ __('update item') }} : {{$item->name}}</span>
                    </div>

                    <div class="card-body">

                        @include('.includes.status')

                        <form enctype="multipart/form-data" action="{{Route('admin.items.update' , $item)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="description">{{__('Description')}}</label>
                                <textarea name="desc" type="text" class="form-control" rows="5" id="description" placeholder="{{__('Enter Description')}}" >
                                    {{$item->desc}}
                                </textarea>
                            </div>

                            <div class="form-check-inline my-3">
                                <input name="sponsored" type="checkbox" class="form-check-input" @if($item->sponsored == 1) checked @endif id="sponsored" >
                                <label class="form-check-label" for="sponsored">{{__('Sponsored')}}</label>
                            </div>

                            <div class="form-group">
                                <label for="sponsored_index">{{__('Sponsored index')}}</label>
                                <input name="sponsored_index" type="number" class="form-control" value="{{$item->sponsored_index}}" id="sponsored_index" placeholder="{{__('Enter sponsored index')}}" >
                            </div>


                            <div class="form-group">
                                <label for="phone">{{__('Phone')}}</label>
                                <input name="phone" type="text" class="form-control" id="phone"
                                       placeholder="{{__('Enter Phone')}}" value="{{$item->phone}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('Email')}}</label>
                                <input name="email" type="email" class="form-control" id="email"
                                       placeholder="{{__('Enter Email')}}" value="{{$item->email}}">
                            </div>

                            <div class="form-group">
                                <label for="name">{{__('Category')}}</label>
                                <select class="custom-select" name="category">
                                    <option selected>Open this select menu</option>
                                    @foreach($categories as $category)
                                        @foreach($category->subcategories as $subcategory)
                                            @foreach($subcategory->subsubcategories as $subsubcategory)
                                                @if($item->category_id == $category->id && $item->subcategory_id == $subcategory->id && $item->subsubcategory_id == $subsubcategory->id)
                                                    <option selected value="{{$category->id}}:{{$subcategory->id}}:{{$subsubcategory->id}}">{{$category->name}} > {{$subcategory->name}} > {{$subsubcategory->name}}</option>
                                                @else
                                                    <option value="{{$category->id}}:{{$subcategory->id}}:{{$subsubcategory->id}}">{{$category->name}} > {{$subcategory->name}} > {{$subsubcategory->name}}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('Image')}}</label>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">{{__('choose image')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image1">{{__('Image 1')}}</label>
                                <div class="custom-file">
                                    <input type="file" name="image1" class="custom-file-input" id="image1">
                                    <label class="custom-file-label" for="image1">{{__('choose image 1')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image2">{{__('Image 2')}}</label>
                                <div class="custom-file">
                                    <input type="file" name="image2" class="custom-file-input" id="image2">
                                    <label class="custom-file-label" for="image2">{{__('choose image 2')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image3">{{__('Image 3')}}</label>
                                <div class="custom-file">
                                    <input type="file" name="image3" class="custom-file-input" id="image3">
                                    <label class="custom-file-label" for="image3">{{__('choose image 3')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image4">{{__('Image 4')}}</label>
                                <div class="custom-file">
                                    <input type="file" name="image4" class="custom-file-input" id="image4">
                                    <label class="custom-file-label" for="image4">{{__('choose image 4')}}</label>
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
