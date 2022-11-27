@extends('layouts.admin_panel')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body row justify-content-around">
                        @include('.includes.status')

                        <div class="card col-3 p-0 m-3 border-primary">
                            <div class="card-header bg-primary text-light">{{ __('All Items') }}</div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><b class="text-primary">{{ $allItemsCount }}</b> Item</h4>
                            </div>
                        </div>
                        <div class="card col-3 p-0 m-3 border-warning">
                            <div class="card-header bg-warning">{{ __('Sponsored Items') }}</div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><b class="text-primary">{{ $sponsoredItemsCount }}</b> Item</h4>
                            </div>
                        </div>
                        <div class="card col-3 p-0 m-3 border-info">
                            <div class="card-header bg-info text-light">{{ __('UnSponsored Items') }}</div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><b class="text-primary">{{ $unSponsoredItemsCount }}</b> Item</h4>
                            </div>
                        </div>
                        <div class="card col-3 p-0 m-3 border-dark">
                            <div class="card-header bg-dark text-light">{{ __('Categories') }}</div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><b class="text-primary">{{ $categoriesCount }}</b> {{__('category')}}</h4>
                            </div>
                        </div>
                        <div class="card col-3 p-0 m-3 border-info">
                            <div class="card-header bg-info text-light">{{ __('Sub Categories') }}</div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><b class="text-primary">{{ $subCategoriesCount }}</b> {{__('sub category')}}</h4>
                            </div>
                        </div>
                        <div class="card col-3 p-0 m-3 border-secondary">
                            <div class="card-header bg-secondary text-light">{{ __('Sub Sub Categories') }}</div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><b class="text-primary">{{ $subSubCategoriesCount }}</b> {{__('sub sub category')}}</h4>
                            </div>
                        </div>
                        <div class="card col-3 p-0 m-3 border-success">
                            <div class="card-header bg-success text-light">{{ __('Users') }}</div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><b class="text-primary">{{ $usersCount }}</b> {{__('user')}}</h4>
                            </div>
                        </div>
                        <div class="card col-3 p-0 m-3 border-warning">
                            <div class="card-header bg-warning">{{ __('Banned Users') }}</div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><b class="text-primary">{{ $bannedUsersCount }}</b> {{__('user')}}</h4>
                            </div>
                        </div>
                        <div class="card col-3 p-0 m-3 border-danger">
                            <div class="card-header bg-danger text-light">{{ __('Admins') }}</div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><b class="text-primary">{{ $adminsCount }}</b> {{__('admin')}}</h4>
                            </div>
                        </div>
                        <div class="card col-3 p-0 m-3 border-secondary">
                            <div class="card-header bg-secondary text-light">{{ __('Banned Admins') }}</div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><b class="text-primary">{{ $bannedAdminsCount }}</b> {{__('admin')}}</h4>
                            </div>
                        </div>
                        <div class="card col-3 p-0 m-3 ">
                            <div class="card-header">{{ __('Pages') }}</div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><b class="text-primary">{{ $pagesCount }}</b> {{__('page')}}</h4>
                            </div>
                        </div>
                        <div class="card col-3 p-0 m-3 border-warning">
                            <div class="card-header bg-warning">{{ __('Coin Packs') }}</div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><b class="text-primary">{{ $coinPacksCount }}</b> {{__('pack')}}</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
