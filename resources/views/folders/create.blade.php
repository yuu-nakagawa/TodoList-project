@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <a href="javascript:history.back()" class="col-md-offset-2 col-md-1 btn btn-default">戻る</a>
            <div class="col col-md-6">
                <nav class="panel panel-default">
                    <div class="panel-heading">フォルダを追加する</div>
                    <div class="panel-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{ route('folders.create') }}" method="post">
                            @csrf
                            <div class="from-group">
                                <label for="title">フォルダ名</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">送信</button>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection