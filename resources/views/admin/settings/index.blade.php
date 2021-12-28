@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Settings
            </h1>
        </div>
        <div class="col-sm-6">
            {{ Breadcrumbs::render(\Request::route()->getName()) }}
        </div>
    </div>
@stop

@section('content')
    <form id="dataForm" action="{{ route('admin.settings.update') }}" method="post">
        @csrf

        <div class="card card-default {{--col-xl-6--}} col-xl-12">
            <div class="card-header">
                <h3 class="card-title">
                    @isset($Icon)
                        Edit Icon #{{ $Icon->id }}
                    @else
                        Add Icon
                    @endisset
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="nav-tabs-custom">
                    @include('admin.inc.languages')

                    <div class="tab-content">
                        @foreach ($Languages as $key => $Language)
                            <div class="tab-pane {{ $key == 0 ? 'active' : '' }}"
                                 id="{{ str_replace(' ', '_', $Language->name) }}">
                                <div class="row mt-3">
                                    <div class="col-xl-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Social</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Twitter</label>
                                                    <input type="text"
                                                           name="settings[social_twitter][{{ $Language->code }}]"
                                                           value="{{ $social_twitter[$Language->code] ?? '' }}"
                                                           class="form-control" placeholder="url">
                                                </div>
                                                <div class="form-group">
                                                    <label>Facebook</label>
                                                    <input type="text"
                                                           name="settings[social_facebook][{{ $Language->code }}]"
                                                           value="{{ $social_facebook[$Language->code] ?? '' }}"
                                                           class="form-control" placeholder="url">
                                                </div>
                                                <div class="form-group">
                                                    <label>Instagram</label>
                                                    <input type="text"
                                                           name="settings[social_instagram][{{ $Language->code }}]"
                                                           value="{{ $social_instagram[$Language->code] ?? '' }}"
                                                           class="form-control" placeholder="url">
                                                </div>
                                                <div class="form-group">
                                                    <label>YouTube</label>
                                                    <input type="text"
                                                           name="settings[social_youtube][{{ $Language->code }}]"
                                                           value="{{ $social_youtube[$Language->code] ?? '' }}"
                                                           class="form-control" placeholder="url">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Footer</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Text</label>
                                                    <input type="text"
                                                           name="settings[footer_text][{{ $Language->code }}]"
                                                           value="{{ $footer_text[$Language->code] ?? '' }}"
                                                           class="form-control" placeholder="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Copyright</label>
                                                    <input type="text"
                                                           name="settings[footer_copyright][{{ $Language->code }}]"
                                                           value="{{ $footer_copyright[$Language->code] ?? '' }}"
                                                           class="form-control" placeholder="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Payments</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Stripe Secret Key</label>
                                    <input type="text" name="payments[stripe_secret_key]"
                                           value="{{ \App\Models\Setting::findByName('stripe_secret_key')->data ?? null }}"
                                           class="form-control" placeholder="Stripe Secret Key">
                                </div>
                                <div class="form-group">
                                    <label>PayPal Client ID</label>
                                    <input type="text" name="payments[paypal_client_id]"
                                           value="{{ \App\Models\Setting::findByName('paypal_client_id')->data ?? null }}"
                                           class="form-control" placeholder="PayPal Client ID">
                                </div>
                                <div class="form-group">
                                    <label>PayPal Secret Key</label>
                                    <input type="text" name="payments[paypal_secret_key]"
                                           value="{{ \App\Models\Setting::findByName('paypal_secret_key')->data ?? null }}"
                                           class="form-control" placeholder="PayPal Secret Key">
                                </div>
                                <div class="form-group">
                                    <label>PayPal Mode</label>
                                    <select name="payments[paypal_mode]" class="form-control">
                                        <option {{ (\App\Models\Setting::findByName('paypal_mode')->data ?? null) == 'sandbox' ? 'selected' : '' }} value="sandbox">Sandbox</option>
                                        <option {{ (\App\Models\Setting::findByName('paypal_mode')->data ?? null) == 'live' ? 'selected' : '' }} value="live">Live</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Affilae</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Program ID</label>
                                    <input type="text" name="payments[affilae_program_id]"
                                           value="{{ \App\Models\Setting::findByName('affilae_program_id')->data ?? null }}"
                                           class="form-control" placeholder="Program ID">
                                </div>
                                <div class="form-group">
                                    <label>Key</label>
                                    <input type="text" name="payments[affilae_key]"
                                           value="{{ \App\Models\Setting::findByName('affilae_key')->data ?? null }}"
                                           class="form-control" placeholder="Key">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>
            </div>
    </form>
@stop

@section('js')
    <script src="{{ asset('admin-assets/js/basic.js') }}"></script>
@stop
