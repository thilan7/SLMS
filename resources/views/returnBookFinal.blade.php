@extends('layouts.master')
@section('title')
    Return Book
@endsection
@section('content')
    @include('includes.message-block')
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h2>Return Details</h2></header>

            <?php $v=$bookDetail ?>
            <article class="post" data-postid="{{$v->id}}">
                {{$a=null}}
                {{$r=null}}
                @if($v->availability==1)
                    <?php $a="available" ?>
                @endif
                @if($v->availability==0)
                    <?php $a="not available" ?>
                @endif
                @if($v->reference==1)
                    <?php $r="reference book" ?>
                @endif
                @if($v->reference==0)
                    <?php $r="not a reference book" ?>
                @endif
                <h3>Book Details</h3>
                <p>Book_ID | {{$v->book_id}}</p>
                <p>Title | {{$v->title}}</p>
                <p>Author | {{$v->author}}</p>
                <p>ISBN Number | {{$v->isbn_number}}</p>
                <p>Description | {{$v->description}}</p>
                <p>Reference | {{$r}}</p>
                <p>Availability |{{$a}} </p>
                <div class="info">
                    Date Added | {{$v->created_at}}
                </div>

                <h3>User Details</h3>
                <p>admission_number | {{$studentDetail->admission_number}}</p>
                <p>first_name | {{$studentDetail->first_name}}</p>
                <p>last_name | {{$studentDetail->last_name}}</p>
                <p>email | {{$studentDetail->email}}</p>
                <p>telephone | {{$studentDetail->telephone}}</p>

                <div class="info">
                    Date account created | {{$studentDetail->created_at}}
                </div>

                <h3>Transaction Details</h3>
                <p>due_date | {{$transactionObject->due_date}}</p>
                <p>burrowed_date | {{$transactionObject->burrowed_date}}</p>
                <p>fine | Rs. {{$fine}}/=</p>
            </article>
            <form action="{{route('return-BOOk',['book_id'=>$v->book_id])}}" method="post">
                <button type="submit" class="btn btn-primary">Return</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
        </div>
    </section>
@endsection