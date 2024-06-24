<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Dashrock</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class="bx bx-arrow-back"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-home-alt"></i>
                </div>
                <div class="menu-title">{{ __('Dashboard') }}</div>
            </a>
            <ul>
                @foreach (auth()->user()->roles->pluck('name')->toArray() as $role)
                    @if ($role === 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}"><i
                                    class="bx bx-radio-circle"></i>{{ __('Stats') }}</a>
                        </li>
                    @endif
                    @if ($role === 'client')
                        <li>
                            <a href="{{ route('client.dashboard') }}"><i
                                    class="bx bx-radio-circle"></i>{{ __('Your Stats') }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
        @if (auth()->user()->roles->contains('name', 'admin'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">{{ __('Admin') }}</div>
                </a>
                <ul>
                    <li>
                        <a href="javascript:;" class="has-arrow">

                            <div class="parent-icon"><i class="bx bx-user-circle"></i>
                            </div>
                            <div class="menu-title">{{ __('Users') }}</div>
                        </a>
                        <ul>
                            <li> <a href="{{ route('users') }}"><i
                                        class="bx bx-radio-circle"></i>{{ __('All users') }}</a>
                            </li>
                            <li> <a href="{{ route('manage.roles') }}"><i
                                        class="bx bx-radio-circle"></i>{{ __('Manage Roles') }}</a>
                            </li>
                            <li> <a href="{{ route('clients') }}"><i
                                        class="bx bx-radio-circle"></i>{{ __('Clients') }}</a>
                            </li>
                            <li> <a href="{{ route('users.create') }}"><i
                                        class="bx bx-radio-circle"></i>{{ __('Add user') }}</a>
                            </li>
                            <li> <a href="{{ route('mechanics') }}"><i
                                        class="bx bx-radio-circle"></i>{{ __('Mechanics') }}</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"> <i class="lni lni-car-alt"></i>
                            </div>
                            <div class="menu-title">{{ __('Vehicles') }}</div>
                        </a>
                        <ul>
                            <li> <a href="{{ route('vehicles') }}"><i
                                        class="bx bx-radio-circle"></i>{{ __('Vehicles') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-category"></i>
                            </div>
                            <div class="menu-title">{{ __('Spare Parts') }}</div>
                        </a>
                        <ul>
                            <li> <a href="{{ route('spare-parts') }}"><i
                                        class="bx bx-radio-circle"></i>{{ __('Spare parts') }}</a>
                            </li>
                            <li> <a href="{{ route('spare-parts.create') }}"><i
                                        class="bx bx-radio-circle"></i>{{ __('Add Part') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-receipt"></i></div>
                            <div class="menu-title">{{ __('Invoices') }}</div>
                        </a>
                        <ul>
                            <li><a href="{{ route('invoices') }}"><i class="bx bx-radio-circle"></i>
                                    {{ __('Invoices') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-wrench bx-sm"></i></div>
                            <div class="menu-title">{{ __('Repairs') }}</div>
                        </a>
                        <ul>
                            <li><a href="{{ route('repairs') }}"><i class="bx bx-radio-circle"></i>
                                    {{ __('Repairs') }}</a>
                            </li>
                            <li><a href="{{ route('repairs.create') }}"><i class="bx bx-radio-circle"></i>
                                    {{ __('Add Repair') }}</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bxs-calendar-check bx-sm"></i></div>
                            <div class="menu-title">{{ __('Appointments') }}</div>
                        </a>
                        <ul>
                            <li><a href="{{ route('appointments') }}"><i class="bx bx-radio-circle"></i>
                                    {{ __('Appointments') }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->user()->roles->contains('name', 'client'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">{{ __('Client') }}</div>
                </a>
                <ul>
                    <li>
                        <a href="javascript:;" class="has-arrow">

                            <div class="parent-icon"><i class="bx bx-user-circle"></i>
                            </div>
                            <div class="menu-title">{{ __('Your Vehicles') }}</div>
                        </a>
                        <ul>
                            <li> <a href="{{ route('client.vehicles') }}"><i
                                        class="bx bx-radio-circle"></i>{{ __('All Your Vehicles') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-wrench bx-sm"></i></div>
                            <div class="menu-title">{{ __('Your Repairs') }}</div>
                        </a>
                        <ul>
                            <li><a href="{{ route('client.repairs') }}"><i class="bx bx-radio-circle"></i>
                                    {{ __('Repairs') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bxs-calendar-check bx-sm"></i></div>
                            <div class="menu-title">{{ __(' Your Appointments') }}</div>
                        </a>
                        <ul>
                            <li><a href="{{ route('client.appointments') }}"><i class="bx bx-radio-circle"></i>
                                    {{ __('Your Appointments') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-receipt"></i></div>
                            <div class="menu-title">{{ __(' Your Invoives') }}</div>
                        </a>
                        <ul>
                            <li><a href="/client/invoices"><i class="bx bx-radio-circle"></i>
                                    {{ __('Your Invoices') }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->user()->roles->contains('name', 'mechanic'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-wrench bx-sm"></i>
                    </div>
                    <div class="menu-title">{{ __('Mechanic') }}</div>
                </a>
                <ul>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-wrench bx-sm"></i></div>
                            <div class="menu-title">{{ __('Repairs to do') }}</div>
                        </a>
                        <ul>
                            <li><a href="{{ route('mechanic.for.repairs') }}"><i class="bx bx-radio-circle"></i>
                                    {{ __('Repairs') }}</a>
                            </li>
                            <li><a href="{{ route('mechanic.repairs.create') }}"><i class="bx bx-radio-circle"></i>
                                    {{ __('New repair') }}</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-wrench bx-sm"></i></div>
                            <div class="menu-title">{{ __('Vehicles to repair') }}</div>
                        </a>
                        <ul>
                            <li><a href="{{ route('mechanic.for.vehicles') }}"><i class="bx bx-radio-circle"></i>
                                    {{ __('Vehicles') }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
    <!--end navigation-->
</div>
