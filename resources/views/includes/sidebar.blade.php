<div class="col-2 border-right px-0">

    <style>
        .sidebar .nav-item:hover, .active {
            background-color: #2d3748;
        }

        .sidebar .nav-item:hover > .nav-link, .active > .nav-link {
            color: white !important;
        }

        .active:hover > .nav-link {
            color: #1d68a7 !important;
        }

    </style>

    <div class="row py-3 px-2">
        <img class="col-4 img-fluid" width="100" height="100" onerror="this.src='/images/user.png'"
             src="/uploads/image/{{ auth()->user()->photo }}">
        <div class="col-8 row px-0">
            <div class="col-12">{{auth()->user()->name}}</div>
            <div class="col-12 text-muted">{{auth()->user()->email}}</div>
        </div>
    </div>


    <ul class="navbar-nav sidebar">

        @if(Route::has('admin.home'))
            <li class="nav-item border-bottom border-top @if(Route::currentRouteName() == 'admin.home') active @endif pl-4 py-2">
                <a href="{{Route('admin.home')}}"
                   class="nav-link text-capitalize text-muted"><i class="fa fa-home"></i> {{__('home')}}</a>
            </li>
        @endif

        @if(Route::has('admin.items.index'))
            <li class="nav-item border-bottom @if(Route::currentRouteName() == 'admin.items.index') active @endif pl-4 py-2">
                <a href="{{Route('admin.items.index')}}"
                   class="nav-link text-capitalize text-muted"><i class="fa fa-list-ul"></i> {{__('items')}}</a>
            </li>
        @endif

        @if(Route::has('admin.categories.index'))
            <li class="nav-item border-bottom @if(Route::currentRouteName() == 'admin.categories.index') active @endif pl-4 py-2">
                <a href="{{Route('admin.categories.index')}}"
                   class="nav-link text-capitalize text-muted"><i class="fa fa-list-ol"></i> {{__('categories')}}</a>
            </li>
        @endif
        @if(Route::has('admin.subcategories.index'))
            <li class="nav-item border-bottom @if(Route::currentRouteName() == 'admin.subcategories.index') active @endif pl-4 py-2">
                <a href="{{Route('admin.subcategories.index')}}"
                   class="nav-link text-capitalize text-muted"><i class="fa fa-list-alt"></i> {{__('sub categories')}}
                </a>
            </li>
        @endif
        @if(Route::has('admin.subsubcategories.index'))
            <li class="nav-item border-bottom @if(Route::currentRouteName() == 'admin.subsubcategories.index') active @endif pl-4 py-2">
                <a href="{{Route('admin.subsubcategories.index')}}"
                   class="nav-link text-capitalize text-muted"><i class="fa fa-list"></i> {{__('sub sub categories')}}
                </a>
            </li>
        @endif

            @if(Route::has('admin.film-categories.index'))
                <li class="nav-item border-bottom @if(Route::currentRouteName() == 'admin.film-categories.index') active @endif pl-4 py-2">
                    <a href="{{Route('admin.film-categories.index')}}"
                       class="nav-link text-capitalize text-muted"><i class="fa fa-list"></i> {{__('film categories')}}
                    </a>
                </li>
            @endif

            @if(Route::has('admin.films.index'))
                <li class="nav-item border-bottom @if(Route::currentRouteName() == 'admin.films.index') active @endif pl-4 py-2">
                    <a href="{{Route('admin.films.index')}}"
                       class="nav-link text-capitalize text-muted"><i class="fa fa-list"></i> {{__('films')}}
                    </a>
                </li>
            @endif

            @if(Route::has('admin.series-categories.index'))
                <li class="nav-item border-bottom @if(Route::currentRouteName() == 'admin.series-categories.index') active @endif pl-4 py-2">
                    <a href="{{Route('admin.series-categories.index')}}"
                       class="nav-link text-capitalize text-muted"><i class="fa fa-list"></i> {{__('series categories')}}
                    </a>
                </li>
            @endif

            @if(Route::has('admin.series.index'))
                <li class="nav-item border-bottom @if(Route::currentRouteName() == 'admin.series.index') active @endif pl-4 py-2">
                    <a href="{{Route('admin.series.index')}}"
                       class="nav-link text-capitalize text-muted"><i class="fa fa-list"></i> {{__('series')}}
                    </a>
                </li>
            @endif

        @if(Route::has('admin.users.index'))
            <li class="nav-item border-bottom @if(Route::currentRouteName() == 'admin.users.index') active @endif pl-4 py-2">
                <a href="{{Route('admin.users.index')}}"
                   class="nav-link text-capitalize text-muted"><i class="fa fa-users"></i> {{__('users')}}</a>
            </li>
        @endif
        @if(Route::has('admin.pages.index'))
            <li class="nav-item border-bottom @if(Route::currentRouteName() == 'admin.pages.index') active @endif pl-4 py-2">
                <a href="{{Route('admin.pages.index')}}"
                   class="nav-link text-capitalize text-muted"><i class="fab fa-html5"></i> {{__('pages')}}</a>
            </li>
        @endif
        @if(Route::has('admin.coinpacks.index'))
            <li class="nav-item border-bottom @if(Route::currentRouteName() == 'admin.coinpacks.index') active @endif pl-4 py-2">
                <a href="{{Route('admin.coinpacks.index')}}"
                   class="nav-link text-capitalize text-muted"><i class="fa fa-coins"></i> {{__('coinpacks')}}</a>
            </li>
        @endif
    </ul>

    <div class="col-12 py-2 px-2 text-center border-top border-dark" >
        <h5 class="text-center">Version 1.0.1</h5>
    </div>

</div>
