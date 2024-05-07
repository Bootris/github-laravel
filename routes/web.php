<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('home');
});
// Index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->paginate(5);

    return view('jobs.index', [
        'jobs' => $jobs,
    ]);
});
// Create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});
// Show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});
// Store
Route::post('/jobs', function () {
    // validation...
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => 'required',
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs');
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});
// Update
Route::patch('/jobs/{id}/', function ($id) {
    //validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => 'required',
    ]);
    //authorize

    // update the job
    $job = Job::findOrFail($id);

    // $job->title = request('title');
    // $job->salary = request('salary');
    // $job->save();
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    // and persist
    // redirect to the job page
    return redirect('/jobs/'. $job->id);
});

// Destroy
Route::delete('/jobs/{id}/', function ($id) {
    $job = Job::findOrFail($id);
    $job->delete();

    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
