@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <form action="{{ route("admin.import.upload") }}" method="post" class="form-inline" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="state">File</label>
                    <input type="file" class="form-control" id="state" aria-describedby="state" name="file">
                </div>
                <button type="submit" class="btn btn-primary mb-2">upload</button>
            </form>
        </div>
        <div class="row">
            <div class="col-12 bg-white m-1">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Files</td>
                        <td>Import</td>
                        <td>delete</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item }}</td>
                            <td><a href="{{ route("admin.import.import",["importFile"=>$item]) }}">import</a></td>
                            <td class="text-warning"><a href="{{ route("admin.import.delete",["importFile"=>$item]) }}">remove</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="10"></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
