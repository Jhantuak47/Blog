

<div id='cssmenu'>
<ul class = "nav navbar-anv navbar-left">
    <a class="navbar-brand" href="{{ url('/') }}">
      {{ config('app.name', 'Laravel') }}
  </a>
   <li><a href='/'>Home</a></li>
   <li><a href='/services'>Service</a></li>
   <li><a href='/about'>About</a></li>
   <li><a href='/post'>Blog</a></li>
</ul>

      <!-- Authentication Links -->
<ul class = "nav navbar-anv navbar-right">
      @guest
          <li align= "left"><a href="{{ route('login') }}">Login</a></li>
          <li><a href="{{ route('register') }}">Register</a></li>
      @else
          <li>
              <a href = "/home">
                  {{ Auth::user()->name }}
              </a>
          </li>
          <li>
              <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                          Logout
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                 </form>
            </li>
      @endguest
</ul>
</div>

