@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-headeing">パスワード再発行</div>

                <div class="panel-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password" >パスワード</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" >新しいパスワード(確認)</label>
                            <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                送信
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
