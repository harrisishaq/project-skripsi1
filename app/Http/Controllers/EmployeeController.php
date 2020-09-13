<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataEmployee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function rules($id = false)
    {
        return  [
            'employeeNumber' => 'required|integer',
            'firstName' => 'required',
            'lastName' => 'required',
        ];
    }


    public function add()
    {
        return view('employee.add-edit', ['edit' => false, 'id' => false]);
    }

    public function create(Request $request)
    {
        $old_employee = DataEmployee::where('employeeNumber', $request->employeeNumber)->first();
        // dd($old_employee);

        // $old_employee->employeeNumber != $request->employeeNumber
        if(empty($old_employee->employeeNumber)){
            $data = $this->validate($request, $this->rules());
            $employee = DataEmployee::create($data);
        
            return redirect('home')->withSuccess(__('New Employee added successfully.'));
        }

        return redirect()->route('employee.add')
            ->withErrors(__('Employee Number has already been taken.'));
    }

    public function edit($id)
    {
        $employee = DataEmployee::findOrFail($id);
        $employee_id = $employee->id;
        return view('employee.add-edit', ['edit' => true, 'id' => $employee_id, 'data' => $employee]);
    }

    public function update(Request $request, $id)
    {
        $employee = DataEmployee::findOrFail($id);
        if($employee->employeeNumber == $request->employeeNumber){
            $data = $this->validate($request, $this->rules());
            $employee->update($data);
        
            return redirect()->route('home')->withSuccess('Employee data has been Updated');
        } 
        
        return redirect()->route('employee.add')
            ->withErrors(__('Employee Number has already been taken.'));
    }

    public function delete($id)
    {
        $data = DataEmployee::findOrFail($id);
        $data->delete();
        return redirect()->route('home')->withSuccess('Employee data has been Deleted');
    }
}
