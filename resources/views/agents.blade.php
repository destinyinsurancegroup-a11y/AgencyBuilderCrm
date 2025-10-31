@extends('layouts.app')

@section('title', 'Agents')

@section('content')
    <h2>Agents</h2>
    <p>This page lists all agents — both hired and networking — just like Destiny CRM’s agent tabs.</p>

    <button class="btn">+ Add New Agent</button>
    <p>Upload CSV / Excel</p>

    <ul>
        <li>Sarah Williams</li>
        <li>David Brown</li>
        <li>Lisa Thompson</li>
    </ul>

    <h3>Agent Details</h3>
    <p>When you select an agent, you’ll see more details here (commissions, policies, performance, etc.).</p>
@endsection
