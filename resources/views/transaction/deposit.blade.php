@extends('app')
@section('content')
<form  action="{{ route('deposit-store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12 text-center mt-5">
            <h3>Deposit</h3>
        </div>
        <div class="col-md-12  row">
            <div class="form-group col-md-4 row">
                <div class="form-label col-md-4">Amount</div>
                <div class="col-md-8">
                    <input type="number" class="form-control amount" name="amount" autocomplete="off">
                </div>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary">Deposit</button>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-md-12">
        <h3>All Deposit</h3>
    </div>
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Date</th>
                    <th>Transaction Type</th>
                    <th>Amount</th>
                    <th>Fee</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deposit as $key=>$row)
                <tr>
                    <td>{{$key++}}</td>
                    <td>{{$row->date}}</td>
                    <td>Deposit</td>
                    <td>{{$row->amount}}</td>
                    <td>{{$row->fee}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection
