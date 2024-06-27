@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-4">
                <nav class="panel panel-default">
                    <div class="panel-heading">フォルダ</div>
                    <div class="panel-body">
                        <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
                            フォルダを追加する
                        </a>
                    </div>
                    <div class="list-group">
                        @foreach($folders as $folder)
                        <div>
                            <a href="{{ route('tasks.index',['folder' => $folder->id]) }}"
                            class="list-group-item {{ $current_folder_id === $folder->id ? 'list-group-item-action active-folder' : '' }}" >
                                {{ $folder->title }}
                            </a>
                        </div>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="column col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">タスク</div>
                    <div class="panel-body">
                        <div class="text-right" style="margin-bottom: 2rem;">
                            <a href="{{ route('tasks.create', ['folder' => $current_folder_id]) }}" class="btn btn-default btn-block">
                                タスクを追加する
                            </a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>タイトル</th>
                                    <th class="text-center"><a href="{{ route('tasks.sort',['folder' => $current_folder_id,'clicks' => $clicks]) }}" class="mojistyle">状態</a></th>
                                    <th class="text-center"><a href="{{ route('tasks.kigen',['folder' => $current_folder_id, 'clicks' => $clicks]) }}" class="mojistyle">期限</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                <tr style="{{ \Carbon\Carbon::parse($task->formatted_due_date)->lt(\Carbon\Carbon::today()) ? 'background-color: #e6e9ed;' : '' }}">
                                    <td>{{ $task->title }}</td>
                                    <td><span class="label {{ $task->status_class }}">{{ $task->status_label }}</span></td>
                                    <td>{{ $task->formatted_due_date }}</td>
                                    <td><a href="{{ route('tasks.edit', ['folder' => $task->folder_id, 'task' => $task->id]) }}">編集</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    .mojistyle {
        color: #aab2bd;
        border: 1px solid #aab2bd;
        padding: 0.2em 0.5em;
        border-radius: 4px;     
    }
    .mojistyle:hover {
        color : #fff;
        background-color : #ccd1d9;
        padding: 0.2em 0.5em;
        border-radius: 4px;
        border: 1px solid transparent;
    }
    .active-folder {
        background-color : #e6e9ed !important;
    }
</style>
