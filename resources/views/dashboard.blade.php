<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-4">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        
        @if(Auth::user()->role == 'admin')
        <a href="/create-user">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create User') }}
            </h2>
        </a>
        @endif
        </div>
    </x-slot>
    @if(Session::has('success'))
    <div id="alert" class="flex items-center p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 3a1 1 0 00-1 1v6.586l-2.293-2.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l4-4a1 1 0 00-1.414-1.414L11 10.586V4a1 1 0 00-1-1z"/>
        </svg>
        <span class="sr-only">Success</span>
       {{ Session::get('success') }}
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 text-green-500 hover:text-green-700 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 inline-flex items-center justify-center" aria-label="Close" onclick="closeAlert()">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9.293l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707A1 1 0 015.707 4.293L10 8.586z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/add" method="post">
                        @csrf
                        <div class="flex gap-4">
                            <x-input label="Item" name="item" placeholder="Eg pen" required></x-input>
                            <div class="sm:col-span-3">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                                <div class="mt-2">
                                <select name="type" id="" required>
                                    <option value="" selected disabled>Select an option</option>
                                    <option value="income">Income</option>
                                    <option value="expense">Expense</option>
                                </select>
                                </div>
                              </div>
                              <x-input label="amount" type="number" name="amount" placeholder="eg 1000" required></x-input>
                              <x-button type="submit" class="bg-blue-700 hover:bg-blue-400 text-white px-4 rounded-md">Submit</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($accounts->isEmpty())
    <div class="text-center">
        <h1>No expense or income has been added</h1>
    </div>
    @else
    <div class="container mx-auto px-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        @if(Auth::user()->role == 'accountant')
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        @else
                         <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Users</th>
                         @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($accounts as $account)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $account->item }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $account->type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $account->amount }}</td>
                        @if(Auth::user()->role == 'accountant')
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="/edit/{{ $account->id }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                           <x-button form="delete-form" class="text-red-600 hover:text-red-900 ml-4"> Delete</x-button>
                        </td>
                        @else
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $account->user->name }}</td>
                        @endif
                    </tr>
                    <form id="delete-form" action="/delete/{{ $account->id }}" method="post" class="hidden">
                    @csrf
                    @method('DELETE')
                    </form>
                    @endforeach
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">Total</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $totalincome - $totalexpense }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                           
                        </td>
                    </tr>
                </tbody>
            </table>
            @if(Auth::user()->role =='admin')
            {{ $accounts->links() }}
            @endif
        </div>
    </div>
    @endif
    <script>
        function closeAlert() {
            const alert = document.getElementById('alert');
            alert.style.display = 'none'; // Hide the alert
        }
    </script>
    
</x-app-layout>
