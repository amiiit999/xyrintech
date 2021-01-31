<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function addtask(Request $request){
    	$this->validate($request,[
         'task' => 'required',
         'date' => 'required',
         'priority' => 'required'    
    	]);

    	$task = new Task;
    	$task->task = $request->input('task');
    	$task->date = $request->input('date');
    	$task->priority = $request->input('priority');
    	$task->save();

    	return redirect('/')->with('add','Task Added Successfully !!');
    }

    public function display(){
        $display = Task::all();
      //  $dd = Task::tasks()->date;
    //$newDate = \Carbon\Carbon::createFromFormat('Y-m-d', $dd)->format('d M Y');
        
        return view('tasks.home',['display'=>$display]);
    }

    public function edittask($id){
        $edit = Task::where('id','=',$id)->first();
         return view('tasks.edit',['edit'=>$edit]);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
         'task' => 'required',
         'date' => 'required',
         'priority' => 'required'    
        ]);

        $update =  Task::find($id);
        $update->task = $request->input('task');
        $update->date = $request->input('date');
        $update->priority = $request->input('priority');
        $update->save();

        return redirect('/')->with('update','Task Updated Successfully !!');
        
    }

    public function delete($id){
       Task::where('id','=',$id)->delete();
       return redirect('/')->with('delete','Data Deleted Successfully !!');
    }
}
