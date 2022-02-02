<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Book;

class TaskController extends Controller
{
    public function index()
    {
           $tasks = Task::all();
           return view('tasks.index')->with(['tasks'=>$tasks]);
    }
}