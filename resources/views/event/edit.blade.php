@extends('app')
@section('title')
    イベント情報編集画面
@endsection
@section('content')
    <form action="{{route("event_update",$item->id)}}" method="post">
        @csrf
        @method("patch")
        name: <input type="text" name="name" value="{{$item->name}}">
        place: <input type="text" name="place" value="{{$item->place}}">
        date: <input type="date" name="event_date" value="{{$item->event_date}}">
        <button>更新</button>
    </form>
    <a href="{{route("event_index")}}"><button>戻る</button></a>
    @if (session("message"))
        <p style="color: orange">{{session("message")}}</p>
    @endif
    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
@endsection