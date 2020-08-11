<div class="sidebar" data-color="orange">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
    <div class="logo">
        <a href="{{ url('/') }}" class="simple-text logo-mini">
            {{ config('app.name', 'Laravel') }}
        </a>
        <a href="{{ route('home') }}" class="simple-text logo-normal">
            admin
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li class="@if('home' === Route::currentRouteName()) active @endif">
                <a href="{{ route('home') }}">
                    <i class="fas fa-home"></i>
                    <p>Home</p>
                </a>
            </li>
            @if (Auth::user()->role === 'admin')
                <li class="@if('users.index' === Route::currentRouteName()) active @endif">
                    <a href="{{ route('users.index') }}">
                        <i class="fas fa-users"></i>
                        <p>User Accounts</p>
                    </a>
                </li>
                <li class="@if('services.index' === Route::currentRouteName()) active @endif">
                    <a href="{{ route('services.index') }}">
                        <i class="fas fa-briefcase"></i>
                        <p>Services</p>
                    </a>
                </li>
            @endif
            <li>
                <a href="./reports.html">
                    <i class="now-ui-icons education_atom"></i>
                    <p>Reports</p>
                </a>
            </li>
            <li>
                <a href="./complaints.html">
                    <i class="now-ui-icons education_atom"></i>
                    <p>Complaints</p>
                </a>
            </li>
            <li>
                <a href="./logs.html">
                    <i class="now-ui-icons education_atom"></i>
                    <p>Logs</p>
                </a>
            </li>
        </ul>
    </div>
</div>
