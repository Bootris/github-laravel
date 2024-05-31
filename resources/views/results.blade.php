<x-layout>
    <x-slot:heading>
        Search Results
    </x-slot:heading>

    <section class="text-center pt-6">
        <h1 class="font-bold text-3xl">Search Results for "{{ request('q') }}"</h1>
    </section>

    @if($jobs->isEmpty())
        <p class="text-center mt-6">No jobs found matching your search criteria.</p>
    @else
        <div class="space-y-4 mt-6">
            @foreach ($jobs as $job)
                <a href="/jobs/{{ $job->id }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
                    <div class="font-bold text-blue-500">
                        {{ optional($job->employer)->name ?? 'Unknown Employer' }}
                    </div>
                    <div>
                        <strong class="text-laracasts">{{ $job->title }}:</strong> pays {{ $job->salary }} per year
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</x-layout>
