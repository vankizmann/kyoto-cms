@extends(app('kyoto')->getLayout())

@section('content')
    <form action="{{ url()->current() }}" method="post">
        @csrf
        <div>
            <input name="email" type="text" value="{{ request()->old('email') }}">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <input name="password" type="password" value="{{ request()->old('email') }}">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Send</button>
    </form>
@endsection
