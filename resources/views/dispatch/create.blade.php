@extends('app')
@section('title')
    派遣新規登録画面
@endsection
@section('content')
    <form action="{{ route('dispatch_store') }}" method="POST">
        @csrf
        event_name: 
        <select name="event_name" id="">
            @foreach ($events as $event)
                <option value="{{$event->name}}">{{$event->name}}</option>
            @endforeach
        </select>
        worker_name: 
        <select name="worker_name" id="">
            @foreach ($workers as $worker)
                <option value="{{$worker->name}}">{{$worker->name}}</option>
            @endforeach
        </select>
        memo: <input type="text" name="memo">
        <button>登録</button>
    </form>
    <a href="{{route("dispatch_index")}}"><button>戻る</button></a>
    @if (session('message'))
        <p style="color: orange">{{ session('message') }}</p>
    @endif

    @if ($errors->any())
        <p style="color: red">{{ $errors->first() }}</p>
    @endif
@endsection
