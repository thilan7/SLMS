@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
    @include('includes.message-block')


    @if(Auth::user()==null)
    @elseif(Auth::user()->user_level !="admin")

        <div class="TransactionTable">
            @if(sizeof($transactions)==0)

            @else
                {{--{{var_dump($transactions)}}--}}
                {{--{{var_dump(Auth::user()->admission_number)}}--}}
                <section class="row posts">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="container">
                            <h2>Your Book Transactions!</h2>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Title of the book</th>
                                    <th>Reserved date</th>
                                    <th>Burrowed date</th>
                                    <th>Due date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transactionn)
                                    <tr>
                                        <?php $book = \App\Book::where('book_id',$transactionn->book_id )->first() ?>
                                        <td>{{$book->title}}</td>
                                        <td>{{$transactionn->reserved_date}}</td>
                                        <td>{{$transactionn->burrowed_date}}</td>
                                        <td>{{$transactionn->due_date}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            @endif
        </div>
        <section class="row posts">
            <div class="col-md-6 col-md-offset-3">
                <header><h2>New Entries!!!</h2></header>
                @foreach($books as $v)
                    <article class="post" data-postid="{{$v->id}}">
                        {{$a=null}}
                        {{$r=null}}
                        @if($v->availability==1)
                            <?php $a = "available" ?>
                        @endif
                        @if($v->availability==0)
                            <?php $a = "not available" ?>
                        @endif
                        @if($v->reference==1)
                            <?php $r = "reference book" ?>
                        @endif
                        @if($v->reference==0)
                            <?php $r = "not a reference book" ?>
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
                            @if(Auth::user()!=null)
                                @if($v->availability==1 and $v->reference==0)
                                    <a href="{{route('book.reserve',['book_id'=>$v->id])}}" class="reserve">Reserve</a>
                                    |
                                @endif
                                @if($v->availability==0 and $v->reference==0)
                                    <?php
                                    $ff = 0;
                                    $t = \App\Transaction::where('book_id', $v->book_id)->get();
                                    if (sizeof($t) > 0) {
                                        $ff = $t[0]->student_id;
                                    }
                                    ?>
                                    {{--{{dd($ff)}}--}}
                                    @if(Auth::user()->admission_number==$ff)
                                        <a href="{{route('book.unreserve',['book_id'=>$v->id])}}" class="Unreserve">Unreserve</a>
                                        |
                                    @elseif(Auth::user()->admission_number!=$ff)
                                        <a href="#" class="Reserved">Reserved</a> |
{{--                                            {{dd($ff)}}--}}
                                        @endif
                                @endif
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>

        </section>

    @elseif(Auth::user()->user_level =="admin")
        <br>
        <br>
        <br>
        <div class="ButtonGroup">
            <!-- Split button -->
            <div class="btn-group">
                <button type="button" class="btn btn-success">Book</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="{{route("add")}}">Add Books</a></li>
                    {{--<li><a href="#">Another action</a></li>--}}
                    {{--<li><a href="#">Something else here</a></li>--}}
                    {{--<li role="separator" class="divider"></li>--}}
                    {{--<li><a href="#">Separated link</a></li>--}}
                </ul>
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-danger">Student</button>
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="{{route("addStudents")}}">Add Students</a></li>
                </ul>
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-primary">Transaction</button>
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="{{route("transaction")}}">Lend Book</a></li>
                    <li><a href="{{route("returnBook")}}">Return Book</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{route("transactionHistory")}}">Transaction History</a></li>
                </ul>
            </div>
        </div>
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <header><h3>Add Notice</h3></header>
                <form action="{{route('post.create')}}" method="post">
                    <div class="form-group">
                        <textarea class="form-control" name="body" id="new-post" rows="5"
                                  placeholder="your post"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                </form>
            </div>
        </section>

        <section class="row posts">
            <div class="col-md-6 col-md-offset-3">
                <header><h3>Previous Notices</h3></header>
                @foreach($posts as $post)
                    <article class="post" data-postid="{{$post->id}}">
                        <p>{{$post->body}}</p>
                        <div class="info">
                            {{$post->created_at}}
                            {{--Posted by {{$post->user->first_name}} + datte--}}
                        </div>
                        <div class="interaction">
                            <a href="#" class="edit">Edit</a> |
                            <a href="{{route('post.delete',['post_id'=>$post->id])}}">Delete</a>
                        </div>
                    </article>
                @endforeach
            </div>

        </section>
        <div class="TransactionTable">
            @if(sizeof($transactions)==0)
                {{--{{var_dump($transactions)}}--}}
                {{--{{var_dump(Auth::user()->admission_number)}}--}}
            @else
                <section class="row posts">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="container">
                            <h2>Your Book Transactions!</h2>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Title of the book</th>
                                    <th>Reserved date</th>
                                    <th>Burrowed date</th>
                                    <th>Due date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transactionn)
                                    <tr>
                                        {{--{{ $book = Book::where('book_id',$transactionn->book_id )->first()}}--}}
                                        <?php $book = \App\Book::where('book_id',$transactionn->book_id )->first() ?>

                                        <td>{{$book->title}}</td>
                                        <td>{{$transactionn->reserved_date}}</td>
                                        <td>{{$transactionn->burrowed_date}}</td>
                                        <td>{{$transactionn->due_date}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            @endif
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Notice</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="post-body">Edit the Post</label>
                                <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script>
            var token = '{{Session::token()}}';
            var url = '{{route('edit')}}';
        </script>
    @endif
@endsection