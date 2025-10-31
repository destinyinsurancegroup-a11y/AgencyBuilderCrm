@extends('layouts.app')
@section('title','Calendar')

@section('content')
  <div class="section">
    <h3>Calendar</h3>

    <p>This page will show appointments, policy renewals, birthdays, and tasks from your CRM schedule.</p>

    {{-- Example calendar box --}}
    <div class="section" style="margin-top:20px; background:#fff; color:#000;">
      <h3 style="border-left:4px solid var(--gold); padding-left:8px;">Upcoming Events</h3>
      <ul style="list-style:none; padding-left:10px;">
        <li>📅 Nov 3 — Meeting with John Smith (Life Policy Renewal)</li>
        <li>📅 Nov 4 — Team training call with agents</li>
        <li>📅 Nov 5 — Client birthday: Sarah Johnson</li>
      </ul>
    </div>

    <div class="section" style="margin-top:20px;">
      <h3>Add New Event</h3>
      <form>
        <input type="text" placeholder="Event name" class="search-input" style="margin-bottom:8px;">
        <input type="date" class="search-input" style="margin-bottom:8px;">
        <button class="btn">Save Event</button>
      </form>
    </div>
  </div>
@endsection
