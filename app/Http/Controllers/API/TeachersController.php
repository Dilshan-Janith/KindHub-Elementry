<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\TeacherClass;
use DB;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Teacher::latest()->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'classes' => 'required',
            'telephone' => 'required',
            'email' => 'required',
        ]);
        DB::transaction(function () use($request){
            $teacher = new Teacher();
            $teacher->first_name = $request->first_name;
            $teacher->last_name = $request->last_name;
            $teacher->telephone = $request->telephone;
            $teacher->email = $request->email;
            $teacher->save();

            foreach ($request->classes as $key => $classes) {
                $teacher_class = new TeacherClass();
                $teacher_class->teacher_id = $teacher->id;
                $teacher_class->class_id = $classes;
                $teacher_class->save();
            }
        });

        return ['message' => 'Teacher Succesfully Created'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function () use($request, $id){
            $teacher = Teacher::findOrFail($id);
            $teacher->first_name = $request->first_name;
            $teacher->last_name = $request->last_name;
            $teacher->telephone = $request->telephone;
            $teacher->email = $request->email;
            $teacher->update();

            foreach ($request->classes as $key => $classes) {
                $teacher_class = TeacherClass::findOrFail($id);
                $teacher_class->teacher_id = $id;
                $teacher_class->class_id = $classes;
                $teacher_class->update();
            }
        });

        return ['message' => 'Teacher Update Succesfull'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Teacher::findOrFail($id)->delete();

        $teacher_class = TeacherClass::where('teacher_id',$id)->get();
        foreach ($teacher_class as $key => $classes) {
            $classes->delete();
        }

        return ['message' => 'Teacher deleted Succesfully'];
    }

    public function Teacher() {
        $teacher = Teacher::all();
        return $teacher->toArray();
    }
}
