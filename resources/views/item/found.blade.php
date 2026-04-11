<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report Finding') }}: {{ $item->item_name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="mb-8 p-4 bg-green-50 border-l-4 border-green-400 text-green-700">
                    <p class="font-bold">Thank you for being a hero!</p>
                    <p class="text-sm">Please provide details about where and how you found this item.
                        Your information will be sent to the admin and owner for verification.</p>
                </div>
                <form action="{{ route('item.found.store', $item->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <div>
                        <x-input-label for="location_found" value="1. Where exactly did you find this?" />
                        <x-text-input id="location_found" name="location_found" type="text" class="mt-1 
block w-full" placeholder="e.g. Under the bench at the main library cafe" required />
                        <x-input-error class="mt-2" :messages="$errors->get('location_found')" />
                    </div>
                    <div>
                        <x-input-label for="finding_details" value="2. Additional Details" />
                        <textarea id="finding_details" name="finding_details" rows="4" class="mt-1 block w-full border-gray-300 focus:border-green-500 focus:ring
green-500 rounded-md shadow-sm" placeholder="Describe the condition of the item or any circumstances of the 
f
ind..." required></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('finding_details')" />
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <x-input-label for="finder_photo" value="3. Photo of the Item (Recommended)" />
                        <p class="text-xs text-gray-500 mb-3">Uploading a photo of the item where you
                            found it helps the owner confirm it's theirs quickly.</p>
                        <input type="file" id="finder_photo" name="finder_photo" class="block w-full text
sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font
semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
                        <x-input-error class="mt-2" :messages="$errors->get('finder_photo')" />
                    </div>
                    <div class="flex items-center justify-between pt-4 border-t">
                        <a href="javascript:history.back()" class="text-sm text-gray-600 hover:text-gray-900 
transition">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 
border border-transparent rounded-lg font-semibold text-white uppercase tracking-widest 
hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring 
ring-green-300 transition ease-in-out duration-150 shadow-sm">
                            Submit Found Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>