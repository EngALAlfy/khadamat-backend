@extends('layouts.admin_panel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">{{ __('items') }}</span>
                        <span class="float-right">
                            <a class="btn btn-success" href="{{Route('admin.items.create')}}"><i
                                    class="fa fa-plus"></i></a>
                        </span>
                    </div>

                    <div class="card-body">
                        @include('.includes.status')

                        <table id="table" data-toggle="table" data-show-columns="true"
                               data-search="true"
                               data-show-columns-toggle-all="true" data-data="{{json_encode($items->items())}}" data-detail-view="true"
                               data-detail-formatter="imagesFormat">
                            <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="desc" data-formatter="widthFormat">Desc</th>
                                <th data-field="image" data-formatter="imageFormat">Image</th>
                                <th data-field="category" data-formatter="categoryFormat">Category</th>
                                <th data-field="subcategory" data-formatter="subcategoryFormat">SubCategory</th>
                                <th data-field="subsubcategory" data-formatter="subsubcategoryFormat">SubSubCategory</th>
                                <th data-field="views">views</th>
                                <th data-field="sponsored">sponsored</th>
                                <th data-field="sponsored_index" data-sortable="true">sponsored index</th>
                                <th data-field="email" data-sortable="true">Email</th>
                                <th data-field="phone" data-sortable="true">Phone</th>
                                <th data-field="created_user" data-formatter="createdByFormat">Created By</th>
                                <th data-field="created_at" >Created At</th>
                                <th data-field="actions" data-formatter="actionsFormat">Actions</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/pages/items.js') }}"></script>

@endsection

