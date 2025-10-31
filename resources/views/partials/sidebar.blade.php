<div class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ secure_asset('images/abc-logo.png') }}" alt="Agency Builder CRM Logo" class="sidebar-logo-img">
        <h2>AGENCY BUILDER<br><span>CRM</span></h2>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ url('/') }}">Dashboard</a>
        <a href="{{ url('/book') }}">Book of Business</a>
        <a href="{{ url('/contacts') }}">All Contacts</a>
        <a href="{{ url('/agents') }}">Agents</a>
        <a href="{{ url('/calendar') }}">Calendar</a>
        <a href="{{ url('/settings') }}">Settings</a>
        <a href="{{ url('/logout') }}">Logout</a>
    </nav>
</div>
