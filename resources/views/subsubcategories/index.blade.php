@extends('layouts.admin_panel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">{{ __('subcategories') }}</span>
                        <span class="float-right">
                            <a class="btn btn-success" href="{{Route('admin.subsubcategories.create')}}"><i
                                    class="fa fa-plus"></i></a>
                        </span>
                    </div>

                    <div class="card-body">

                        @include('.includes.status')

                            <table id="table" data-show-columns="true"
                                   data-search="true"
                                   data-show-columns-toggle-all="true" data-toggle="table" data-data="{{$subsubcategories}}">
                                <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th data-field="name" data-sortable="true">Name</th>
                                    <th data-field="image" data-formatter="imageFormat">Image</th>
                                    <th data-field="category" data-formatter="categoryFormat">Category</th>
                                    <th data-field="sub_category" data-formatter="subcategoryFormat">Sub Category</th>
                                    <th data-field="created_user" data-formatter="createdByFormat">Created By</th>
                                    <th data-field="actions" data-formatter="actionsFormat">Actions</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/pages/subsubcategories.js') }}"></script>

@endsection

