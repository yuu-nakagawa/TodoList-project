@extends('layout')

@section('styles')
    @include('share.flatpickr.styles')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <a href="javascript:history.back()" class="col-md-offset-2 col-md-1 btn btn-default">戻る</a>
            <div class="col-md-6">
                <nav class="panel panel-default">
                    <div class="panel-heading">タスクを編集する</div>
                    <div class="panel-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $message)
                            <p>{{ $message }}</p>
                            @endforeach
                        </div>
                        @endif
                        <form action="{{ route('tasks.edit', ['folder' => $task->folder_id, 'task' => $task->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">タイトル</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ?? $task->title }}">
                            </div>
                            <div class="form-group">
                                <label for="status">状態</label>
                                <select name="status" id="status" class="form-control">
                                    @foreach(\App\Models\Task::STATUS as $key => $val)
                                        <option value="{{ $key }}"{{ $key == old('status', $task->status) ? 'selected' : '' }}>
                                            {{ $val['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="due_date">期限</label>
                                <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') ?? $task->formatted_due_date }}">
                            </div>
                            <div class="col-md-6 text-left">
                                <button type="submit" class="btn btn-primary">登録</button>
                            </div>
                        </form>
                        <form action="{{ route('tasks.destroy', ['folder' => $task->folder_id,'task' => $task->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-default">削除</button>
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