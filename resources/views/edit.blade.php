<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
   
    
   
    <div class="container mx-auto px-4">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="/update/{{ $account->id }}" method="post">
                            @csrf
                            <div class="flex gap-4">
                                <x-input label="Item" name="item" placeholder="Eg pen" value="{{ $account->item }}"></x-input>
                                <div class="sm:col-span-3">
                                    <label class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                                    <div class="mt-2">
                                    <select name="type" id="">
                                        <option value=""  disabled>Select an option</option>
                                        <option value="income" {{ $account->type == 'income'?'selected':'' }}>Income</option>
                                        <option value="expense" {{ $account->type == 'expense'?'selected':'' }}>Expense</option>
                                    </select>
                                    </div>
                                  </div>
                                  <x-input label="amount" type="number" name="amount" placeholder="eg 1000" value="{{ $account->amount }}"></x-input>
                                  <x-button type="submit" class="bg-blue-700 hover:bg-blue-400 text-white px-4 rounded-md">update</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function closeAlert() {
            const alert = document.getElementById('alert');
            alert.style.display = 'none'; // Hide the alert
        }
    </script>
    
</x-app-layout>
