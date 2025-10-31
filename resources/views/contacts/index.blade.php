{{-- resources/views/contacts/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Contacts')

@section('content')
<style>
:root{
  --gold:#D4AF37; --bg:#0b0b0c; --panel:#131316; --soft:#1b1b20; --paper:#fffdf7; --line:#e7e3cc; --ink:#111;
}
*{box-sizing:border-box}
body{background:var(--bg);}
.layout-contacts{display:flex;min-height:calc(100vh - 60px);} /* adjust if header height differs */

/* Sidebar (keep if your app layout doesn't already include it) */
.sidebar{width:270px;background:#000 url("/assets/dazz.png") no-repeat center/cover;position:relative;display:flex;flex-direction:column;align-items:center;padding:24px 16px;}
.sidebar::before{content:"";position:absolute;inset:0;background:rgba(0,0,0,0.72);}
.sidebar *{position:relative;z-index:1;}
.sidebar-logo{width:360px;max-width:100%;filter:drop-shadow(0 0 6px rgba(212,175,55,.9));margin-bottom:10px;}
.sidebar-nav{width:100%;margin-top:10px;}
.sidebar-nav a{display:block;color:#fff;text-decoration:none;padding:10px 12px;margin-bottom:6px;border-radius:8px;border:1px solid rgba(212,175,55,.25);background:linear-gradient(180deg,rgba(255,255,255,.02),rgba(0,0,0,.25));transition:.18s;font-size:14px;}
.sidebar-nav a:hover{border-color:var(--gold);box-shadow:0 0 12px rgba(212,175,55,.35);}
.sidebar-nav a.active{background:rgba(212,175,55,.15);border-color:var(--gold);font-weight:600;}

/* Middle list column */
.middle{width:600px;max-width:620px;background:var(--panel);border-right:1px solid rgba(212,175,55,.35);display:flex;flex-direction:column;}
.middle-actions{display:flex;align-items:center;justify-content:space-between;padding:12px;border-bottom:1px solid rgba(212,175,55,.25);background:linear-gradient(180deg,rgba(212,175,55,.06),rgba(0,0,0,0)); color:#fff; font-weight:700;}
.pager{display:flex;align-items:center;justify-content:space-between;padding:8px 12px;border-bottom:1px solid rgba(255,255,255,.06);background:var(--soft);}
.pager .meta{font-size:12px;color:var(--gold);}
.pg-btn{background:var(--gold);color:#000;border:none;padding:6px 10px;border-radius:8px;font-weight:800;cursor:pointer;}
.pg-btn[disabled]{opacity:.35;cursor:not-allowed;}

.search-wrap{padding:8px 12px;border-bottom:1px solid rgba(255,255,255,.06);background:var(--soft);}
.search-input{width:100%;padding:10px 12px;border-radius:10px;border:1px solid var(--gold);background:#0a0a0a;color:#fff;font-size:14px;outline:none;}

.contact-list{flex:1;overflow-y:auto;padding:10px;}
.contact-item{display:flex;align-items:center;gap:8px;padding:10px;border-radius:10px;margin-bottom:6px;background:rgba(255,255,255,.02);border:1px solid rgba(255,255,255,.06);transition:.15s;}
.contact-item:hover{background:rgba(255,255,255,.05);}
.contact-item.active{background:rgba(212,175,55,.15);border-color:var(--gold);}
a.name{color:var(--gold);text-decoration:none;font-weight:800;font-size:15px;flex:1;}
a.name:hover{text-decoration:underline;}
.small{color:#c9c9c9;font-size:12px;}
.flash{box-shadow:0 0 0 3px rgba(212,175,55,.45);border-color:var(--gold)!important;}

/* Right info panel */
.right{flex:1;background:linear-gradient(180deg,#f8f8f8 0%,#f1f1f1 100%);color:#000;overflow-y:auto;padding:18px 40px;box-shadow:inset 0 0 12px rgba(0,0,0,.1);}
.section{margin-top:18px;background:var(--paper);border:1px solid var(--line);border-radius:12px;padding:16px 18px;box-shadow:0 6px 14px rgba(0,0,0,.06);}
.section h3{margin:0 0 10px 0;font-size:18px;color:#000;border-left:4px solid var(--gold);padding-left:8px;}
</style>

<div class="layout-contacts">
    {{-- If your app already renders a sidebar, remove this <aside> block --}}
    <aside class="sidebar">
        <img src="/assets/agency_builder_logo.png" class="sidebar-logo" alt="Agency Builder Logo">
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('contacts.index') }}" class="active">All Contacts</a>
            <a href="{{ url('/book-of-business') }}">Book of Business</a>
            <a href="{{ url('/service') }}">Service Department</a>
            <a href="{{ url('/calendar') }}">Calendar / Activity</a>
            <a href="{{ url('/billing') }}">Billing</a>
            <a href="{{ url('/settings') }}">Settings</a>
            <a href="{{ url('/logout') }}">Logout</a>
        </nav>
    </aside>

    <section class="middle">
        <div class="middle-actions">
            <div>All Contacts</div>
            <div class="small">Total: {{ (int)$total }}</div>
        </div>

        <div class="pager">
            <span class="meta">Showing {{ $from }}–{{ $to }} of {{ $total }}</span>
            <div>
                <button class="pg-btn" @if($page<=1) disabled @endif onclick="location.href='{{ route('contacts.index', ['page'=>max(1,$page-1)]) }}'">◄</button>
                <button class="pg-btn" @if($page>=$totalPages) disabled @endif onclick="location.href='{{ route('contacts.index', ['page'=>min($totalPages,$page+1)]) }}'">►</button>
            </div>
        </div>

        <div class="search-wrap">
            <input type="text" id="contactSearch" class="search-input" placeholder="Search by name, email, or phone...">
        </div>

        <div class="contact-list" id="contactList">
            @forelse ($contacts as $r)
                @php
                    $lowerName   = mb_strtolower((string)$r->name);
                    $lowerEmail  = mb_strtolower((string)($r->email ?? ''));
                    $digitsPhone = preg_replace('/\D+/', '', (string)($r->phone ?? ''));
                    // Maintain the same routing pattern; if you have a unified contact route, swap here.
                    $href = url('/contacts/view?type='.rawurlencode($r->src).'&id='.(int)$r->id);
                @endphp
                <div
                    class="contact-item {{ ($selectedId && $selectedId===(int)$r->id && $selectedSrc===$r->src) ? 'active' : '' }}"
                    data-id="{{ (int)$r->id }}"
                    data-src="{{ e($r->src) }}"
                    data-name="{{ e($lowerName) }}"
                    data-email="{{ e($lowerEmail) }}"
                    data-phone="{{ e($digitsPhone) }}"
                >
                    <a class="name" href="{{ $href }}">{{ e($r->name) }}</a>
                    <div class="small">
                        {{ e($r->grp) }}
                        @if($r->email) &nbsp;•&nbsp; {{ e($r->email) }} @endif
                        @if($r->phone) &nbsp;•&nbsp; {{ e($r->phone) }} @endif
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
                Start typing a <b>name</b>, <b>email</b>, or <b>phone</b> on the left. We’ll scroll to a match
                on this page, or <b>jump to the correct page</b> automatically and highlight the contact.
            </div>
        </div>
    </section>
</div>

<script>
function debounce(fn, ms){ let t; return function(...a){ clearTimeout(t); t=setTimeout(()=>fn.apply(this,a), ms); }; }
function digitsOnly(s){ return (s||'').replace(/\D+/g,''); }

function focusItemByIdSrc(id, src){
  const list = document.getElementById('contactList');
  const item = list.querySelector('.contact-item[data-id="'+id+'"][data-src="'+src+'"]');
  if (item){
    item.scrollIntoView({behavior:'smooth', block:'center'});
    item.classList.add('flash');
    setTimeout(()=>item.classList.remove('flash'), 1600);
  }
}

function findLocal(term){
  const t = (term||'').trim().toLowerCase();
  if (!t) return null;
  const td = digitsOnly(t);
  const items = Array.from(document.querySelectorAll('#contactList .contact-item'));

  // prefix first
  let m = items.find(it=>{
    const nm = it.getAttribute('data-name')  || '';
    const em = it.getAttribute('data-email') || '';
    const ph = it.getAttribute('data-phone') || '';
    return nm.startsWith(t) || em.startsWith(t) || (td && ph.startsWith(td));
  });
  if (m) return { id: parseInt(m.getAttribute('data-id')||'0',10), src: m.getAttribute('data-src')||'' };

  // contains fallback
  m = items.find(it=>{
    const nm = it.getAttribute('data-name')  || '';
    const em = it.getAttribute('data-email') || '';
    const ph = it.getAttribute('data-phone') || '';
    return nm.indexOf(t)!==-1 || em.indexOf(t)!==-1 || (td && ph.indexOf(td)!==-1);
  });
  return m ? { id: parseInt(m.getAttribute('data-id')||'0',10), src: m.getAttribute('data-src')||'' } : null;
}

const onType = debounce(async function(ev){
  const val = ev.target.value || '';
  const local = findLocal(val);
  if (local){ focusItemByIdSrc(local.id, local.src); return; }
  if (!val.trim()) return;

  try{
    const url = new URL('{{ route('contacts.find') }}', window.location.origin);
    url.searchParams.set('find_q', val);
    const resp = await fetch(url.toString(), {headers:{'Accept':'application/json'}});
    const data = await resp.json();
    if (data && data.ok && data.page){
      const currentPage = {{ (int)$page }};
      if (data.page === currentPage){
        focusItemByIdSrc(data.id, data.src);
      } else {
        const params = new URLSearchParams(window.location.search);
        params.set('page', data.page);
        params.set('id', data.id);
        params.set('src', data.src);
        window.location.href = `{{ route('contacts.index') }}?${params.toString()}`;
      }
    }
  }catch(e){ /* silent */ }
}, 200);

document.getElementById('contactSearch').addEventListener('input', onType);

(function(){
  const params = new URLSearchParams(window.location.search);
  const id  = params.get('id');
  const src = params.get('src');
  if (id && src) setTimeout(()=>focusItemByIdSrc(id, src), 250);
})();
</script>
@endsection
