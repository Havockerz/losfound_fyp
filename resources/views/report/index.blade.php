<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report New Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="item_name" :value="__('Item Name')" />
                        <x-text-input id="item_name" class="block mt-1 w-full" type="text" name="item_name" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="type" :value="__('Report Type')" />
                        <select name="type" id="type" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="lost">Lost Item</option>
                            <option value="found">Found Item</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="item_type" :value="__('Item Type')" />
                        <select name="item_type" id="item_type" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="" disabled selected>Choose item type</option>

                            <option value="Electronics">Electronics (Phone, SmartWatch, Laptop, Tablet, Earbuds)</option>
                            <option value="Documents">Documents (Passport, License)</option>
                            <option value="Wallet / Purse / Handbag">Wallet / Purse / Handbag</option>
                            <option value="Card">Cards (IC, Bank, Student)</option>
                            <option value="Keys">Keys</option>
                            <option value="Clothing">Clothing (Footwear, Jacket, Headwear, Scarves)</option>
                            <option value="Bag">Bag / Backpack</option>
                            <option value="Accessories">Accessories (Watch, Jewelry, Eyewear, Rings, Bracelets)</option>
                            <option value="Stationery">Stationery (Pen, Pencil, Notebooks)</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea name="description" id="description" rows="3" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="reported_date" :value="__('Date')" />
                        <x-text-input id="reported_date" class="block mt-1 w-full" type="date" name="reported_date" required />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="image" :value="__('Item Picture')" />
                        <input type="file" name="image" id="image" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                    </div>

                    <div class="flex items-center justify-end">
                        <x-primary-button>
                            {{ __('Submit Report') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>