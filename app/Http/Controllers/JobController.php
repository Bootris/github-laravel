<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use App\Notifications\TestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class JobController extends Controller
{
    public function index(Request $request): View
    {
        // Search term variable
        $searchTerm = $request->input('search');

        $jobs = Job::with('employer')
            ->search($searchTerm)
            ->latest()
            ->paginate(5);

        return view('jobs.index', [
            'jobs' => $jobs,
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => 'required',
        ]);

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => auth()->user()->employeers->first()->id,
        ]);

        Mail::to($job->employer->user)->queue(
            new JobPosted($job)
        );

        Notification::send($job->employer->user, new TestNotification());

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {

        if ($job->employer->user->isNot(Auth::user())) {
            abort(403);
        }

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => 'required',
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        // and persist
        // redirect to the job page
        return redirect('/jobs/'. $job->id);
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect('/jobs');
    }
}
