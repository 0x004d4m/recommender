{{-- This file is used for menu items by any Backpack v6 theme --}}
@if(backpack_user()->hasAnyRole(implode('|', \App\Models\Role::get()->pluck('name')->toArray())))
@else
    <script>
        window.location = '{{url('/admin/logout')}}';
    </script>
@endif
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

@if(backpack_user()->can('Manage Posts'))
    <x-backpack::menu-item title="Posts" icon="la la-question" :link="backpack_url('post')" />
@endif
@if(backpack_user()->can('Manage Roles') || backpack_user()->can('Manage Users'))
<x-backpack::menu-dropdown title="Add-ons" icon="la la-puzzle-piece">
    <x-backpack::menu-dropdown-header title="Authentication" />
        @if(backpack_user()->can('Manage Users'))
            <x-backpack::menu-dropdown-item title="Users" icon="la la-user" :link="backpack_url('user')" />
        @endif
        @if(backpack_user()->can('Manage Roles'))
            <x-backpack::menu-dropdown-item title="Roles" icon="la la-group" :link="backpack_url('role')" />
            <x-backpack::menu-dropdown-item title="Permissions" icon="la la-key" :link="backpack_url('permission')" />
        @endif
    </x-backpack::menu-dropdown>
@endif


