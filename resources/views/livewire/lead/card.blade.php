<div wire:key="lead-{{ $lead['id'] }}" x-data="{ open: false, highlight: @js(in_array($lead['id'], $recentlyMoved ?? [])) }" x-init="if (highlight) setTimeout(() => highlight = false, 10000)"
    wire:sortable-group.item="{{ $lead['id'] }}" :class="highlight ? 'ring-2 ring-blue-400 bg-blue-50' : ''"
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
        <p class="text-xs text-gray-500">
            <span class="font-semibold">Author:</span>
            {{ $lead['user']['name'] ?? 'Unknown' }}
        </p>
        <p class="text-xs text-gray-500">
            <span class="font-semibold">Created At:</span>
            {{ Carbon\Carbon::parse($lead['created_at'])->format('d M, Y h:i A') ?? 'Unknown' }}
        </p>
    </div>

    <button x-on:click="open = !open" type="button"
        class="text-xs text-blue-600 mt-2 hover:underline focus:outline-none pl-6">
        <span x-show="!open">Show details</span>
        <span x-show="open" style="display: none;">Hide details</span>
    </button>

    @if ($lead['user_id'] == Auth::id())
        <button wire:click="edit('{{ $lead['id'] }}')"
            class="absolute top-2 right-2 opacity-100 md:opacity-0 md:group-hover:opacity-100" title="Edit">
            ✏️
        </button>
        <button wire:click.stop="delete('{{ $lead['id'] }}')"
            wire:confirm="Are you sure you want to delete this lead?"
            class="absolute top-8 right-2 opacity-100 md:opacity-0 md:group-hover:opacity-100" title="Delete">
            🗑️
        </button>
    @endif
</div>
