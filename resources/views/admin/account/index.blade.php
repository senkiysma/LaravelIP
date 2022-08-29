@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route("admin.account.index") }}" method="get" class="form-inline">
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" aria-describedby="state" 
                        name="App\Models\\Models\ate" value="{{ request("state") }}">
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="no">No order last 6 months</label>
                        <input type="checkbox" name="no" class="form-check-input" id="no" aria-describedby="no" {{ request("no")=="on"?"checked":"" }}>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                </form>
            </div>
            <div class="col-12 bg-white m-1">
                <table class="table">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Email ({{ $items->total() }})</td>
                        <td>State</td>
                        <td>Last 6 months orders</td>
                        <td>Checked</td>
                        <td>By</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->state }}</td>
                            <td>{{ $item->no_order_6months }}</td>
                            <td>{{ !is_null($item->checked_out)?$item->checked_out->format("d/m/y"):"" }}</td>
                            <td>{{ is_object($item->user)?$item->user->name:"NA" }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="10">{{ $items->appends(request()->query())->links() }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
