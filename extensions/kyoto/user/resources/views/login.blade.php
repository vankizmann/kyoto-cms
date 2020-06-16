@extends(app('kyoto')->getLayout())

@section('content')
    <form action="{{ url()->current() }}" method="post">
        @csrf
        <input name="email" type="text" value="{{ request()->old('email') }}">
        @error('email')
        <div class="alert alert-danger">123{{ $message }}</div>
        @enderror
        <input name="password" type="password" value="{{ request()->old('email') }}">
        @error('password')
        <div class="alert alert-danger">123{{ $message }}</div>
        @enderror
        <button type="submit">Send</button>
    </form>
@endsection
