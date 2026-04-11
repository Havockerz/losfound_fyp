<x-app-layout> 
<x-slot name="header"> 
<h2 class="font-semibold text-xl text-gray-800 leading-tight"> 
{{ __('Claim Ownership') }}: {{ $item->item_name }} 
</h2> 
</x-slot> 
<div class="py-12"> 
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8"> 
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8"> 
<div class="mb-8 p-4 bg-amber-50 border-l-4 border-amber-400 text-amber-700"> 
<p class="font-bold">Verification Required</p> 
<p class="text-sm">To ensure the item reaches its rightful owner, please provide 
specific details that only the owner would know. Your request will be reviewed by an 
administrator.</p> 
</div> 
<form action="{{ route('items.claim.store', $item->id) }}" method="POST" 
enctype="multipart/form-data" class="space-y-6"> 
@csrf 
<div> 
<x-input-label for="verification_answer" value="1. What specific features or marks 
distinguish your item?" /> 
<x-text-input id="verification_answer" name="verification_answer" type="text" 
class="mt-1 block w-full" placeholder="e.g. A scratch on the back, a specific wallpaper, a 
unique keychain..." required /> 
<x-input-error class="mt-2" :messages="$errors->get('verification_answer')" /> 
</div> 
<div> 
<x-input-label for="description" value="2. Detailed Description" /> 
<textarea id="description" name="description" rows="5" 
class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue
500 rounded-md shadow-sm" 
placeholder="Please describe when and where you lost it, the contents (if it's a 
bag/wallet), or any other proof of ownership..." required></textarea> 
<x-input-error class="mt-2" :messages="$errors->get('description')" /> 
</div> 
<div class="p-4 bg-gray-50 rounded-lg border border-gray-200"> 
<x-input-label for="proof_image" value="3. Photo Proof (Highly Recommended)" /> 
<p class="text-xs text-gray-500 mb-3">Upload a photo of you with the item, or a 
photo of the receipt/box if available.</p> 
<input type="file" id="proof_image" name="proof_image" class="block w-full text
sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font
semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" /> 
<x-input-error class="mt-2" :messages="$errors->get('proof_image')" /> 
</div> 
<div class="flex items-center justify-between pt-4 border-t"> 
<a href="javascript:history.back()" class="text-sm text-gray-600 hover:text-gray-900 
transition"> 
Cancel 
</a> 
<x-primary-button class="bg-blue-600 hover:bg-blue-700"> 
{{ __('Submit Claim for Review') }} 
</x-primary-button> 
</div> 
</form> 
</div> 
</div> 
</div> 
</x-app-layout>