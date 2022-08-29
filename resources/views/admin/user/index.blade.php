@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route("admin.user.store") }}" method="post" class="form-inline">
                    @csrf
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div><div class="form-group">
                        <label for="email">email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="text" class="form-control" id="email" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Create User</button>
                </form>
            </div>
            <div class="col-12 bg-white m-1">
                <table class="table">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Email</td>
                        <td>Role</td>
                        <td>Total Gets</td>
                        <td>delete</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $t = 0;?>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <a href="{{ route("admin.user.accounts",["user_id"=>$item->id]) }}">{{ $item->email }}</a>
                            </td>
                            <td>{{ $item->role }}</td>
                            <td>{{ $item->accounts->count() }}</td>
                            <td><a href="{{ route("admin.user.delete",['id'=>$item->id]) }}">Remove</a></td>
                        </tr>
                        <?php  $t +=$item->accounts->count();  ?>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="10">{{ number_format($t) }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
