<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Redirect customers to products page instead of dashboard
        if ($user->isCustomer()) {
            return redirect()->route('products.index');
        }
        
        if ($user->isAdmin()) {
            $users = User::with('role')->get();
            $roles = Role::all();
            return view('dashboard', compact('users', 'roles'));
        } elseif ($user->isSeller()) {
            $products = Product::where('user_id', $user->id)->get();
            return view('dashboard', compact('products'));
        }
        
        return view('dashboard');
    }
}
