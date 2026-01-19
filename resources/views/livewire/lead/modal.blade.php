 @if ($showModal)
     <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
         <div class="bg-white rounded-lg w-full max-w-md p-6">
             <h2 class="text-lg font-semibold mb-4">
                 {{ $editingId ? 'Edit Lead' : 'Create Lead' }}
             </h2>

             <div class="space-y-4">
                 <!-- Title -->
                 <div>
                     <label for="title" class="block text-sm font-medium text-gray-700">
                         Title <span class="text-red-600">*</span>
                     </label>
                     <input id="title" type="text" wire:model.defer="form.title" placeholder="e.g. John Doe"
                         class="mt-1 w-full border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200" />
                     <p class="text-xs text-red-600 mt-1">
                         {{ $errors->first('form.title') }}
                     </p>
                 </div>

                 <!-- Email -->
                 <div>
                     <label for="email" class="block text-sm font-medium text-gray-700">
                         Email <span class="text-red-600">*</span>
                     </label>
                     <input id="email" type="email" wire:model.defer="form.email"
                         placeholder="e.g. johndoe@example.com"
                         class="mt-1 w-full border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200" />
                     <p class="text-xs text-red-600 mt-1">
                         {{ $errors->first('form.email') }}
                     </p>
                 </div>

                 <!-- Phone -->
                 <div>
                     <label for="phone" class="block text-sm font-medium text-gray-700">
                         Phone <span class="text-red-600">*</span>
                     </label>
                     <input id="phone" type="text" wire:model.defer="form.phone" placeholder="e.g. +1234567890"
                         class="mt-1 w-full border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200" />
                     <p class="text-xs text-red-600 mt-1">
                         {{ $errors->first('form.phone') }}
                     </p>
                 </div>
             </div>


             <div class="flex justify-end gap-2 mt-6">
                 <button wire:click="$set('showModal', false)" class="px-4 py-2 text-sm border rounded">
                     Cancel
                 </button>

                 <button wire:click="store" class="px-4 py-2 text-sm bg-blue-600 text-white rounded">
                     {{ $editingId ? 'Update' : 'Save' }}
                 </button>
             </div>
         </div>
     </div>
 @endif
