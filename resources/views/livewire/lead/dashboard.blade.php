    <div class="container mx-auto px-4 py-6">
        <!-- Add Lead Button -->
        <div class="flex justify-end mb-4">
            <button wire:click="create" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                + Add Lead
            </button>
        </div>


        <!-- Horizontal Scroll Wrapper -->
        <div class="overflow-x-auto">
            <div class="flex gap-4 min-w-max" wire:sortable-group="updateLeadOrder">
                @foreach (['lead', 'contacted', 'proposal_sent', 'won'] as $status)
                    <div class="w-80 flex-shrink-0">
                        <div class="bg-gray-100 rounded-lg shadow-sm h-[75vh] flex flex-col">

                            <!-- Column Header -->
                            <div class="px-4 py-3 border-b bg-gray-200 rounded-t-lg">
                                <h2 class="font-semibold text-sm uppercase tracking-wide text-gray-700">
                                    {{ str_replace('_', ' ', $status) }}
                                </h2>
                            </div>

                            <!-- Cards -->
                            <div class="flex-1 overflow-y-auto p-3 space-y-3"
                                wire:sortable-group.item-group="{{ $status }}">
                                @forelse ($leads[$status] ?? [] as $lead)
                                    <div wire:key="lead-{{ $lead['id'] }}" x-data="{ open: false, highlight: @js(in_array($lead['id'], $recentlyMoved ?? [])) }"
                                        x-init="if (highlight) setTimeout(() => highlight = false, 10000)" wire:sortable-group.item="{{ $lead['id'] }}"
                                        :class="highlight ? 'ring-2 ring-blue-400 bg-blue-50' : ''"
                                        class="relative bg-white rounded-md p-3 shadow-sm hover:shadow-md transition group">

                                        <!-- Drag Handle -->
                                        <div wire:sortable-group.handle
                                            class="absolute top-3 left-2 cursor-move text-gray-400 hover:text-gray-600 z-10 px-1">
                                            ⠿
                                        </div>

                                        <div class="pl-6 pr-6">
                                            <p class="text-sm font-medium text-gray-800">
                                                {{ $lead['title'] }}
                                            </p>
                                        </div>

                                        <div x-show="open" style="display: none;" class="mt-2 space-y-1 pl-6">
                                            <p class="text-xs text-gray-500">
                                                <span class="font-semibold">Email:</span>
                                                {{ $lead['email'] ?? 'No email' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                <span class="font-semibold">Phone:</span>
                                                {{ $lead['phone'] ?? 'No phone' }}
                                            </p>
                                        </div>

                                        <button x-on:click="open = !open" type="button"
                                            class="text-xs text-blue-600 mt-2 hover:underline focus:outline-none pl-6">
                                            <span x-show="!open">Show details</span>
                                            <span x-show="open" style="display: none;">Hide details</span>
                                        </button>

                                        <button wire:click="edit({{ $lead['id'] }})"
                                            class="absolute top-2 right-2 opacity-100 md:opacity-0 md:group-hover:opacity-100"
                                            title="Edit">
                                            ✏️
                                        </button>
                                        <button wire:click.stop="delete({{ $lead['id'] }})"
                                            wire:confirm="Are you sure you want to delete this lead?"
                                            class="absolute top-8 right-2 opacity-100 md:opacity-0 md:group-hover:opacity-100"
                                            title="Delete">
                                            🗑️
                                        </button>
                                    </div>
                                @empty
                                    <p class="text-xs text-gray-400 text-center mt-4">
                                        No leads
                                    </p>
                                @endforelse
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Modal -->
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
                            <input id="title" type="text" wire:model.defer="form.title"
                                placeholder="e.g. John Doe"
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
                            <input id="phone" type="text" wire:model.defer="form.phone"
                                placeholder="e.g. +1234567890"
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

        <!-- Lead Details -->


    </div>
