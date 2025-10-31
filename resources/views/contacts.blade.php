@extends('layouts.app')
@section('title','All Contacts')

@section('content')
  <div class="section">
    <h3>All Contacts</h3>

    <p>Below is a placeholder example of what will soon show your contacts list, search bar, and details — just like Destiny CRM.</p>

    {{-- Add New Contact + Import --}}
    <div class="middle-actions">
      <button class="btn">+ Add New Contact</button>
      <form method="POST" action="#" enctype="multipart/form-data">
        @csrf
        <label class="import-label" for="fileUpload">Upload CSV / Excel</label>
        <input id="fileUpload" type="file" hidden>
      </form>
    </div>

    {{-- Search bar --}}
    <div class="search-wrap">
      <input type="text" class="search-input" placeholder="Search by name, phone, or email...">
    </div>

    {{-- Example contact list --}}
    <div class="contact-list">
      <div class="contact-item">
        <span class="dot green"></span>
        <a class="name" href="#">John Smith</a>
      </div>
      <div class="contact-item">
        <span class="dot red"></span>
        <a class="name" href="#">Jane Doe</a>
      </div>
      <div class="contact-item">
        <span class="dot green"></span>
        <a class="name" href="#">Michael Johnson</a>
      </div>
    </div>

    {{-- Contact detail panel --}}
    <div class="section" style="margin-top:20px;">
      <h3>Contact Information</h3>
      <p>Select a contact on the left to see full details here. Later we’ll connect this to your database.</p>
    </div>

  </div>
@endsection
