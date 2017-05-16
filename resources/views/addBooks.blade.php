@extends('layouts.master')
@section('title')
    Add Book
@endsection
@section('content')
    @include('includes.message-block')


    <div class="col-md-6">
        <h3>Add Book</h3>
        <form action="{{route('addbook')}}" method="post">
            <div class="form-group">
                <label for="bookID"> Book ID</label>
                <input class="form-control" type="text" name="bookID" id="bookID">
            </div>
            <div class="form-group">
                <label for="title"> Title</label>
                <input class="form-control" type="text" name="title" id="title">
            </div>
            <div class="form-group">
                <label for="author"> Author</label>
                <input class="form-control" type="text" name="author" id="author">
            </div>
            <div class="form-group">
                <label for="isbn"> ISBN</label>
                <input class="form-control" type="text" name="isbn" id="isbn">
            </div>

            <div class="form-group">
                <label for="description"> Description</label>
                <textarea class="form-control" name="description" id="description"
                          placeholder="Enter text here"></textarea>
            </div>


            <select class="form-group form-control" name="reference" id="reference">
                <option value=1>Reference</option>
                <option value=0>Non Reference</option>
            </select>

            <button type="submit" class="btn btn-primary">Submit</button>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>
@endsection