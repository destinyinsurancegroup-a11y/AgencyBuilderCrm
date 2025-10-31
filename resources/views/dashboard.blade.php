@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<h1>Dashboard</h1>
<p class="subtitle">Good afternoon, Agent — here’s your daily overview.</p>

<div id="dashboardCards" class="card-grid">
    <div class="card" data-id="1">
        <h3>📊 Current Production</h3>
        <ul>
            <li>Calls: 35</li>
            <li>Presentations: 9</li>
            <li>Sales: 3</li>
            <li>Premium: $2,950</li>
        </ul>
    </div>

    <div class="card" data-id="2">
        <h3>📅 Upcoming Appointments</h3>
        <ul>
            <li>John Smith — Tues 2PM</li>
            <li>Maria Lopez — Wed 11AM</li>
        </ul>
    </div>

    <div class="card" data-id="3">
        <h3>🌟 Today’s Insights</h3>
        <ul>
            <li>2 Birthdays this week</li>
            <li>1 Anniversary coming up</li>
        </ul>
    </div>

    <div class="card" data-id="4">
        <h3>🆕 Recently Added</h3>
        <ul>
            <li>Olivia Chen — Lead</li>
            <li>James Carter — Client</li>
        </ul>
    </div>
</div>

<footer>© 2025 Agency Builder CRM — Tier 1</footer>

@push('scripts')
<script>
    // Enable drag & drop with Sortable.js
    new Sortable(document.getElementById('dashboardCards'), {
        animation: 150,
        ghostClass: 'sortable-ghost',
        dragClass: 'sortable-drag',
        chosenClass: 'sortable-chosen'
    });
</script>
@endpush
@endsection
