<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * タスク一覧
     * @param Folder $folder
     * @return \\Illuminate\View\View
     */
    public function index(Folder $folder)
    {
        //ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();

        //選ばれたフォルダに紐づくタスクを取得する
        $tasks = $folder->tasks()->get();
        $clicks = 0;

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
            'clicks' => $clicks,
        ]);
    }

    /**
     * タスク並べ替え(状態順)
     * @param Folder $folder
     * @return \\Illuminate\View\View
     */
    public function sortTasksByStatus(Folder $folder, $clicks)
    {
        //ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();
        $clicks++;
        //クリック回数に応じてソート条件を変更する
        $tasks = $folder->tasks()->orderByRaw('status = ? desc',[$clicks])->get();

        //クリック回数が3回になったら0に戻す
        if($clicks == 3) {
            $clicks = 0;
        }

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
            'clicks' => $clicks,
        ]);
    }

    /**
     * 期限並べ替え
     */
    public function sortTasksByDueDate(Folder $folder,$clicks)
    {
        //ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();

        if($clicks == 2 || $clicks == 3) {
            $clicks == 0;
        }
        //フォルダを日付順に並べて取得する
        if($clicks == 0) {
            $tasks = $folder->tasks()->orderBy('due_date','asc')->get();
            $clicks++;
        } else {
            $tasks = $folder->tasks()->orderBy('due_date','desc')->get();
            $clicks = 0;
        }
        return view('tasks/index',[
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
            'clicks' => $clicks,
        ]);
    }
    /**
     * タスク作成フォーム
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create',[
            'folder_id' => $folder->id
        ]);
    }

    /**
     * タスク作成
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Folder $folder,CreateTask $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }

    /**
     * タスク編集フォーム
     * @param Folder $folder
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function showEditForm(Folder $folder,Task $task)
    {
        $this->checkRelation($folder, $task);
        return view('tasks/edit', [
            'task' => $task,
        ]);
    }
    /**
     * タスク削除フォーム
     * @param Folder $folder
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function showDeleteForm(Folder $folder,Task $task)
    {
        $this->checkRelation($folder, $task);
        return view('tasks/delete', [
            'task' => $task,
        ]);
    }

    /**
     * タスク編集
     * @param Folder $folder
     * @param Task $task
     * @param EditTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $this->checkRelation($folder, $task);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('tasks.index', [
            'folder' => $task->folder_id,
        ]);
    }

    /**
     * 削除処理
     */
    public function destroy(Folder $folder,Task $task)
    {
        $this->checkRelation($folder,$task);
        //レコードを削除
        $task->delete();
        //削除したら一覧画面にリダイレクト
        return redirect()->route('tasks.index',[
            'folder' => $task->folder_id,
        ]);
    }
    /**
     * フォルダとタスクの関連性があるか調べる
     * @param Folder $folder
     * @param Task $task
     */
    private function checkRelation(Folder $folder, Task $task)
    {
        if($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}
