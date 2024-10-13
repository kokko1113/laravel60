@extends('app')
@section('title')
    派遣情報一覧
@endsection
@section('content')
    <a href="{{route('dispatch_create')}}"><button>派遣新規登録</button></a>
    <a href="{{route('dashboard')}}"><button>戻る</button></a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>event_name</th>
            <th>worker_name</th>
            <th>memo</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->event->name}}</td>
                <td>{{$item->worker->name}}</td>
                <td>{{$item->memo}}</td>
                <td><a href="{{route("dispatch_edit",$item->id)}}"><button>編集</button></a></td>
                <td>
                    <form action="{{route("dispatch_destroy",$item->id)}}" method="POST">
                        @csrf
                        @method("delete")
                        <button onclick="confirm('本当に削除しますか')">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
