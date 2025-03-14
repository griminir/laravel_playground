@props(['name'])
@error($name)
<p class="text-xs text-red-600 font-semibold my-3">{{ $message }}</p>
@enderror