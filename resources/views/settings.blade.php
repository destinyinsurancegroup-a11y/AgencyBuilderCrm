@extends('layouts.app')
@section('title','Settings')

@section('content')
  <div class="section">
    <h3>Settings</h3>

    <p>This page lets you update your account details, logo, and system preferences for your agency.</p>

    <div class="section" style="margin-top:20px;">
      <h3>Account Information</h3>
      <form>
        <label style="display:block; color:#b07900;">Agency Name</label>
        <input type="text" class="search-input" placeholder="Agency Builder CRM" style="margin-bottom:8px;">

        <label style="display:block; color:#b07900;">Contact Email</label>
        <input type="email" class="search-input" placeholder="admin@agencybuildercrm.com" style="margin-bottom:8px;">

        <button class="btn">Save Changes</button>
      </form>
    </div>

    <div class="section" style="margin-top:20px;">
      <h3>Branding</h3>
      <p>You can upload your ABC logo or update theme colors here.</p>
      <form method="POST" action="#" enctype="multipart/form-data">
        @csrf
        <label class="import-label" for="logoUpload">Upload New Logo</label>
        <input id="logoUpload" type="file" hidden>
      </form>
    </div>
  </div>
@endsection
