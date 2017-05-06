<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Student;
use App\Skill;
use Auth;

class StudentController extends Controller
{
    public function index(Request $request)    {
        if(Auth::guest())
            return redirect('login');
        $NUM_PAGE = 3;
        $students = Student::orderBy('updated_at','desc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('student.index')->with('students',$students)
                                ->with('page',$page)
                                ->with('NUM_PAGE',$NUM_PAGE);
    }

    public function create()    {
        $skills = Skill::all();
        return view('student.create',compact('skills'));
    }

    public function store(Request $request)    {
        $rules = [ 
            'name' => 'required',
            'email' => 'required|email',
            'major' => 'required'
        ];

        $v = Validator::make($request->all(), $rules);
        if ( $v->passes() )
         {Student::create( $request->all() );
          $skills = $request->input('skills');
         $student = Student::all()->last();
          $student->skills()->attach($skills);
         return redirect('students');}
        else
            return redirect('/students/create')
                ->withErrors($v->messages());       
        
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('student.show')->with('student',$student);
    }

    public function edit($id)
    {

        $student = Student::findOrFail($id);
        $skills = Skill::all();
        return view('student.edit')->with('student',$student)
                                 ->with('id',$id)
                                 ->with('skills',$skills);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $skills = Skill::all();
        $rules = [ 
            'name' => 'required',
            'email' => 'required|email',
            'major' => 'required'
        ];

        $v = Validator::make($request->all(), $rules);
        if ( $v->passes() )
        {
             $skills = $request->input('skills');         
        
             if ($skills == null)
                  $student->skills()->detach(Skill::all()); 
             else
                 $student->skills()->sync($skills);      
             $student->update($request->all());
              return redirect('students');
        }
        else
        {
            return view('student.edit')->with('student',$student)
                                 ->with('id',$id)
                                 ->with('skills',$skills)
                                 ->withErrors($v->messages());  
        }
    }

    public function destroy($id)
    {
        Student::destroy($id);
        return redirect('students');
    }
    
    public function searchSkill(Request $request,$id)
    { 
        $NUM_PAGE = 3;
         $allstudents = Student::all();

         $skill=Skill::findOrFail($id);
         $items=[];

        foreach($allstudents as $student)
        {
            $s_skill = $student->skills()->get();
            foreach($s_skill as $s)
            {
                if($s->id==$skill->id)
                    array_push( $items, $student);
            }
        }    
      
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
       return view('student.showsearchskill')->with('students',$items)
                                ->with('page',$page)
                                ->with('NUM_PAGE',$NUM_PAGE);
    }
}