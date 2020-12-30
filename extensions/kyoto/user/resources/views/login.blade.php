@extends(app('kyoto')->getLayout())

@section('content')
    <form class="kyo-login kyo-form" action="{{ Request::fullUrl() }}" method="post">

        @csrf

        <div class="kyo-form-item">
            <h2>{{ kyoto()->getMenu('title') }}</h2>
        </div>

        <div class="kyo-form-item">
            <label class="kyo-form-label" for="email">
                {{ trans('E-Mail-Address') }}
            </label>
            <input id="email" class="kyo-input" name="email" type="text" value="{{ request()->old('email') }}">
            @error('email')
                <div class="kyo-alert kyo-alert--danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="kyo-form-item">
            <label class="kyo-form-label" for="email">
                {{ trans('Password') }}
            </label>
            <input class="kyo-input" name="password" type="password" value="{{ request()->old('email') }}">
            @error('password')
                <div class="kyo-alert kyo-alert--danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="kyo-form-item">
            <button class="kyo-button" type="submit">{{ trans('Login') }}</button>
        </div>

    </form>
@endsection
