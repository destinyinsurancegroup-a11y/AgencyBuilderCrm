<aside class="sidebar">
  <img src="{{ asset('abc-logo.png') }}" class="sidebar-logo" alt="ABC">
  <nav class="sidebar-nav">
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('book') }}" class="{{ request()->routeIs('book') ? 'active' : '' }}">Book of Business</a>
    <a href="{{ route('contacts') }}" class="{{ request()->routeIs('contacts') ? 'active' : '' }}">All Contacts</a>
    <a href="{{ route('agents') }}" class="{{ request()->routeIs('agents') ? 'active' : '' }}">Agents</a>
    <a href="{{ route('calendar') }}" class="{{ request()->routeIs('calendar') ? 'active' : '' }}">Calendar</a>
    <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}">Settings</a>
    <a href="{{ route('logout') }}">Logout</a>
  </nav>
</aside>
