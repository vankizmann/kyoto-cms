@extends(app('kyoto')->getLayout())

@section('content')
    <div class="kyo-login">

        @if (true)
            <div class="kyo-login__logo">
                <img src="{{ asset('kyoto/backend::img/kyoto-square.svg') }}">
            </div>
        @endif

        <n-form :prevent="false" action="{{ request()->fullUrl() }}" method="post">

            @csrf

            <div class="grid grid--row grid--wrap grid--middle">

                @if(session()->has('success') || session()->has('error'))
                    <div class="col--1-1">
                        <n-form-item>

                            @if(session()->has('success'))
                                <div class="kyo-message kyo-message--success">{{ session()->get('success') }}</div>
                            @endif

                            @if(session()->has('error'))
                                <div class="kyo-message kyo-message--danger">{{ session()->get('error') }}</div>
                            @endif

                        </n-form-item>
                    </div>
                @endif

                <div class="col--1-1">
                    <n-form-item label="{{ trans('E-Mail-Address') }}">

                        <n-input name="email" native-type="email" value="{{ request()->old('email') }}"></n-input>

                        @error('email')
                            <div class="n-form-item__error">{{ $message }}</div>
                        @enderror

                    </n-form-item>
                </div>

                <div class="col--1-1">
                    <n-form-item label="{{ trans('Password') }}">

                        <n-input name="password" native-type="password" value="{{ request()->old('password') }}"></n-input>

                        @error('password')
                            <div class="n-form-item__error">{{ $message }}</div>
                        @enderror

                    </n-form-item>
                </div>

                <div class="col--1-1 col--auto@xs col--flex-1">
                    <n-form-item>
                        <n-button :link="true" icon="fa fa-arrow-right" icon-position="after">{{ trans('Reset password') }}</n-button>
                    </n-form-item>
                </div>

                <div class="col--1-1 col--auto@xs col--flex-0">
                    <n-form-item>
                        <n-button button-type="submit">{{ trans('Login') }}</n-button>
                    </n-form-item>
                </div>

            </div>

        </n-form>
    </div>
@endsection
