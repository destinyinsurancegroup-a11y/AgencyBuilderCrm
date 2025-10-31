@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<h1 id="greeting"></h1>
<p id="datetime" class="subtitle"></p>

<div class="search-container">
    <input type="text" id="globalSearch" placeholder="Search contacts, leads, or clients..." />
    <button class="search-btn">🔍</button>
</div>

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
            <li>John Smith — Tues 2 PM</li>
            <li>Maria Lopez — Wed 11 AM</li>
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
    // ----- GREETING + LIVE DATE/TIME -----
    function updateGreeting() {
        const now = new Date();
        const hour = now.getHours();

        // Laravel user name passed from backend
        const userName = "{{ Auth::user()->name ?? 'Agent' }}";
        let greeting;

        if (hour < 12) greeting = "Good morning";
        else if (hour < 18) greeting = "Good afternoon";
        else greeting = "Good evening";

        document.getElementById("greeting").textContent = `${greeting}, ${userName}.`;
        document.getElementById("datetime").textContent =
            now.toLocaleString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
    }

    updateGreeting();
    setInterval(updateGreeting, 60000);

    // ----- DRAGGABLE CARDS -----
    new Sortable(document.getElementById('dashboardCards'), {
        animation: 150,
        ghostClass: 'sortable-ghost',
        dragClass: 'sortable-drag',
        chosenClass: 'sortable-chosen'
    });

    // ----- SEARCH BAR -----
    document.querySelector('.search-btn').addEventListener('click', () => {
        const query = document.getElementById('globalSearch').value.trim();
        if (query) alert(`Searching for "${query}" (feature coming soon).`);
    });
</script>
@endpush
@endsection
