
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Job | HireLens</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        input, select, textarea { outline: none; }
        input:focus, select:focus, textarea:focus {
            border-color: #5269d9;
            box-shadow: 0 0 0 3px rgba(82, 105, 217, .12);
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">
<div class="min-h-screen md:flex">

    
    <aside class="w-full bg-slate-950 p-6 text-white md:min-h-screen md:w-64 md:shrink-0">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-500 text-xl font-bold">H</div>
            <div>
                <div class="text-xl font-bold tracking-tight">HireLens</div>
                <div class="text-xs text-slate-400">SMART HIRING PLATFORM</div>
            </div>
        </a>

        <p class="mb-3 mt-10 text-xs font-semibold uppercase tracking-widest text-slate-500">
            Workspace
        </p>

        <div class="mb-2 flex items-center gap-3 rounded-xl bg-indigo-500/20 px-4 py-3 text-indigo-200">
            <span>▦</span>
            <span class="font-medium">Create Job</span>
        </div>

        <div class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-400">
            <span>▤</span>
            <span>Job Management</span>
        </div>

        <div class="mt-12 rounded-xl border border-slate-800 bg-slate-900 p-4">
            <p class="text-sm font-semibold">Better hiring starts here.</p>
            <p class="mt-2 text-xs leading-5 text-slate-400">
                Define the skills and evaluation criteria that matter for your next hire.
            </p>
        </div>
    </aside>

    <!-- Main content -->
    <main class="min-w-0 flex-1 px-4 py-8 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-4xl">

            <div class="mb-8 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="text-sm text-slate-500">Workspace / Jobs / <span class="text-indigo-600">Create</span></p>
                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Create a new job</h1>
                    <p class="mt-2 text-sm text-slate-500">
                        Define the role, required skills, and candidate evaluation criteria.
                    </p>
                </div>
                <span class="rounded-full border border-indigo-100 bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">
                    JOB SETUP
                </span>
            </div>

            @if(session('success'))
                <div role="status" class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div role="alert" class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <p class="mb-2 font-semibold">Please check the following:</p>
                    <ul class="list-inside list-disc space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jobs.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Job details -->
                <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-100 px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-lg text-indigo-600">01</div>
                            <div>
                                <h2 class="font-bold text-slate-900">Job details</h2>
                                <p class="mt-1 text-sm text-slate-500">Start with the basic information about the role.</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-5 p-6 sm:grid-cols-2">
                        <div>
                            <label for="title" class="mb-2 block text-sm font-semibold">Job title <span class="text-red-500">*</span></label>
                            <input id="title" name="title" type="text" required maxlength="255"
                                value="{{ old('title', 'Junior Software Developer') }}"
                                placeholder="e.g. Junior Software Developer"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="department" class="mb-2 block text-sm font-semibold">
                                Department <span class="text-red-500">*</span>
                            </label>
                            <select id="department" name="department" required
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm">
                                <option value="">Select department</option>
                                @foreach(['Engineering', 'Product', 'Design', 'HR', 'Other'] as $department)
                                    <option value="{{ $department }}" @selected(old('department', '') === $department)>
                                        {{ $department === 'HR' ? 'Human Resources' : $department }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <div id="other-department-wrapper" class="mt-4 hidden">
                                <label for="other_department" class="mb-2 block text-sm font-semibold">
                                    Enter department name <span class="text-red-500">*</span>
                                </label>
                                <input id="other_department" name="other_department" type="text"
                                    value="{{ old('other_department') }}" maxlength="255"
                                    placeholder="e.g. Data Science"
                                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                                @error('other_department')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="description" class="mb-2 block text-sm font-semibold">Job description <span class="text-red-500">*</span></label>
                            <textarea id="description" name="description" rows="4" required
                                placeholder="Describe the role and its responsibilities."
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">{{ old('description') }}</textarea>
                            @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="skills" class="mb-2 block text-sm font-semibold">Required skills <span class="text-red-500">*</span></label>
                            <input id="skills" name="skills" type="text" required
                                value="{{ old('skills', 'Python, Databases, Problem-Solving') }}"
                                placeholder="Python, SQL, Communication"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                            <p class="mt-2 text-xs text-slate-500">Separate each skill with a comma.</p>
                            @error('skills') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="eligibility_rules" class="mb-2 block text-sm font-semibold">Eligibility rules <span class="text-slate-400">(optional)</span></label>
                            <textarea id="eligibility_rules" name="eligibility_rules" rows="2"
                                placeholder="e.g. Must be eligible to work in Kuwait"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">{{ old('eligibility_rules') }}</textarea>
                            @error('eligibility_rules') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <!-- Scoring weights -->
                <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-100 px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50 text-lg text-violet-600">02</div>
                            <div>
                                <h2 class="font-bold text-slate-900">Evaluation scoring weights</h2>
                                <p class="mt-1 text-sm text-slate-500">Choose how each assessment contributes to the evaluation.</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid gap-4 sm:grid-cols-3">
                            @foreach([
                                'coding_test' => ['label' => 'Coding test', 'default' => 50],
                                'interview' => ['label' => 'Interview', 'default' => 30],
                                'cv_screening' => ['label' => 'CV screening', 'default' => 20],
                            ] as $key => $item)
                                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                                    <label for="weight_{{ $key }}" class="mb-3 block text-sm font-semibold">{{ $item['label'] }}</label>
                                    <div class="flex items-center gap-2">
                                        <input id="weight_{{ $key }}" name="weights[{{ $key }}]" type="number"
                                            min="0" max="100" step="1" required
                                            value="{{ old('weights.' . $key, $item['default']) }}"
                                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm">
                                        <span class="text-sm text-slate-500">%</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-5 rounded-xl bg-indigo-50 p-4">
                            <p class="text-sm font-semibold text-indigo-900">Important: the total must equal 100%.</p>
                            <p class="mt-1 text-xs text-indigo-700">For example: 50% coding test + 30% interview + 20% CV screening.</p>
                        </div>
                    </div>
                </section>

                <!-- Actions -->
                <div class="flex flex-wrap items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-xs text-slate-500"><span class="text-red-500">*</span> Required fields</p>
                    <button type="submit"
                        class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200">
                        Save Job <span class="ml-2">→</span>
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-xs text-slate-400">HireLens · Smart hiring, better growth.</p>
        </div>
    </main>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const department = document.getElementById('department');
        const otherWrapper = document.getElementById('other-department-wrapper');
        const otherInput = document.getElementById('other_department');

        function toggleOtherDepartment() {
            const isOther = department.value === 'Other';

            otherWrapper.classList.toggle('hidden', !isOther);
            otherInput.required = isOther;

            if (!isOther) {
                otherInput.value = '';
            }
        }

        department.addEventListener('change', toggleOtherDepartment);

        toggleOtherDepartment();
    });
</script>

</body>
</html>
