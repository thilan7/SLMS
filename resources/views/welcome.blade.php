@extends('layouts.master')

@section('title')
    welcome!
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        {{--<div class="col-md-6">--}}
            {{--<h3>Sign Up</h3>--}}
            {{--<form action="{{route('signup')}}" method="post">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="email"> Your email</label>--}}
                    {{--<input class="form-control" type="text" name="email" id="email">--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label for="first_name"> First Name</label>--}}
                    {{--<input class="form-control" type="text" name="first_name" id="first_name">--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label for="password"> Password</label>--}}
                    {{--<input class="form-control" type="password" name="password" id="password">--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                {{--<input type="hidden" name="_token" value="{{Session::token()}}">--}}
            {{--</form>--}}
        {{--</div>--}}
        <div class="col-md-6">
            <h3>Sign In</h3>
            <form action="{{route('signin')}}" method="post">
                <div class="form-group">
                    <label for="email"> Your email</label>
                    <input class="form-control" type="text" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="password"> Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
        </div>

    </div>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Librarian`s Notices</h3></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{$post->id}}">
                    <p>{{$post->body}}</p>
                    <div class="info">
                        {{$post->created_at}}
                    </div>
                </article>
            @endforeach
        </div>

    </section>
@endsection