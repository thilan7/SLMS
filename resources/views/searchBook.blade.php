@extends('layouts.master')
@section('title')
    search Book
@endsection
@section('content')

    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h2>Search Results</h2></header>
            @foreach($var as $v)
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
                    <div class="interaction">
                        @if(Auth::user()==null)

                        @elseif(Auth::user()->user_level =="admin")
                            <a href="{{route('book.edit',['book_id'=>$v->id])}}">Edit</a> |
                            <a href="{{route('book.delete',['book_id'=>$v->id])}}" class="delete">Delete</a> |
                        @endif
                        @if(Auth::user()!=null)
                                @if($v->availability==1 and $v->reference==0)
                                        <a href="{{route('book.reserve',['book_id'=>$v->id])}}" class="reserve">Reserve</a> |
                                @endif
                                @if($v->availability==0 and $v->reference==0)
                                        <?php
                                            $ff=0;
                                        $t=\App\Transaction::where('book_id', $v->book_id )->get();
                                            if(sizeof($t)>0){
                                                $ff=$t[0]->student_id;
                                            }
                                        ?>
                                        @if(Auth::user()->admission_number==$ff)
                                            <a href="{{route('book.unreserve',['book_id'=>$v->id])}}" class="Unreserve">Unreserve</a> |
                                        @elseif(Auth::user()->admission_number!=$ff)
                                            <a href="#" class="Reserved">Reserved</a> |


                                            @endif
                                    @endif
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

    </section>

@endsection