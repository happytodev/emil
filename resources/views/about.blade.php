@extends('layout')

@section('title')
{{ $frontMatter['title'] }}
@endsection

@section('content')
@if (isset($frontMatter))
<h1>{{ $frontMatter['title'] }}</h1>
@endif

<h2>This the about layout</h2>

    {!! $html !!}
    
@endsection

