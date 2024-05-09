@extends('app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h3>Current Balance: {{$balance}}</h3>
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
                @foreach ($transaction as $key=>$row)
                    <tr>
                        <td>{{$key++}}</td>
                        <td>{{$row->date}}</td>
                        <td>{{$row->transaction_type}}</td>
                        <td>{{$row->amount}}</td>
                        <td>{{$row->fee}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
