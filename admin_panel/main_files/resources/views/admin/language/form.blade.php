@extends('admin.master_layout')
@section('title')
    <title>{{__('admin.Languages')}}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('admin.Languages')}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
                    <div class="breadcrumb-item">{{__('admin.Languages')}}</div>
                </div>
            </div>
            <div class="section-body">
                <a href="{{ route('admin.languages') }}" class="btn btn-primary"><i
                        class="fas fa-list"></i> {{__('admin.Language')}}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form
                                    action="{{ isset($language) ? route('admin.language.update', $language->id) : route('admin.language.store') }}"
                                    method="post">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="plan_name">{{ __('admin.Language Name') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="lang_name" class="form-control"
                                                       value="{{ old('lang_name', $language->lang_name ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lang_code">{{ __('admin.Language Code') }} <span class="text-danger">*</span></label>
                                                <input type="text" name="lang_code" class="form-control"
                                                       value="{{ old('lang_code', isset($language) ? $language->lang_code : '') }}"
                                                       @if(isset($language)) readonly disabled @endif>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="is_default">{{ __('admin.is Default ?') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="is_default" id="is_default" class="form-control">
                                                    <option
                                                        value="No" {{ old('is_default', $language->is_default ?? '') == 'No' ? 'selected' : '' }}>{{ __('admin.No') }}</option>
                                                    <option
                                                        value="Yes" {{ old('is_default', $language->is_default ?? '') == 'Yes' ? 'selected' : '' }}>{{ __('admin.Yes') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lang_direction">{{ __('admin.Language Direction') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="lang_direction" id="lang_direction" class="form-control">
                                                    <option
                                                        value="left_to_right" {{ old('lang_direction', $language->lang_direction ?? '') == 'left_to_right' ? 'selected' : '' }}>{{ __('admin.Left To Right') }}</option>
                                                    <option
                                                        value="right_to_left" {{ old('lang_direction', $language->lang_direction ?? '') == 'right_to_left' ? 'selected' : '' }}>{{ __('admin.Right To Left') }}</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">{{ __('admin.Status') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="status" id="status" class="form-control">
                                                    <option
                                                        value="1" {{ old('status', $language->status ?? '') == '1' ? 'selected' : '' }}>{{ __('admin.Active') }}</option>
                                                    <option
                                                        value="0" {{ old('status', $language->status ?? '') == '0' ? 'selected' : '' }}>{{ __('admin.InActive') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button
                                        class="btn btn-primary">{{ isset($language) ? __('admin.Update') : __('admin.Save') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
