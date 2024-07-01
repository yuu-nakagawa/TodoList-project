@extends('layout')

@section('styles')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <a href="javascript:history.back()" class="col-md-offset-2 col-md-1 btn btn-default">戻る</a>
            <div class="col-md-6">
                <nav class="panel panel-default">
                    <div class="panel-heading">以下を削除してよろしいですか？</div>
                    <div class="panel-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $message)
                            <p>{{ $message }}</p>
                            @endforeach
                        </div>
                        @endif
                        <form action="{{ route('tasks.delete', ['folder' => $task->folder_id, 'task' => $task->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">タイトル</label>
                                <p>{{ old('title') ?? $task->title }}</p>
                            </div>
                            <div class="form-group">
                                <label for="status">状態</label>
                                <p{{ old('status') ?? $task->status }}></p>
                                    @foreach(\App\Models\Task::STATUS as $key => $val)
                                        <p value="{{ $key }}">
                                        {{ $key == old('status', $task->status) ? $val['label'] : '' }}
                                        </p>
                                    @endforeach
                            </div>
                            <div class="form-group">
                                <label for="due_date">期限</label>
                                <p>{{ old('due_date') ?? $task->formatted_due_date }}</p>
                            </div>
                        </form>
                        <form action="{{ route('tasks.destroy', ['folder' => $task->folder_id,'task' => $task->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-danger" onclick="sakujo()">削除</button>
                            </div>
                            <script>
                                function sakujo() {
                                    alert('削除しました。');
                                }
                            </script>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection