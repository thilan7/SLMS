@extends('layouts.master')
@section('title')
    Transaction History
@endsection
@section('content')
    @include('includes.message-block')

<div class="TransactionTable">
    @if(sizeof($data)==0)
        {{dd(sizeof($data))}}
    @else
        <section class="row posts">
            <div class="col-md-6 col-md-offset-3">
                <div class="container">
                    <h2>Transactions History!</h2>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Book ID</th>
                            <th>Reserved date</th>
                            <th>Burrowed date</th>
                            <th>Returned date</th>
                            <th>Due date</th>
                            <th>Fine</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{$d->student_id}}</td>
                                <td>{{$d->book_id}}</td>
                                <td>{{$d->reserved_date}}</td>
                                <td>{{$d->burrowed_date}}</td>
                                <td>{{$d->returned_date}}</td>
                                <td>{{$d->due_date}}</td>
                                <td>{{$d->fine}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @endif
</div>
@endsection