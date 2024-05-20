
@props(['name'])

@error($name)
    <p class="text-xs text-red-500 font-semidold mt-1">{{$message}}</p>
@enderror