@extends(app('kyoto')->getLayout())

@section('content')
    <div class="kyo-page">
        <h1>{{ $page->title }}</h1>
        <p>
            {{ $page->content }}
        </p>
    </div>
    @php dump($page->toArray()) @endphp
@endsection
