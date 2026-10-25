<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class JobController extends Controller
{
    public function create(): View //This method displays the page but doesn't save the job
    {
        return view('jobs.create');
    }

    public function store(Request $request): RedirectResponse //this runs when user submits the form
    {
        $totalWeight = array_sum($request->input('weights', []));

        $validated = $request->validate([ //here we are validating the input
            'title' => ['required', 'string', 'max:255'], // this tells laravel that the title must not be empty, must be a string, and must not exceed 255 characters
            'department' => ['required', 'string', Rule::in(['Engineering', 'Product', 'Design', 'HR', 'Other'])],
            'other_department' => ['required_if:department,Other', 'nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'skills' => ['required', 'string'],
            'eligibility_rules' => ['nullable', 'string'],
            'weights' => [function ($attribute, $value, $fail) use ($totalWeight) {
                if ($totalWeight !== 100) {
                    $fail('The total scoring weights must equal exactly 100%.');
                }
            }],
        ]);

        $job = new Job();
        $job->title = $validated['title'];
        $job->department = $validated['department'] === 'Other'
            ? trim($validated['other_department'])
            : $validated['department'];

        $job->description = $validated['description'];
        $job->skills = $validated['skills'];
        $job->eligibility_rules = $validated['eligibility_rules'] ?? null;
        $job->scoring_weights = json_encode($request->input('weights'));
        $job->save();
        
        return redirect()
    ->route('jobs.create')
    ->with('success', 'Job saved successfully!');
    }
}
