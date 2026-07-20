<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * শুধু is_admin = true থাকা ইউজারদেরই admin panel-এ ঢুকতে দেয়।
     * status=2 (Approved) হওয়াই যথেষ্ট না — is_admin আলাদাভাবে true হতে হবে।
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check() || ! Auth::user()->is_admin) {
            abort(403, 'এই পেজ অ্যাক্সেস করার অনুমতি আপনার নেই।');
        }

        return $next($request);
    }
}
