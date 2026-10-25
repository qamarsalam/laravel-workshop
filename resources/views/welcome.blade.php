<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create Job</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Tailwind CSS Styling Framework Using Your Colors -->
        `<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>`
        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
        </style>
    </head>
    <body class="bg-gray-50 text-gray-900 min-h-screen py-10 px-4">

        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm border border-gray-200 p-6 sm:p-8">
            
            <!-- Step 10: Confirmation Message -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg">
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Form Validation Global Error (Step 8 Summary) -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 class="text-2xl font-bold text-gray-900 mb-2">Create Job MVP</h1>
            <p class="text-gray-500 mb-8">Define your job requirements and evaluation settings.</p>

            <!-- Form Start -->
            <form action="{{ route('jobs.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Step 2: Job Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', 'Junior Software Developer') }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                <!-- Step 3: Department -->
                <div>
                    <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                    <select name="department" id="department" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <option value="">Select Department</option>
                        <option value="Engineering" selected>Engineering</option>
                        <option value="Product">Product</option>
                        <option value="Design">Design</option>
                        <option value="HR">Human Resources</option>
                    </select>
                </div>

                <!-- Step 4: Job Goal & Responsibilities -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Job Goal & Responsibilities</label>
                    <textarea name="description" id="description" rows="4" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" 
                              placeholder="Describe the main targets and day-to-day tasks...">{{ old('description') }}</textarea>
                </div>

                <!-- Step 5: Required Skills -->
                <div>
                    <label for="skills" class="block text-sm font-medium text-gray-700 mb-1">Required Skills (Comma separated)</label>
                    <input type="text" name="skills" id="skills" value="{{ old('skills', 'Python, Databases, Problem-Solving') }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" 
                           placeholder="e.g. Python, SQL, Communication">
                </div>

                <!-- Step 6: Eligibility Rules -->
                <div>
                    <label for="eligibility_rules" class="block text-sm font-medium text-gray-700 mb-1">Eligibility Rules</label>
                    <textarea name="eligibility_rules" id="eligibility_rules" rows="2" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" 
                              placeholder="e.g. Minimum 2 years experience, Remote (Kuwait only)">{{ old('eligibility_rules') }}</textarea>
                </div>

                <!-- Step 7 & 8: Scoring Weights Configuration -->
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                    <h3 class="text-sm font-semibold text-gray-900 mb-1">Evaluation Scoring Weights</h3>
                    <p class="text-xs text-gray-500 mb-4">Assign importance to each source. The total must equal exactly <span class="font-bold text-blue-600">100%</span>.</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Coding Test (%)</label>
                            <input type="number" name="weights[coding_test]" value="{{ old('weights.coding_test', 50) }}" min="0" max="100"
                                   class="w-full px-3 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Interview (%)</label>
                            <input type="number" name="weights[interview]" value="{{ old('weights.interview', 30) }}" min="0" max="100"
                                   class="w-full px-3 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">CV Screening (%)</label>
                            <input type="number" name="weights[cv_screening]" value="{{ old('weights.cv_screening', 20) }}" min="0" max="100"
                                   class="w-full px-3 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                    </div>
                </div>

                <!-- Step 9: Save Job Button -->
                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm hover:shadow transition outline-none cursor-pointer">
                        Save Job
                    </button>
                </div>
            </form>
            <!-- Form End -->

        </div>

    </body>
</html>
