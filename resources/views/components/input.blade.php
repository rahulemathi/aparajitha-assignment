@props(['label'])
<div class="sm:col-span-3">
          <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">{{ $label }}</label>
          <div class="mt-2">
            <input {{ $attributes->merge(['class'=>'block flex-1 border-1 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6']) }} >
          </div>
        </div>