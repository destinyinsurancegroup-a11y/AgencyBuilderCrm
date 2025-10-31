<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $tables = [
            'book_of_business' => 'Book of Business',
            'hired_agents' => 'Hired Agents',
            'networking_agents' => 'Networking Agents',
            'funeral_homes' => 'Funeral Homes',
            'church_pastors' => 'Church Pastors',
        ];

        $perPage = 50;
        $page = max(1, (int) $request->get('page', 1));
        $offset = ($page - 1) * $perPage;

        // Build unified dataset
        $contacts = collect();
        foreach ($tables as $table => $label) {
            if (DB::getSchemaBuilder()->hasTable($table)) {
                $cols = DB::getSchemaBuilder()->getColumnListing($table);
                $phone = in_array('phone', $cols) ? 'phone' : DB::raw("NULL as phone");
                $email = in_array('email', $cols) ? 'email' : DB::raw("NULL as email");

                $rows = DB::table($table)
                    ->select('id', 'name', DB::raw("$phone"), DB::raw("$email"), DB::raw("'$table' as src"), DB::raw("'$label' as grp"))
                    ->get();
                $contacts = $contacts->merge($rows);
            }
        }

        $contacts = $contacts->sortBy('name')->values();
        $total = $contacts->count();
        $pages = max(1, ceil($total / $perPage));

        $paginated = $contacts->slice($offset, $perPage);

        return view('contacts.index', [
            'contacts' => $paginated,
            'total' => $total,
            'from' => $offset + 1,
            'to' => min($offset + $perPage, $total),
            'page' => $page,
            'pages' => $pages,
        ]);
    }
}
