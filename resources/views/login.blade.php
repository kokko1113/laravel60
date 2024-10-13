@extends('app')
@section('title')
    ログイン画面
@endsection
@section('content')
    <form action="{{ route('check') }}" method="POST">
        @csrf
        email: <input type="text" name="email">
        pass: <input type="text" name="password">
        <button>送信</button>
    </form>

    @error('message')
        <p style="color: red">{{ $errors->first('message') }}</p>
    @enderror
@endsection
