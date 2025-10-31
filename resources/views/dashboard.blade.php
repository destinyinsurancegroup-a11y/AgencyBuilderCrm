@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<h1>Dashboard</h1>
<p>Good afternoon, Agent — here’s your daily overview.</p>

<div class="card-grid">
    <div class="card">
        <h3>📊 Current Production</h3>
        <ul>
            <li>Calls: 35</li>
            <li>Presentations: 9</li>
            <li>Sales: 3</li>
            <li>Premium: $2,950</li>
        </ul>
    </div>

    <div class="card">
        <h3>📅 Upcoming Appointments</h3>
        <ul>
            <li>John Smith — Tues 2PM</li>
            <li>Maria Lopez — Wed 11AM</li>
        </ul>
    </div>

    <div class="card">
        <h3>🌟 Today’s Insights</h3>
        <ul>
            <li>2 Birthdays this week</li>
            <li>1 Anniversary coming up</li>
        </ul>
    </div>

    <div class="card">
        <h3>🆕 Recently Added</h3>
        <ul>
            <li>Olivia Chen — Lead</li>
            <li>James Carter — Client</li>
        </ul>
    </div>
</div>

<footer>
    © 2025 Agency Builder CRM — Tier 1
</footer>
@endsection
