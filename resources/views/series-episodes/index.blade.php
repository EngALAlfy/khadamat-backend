@extends('layouts.admin_panel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">{{ $series->name }}</span>
                        <span class="float-right">
                            <a class="btn btn-success" href="{{Route('admin.series-episodes.create' , $series->id)}}"><i
                                    class="fa fa-plus"></i></a>
                        </span>
                    </div>

                    <div class="card-body">
                        @include('.includes.status')

                        <table id="table" data-toggle="table" data-show-columns="true"
                               data-search="true"
                               data-show-columns-toggle-all="true" data-data="{{$episodes}}" >
                            <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="order">order</th>
                                <th data-field="name">name</th>
                                <th data-field="desc" data-formatter="widthFormat">Desc</th>
                                <th data-field="image" data-formatter="imageFormat">Image</th>
                                <th data-field="file" data-formatter="videoFormat">file</th>
                                <th data-field="url">url</th>
                                <th data-field="views">views</th>
                                <th data-field="created_user" data-formatter="createdByFormat">Created By</th>
                                <th data-field="created_at" >Created At</th>
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
    <script src="{{ asset('js/pages/series-episodes.js') }}"></script>

@endsection

