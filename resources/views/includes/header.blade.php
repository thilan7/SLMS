<header>
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>--}}
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js'></script>--}}

    <script type="text/javascript" src="{{ URL::asset('js/sticky.js') }}"></script>


    <link rel="stylesheet" href="{{ URL::asset('/css/navigationbar.css') }}">

    <div class="logo">
        {{--<h1 class="logo">Company Logo</h1>--}}
        <a href="/">
            <img src="images/lib.png"   alt="Library Logo" width="301" height="86" class="thumbs" />
        </a>
    </div>
    <div class="topnav">
        <h2 class="company">~ e - lib ~</h2>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Facilities</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="{{route('logout')}}">LOGOUT</a></li>

            </ul>
        </nav>
    </div>
</header>
<main>
    <div class="mmain">
        @yield('allContent')
    </div>
</main>