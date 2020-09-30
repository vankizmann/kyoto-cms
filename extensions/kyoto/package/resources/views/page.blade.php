@extends(app('kyoto')->getLayout())

@section('content')
    @php dump(app('kyoto')->getMenu()->toArray()) @endphp
@endsection
