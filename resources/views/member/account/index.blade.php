@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route("member.account.index") }}" method="get" class="form-inline">
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" aria-describedby="state" name="state" value="{{ request("state") }}">
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
                        <td>No Order 6m</td>
                        <td>Checked</td>
                        <td>By</td>
                        <td>Get This</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr id="acc{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            @if($item->user_id==auth()->user()->id)
                                <td>
                                    {{ $item->email }}<br/>
                                    {{ $item->password }}
                                </td>
                            @else
                                <td>{{ $item->email }}</td>
                            @endif
                            <td>{{ $item->state}}</td>
                            <td>
                                {{ $item->no_order_6months }} |
                                {{ $item->order }}
                            </td>
                            <td>{{ !is_null($item->checked_out)?$item->checked_out->format("d/m/y"):"" }}</td>
                            <td>{{ is_object($item->user)?$item->user->name:"" }}</td>
                            <td><a href="{{ route("member.account.checkout",['id'=>$item->id]) }}">Get This</a></td>
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
