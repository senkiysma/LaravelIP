@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route("admin.settings.ip.store") }}" method="post" class="form-inline">
                    @csrf
                    <div class="form-group">
                        <label for="ip">Add acceptable Ip &ensp;</label>
                        <input type="text" class="form-control" 
                        id="ip" aria-describedby="state" name="ip" value="">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Add</button>
                </form>
            </div>
            <div class="col-12 bg-white m-1">
                <table class="table">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Ip</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->ip }}</td>
                            <td>
                                <form action="{{ route('admin.settings.ip.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
