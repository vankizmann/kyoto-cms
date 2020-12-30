@extends(app('kyoto')->getLayout())

@section('content')
    <div class="kyo-login">
        <n-form :propagation="true" action="{{ request()->fullUrl() }}" method="post">

            @csrf

            <n-form-item>
                <h1>{{ trans(app('kyoto')->getMenu('title')) }}</h1>

                @if(session()->has('success'))
                    <div class="text--success">{{ session()->get('success') }}</div>
                @endif

                @if(session()->has('error'))
                    <div class="text--danger">{{ session()->get('error') }}</div>
                @endif

            </n-form-item>

            <n-form-item label="{{ trans('E-Mail-Address') }}">
                <n-input name="email" native-type="email" value="{{ request()->old('email') }}"></n-input>
                @error('email')
                    <div class="n-form-item__error">{{ $message }}</div>
                @enderror
            </n-form-item>

            <n-form-item label="{{ trans('Password') }}">
                <n-input name="password" native-type="password" value="{{ request()->old('password') }}"></n-input>
                @error('password')
                    <div class="n-form-item__error">{{ $message }}</div>
                @enderror
            </n-form-item>

            <n-form-item>
                <n-button button-type="submit">{{ trans('Login') }}</n-button>
            </n-form-item>

        </n-form>
    </div>
@endsection
