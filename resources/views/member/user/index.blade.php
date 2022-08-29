@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route("member.user.index") }}" method="get" class="form-inline">
                    <div class="form-group">
                        <label for="name">From</label>
                        <input type="date" class="form-control" id="from" name="from" value="{{ $from }}">
                    </div><div class="form-group">
                        <label for="email">To</label>
                        <input type="date" class="form-control" id="to" name="to" value="{{ $to }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">search</button>
                </form>
            </div>
            <div class="col-12 bg-white m-1">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Date</td>
                        <td>Get</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $t = 0;?>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->date }}</td>
                            <td>
                               {{ $item->gets }}
                            </td>
                        </tr>
                        <?php  $t +=$item->gets ;  ?>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td></td>
                        <td colspan="10">{{ number_format($t) }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
