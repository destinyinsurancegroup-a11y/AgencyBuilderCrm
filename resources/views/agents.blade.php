@extends('layouts.app')
@section('title','Agents')

@section('content')
  <div class="section">
    <h3>Agents</h3>

    <p>This page will list all of your agents — both hired and networking — just like Destiny CRM’s agent tabs.</p>

    {{-- Add New Agent + Import --}}
    <div class="middle-actions">
      <button class="btn">+ Add New Agent</button>
      <form method="POST" action="#" enctype="multipart/form-data">
        @csrf
        <label class="import-label" for="fileUpload">Upload CSV / Excel</label>
        <input id="fileUpload" type="file" hidden>
      </form>
    </div>

    {{-- Example agent list --}}
    <div class="contact-list">
      <div class="contact-item">
        <span class="dot green"></span>
        <a class="name" href="#">Sarah Williams</a>
      </div>
      <div class="contact-item">
        <span class="dot red"></span>
        <a class="name" href="#">David Brown</a>
      </div>
      <div class="contact-item">
        <span class="dot green"></span>
        <a class="name" href="#">Lisa Thompson</a>
      </div>
    </div>

    {{-- Agent info panel --}}
    <div class="section" style="margin-top:20px;">
      <h3>Agent Details</h3>
      <p>When you select an agent, you’ll see more details here (commissions, policies, performance, etc.).</p>
    </div>
  </div>
@endsection
