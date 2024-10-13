@extends('app')
@section('title')
    イベント新規登録画面
@endsection
@section('content')
    <form action="{{ route('event_store') }}" method="POST">
        @csrf
        name: <input type="text" name="name">
        place: <input type="text" name="place">
        date: <input type="date" name="event_date">
        <button>登録</button>
    </form>
    <a href="{{route("event_index")}}"><button>戻る</button></a>
    @if (session('message'))
        <p style="color: orange">{{ session('message') }}</p>
    @endif

    @if ($errors->any())
        <p style="color: red">{{ $errors->first() }}</p>
    @endif
@endsection
