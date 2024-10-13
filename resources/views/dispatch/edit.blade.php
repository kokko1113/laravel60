@extends('app')
@section('title')
    派遣情報編集画面
@endsection
@section('content')
    <form action="{{ route('dispatch_update', $item->id) }}" method="post">
        @csrf
        @method('patch')
        event_name:
        <select name="event_name" id="">
            @foreach ($events as $event)
                <option {{ $event->name == $prev_event ? 'selected' : '' }} 
                     value="{{ $event->name }}">{{ $event->name }}</option>
            @endforeach
        </select>
        worker_name:
        <select name="worker_name" id="">
            @foreach ($workers as $worker)
                <option {{ $worker->name == $prev_worker ? 'selected' : '' }} 
                value="{{ $worker->name }}">{{ $worker->name }}</option>
            @endforeach
        </select>
        memo: <input type="text" value="{{$item->memo}}" name="memo">
        <button>更新</button>
    </form>
    <a href="{{ route('dispatch_index') }}"><button>戻る</button></a>
    @if (session('message'))
        <p style="color: orange">{{ session('message') }}</p>
    @endif
    @if ($errors->any())
        <p style="color: red">{{ $errors->first() }}</p>
    @endif
@endsection
