@extends('admin.master_layout')
@section('title')
    <title>{{__('admin.Settings')}}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('admin.Settings')}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-3">
                                            <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">


                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link active" id="general-setting-tab"
                                                       data-toggle="tab" href="#generalSettingTab" role="tab"
                                                       aria-controls="generalSettingTab"
                                                       aria-selected="true">{{__('admin.General Setting')}}</a>
                                                </li>

                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="logo-tab" data-toggle="tab" href="#logoTab"
                                                       role="tab" aria-controls="logoTab"
                                                       aria-selected="true">{{__('admin.Logo and Favicon')}}</a>
                                                </li>


                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="logo-tab" data-toggle="tab"
                                                       href="#themeColorTab" role="tab" aria-controls="themeColorTab"
                                                       aria-selected="true">{{__('admin.Theme Color')}}</a>
                                                </li>

                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="cookie-tab" data-toggle="tab"
                                                       href="#cookieTab" role="tab" aria-controls="cookieTab"
                                                       aria-selected="true">{{__('admin.Cookie Consent')}}</a>
                                                </li>

                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="recaptcha-tab" data-toggle="tab"
                                                       href="#recaptchaTab" role="tab" aria-controls="recaptchaTab"
                                                       aria-selected="true">{{__('admin.Google Recaptcha')}}</a>
                                                </li>

                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="tawk-chat-tab" data-toggle="tab"
                                                       href="#tawkChatTab" role="tab" aria-controls="tawkChatTab"
                                                       aria-selected="true">{{__('admin.Tawk Chat')}}</a>
                                                </li>

                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="google-analytic-tab" data-toggle="tab"
                                                       href="#googleAnalyticTab" role="tab"
                                                       aria-controls="googleAnalyticTab"
                                                       aria-selected="true">{{__('admin.Google Analytic')}}</a>
                                                </li>

                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="custom-pagination-tab" data-toggle="tab"
                                                       href="#customPaginationTab" role="tab"
                                                       aria-controls="customPaginationTab"
                                                       aria-selected="true">{{__('admin.Custom Pagination')}}</a>
                                                </li>


                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="facebook-pixel-tab" data-toggle="tab"
                                                       href="#facebookPixelTab" role="tab"
                                                       aria-controls="facebookPixelTab"
                                                       aria-selected="true">{{__('admin.Facebook Pixel')}}</a>
                                                </li>

                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="pay-out-tab" data-toggle="tab"
                                                       href="#payOutTab" role="tab" aria-controls="payOutTab"
                                                       aria-selected="true">{{__('admin.Payout Settings')}}</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-9">
                                            <div class="border rounded">
                                                <div class="tab-content no-padding" id="settingsContent">

                                                    <div class="tab-pane fade show active" id="generalSettingTab"
                                                         role="tabpanel" aria-labelledby="general-setting-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form
                                                                    action="{{ route('admin.update-general-setting') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="form-group">
                                                                        <label
                                                                            for="">{{__('admin.Frotnend URL')}} </label>
                                                                        <input type="text" name="frontend_url"
                                                                               class="form-control"
                                                                               value="{{ $setting->frontend_url }}">
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.App Name')}}</label>
                                                                        <input type="text" name="lg_header"
                                                                               class="form-control"
                                                                               value="{{ $setting->sidebar_lg_header }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.Timezone')}}</label>
                                                                        <select name="timezone" id="timezone-select" class="form-control select2">
                                                                            @foreach ($timezones as $timezone)
                                                                                <option value="{{ $timezone['value'] }}"
                                                                                    {{ old('timezone', $setting->timezone) == $timezone['value'] ? 'selected' : '' }}>
                                                                                    {{ $timezone['name'] }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <button class="btn btn-primary"
                                                                            type="submit">{{__('admin.Update')}}</button>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="logoTab" role="tabpanel"
                                                         aria-labelledby="logo-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form action="{{ route('admin.update-logo-favicon') }}"
                                                                      method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="form-group">
                                                                        <label
                                                                            for="">{{__('admin.Existing Logo')}}</label>
                                                                        <div>
                                                                            <img src="{{ asset($setting->logo) }}"
                                                                                 alt="" width="200px">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.New Logo')}}</label>
                                                                        <input type="file" name="logo"
                                                                               class="form-control-file">
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label
                                                                            for="">{{__('admin.Existing Favicon')}}</label>
                                                                        <div>
                                                                            <img src="{{ asset($setting->favicon) }}"
                                                                                 alt="" width="50px">
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label
                                                                            for="">{{__('admin.New Favicon')}}</label>
                                                                        <input type="file" name="favicon"
                                                                               class="form-control-file">
                                                                    </div>

                                                                    <button
                                                                        class="btn btn-primary">{{__('admin.Update')}}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="tab-pane fade" id="themeColorTab" role="tabpanel"
                                                         aria-labelledby="cookie-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form action="{{ route('admin.update-theme-color') }}"
                                                                      method="POST">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="form-group">
                                                                        <label
                                                                            for="cookie_text">{{__('admin.Primary Background')}}</label>
                                                                        <input type="color"
                                                                               value="{{ $setting->theme_one_color }}"
                                                                               name="theme_one_color"
                                                                               class="form-control">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label
                                                                            for="cookie_text">{{__('admin.Primary Foregorund')}}</label>
                                                                        <input type="color"
                                                                               value="{{ $setting->theme_two_color }}"
                                                                               name="theme_two_color"
                                                                               class="form-control">
                                                                    </div>

                                                                    <button type="submit"
                                                                            class="btn btn-primary">{{__('admin.Update')}}</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="cookieTab" role="tabpanel"
                                                         aria-labelledby="cookie-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form
                                                                    action="{{ route('admin.update-cookie-consent') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="form-group">
                                                                        <label
                                                                            for="cookie_text">{{__('admin.Message')}}</label>
                                                                        <textarea class="form-control text-area-5"
                                                                                  name="message" id="cookie_text"
                                                                                  cols="30"
                                                                                  rows="5">{{ $cookieConsent->message }}</textarea>
                                                                    </div>
                                                                    <button type="submit"
                                                                            class="btn btn-primary">{{__('admin.Update')}}</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="recaptchaTab" role="tabpanel"
                                                         aria-labelledby="recaptcha-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form
                                                                    action="{{ route('admin.update-google-recaptcha') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="">{{__('admin.Allow Recaptcha')}}</label>
                                                                        <select name="allow" id="allow"
                                                                                class="form-control">
                                                                            <option
                                                                                {{ $googleRecaptcha->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Enable')}}</option>
                                                                            <option
                                                                                {{ $googleRecaptcha->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Disable')}}</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label
                                                                            for="">{{__('admin.Captcha Site Key')}}</label>
                                                                        <input type="text" class="form-control"
                                                                               name="site_key"
                                                                               value="{{ $googleRecaptcha->site_key }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label
                                                                            for="">{{__('admin.Captcha Secret Key')}}</label>
                                                                        <input type="text" class="form-control"
                                                                               name="secret_key"
                                                                               value="{{ $googleRecaptcha->secret_key }}">
                                                                    </div>

                                                                    <button
                                                                        class="btn btn-primary">{{__('admin.Update')}}</button>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="tab-pane fade" id="tawkChatTab" role="tabpanel"
                                                         aria-labelledby="tawk-chat-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form action="{{ route('admin.update-tawk-chat') }}"
                                                                      method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="">{{__('admin.Allow Live Chat')}}</label>
                                                                        <select name="allow" id="tawk_allow"
                                                                                class="form-control">
                                                                            <option
                                                                                {{ $tawkChat->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Enable')}}</option>
                                                                            <option
                                                                                {{ $tawkChat->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Disable')}}</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.Widget Id')}}</label>
                                                                        <input type="text" class="form-control"
                                                                               name="widget_id"
                                                                               value="{{ $tawkChat->widget_id }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label
                                                                            for="">{{__('admin.Property Id')}}</label>
                                                                        <input type="text" class="form-control"
                                                                               name="property_id"
                                                                               value="{{ $tawkChat->property_id }}">
                                                                    </div>


                                                                    <button
                                                                        class="btn btn-primary">{{__('admin.Update')}}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="tab-pane fade" id="googleAnalyticTab" role="tabpanel"
                                                         aria-labelledby="google-analytic-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form
                                                                    action="{{ route('admin.update-google-analytic') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="">{{__('admin.Allow Google Analytic')}}</label>
                                                                        <select name="allow" id="tawk_allow"
                                                                                class="form-control">
                                                                            <option
                                                                                {{ $googleAnalytic->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Enable')}}</option>
                                                                            <option
                                                                                {{ $googleAnalytic->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Disable')}}</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label
                                                                            for="">{{__('admin.Analytic Tracking Id')}}</label>
                                                                        <input type="text" class="form-control"
                                                                               name="analytic_id"
                                                                               value="{{ $googleAnalytic->analytic_id }}">
                                                                    </div>

                                                                    <button
                                                                        class="btn btn-primary">{{__('admin.Update')}}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="customPaginationTab" role="tabpanel"
                                                         aria-labelledby="custom-pagination-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form
                                                                    action="{{ route('admin.update-custom-pagination') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                        <tr>
                                                                            <th width="50%">{{__('admin.Section Name')}}</th>
                                                                            <th width="50%">{{__('admin.Quantity')}}</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach ($customPaginations as $customPagination)
                                                                            <tr>
                                                                                <td>{{ $customPagination->page_name }}</td>
                                                                                <td>
                                                                                    <input type="number"
                                                                                           value="{{ $customPagination->qty }}"
                                                                                           name="quantities[]"
                                                                                           class="form-control">
                                                                                    <input type="hidden"
                                                                                           value="{{ $customPagination->id }}"
                                                                                           name="ids[]">
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                        </tbody>


                                                                    </table>
                                                                    <button
                                                                        class="btn btn-primary">{{__('admin.Update')}}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="facebookPixelTab" role="tabpanel"
                                                         aria-labelledby="facebook-pixel-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form
                                                                    action="{{ route('admin.update-facebook-pixel') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="">{{__('admin.Allow Facebook Pixel')}}</label>
                                                                        <div>
                                                                            @if ($facebookPixel->status == 1)
                                                                                <input id="status_toggle"
                                                                                       type="checkbox" checked
                                                                                       data-toggle="toggle"
                                                                                       data-on="{{__('admin.Enable')}}"
                                                                                       data-off="{{__('admin.Disable')}}"
                                                                                       data-onstyle="success"
                                                                                       data-offstyle="danger"
                                                                                       name="allow_facebook_pixel">
                                                                            @else
                                                                                <input id="status_toggle"
                                                                                       type="checkbox"
                                                                                       data-toggle="toggle"
                                                                                       data-on="{{__('admin.Enable')}}"
                                                                                       data-off="{{__('admin.Disable')}}"
                                                                                       data-onstyle="success"
                                                                                       data-offstyle="danger"
                                                                                       name="allow_facebook_pixel">
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label
                                                                            for="">{{__('admin.Facebook App Id')}}</label>
                                                                        <input type="text"
                                                                               value="{{ $facebookPixel->app_id }}"
                                                                               class="form-control" name="app_id">
                                                                    </div>
                                                                    <button
                                                                        class="btn btn-primary">{{__('admin.Update')}}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="payOutTab" role="tabpanel" aria-labelledby="pay-out-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form action="{{ route('admin.update-payout-setting') }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group">
                                                                        <label for="payout_type">{{ __('admin.Payout Type') }}</label>
                                                                        <select id="payout_type" class="form-control" name="payout_type" onchange="toggleCommissionInput()">
                                                                            <option selected disabled>{{ __('admin.Select Any') }}</option>
                                                                            <option value="{{ \App\Constants\Status::COMMISSION_BASED }}" {{ old('payout_type', $currentPayoutType) == \App\Constants\Status::COMMISSION_BASED ? 'selected' : '' }}>
                                                                                {{ __('admin.Commission') }}
                                                                            </option>
                                                                            <option value="{{ \App\Constants\Status::SUBSCRIPTION_BASED }}" {{ old('payout_type', $currentPayoutType) == \App\Constants\Status::SUBSCRIPTION_BASED ? 'selected' : '' }}>
                                                                                {{ __('admin.Subscription') }}
                                                                            </option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group" id="commission_percentage_input" style="display: {{ (old('payout_type', $currentPayoutType) == \App\Constants\Status::COMMISSION_BASED) ? 'block' : 'none' }}">
                                                                        <label for="commission_percentage">{{ __('admin.Commission Percentage') }}</label>
                                                                        <div class="input-group">
                                                                            <input type="number" id="commission_percentage" name="commission_percentage" class="form-control" placeholder="Enter commission percentage" value="{{ old('commission_percentage', $currentCommissionPercentage) }}">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text">@lang('%')</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <button class="btn btn-primary mt-2">{{ __('admin.Update') }}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        "use strict";
        function toggleCommissionInput() {
            const payoutType = document.getElementById('payout_type').value;
            const commissionInput = document.getElementById('commission_percentage_input');
            commissionInput.style.display = payoutType == "{{ \App\Constants\Status::COMMISSION_BASED }}" ? 'block' : 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleCommissionInput();
        });

    </script>
@endsection
