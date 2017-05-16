@extends('layouts.master')
@section('title')
    Add Student
@endsection
@section('content')
    @include('includes.message-block')

    <div class="col-md-6">
        <h3>Add Student</h3>
        <form action="{{route('signup')}}" method="post">
            <div class="form-group">
                <label for="first_name">  first_name</label>
                <input class="form-control" placeholder="Thilan" type="text" name="first_name" id="first_name">
            </div>
            <div class="form-group">
                <label for="last_name"> last_name</label>
                <input class="form-control" type="text" placeholder="Bandara" name="last_name" id="last_name">
            </div>
            <div class="form-group">
                <label for="admission_number"> admission_number</label>
                <input class="form-control" type="text" name="admission_number" placeholder="140066T" id="admission_number">
            </div>
            <div class="form-group">
                <label for="email"> email</label>
                <input class="form-control" type="text" placeholder="thilan.k.bandara@gmail.com" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="birth_day"> birth_day</label>
                <input class="form-control" type="text" placeholder="1994-03-03" name="birth_day" id="birth_day">
            </div>
            <div class="form-group">
                <label for="telephone"> telephone</label>
                <input class="form-control" type="text" placeholder="0757995753" name="telephone" id="telephone">
            </div>
            <div class="form-group">
                <label for="password"> password</label>
                <input class="form-control" type="text" name="password" id="password">
            </div>

            <select class="form-group form-control" name="user_level" id="user_level">
                <option value='admin'>Admin</option>
                <option value='student'>Student</option>
            </select>

            <button type="submit" class="btn btn-primary">Submit</button>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>
@endsection

