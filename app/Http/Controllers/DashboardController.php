<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Halaman dashboard default
     */
    public function index()
    {
        return view('pages.dashboard');
    }

    /**
     * Halaman dashboard admin
     */
    public function admin()
    {
        return view('pages.dashboard-admin', [
            'title' => 'Admin Dashboard',
        ]);
    }

    /**
     * Halaman dashboard user
     */
    public function user()
    {
        return view('pages.dashboard-user', [
            'title' => 'User Dashboard',
        ]);
    }

    // ==============================
    // Resource methods (opsional)
    // ==============================
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
