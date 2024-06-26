<x-layout>
    <x-slot:heading>
        Job Listings 
    </x-slot:heading>

    <section class="text-center pt-6">
        <h1 class="font-bold text-3xl">Find your Job</h1>
    </section>

    <x-form action="/search" class="mt-6 my-4">
        <x-input :label="false" name="q" placeholder="Web Developer..." />
    </x-form>

    <div class="space-y-4">
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job->id }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
                <div class="font-bold text-blue-500">{{ $job->employer->name }}</div>
                <div>
                    <strong class="text-laracasts">{{ $job['title'] }}:</strong> pays {{ $job['salary'] }} per year
                </div>
            </a>
        @endforeach

        <div>
            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>