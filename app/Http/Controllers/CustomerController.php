<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    const CUSTOMERS_ON_PAGE = 10;

    public function index()
    {
        $data = Customer::orderBy('id', 'desc')->paginate(self::CUSTOMERS_ON_PAGE);
        return view('customers.index', ['customers' => $data]);
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'regex:/^[+][0-9] [0-9]{3} [0-9]{3}[-][0-9]{2}[-][0-9]{2}$/|required|unique:customers',
            'email' => 'email|nullable|unique:customers',
            'instagram' => 'URL|nullable|unique:customers',
            'vk' => 'URL|nullable|unique:customers',
            'address' => 'nullable|max:150',
            'is_confectioner' => 'required|boolean',
            'loyalty' => 'integer|between:-5,5',
            'info' => 'nullable|max:1000',
        ]);

        Customer::storeCustomer([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'instagram' => $request->instagram,
            'vk' => $request->vk,
            'address' => $request->address,
            'is_confectioner' => $request->is_confectioner,
            'loyalty' => $request->loyalty,
            'info' => $request->info,
        ]);
        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $data["customer"] = Customer::find($id);
        return view('customers.edit', $data);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'regex:/^[+][0-9] [0-9]{3} [0-9]{3}[-][0-9]{2}[-][0-9]{2}$/|required|unique:customers,phone,'.$id,
            'email' => 'email|nullable|unique:customers,email,'.$id,
            'instagram' => 'URL|nullable|unique:customers,instagram,'.$id,
            'vk' => 'URL|nullable|unique:customers,vk,'.$id,
            'address' => 'nullable|max:150',
            'is_confectioner' => 'required|boolean',
            'loyalty' => 'integer|between:-5,5',
            'info' => 'max:1000',
        ]);

        Customer::find($id)->update($request->all());
        return redirect()->route('customers.index');
    }

    public function delete($id)
    {
        Customer::destroy($id);
        return redirect()->route('customers.index');
    }
}
