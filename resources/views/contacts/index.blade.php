@extends('layouts.app')
@section('title', 'All Contacts')

@section('content')
<div class="contacts-layout">

    <aside class="sidebar">
        <img src="{{ secure_asset('images/abc-logo.png') }}" class="sidebar-logo" alt="Agency Logo">
        <nav class="sidebar-nav">
            <a href="{{ url('/') }}">Dashboard</a>
            <a href="{{ url('/contacts') }}" class="active">All Contacts</a>
            <a href="{{ url('/book') }}">Book of Business</a>
            <a href="{{ url('/service') }}">Service Department</a>
            <a href="{{ url('/archive') }}">Service Archive</a>
            <a href="{{ url('/agents') }}">Hired Agents</a>
            <a href="{{ url('/networking') }}">Networking Agents</a>
            <a href="{{ url('/funeral') }}">Funeral Homes</a>
            <a href="{{ url('/pastors') }}">Church Pastors</a>
            <a href="{{ url('/calendar') }}">Calendar</a>
            <a href="{{ url('/settings') }}">Settings</a>
            <a href="{{ url('/logout') }}">Logout</a>
        </nav>
    </aside>

    <section class="middle">
        <div class="middle-actions">
            <div style="color:#fff;font-weight:700;">All Contacts</div>
            <div class="small">Total: {{ $total }}</div>
        </div>

        <div class="pager">
            <span class="meta">Showing {{ $from }}–{{ $to }} of {{ $total }}</span>
            <div>
                <a href="{{ $page > 1 ? '?page='.($page-1) : '#' }}" class="pg-btn" {{ $page <= 1 ? 'style=opacity:.4;pointer-events:none;' : '' }}>◄</a>
                <a href="{{ $page < $pages ? '?page='.($page+1) : '#' }}" class="pg-btn" {{ $page >= $pages ? 'style=opacity:.4;pointer-events:none;' : '' }}>►</a>
            </div>
        </div>

        <div class="search-wrap">
            <input type="text" id="contactSearch" class="search-input" placeholder="Search by name, email, or phone...">
        </div>

        <div class="contact-list" id="contactList">
            @forelse($contacts as $r)
            <div class="contact-item" data-name="{{ strtolower($r->name) }}" data-email="{{ strtolower($r->email) }}" data-phone="{{ preg_replace('/\D+/', '', $r->phone) }}">
                <a class="name" href="#">{{ $r->name }}</a>
                <div class="small">
                    {{ $r->grp }}
                    @if($r->email) • {{ $r->email }} @endif
                    @if($r->phone) • {{ $r->phone }} @endif
                </div>
            </div>
            @empty
            <div class="contact-item">No contacts found.</div>
            @endforelse
        </div>
    </section>

    <section class="right">
        <div class="section">
            <h3>How search works</h3>
            <div style="color:#222;line-height:1.5;">
                Start typing a <b>name</b>, <b>email</b>, or <b>phone</b> on the left.  
                We’ll scroll to a match if it’s on the current page, or  
                <b>jump to the correct page</b> automatically and highlight the contact.
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
function debounce(fn, ms){ let t; return (...args)=>{clearTimeout(t);t=setTimeout(()=>fn(...args),ms);} }
function digitsOnly(s){ return (s||'').replace(/\D+/g,''); }

const focusItem = (el)=>{
    el.scrollIntoView({behavior:'smooth', block:'center'});
    el.classList.add('flash');
    setTimeout(()=>el.classList.remove('flash'), 1500);
};

document.getElementById('contactSearch').addEventListener('input', debounce(e=>{
    const q = e.target.value.toLowerCase();
    const qd = digitsOnly(q);
    if(!q){ return; }
    const items = [...document.querySelectorAll('.contact-item')];
    const match = items.find(i=>{
        return i.dataset.name.startsWith(q) || i.dataset.email.startsWith(q) || (qd && i.dataset.phone.startsWith(qd));
    }) || items.find(i=>{
        return i.dataset.name.includes(q) || i.dataset.email.includes(q) || (qd && i.dataset.phone.includes(qd));
    });
    if(match){ focusItem(match); }
}, 200));
</script>
@endpush
@endsection
