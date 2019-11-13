<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Attendance;
class AttendanceController extends Controller
{
    //
    public function store(Request $request)
    {
        $toClearArr = [
            'attendance_time'=>['absence','absence_with_permission'],
            'abandonment_time'=>['absence','absence_with_permission'],
            'absence'=>['attendance_time','abandonment_time','absence_with_permission'],
            'absence_with_permission'=>['attendance_time','abandonment_time','absence'],
        ];

        // first i get on the request 
        // 1- date
        // 2- employee_id
        // 3- payload {field_name} which can be one of the fields in the up of this method

        // then first or create the attendance with the employee_id andv date
        // then update with the field name and its value
        // 

        $attendance = Attendance::firstOrCreate([
            'date'=>$request->date,
            'employee_id'=>$request->employee_id
        ]);

        $attendance->update([$request->key => $request->value]);

        foreach($toClearArr[$request->key] as $attribute){
            $attendance->update([$attribute => null]);
        }

        return response([
            'attendance'=>$attendance
        ]);
    }


    public function destroy(Request $request)
    {
        optional(Attendance::find($request->id))->delete();
        return response([
            'done'=>true,
        ]);
    }
}
