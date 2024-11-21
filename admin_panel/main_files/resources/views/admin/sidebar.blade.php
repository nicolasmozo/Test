@php
    $setting = App\Models\Setting::first();
@endphp


<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ $setting->sidebar_lg_header }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">{{ $setting->sidebar_lg_header }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a class="nav-link"
                                                                              href="{{ route('admin.dashboard') }}"><i
                        class="fas fa-home"></i> <span>{{__('admin.Dashboard')}}</span></a></li>

            <li class="nav-item dropdown {{ Route::is('admin.all-booking') || Route::is('admin.order-show') || Route::is('admin.pending-order') || Route::is('admin.complete-order') || Route::is('admin.complete-request') || Route::is('admin.completed-booking') || Route::is('admin.declined-booking')  ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-shopping-cart"></i><span>{{__('admin.All Orders')}}</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.all-booking') || Route::is('admin.order-show') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('admin.all-booking') }}">{{__('admin.All Orders')}}</a></li>

                    <li class="{{ Route::is('admin.pending-order') ? 'active' : '' }}"><a class="nav-link"
                                                                                          href="{{ route('admin.pending-order') }}">{{__('admin.Pending Orders')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.complete-order') ? 'active' : '' }}"><a class="nav-link"
                                                                                           href="{{ route('admin.complete-order') }}">{{__('admin.Complete Orders')}}</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown {{ menuActive(['admin.pricing-plan.index', 'admin.purchase-list']) }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-tag"></i><span>{{__('admin.Pricing Plan')}}</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ menuActive('admin.pricing-plan.index') }}"><a
                            class="nav-link"
                            href="{{ route('admin.pricing-plan.index') }}">{{__('admin.Plans')}}</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ menuActive('admin.purchase-list') }}"><a
                            class="nav-link"
                            href="{{ route('admin.purchase-list') }}">{{__('admin.Purchase List')}}</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Route::is('admin.product.*') || Route::is('admin.active.product') || Route::is('admin.pending.product') || Route::is('admin.product-variant') || Route::is('admin.product.create') || Route::is('admin.product-review.*') || Route::is('admin.product-type-page.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-th-large"></i><span>{{__('admin.Manage Product')}}</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.product.create') ? 'active' : '' }}"><a class="nav-link"
                                                                                           href="{{ route('admin.product.create') }}">{{__('admin.Create Product')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.product.*') || Route::is('admin.product-variant') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.product.index') }}">{{__('admin.All Product')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.active.product') ? 'active' : '' }}"><a class="nav-link"
                                                                                           href="{{ route('admin.active.product') }}">{{__('admin.Active Product')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.pending.product') ? 'active' : '' }}"><a class="nav-link"
                                                                                            href="{{ route('admin.pending.product') }}">{{__('admin.Pending Product')}}</a>
                    </li>


                    <li class="{{ Route::is('admin.product-review.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                             href="{{ route('admin.product-review.index') }}">{{__('admin.Review')}}</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown {{ Route::is('admin.category.*') || Route::is('admin.assign-home-category') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-th-large"></i><span>{{__('admin.Manage Category')}}</span></a>

                <ul class="dropdown-menu">

                    <li class="{{ Route::is('admin.category.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                       href="{{ route('admin.category.index') }}">{{__('admin.Category List')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.assign-home-category') ? 'active' : '' }}"><a class="nav-link"
                                                                                                 href="{{ route('admin.assign-home-category') }}">{{__('admin.Homepage Category')}}</a>
                    </li>

                </ul>
            </li>


            <li class="nav-item dropdown {{  Route::is('admin.provider') || Route::is('admin.seller-requests') || Route::is('admin.seller-request') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-users"></i><span>{{__('admin.Manage Seller')}}</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ Route::is('admin.provider') ? 'active' : '' }}"><a class="nav-link"
                                                                                     href="{{ route('admin.provider') }}">{{__('admin.Seller List')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.seller-requests') || Route::is('admin.seller-request') ? 'active' : '' }}">
                        <a class="nav-link"
                           href="{{ route('admin.seller-requests') }}">{{__('admin.Seller Request')}}</a></li>

                </ul>
            </li>


            <li class="nav-item dropdown {{  Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.pending-customer-list') || Route::is('admin.send-email-to-all-customer') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>{{__('admin.Users')}}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.send-email-to-all-customer') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.customer-list') }}">{{__('admin.User List')}}</a></li>

                    <li class="{{ Route::is('admin.pending-customer-list') ? 'active' : '' }}"><a class="nav-link"
                                                                                                  href="{{ route('admin.pending-customer-list') }}">{{__('admin.Pending User')}}</a>
                    </li>
                </ul>
            </li>

            @if (checkModule('KYC'))
                @include('kyc::admin.sideber')
            @endif

            @if (checkModule('SupportTicket'))
                @include('supportticket::admin.sideber')
            @endif


            <li class="nav-item dropdown {{ Route::is('admin.withdraw-method.*') || Route::is('admin.provider-withdraw') || Route::is('admin.pending-provider-withdraw') || Route::is('admin.rejectedProviderWithdraw') || Route::is('admin.show-provider-withdraw')  ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="far fa-newspaper"></i><span>{{__('admin.Withdraw Payment')}}
                        @if($pendingWithdrawCounter > 0)
                            <sup class="badge badge-danger">{{ $pendingWithdrawCounter }}</sup>
                        @endif
                    </span></a>

                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.withdraw-method.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                              href="{{ route('admin.withdraw-method.index') }}">{{__('admin.Withdraw Method')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.provider-withdraw') || Route::is('admin.show-provider-withdraw') ? 'active' : '' }}">
                        <a class="nav-link"
                           href="{{ route('admin.provider-withdraw') }}">{{__('admin.Seller Withdraw')}}</a></li>

                    <li class="{{ menuActive('admin.pending-provider-withdraw') }}">
                        <a class="nav-link" href="{{ route('admin.pending-provider-withdraw') }}">{{__('admin.Withdraw Request')}}
                            @if($pendingWithdrawCounter > 0)
                                <sup class="badge badge-danger">{{ $pendingWithdrawCounter }}</sup>
                            @endif
                        </a>
                    </li>

                    <li class="{{ menuActive('admin.rejectedProviderWithdraw') }}">
                        <a class="nav-link"
                           href="{{ route('admin.rejectedProviderWithdraw') }}">{{__('admin.Rejected Request')}}</a>
                    </li>

                </ul>
            </li>


            <li class="nav-item dropdown {{ Route::is('admin.maintainance-mode') || Route::is('admin.seo-setup') || Route::is('admin.default-avatar') ||  Route::is('admin.testimonial.*') || Route::is('admin.partner.*') || Route::is('admin.counter') || Route::is('admin.ad') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-globe"></i><span>{{__('admin.Manage Website')}}</span></a>

                <ul class="dropdown-menu">

                    <li class="{{ Route::is('admin.partner.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                      href="{{ route('admin.partner.index') }}">{{__('admin.Slider')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.testimonial.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                          href="{{ route('admin.testimonial.index') }}">{{__('admin.Testimonial')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.counter') ? 'active' : '' }}"><a class="nav-link"
                                                                                    href="{{ route('admin.counter', ['lang_code' => 'en']) }}">{{__('admin.Counter')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.ad') ? 'active' : '' }}"><a class="nav-link"
                                                                               href="{{ route('admin.ad') }}">{{__('admin.Ads Banner')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.seo-setup') ? 'active' : '' }}"><a class="nav-link"
                                                                                      href="{{ route('admin.seo-setup') }}">{{__('admin.SEO Setup')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.maintainance-mode') ? 'active' : '' }}"><a class="nav-link"
                                                                                              href="{{ route('admin.maintainance-mode') }}">{{__('admin.Maintainance Mode')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.default-avatar') ? 'active' : '' }}"><a class="nav-link"
                                                                                           href="{{ route('admin.default-avatar') }}">{{__('admin.Default Avatar')}}</a>
                    </li>

                </ul>
            </li>


            <li class="nav-item dropdown {{ Route::is('admin.footer.*') || Route::is('admin.social-link.*') || Route::is('admin.footer-link.*') || Route::is('admin.second-col-footer-link') || Route::is('admin.third-col-footer-link') || Route::is('admin.header-info') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-th-large"></i><span>{{__('admin.Header & Footer')}}</span></a>

                <ul class="dropdown-menu">

                    <li class="{{ Route::is('admin.header-info') ? 'active' : '' }}"><a class="nav-link"
                                                                                        href="{{ route('admin.header-info') }}">{{__('admin.Header Info')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.social-link.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                          href="{{ route('admin.social-link.index') }}">{{__('admin.Social Link')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.footer.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                     href="{{ route('admin.footer.index', ['lang_code' => 'en']) }}">{{__('admin.Footer')}}</a>
                    </li>

                </ul>
            </li>


            <li class="{{ Route::is('admin.payment-method') ? 'active' : '' }}"><a class="nav-link"
                                                                                   href="{{ route('admin.payment-method') }}"><i
                        class="fas fa-dollar-sign"></i> <span>{{__('admin.Payment Method')}}</span></a></li>

            @php
                $json_module_data = file_get_contents(base_path('modules_statuses.json'));
                $module_status = json_decode($json_module_data);

            @endphp

            @if ($module_status->PaymentGateway)

                <li class="{{ Route::is('admin.payment-addon') ? 'active' : '' }}"><a class="nav-link"
                                                                                      href="{{ route('admin.payment-addon') }}"><i
                            class="fas fa-dollar-sign"></i> <span>{{__('admin.Gateway')}}<span
                                class="badge badge-danger addon_text">{{__('admin.addon')}}</span></span></a></li>

            @endif


            <li class="nav-item dropdown {{ Route::is('admin.faq.*') || Route::is('admin.about-us.*') || Route::is('admin.terms-and-condition.*') || Route::is('admin.privacy-policy.*') || Route::is('admin.faq.*') || Route::is('admin.contact-us.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-columns"></i><span>{{__('admin.Pages')}}</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.about-us.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                       href="{{ route('admin.about-us.index', ['lang_code' => 'en']) }}">{{__('admin.About Us')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.contact-us.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                         href="{{ route('admin.contact-us.index', ['lang_code' => 'en']) }}">{{__('admin.Contact Us')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.terms-and-condition.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                                  href="{{ route('admin.terms-and-condition.index', ['lang_code' => 'en']) }}">{{__('admin.Terms And Conditions')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.privacy-policy.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                             href="{{ route('admin.privacy-policy.index', ['lang_code' => 'en']) }}">{{__('admin.Privacy Policy')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.faq.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                  href="{{ route('admin.faq.index') }}">{{__('admin.FAQ')}}</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown {{ Route::is('admin.blog-category.*') || Route::is('admin.edit.blog.category') || Route::is('admin.blog.*') || Route::is('admin.blog-comment.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-th-large"></i><span>{{__('admin.Blogs')}}</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.blog-category.*') || Route::is('admin.edit.blog.category') ? 'active' : '' }}">
                        <a class="nav-link"
                           href="{{ route('admin.blog-category.index') }}">{{__('admin.Categories')}}</a></li>

                    <li class="{{ Route::is('admin.blog.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                   href="{{ route('admin.blog.index') }}">{{__('admin.Blogs')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.blog-comment.*') ? 'active' : '' }}"><a class="nav-link"
                                                                                           href="{{ route('admin.blog-comment.index') }}">{{__('admin.Comments')}}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Route::is('admin.email-configuration') || Route::is('admin.email-template') || Route::is('admin.edit-email-template') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-envelope"></i><span>{{__('admin.Email Configuration')}}</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.email-configuration') ? 'active' : '' }}"><a class="nav-link"
                                                                                                href="{{ route('admin.email-configuration') }}">{{__('admin.Setting')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.email-template') || Route::is('admin.edit-email-template') ? 'active' : '' }}">
                        <a class="nav-link"
                           href="{{ route('admin.email-template') }}">{{__('admin.Email Template')}}</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Route::is('admin.admin-language') || Route::is('admin.admin-validation-language') || Route::is('admin.website-language') || Route::is('admin.website-validation-language') || Route::is('admin.languages') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-th-large"></i><span>{{__('admin.Manage Language')}}</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ menuActive('admin.languages') }}">
                        <a class="nav-link"  href="{{ route('admin.languages') }}">{{__('admin.Languages')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.admin-language') ? 'active' : '' }}">
                        <a class="nav-link"  href="{{ route('admin.admin-language', ['lang_code' => 'en']) }}">{{__('admin.Admin Language')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.admin-validation-language') ? 'active' : '' }}"><a class="nav-link"
                                                                                                      href="{{ route('admin.admin-validation-language', ['lang_code' => 'en']) }}">{{__('admin.Admin Validation')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.website-language') ? 'active' : '' }}"><a class="nav-link"
                                                                                             href="{{ route('admin.website-language', ['lang_code' => 'en']) }}">{{__('admin.Frontend Language')}}</a>
                    </li>

                    <li class="{{ Route::is('admin.website-validation-language') ? 'active' : '' }}"><a class="nav-link"
                                                                                                        href="{{ route('admin.website-validation-language', ['lang_code' => 'en']) }}">{{__('admin.Frontend Validation')}}</a>
                    </li>

                </ul>
            </li>

            <li class="{{ Route::is('admin.currency.*') ? 'active' : '' }}"><a class="nav-link"
                                                                               href="{{ route('admin.currency.index') }}"><i
                        class="fas fa-dollar-sign"></i> <span>{{__('admin.Currencies')}}</span></a></li>

            <li class="{{ Route::is('admin.general-setting') ? 'active' : '' }}"><a class="nav-link"
                                                                                    href="{{ route('admin.general-setting') }}"><i
                        class="fas fa-cog"></i> <span>{{__('admin.Setting')}}</span></a></li>

            @php
                $logedInAdmin = Auth::guard('admin')->user();
            @endphp
            @if ($logedInAdmin->admin_type == 1)
                <li class="{{ Route::is('admin.clear-database') ? 'active' : '' }}"><a class="nav-link"
                                                                                       href="{{ route('admin.clear-database') }}"><i
                            class="fas fa-trash"></i> <span>{{__('admin.Clear Database')}}</span></a></li>
            @endif

            <li class="{{ Route::is('admin.subscriber') ? 'active' : '' }}"><a class="nav-link"
                                                                               href="{{ route('admin.subscriber') }}"><i
                        class="fas fa-fire"></i> <span>{{__('admin.Subscribers')}}</span></a></li>

            <li class="{{ Route::is('admin.contact-message') ? 'active' : '' }}"><a class="nav-link"
                                                                                    href="{{ route('admin.contact-message') }}"><i
                        class="fas fa-fa fa-envelope"></i> <span>{{__('admin.Contact Message')}}</span></a></li>

            @if ($logedInAdmin->admin_type == 1)
                <li class="{{ Route::is('admin.admin.index') ? 'active' : '' }}"><a class="nav-link"
                                                                                    href="{{ route('admin.admin.index') }}"><i
                            class="fas fa-user"></i> <span>{{__('admin.Admin list')}}</span></a></li>
            @endif

        </ul>

    </aside>
</div>
