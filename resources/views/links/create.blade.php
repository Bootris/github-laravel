<x-layout>
  <x-slot:heading>
      Create Link
  </x-slot:heading>

  @if (session('success'))
      <p class="text-green-500 font-semibold">{{ session('success') }}</p>
  @endif

  <form method="POST" action="{{ route('links.store') }}">
      @csrf 

      <div class="space-y-12">
          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-4">
                  <label for="url" class="block text-sm font-medium leading-6 text-gray-900">URL</label>
                  <div class="mt-2">
                      <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                          <input type="text" name="url" id="url" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Add URL here" required>
                      </div>
                      @error('url')
                          <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                      @enderror
                  </div>
              </div>
              
              <div class="sm:col-span-3">
                  <label for="publish_at" class="block text-sm font-medium leading-6 text-gray-900">Publish At</label>
                  <div class="mt-2">
                      <input type="datetime-local" name="publish_at" id="publish_at" class="block w-full rounded-md shadow-sm ring-1 ring-inset ring-gray-300 border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" required>
                      @error('publish_at')
                          <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                      @enderror
                  </div>
              </div>

              <div class="sm:col-span-3">
                  <label for="delete_at" class="block text-sm font-medium leading-6 text-gray-900">Delete At</label>
                  <div class="mt-2">
                      <input type="datetime-local" name="delete_at" id="delete_at" class="block w-full rounded-md shadow-sm ring-1 ring-inset ring-gray-300 border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" required>
                      @error('delete_at')
                          <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                      @enderror
                  </div>
              </div>
          </div>
      </div>

      <div class="mt-6 flex items-center justify-end gap-x-6">
   
          <x-form-button>CREATE</x-form-button>
      </div>
  </form>

  <h2 class="mt-10 text-lg font-semibold leading-6 text-gray-900">Recent Links</h2>
  <table class="min-w-full divide-y divide-gray-200 mt-4">
      <thead class="bg-gray-50">
          <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Internal ID</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
          </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
          @foreach ($recentLinks as $link)
              <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                      <a href="{{ $link->url }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{ $link->internal_id }}</a>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $link->url }}</td>
              </tr>
          @endforeach
      </tbody>
  </table>
</x-layout>
