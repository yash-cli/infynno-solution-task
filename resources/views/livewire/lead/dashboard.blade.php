    @section('title', 'Lead Dashboard')
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
                @foreach ($this->leadStatuses as $status)
                    <div class="w-80 flex-shrink-0">
                        <div class="bg-gray-100 rounded-lg shadow-sm h-[75vh] flex flex-col">

                            <!-- Column Header -->
                            <div class="px-4 py-3 border-b bg-gray-200 rounded-t-lg">
                                <h2 class="font-semibold text-sm uppercase tracking-wide text-gray-700">
                                    {{ App\Enums\LeadStatus::from($status)->label() }}
                                </h2>
                            </div>

                            <!-- Cards -->
                            <div class="flex-1 overflow-y-auto p-3 space-y-3"
                                wire:sortable-group.item-group="{{ $status }}">

                                @if (!empty($leads[$status] ?? []))
                                    @foreach ($leads[$status] as $lead)
                                        @include('livewire.lead.card', ['lead' => $lead])
                                    @endforeach
                                @else
                                    <p class="text-xs text-gray-400 text-center mt-4">
                                        No leads
                                    </p>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Modal -->
        @include('livewire.lead.modal')
    </div>
