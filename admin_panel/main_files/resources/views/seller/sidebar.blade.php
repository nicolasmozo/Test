@php
    use App\Constants\Status;
    use App\Models\Setting;
    $payOutType = Setting::first();
    $isActive = $payOutType->payout_type == Status::SUBSCRIPTION_BASED;
@endphp


<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('seller.dashboard') }}">{{ $setting->sidebar_lg_header }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('seller.dashboard') }}">{{ $setting->sidebar_sm_header }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Route::is('seller.dashboard') ? 'active' : '' }}"><a class="nav-link"
                                                                               href="{{ route('seller.dashboard') }}"><i
                        class="fas fa-home"></i> <span>{{__('admin.Dashboard')}}</span></a></li>

            <li class="nav-item dropdown {{ Route::is('seller.all-booking') || Route::is('seller.order-show') || Route::is('seller.pending-order') || Route::is('seller.complete-order') || Route::is('seller.complete-request') || Route::is('seller.completed-booking') || Route::is('seller.declined-booking')  ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-shopping-cart"></i><span>{{__('admin.All Orders')}}</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ Route::is('seller.all-booking') || Route::is('seller.order-show') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('seller.all-booking') }}">{{__('admin.Order Items')}}</a>
                    </li>

                    <li class="{{ Route::is('seller.pending-order') ? 'active' : '' }}"><a class="nav-link"
                                                                                           href="{{ route('seller.pending-order') }}">{{__('admin.Pending Items')}}</a>
                    </li>

                    <li class="{{ Route::is('seller.complete-order') ? 'active' : '' }}"><a class="nav-link"
                                                                                            href="{{ route('seller.complete-order') }}">{{__('admin.Complete Items')}}</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown {{ menuActive(['seller.product.*','seller.active.product', 'seller.pending.product','seller.product-variant','seller.product.create','seller.product-review.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-th-large"></i><span>{{__('admin.Manage Product')}}</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ menuActive('seller.product.create')}}">
                        <a class="nav-link" href="{{ route('seller.product.create') }}">{{__('admin.Create Product')}}</a>
                    </li>

                    <li class="{{ (Route::is('seller.product.*') && !Route::is('seller.product.create')) || Route::is('seller.product-variant') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('seller.product.index') }}">{{__('admin.All Product')}}</a>
                    </li>

                    <li class="{{ menuActive('seller.active.product') }}"><a class="nav-link"
                                                                                            href="{{ route('seller.active.product') }}">{{__('admin.Active Product')}}</a>
                    </li>

                    <li class="{{ menuActive('seller.pending.product') }}"><a class="nav-link"
                                                                                             href="{{ route('seller.pending.product') }}">{{__('admin.Pending Product')}}</a>
                    </li>
                </ul>
            </li>


            @if($isActive)
                <li class="{{ menuActive('seller.purchase-plan') }}">
                    <a class="nav-link" href="{{ route('seller.purchase-plan') }}">
                        <i class="fas fa-dollar-sign"></i>
                        <span>{{__('admin.Purchase Plan')}}</span>
                    </a>
                </li>
                <li class="{{ menuActive('seller.purchase-history') }}">
                    <a class="nav-link" href="{{ route('seller.purchase-history') }}">
                        <i class="fas fa-th"></i>
                        <span>{{__('admin.Purchase History')}}</span>
                    </a>
                </li>
            @endif

            <li class="{{ menuActive(['seller.my-withdraw.index', 'seller.my-withdraw.show']) }}"><a class="nav-link"
                                                                                       href="{{ route('seller.my-withdraw.index') }}"><i
                        class="far fa-newspaper"></i> <span>{{__('admin.My Withdraw')}}</span></a></li>

            @if (checkModule('SupportTicket'))
                @include('supportticket::seller.sideber')
            @endif

            @if (checkModule('KYC'))
                <li class="{{ Route::is('seller.kyc') ? 'active' : '' }}"><a class="nav-link"
                                                                             href="{{ route('seller.kyc') }}"><i
                            class="fas fa-certificate"></i> <span>{{__('admin.KYC Verifaction')}}</span></a></li>
            @endif
        </ul>

    </aside>
</div>
