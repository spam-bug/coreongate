<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    public function index() {
        return view('admin.employee.index');
    }

    public function store(EmployeeRequest $request) {
        $employee = Employee::create($request->all());
        $employee->assignRole('Employee');


        if($employee) {
            return redirect()->route('employee.index')->with('success', 'Employee has been registered');
        }

        return redirect()->route('employee.index')->with('error', 'Failed to register employee');
    }

    public function edit($id) {
        $employee = Employee::find($id);

        if($employee) {
            return view('admin.employee.edit', compact('employee'));
        }

        return redirect()->route('employee.index')->with('error', 'Employee not found');
    }

    public function update(EmployeeRequest $request, $id) {
        $employee = Employee::find($id);

        if($employee) {
            $employee->name = $request->name;
            $employee->username = $request->username;
            $employee->password = $request->password;

            if($employee->save()) {
                return redirect()->route('employee.index')->with('success', 'Updated Successfully');
            }
        }

        return redirect()->route('employee.index')->with('error', 'Employee not found');
    }

    public function delete($id) {
        try {
            $employee = Employee::find($id);

            if($employee) {
                Employee::destroy($employee->id);
                return redirect()->back()->with('success', 'Employee has been deleted');
            }

            return redirect()->route('employee.index')->with('error', 'Employee not found');
        } catch (\Exception $e) {
            return redirect()->route('employee.index')->with('error', 'Failed to delete employee');
        }
    }

    public function show_client_edit($id) {
        $client = Client::find($id);

        if($client) {
            return view('employee.clients.edit', compact('client'));
        } else {
            return redirect()->back()->with('error', 'Client not found');
        }
    }


    public function client_edit_process($id, ClientRequest $request) {
        $client = Client::find($id);

        if($client) {
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->username = $request->username;
            $client->email = $request->email;
            $client->password = $request->password;
            $client->address = $request->address;
            $client->contact_number = $request->contact_number;
            $client->birthday = $request->birthday;

            if($client->save()) {
                return redirect()->route('employee.clients')->with('success', 'Client has been updated');
            }
        } else {
            return redirect()->back()->with('error', 'Failed to update client');
        }
    }
}
