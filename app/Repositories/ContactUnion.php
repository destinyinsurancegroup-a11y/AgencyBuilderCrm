<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ContactUnion
{
    /**
     * Build a UNION ALL of the contact-like tables used by Destiny CRM,
     * normalized to: id, name, phone, email, src, grp, tenant_id
     *
     * @param  int|string  $tenantId
     * @return \Illuminate\Database\Query\Builder  subquery builder (not executed)
     */
    public static function unionForTenant($tenantId)
    {
        // Tables => [label, columns that may exist]
        $tables = [
            'book_of_business'  => ['Book of Business',  ['phone','email']],
            'hired_agents'      => ['Hired Agents',      ['phone','email']],
            'networking_agents' => ['Networking Agents', ['phone','email']],
            'funeral_homes'     => ['Funeral Homes',     ['phone','email']],
            'church_pastors'    => ['Church Pastors',    ['phone','email']],
        ];

        // Build one normalized query per table, then unionAll them.
        $base = null;

        foreach ($tables as $table => [$label, $cols]) {
            // Some legacy tables might miss phone/email; use NULL fallback (portable across PG/MySQL).
            $phoneCol = self::columnExists($table, 'phone') ? 'phone' : DB::raw('NULL');
            $emailCol = self::columnExists($table, 'email') ? 'email' : DB::raw('NULL');

            $q = DB::table($table)
                ->selectRaw("id, name, {$phoneCol} as phone, {$emailCol} as email, ? as src, ? as grp, tenant_id", [$table, $label])
                ->where('tenant_id', $tenantId);

            if ($base === null) {
                $base = $q;
            } else {
                $base = $base->unionAll($q);
            }
        }

        // Wrap as subquery so we can order/paginate: SELECT * FROM ( ... UNION ALL ... ) u
        return DB::query()->fromSub($base, 'u');
    }

    /**
     * Cheap schema check using information_schema (works on MySQL & Postgres).
     * Cached per request so we don't hammer the catalog.
     */
    protected static array $existsCache = [];

    protected static function columnExists(string $table, string $column): bool
    {
        $key = $table.'.'.$column;
        if (array_key_exists($key, self::$existsCache)) return self::$existsCache[$key];

        $conn = DB::connection()->getDoctrineSchemaManager();
        $cols = array_map('strtolower', $conn->listTableColumns($table));
        $exists = array_key_exists(strtolower($column), $cols);
        self::$existsCache[$key] = $exists;
        return $exists;
    }
}
