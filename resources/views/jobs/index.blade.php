<x-layout>
    <x-slot:heading>
        Job Listings 
    </x-slot:heading>
    <form method="GET" action="/jobs" class="flex py-3 items-center">
        <input type="text" name="search" placeholder="Search jobs" class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <button type="submit" class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Search
        </button>
    </form>
    <div class="space-y-4"> 
        @foreach ($jobs as $job)
        
        <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
        <div class="font-bold text-blue-500">{{ $job->employer->name }}</div>    
        <div>
            <strong class="text-laracasts">{{ $job['title']}}: </strong> pays {{$job['salary']}} per year
            </div>
        </a>
            
        @endforeach
        <div>
            {{ $jobs->links() }}
        </div>
    </div>

</x-layout>