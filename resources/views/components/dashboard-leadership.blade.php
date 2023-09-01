<div class="max-w-5xl sm:pt-4 sm:pb-2 mx-auto bg-white border-t">
    @if (count($pendingMembers))        
        <div class="bg-gray-300 px-2 py-3">
            Users with pending membership applications
        </div>
        <x-member-list :members="$pendingMembers" />
    @endif
</div>
