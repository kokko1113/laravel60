@extends('app')
@section('title')
    トップページ
@endsection
@section('content')
    <a href="{{route('logout')}}"><button>logout</button></a>

    <a href="{{route('event_index')}}"><button>イベント情報一覧</button></a>
    <a href="{{route('worker_index')}}"><button>人材情報一覧</button></a>
    <a href="{{route('dispatch_index')}}"><button>派遣情報一覧</button></a>
@endsection