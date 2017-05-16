@extends('layouts.master')
@section('title')
    Edit Book
@endsection
@section('content')
    @include('includes.message-block')



    {{--$table->string('book_id');--}}
    {{--$table->string('isbn_number');--}}
    {{--$table->string('title');--}}
    {{--$table->string('author');--}}
    {{--$table->boolean('reference');--}}
    {{--$table->boolean('availability'); // whether the book is removed from the library or not--}}
    {{--$table->string('description');--}}
    {{--});--}}
    {{----}}
    <div class="col-md-6">
        <h3>Edit Book</h3>
        <form action="{{route('bookEdit')}}" method="post">
            <input type="hidden" name="ID" id="ID" value="{{$book->id}}">
            <div class="form-group">
                <label for="bookID"> Book ID</label>
                <input class="form-control" placeholder="{{$book->book_id}}" type="text" name="bookID" id="bookID">
            </div>
            <div class="form-group">
                <label for="title"> Title</label>
                <input class="form-control" type="text" placeholder="{{$book->title}}"    name="title" id="title">
            </div>
            <div class="form-group">
                <label for="author"> Author</label>
                <input class="form-control" type="text"     placeholder="{{$book->author}}"
                       name="author" id="author">
            </div>
            <div class="form-group">
                <label for="isbn"> ISBN</label>
                <input class="form-control" type="text"    placeholder="{{$book->isbn_number}}"
                       name="isbn" id="isbn">
            </div>

            <div class="form-group">
                <label for="description"> Description</label>
                <textarea class="form-control" name="description" id="description"
                          placeholder="{{$book->description}}"></textarea>
            </div>


            <select class="form-group form-control" name="reference" id="reference">
                <option value=1>Reference</option>
                <option value=0>Non Reference</option>
            </select>

            <button type="submit" class="btn btn-primary">Edit</button>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>
@endsection