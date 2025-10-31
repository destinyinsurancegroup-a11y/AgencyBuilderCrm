<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\ContactUnion;

class ContactController extends Controller
{
    const PER_PAGE = 50;

    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id; // strict isolation
        $page     = max(1, (int)$request->integer('page', 1));
        $selectedId  = (int)$request->integer('id', 0);
        $selectedSrc = (string)$request->query('src', '');

        $union = ContactUnion::unionForTenant($tenantId);

        // Total rows:
        $total = (clone $union)->count();

        // Page slice:
        $contacts = (clone $union)
            ->orderBy('name', 'asc')
            ->forPage($page, self::PER_PAGE)
            ->get();

        $totalPages = max(1, (int)ceil($total / self::PER_PAGE));
        $from = $total ? (($page - 1) * self::PER_PAGE + 1) : 0;
        $to   = min($page * self::PER_PAGE, $total);

        return view('contacts.index', compact(
            'contacts','total','totalPages','page','from','to','selectedId','selectedSrc'
        ));
    }

    /**
     * Cross-page search endpoint:
     * - partial match on name/email/phone (digits-only)
     * - returns first match (ordered by name)
     * - computes page number and returns {ok, page, id, src}
     */
    public function find(Request $request)
    {
        $request->validate(['find_q' => 'required|string|max:255']);
        $tenantId = $request->user()->tenant_id;
        $q = trim($request->string('find_q'));

        $like       = '%'.$q.'%';
        $digitsLike = '%'.preg_replace('/\D+/', '', $q).'%';

        $union = ContactUnion::unionForTenant($tenantId);

        // Portable phone normalization: strip ()- + spaces. Use SQL REPLACE chains.
        $phoneExpr = DB::raw(
            "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(COALESCE(phone,''),'-',''),'(',''),')',''),' ',''),'+','')"
        );

        // First pass: partials across name/email/phone
        $first = (clone $union)
            ->select('id','src','name')
            ->where(function($w) use ($like, $digitsLike, $phoneExpr) {
                $w->where('name', 'like', $like)
                  ->orWhere('email', 'like', $like)
                  ->orWhere($phoneExpr, 'like', $digitsLike);
            })
            ->orderBy('name', 'asc')
            ->limit(1)
            ->first();

        // Fallbacks: lexicographic jump >= name, else last record
        if (!$first) {
            $first = (clone $union)
                ->select('id','src','name')
                ->where('name', '>=', $q)
                ->orderBy('name', 'asc')
                ->limit(1)
                ->first();
        }
        if (!$first) {
            $first = (clone $union)
                ->select('id','src','name')
                ->orderBy('name', 'desc')
                ->limit(1)
                ->first();
        }

        if (!$first) {
            return response()->json(['ok' => false]);
        }

        // Rank rows with name < found.name to compute the page:
        $rank = (clone $union)
            ->where('name', '<', $first->name)
            ->count();

        $pageFor = (int) floor($rank / self::PER_PAGE) + 1;

        return response()->json([
            'ok'   => true,
            'page' => $pageFor,
            'id'   => (int)$first->id,
            'src'  => (string)$first->src,
        ]);
    }
}

