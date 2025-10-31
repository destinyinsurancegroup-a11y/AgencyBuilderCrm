<div class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ secure_asset('images/abc-logo.png') }}" alt="Agency Builder CRM Logo" class="sidebar-logo-img">
        <h2 class="logo-text">AGENCY BUILDER<br><span>CRM</span></h2>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ url('/contacts') }}" class="{{ request()->is('contacts') ? 'active' : '' }}">All Contacts</a>
        <a href="{{ url('/book') }}" class="{{ request()->is('book') ? 'active' : '' }}">Book of Business</a>
        <a href="{{ url('/leads') }}" class="{{ request()->is('leads') ? 'active' : '' }}">Leads</a>
        <a href="{{ url('/service') }}" class="{{ request()->is('service') ? 'active' : '' }}">Service</a>
        <a href="{{ url('/calendar') }}" class="{{ request()->is('calendar') ? 'active' : '' }}">Calendar / Activity</a>
        <a href="{{ url('/activity') }}" class="{{ request()->is('activity') ? 'active' : '' }}">Activity</a>
        <a href="{{ url('/billing') }}" class="{{ request()->is('billing') ? 'active' : '' }}">Billing</a>
        <a href="{{ url('/settings') }}" class="{{ request()->is('settings') ? 'active' : '' }}">Settings</a>
        <a href="{{ url('/logout') }}">Logout</a>
    </nav>
</div>
