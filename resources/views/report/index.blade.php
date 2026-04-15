<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report Lost Item') }}
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
    <!-- <input type="hidden" name="type" value="lost"> -->
    
    <div class="mb-4">
        <x-input-label for="item_name" :value="__('Item Name')" />
        <x-text-input id="item_name" class="block mt-1 w-full" type="text" name="item_name"
            placeholder="e.g. Blue Wallet" required />
    </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <x-input-label for="item_type" :value="__('Category')" />
                    <select name="item_type" id="item_type"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="" disabled selected>Choose item type</option>
                        <option value="Electronics">Electronics (Phone, SmartWatch, Laptop, Tablet, Earbuds)</option>
                        <option value="Documents">Documents (Passport, License)</option>
                        <option value="Wallet / Purse / Handbag">Wallet / Purse / Handbag</option>
                        <option value="Card">Cards (IC, Bank, Student)</option>
                        <option value="Keys">Keys</option>
                        <option value="Clothing">Clothing (Footwear, Jacket, Headwear, Scarves)</option>
                        <option value="Bag">Bag / Backpack / Luggage</option>
                        <option value="Accessories">Accessories (Watch, Jewelry, Eyewear, Rings, Bracelets)</option>
                        <option value="Stationery">Stationery (Pen, Pencil, Notebooks)</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div>
                    <x-input-label for="reported_date" :value="__('Date Lost')" />
                    <x-text-input id="reported_date" class="block mt-1 w-full" type="date" name="reported_date"
                        required />
                </div>
            </div>
            <div class="mb-4">
                <x-input-label for="location" :value="__('Location Lost')" />
                <x-text-input id="location" class="block mt-1 w-full" type="text" name="location"
                    placeholder="e.g. Near Cafeteria A" required />
            </div>
            <div class="mb-4">
                <x-input-label for="description" :value="__('Public Description')" />
                <textarea name="description" id="description" rows="2" class="block mt-1 w-
<textarea name=" description" id="description" rows="2" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                    placeholder="General description visible to everyone..." required></textarea>
                
                   <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <x-input-label for="hidden_details" class="text-green-800 font-bold" :value="__('Hidden Details (Verification)')" />
                        <p class="text-xs text-green-600 mb-2">Describe something only the owner
                            would know (e.g., 'What is the lockscreen wallpaper?' or 'How much money is inside?'). This
                            will NOT be shown publicly.</p>
                        <textarea name="hidden_details" id="hidden_details" rows="3" class="block mt-1 w-full border-green-300 focus:border-green-500 focus:ring
green-500 rounded-md shadow-sm" placeholder="e.g. There is a picture of a cat inside the clear slot of the wallet."
                            required></textarea>
                    </div>

                    <div class="mb-6">
                        <x-input-label for="image" :value="__('Item Picture')" />
                        <input type="file" name="image" id="image" class="block mt-1 w-full text-sm 
text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font
semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
                    </div>
                
                <div class="flex items-center justify-end border-t pt-4">
        <x-primary-button class="bg-green-600 hover:bg-green-700">
            {{ __('Post Lost Item') }}
        </x-primary-button>
    </div>
</form>
            </div>
        </div>
    </div>
</x-app-layout>