@extends('app')
@section('title')
    イベント情報一覧
@endsection
@section('content')
    <a href="{{route('event_create')}}"><button>イベント新規登録</button></a>
    <a href="{{route('dashboard')}}"><button>戻る</button></a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>place</th>
            <th>date</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->place}}</td>
                <td>{{$item->event_date}}</td>
                <td><a href="{{route("event_edit",$item->id)}}"><button>編集</button></a></td>
                <td>
                    <form action="{{route("event_destroy",$item->id)}}" method="POST">
                        @csrf
                        @method("delete")
                        <button onclick="confirm('本当に削除しますか')">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
