<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageRecipient;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::latest()->paginate(5);

        return view('messages.index', compact('messages'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        $body_list = array_map(function ($a) {
            return basename($a);
        }, Storage::allFiles('messages'));

        return view('messages.create', compact('students', 'teachers', 'body_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'students' => 'array|required_without:teachers',
            'teachers' => 'array|required_without:students',
            'subject' => 'required|string',
            'body' => 'required|string'
        ]);

        $message = Message::create($request->all());

        if ($request->request->get('students')) {
            $message->students()->attach($request->request->get('students'));
        }
        if ($request->request->get('teachers')) {
            $message->teachers()->attach($request->request->get('teachers'));
        }

        return redirect()->route('messages.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Message $message
     * @return \Illuminate\Http\Response
     */
    public function send(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Message $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        $selected_students_array = MessageRecipient::where('message_id', $message->id)->where('recipient_type', '=', 'App\Models\Student')->get(array('recipient_id as id'))->toArray();
        $selected_students = array_map(function ($a) {
            return $a['id'];
        }, $selected_students_array);

        $selected_teachers_array = MessageRecipient::where('message_id', $message->id)->where('recipient_type', '=', 'App\Models\Teacher')->get(array('recipient_id as id'))->toArray();
        $selected_teachers = array_map(function ($a) {
            return $a['id'];
        }, $selected_teachers_array);

        $students = Student::all();
        $teachers = Teacher::all();
        $body_list = array_map(function ($a) {
            return basename($a);
        }, Storage::allFiles('messages'));

        return view('messages.edit', compact('message', 'students', 'teachers', 'selected_students', 'selected_teachers', 'body_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Message $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $request->validate([
            'students' => 'array|required_without:teachers',
            'teachers' => 'array|required_without:students',
            'subject' => 'required|string',
            'body' => 'required|string'
        ]);
        $message->update($request->all());

        if ($request->request->get('students')) {
            $message->students()->sync($request->request->get('students'));
        }
        if ($request->request->get('teachers')) {
            $message->teachers()->sync($request->request->get('teachers'));
        }

        return redirect()->route('messages.index')
            ->with('success', 'Message updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Message $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
