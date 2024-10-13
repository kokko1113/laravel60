@extends('app')
@section('title')
    人材情報一覧
@endsection
@section('content')
    <a href="{{route('worker_create')}}"><button>人材新規登録</button></a>
    <a href="{{route('dashboard')}}"><button>戻る</button></a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>email</th>
            <th>memo</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->memo}}</td>
                <td><a href="{{route("worker_index")}}"><button>編集</button></a></td>
                <td>
                    <form action="{{route("worker_destroy",$item->id)}}" method="POST">
                        @csrf
                        @method("delete")
                        <button onclick="confirm('本当に削除しますか')">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
