@extends('layouts.admin_panel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">{{ __('users') }}</span>

                    </div>

                    <div class="card-body">
                        @include('.includes.status')

                        <table id="table"
                               class="table"
                               data-toggle="table"
                               data-data="{{json_encode($users->items())}}"
                               data-show-columns="true"
                               data-search="true"
                               data-show-columns-toggle-all="true">
                            <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name" data-sortable="true">Name</th>
                                <th data-field="username" data-visible="false" data-sortable="true">Username</th>
                                <th data-field="email" data-visible="false" data-sortable="true">Email</th>
                                <th data-field="phone" data-sortable="true">phone</th>
                                <th data-field="points" data-sortable="true">points</th>
                                <th data-field="method" data-visible="false" data-sortable="true">method</th>
                                <th data-field="role" data-sortable="true">role</th>
                                <th data-field="banned" data-sortable="true">banned</th>
                                <th data-field="photo" data-formatter="userImageFormat">photo</th>
                                <th data-field="actions" data-formatter="actionsFormat">Actions</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/pages/users.js') }}"></script>

@endsection

