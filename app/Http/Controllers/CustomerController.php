<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('index', [
            'customers' => Customer::when($request->search, function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%");
            })->paginate(10),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|unique:customers|max:14',
        ]);
        Customer::create($validated);

        return redirect()->route('customer.list');
    }

    public function create()
    {
        return Inertia::render('create');
    }

    public function edit(Customer $customer)
    {
        return Inertia::render('edit', [
            'customer' => $customer,
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:14',
        ]);
        $customer->update($validated);

        return redirect()->route('customer.list')->with('success', 'Customer udpated.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customer.list')->with('success', 'Customer Deleted.');
    }
}
