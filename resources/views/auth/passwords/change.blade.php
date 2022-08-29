@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route("user.updatePassword") }}" method="post" class="form-inline">
                    @csrf
                    <div class="form-group">
                        <label for="name">old pass</label>
                        <input type="password" class="form-control" id="old_pass" name="old_pass">
                    </div><div class="form-group">
                        <label for="email">new password</label>
                        <input type="password" class="form-control" id="new_pass" name="new_pass">
                    </div><div class="form-group">
                        <label for="email">new password again</label>
                        <input type="password" class="form-control" id="new_pass2" name="new_pass2">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">change password</button>
                </form>
            </div>
        </div>
    </div>
@endsection
