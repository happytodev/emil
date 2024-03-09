@extends('layout')

@section('title')
{{ $frontMatter['title'] }}
@endsection

@section('content')
@if (isset($frontMatter))
<h1>{{ $frontMatter['title'] }}</h1>
@endif


    {!! $html !!}
    
@endsection

