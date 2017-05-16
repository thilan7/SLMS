@extends('layouts.master')
@section('title')
    Lend a Book
@endsection
@section('content')
    @include('includes.message-block')
    <div class="col-md-6">
        <h3>Lend Book</h3>
        <form action="{{route('lendBook')}}" method="post">
            <div class="form-group">
                <label for="bookID"> Book ID</label>
                <input class="form-control" type="text" name="bookID" id="bookID">
            </div>
            <div class="form-group">
                <label for="title"> Student ID</label>
                <input class="form-control" type="text" name="studentID" id="studentID">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>
    @endsection