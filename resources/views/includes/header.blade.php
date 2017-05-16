<header>
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>--}}
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js'></script>--}}

    <script type="text/javascript" src="{{ URL::asset('js/sticky.js') }}"></script>


    <link rel="stylesheet" href="{{ URL::asset('/css/navigationbar.css') }}">

    <div class="logo">
        {{--<h1 class="logo">Company Logo</h1>--}}
        <a href="/">
            <img src="images/lib.png" alt="Library Logo" width="301" height="86" class="thumbs"/>
        </a>
    </div>
    <div class="topnav">
        <h2 class="company">~ e - lib ~</h2>
        <nav>
            <ul>
                <li><a href="{{route('homeButtionPress')}}">Home</a></li>
                <li><a href="{{route('aboutUs')}}">About Us</a></li>
                <li><a href="{{route('facilities')}}">Facilities</a></li>
                <li><a href="{{route('services')}}">Services</a></li>
                <li><a href="{{route('contactUs')}}">Contact Us</a></li>
                <li><a href="{{route('logout')}}">LOGOUT</a></li>

            </ul>
        </nav>

    </div>
    {{--<div>--}}
        {{--<form action="{{route('searchbook')}}" method="post" class="navbar-form navbar-left SearchBarHeader" role="search">--}}
            {{--<div class="form-group">--}}
                {{--<input type="text" class="form-control" placeholder="Search" name="keyword" id="keyword">--}}
            {{--</div>--}}
            {{--<select class="form-group form-control" name="searchBy" id="searchBy">--}}
                {{--<option value=0>Title</option>--}}
                {{--<option value=1>Author</option>--}}
                {{--<option value=2>ISBN</option>--}}
                {{--<option value=3>Description</option>--}}
                {{--<option value=4>Book ID</option>--}}

            {{--</select>--}}
            {{--<button type="submit" class="btn btn-default">Submit</button>--}}
            {{--<input type="hidden" name="_token" value="{{Session::token()}}">--}}
        {{--</form>--}}
    {{--</div>--}}
</header>
<main>

    <div class="mmain">
        <div>
            <form action="{{route('searchbook')}}" method="post" class="navbar-form navbar-left SearchBarHeader" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="keyword" id="keyword">
                </div>
                <select class="form-group form-control" name="searchBy" id="searchBy">
                    <option value=0>Title</option>
                    <option value=1>Author</option>
                    <option value=2>ISBN</option>
                    <option value=3>Description</option>
                    <option value=4>Book ID</option>

                </select>
                <button type="submit" class="btn btn-default">Search</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
        </div>
        @yield('contentt')
    </div>
</main>