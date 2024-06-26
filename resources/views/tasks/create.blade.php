@extends('layout')

@section('styles')
    @include('share.flatpickr.styles')
@endsection

@section('content')
        <div class="container">
            <div class="row">
                <a href="javascript:history.back()" class="col-md-offset-2 col-md-1 btn btn-default">戻る</a>
                <div class="col col-md-6">
                    <nav class="panel panel-default">
                        <div class="panel-heading">タスクを追加する</div>
                        <div class="panel-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $message)
                                        <p>{{ $message }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{ route('tasks.create', ['folder' => $folder_id]) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="title">タイトル</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="due_date">期限</label>
                                    <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">登録</button>
                                </div>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
    @include('share.flatpickr.scripts')
@endsection