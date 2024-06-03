<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::whereNot(function (Builder $query) {
            $query->where('role', 'Project Manager');
        })
            ->get();
    }
}
