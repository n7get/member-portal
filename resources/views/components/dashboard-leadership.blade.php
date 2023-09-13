<div class="max-w-5xl sm:pt-4 mx-auto bg-white">
    @if (count($pendingMembers))        
        <div class="bg-gray-300 px-2 py-3">
            Users with pending membership applications
        </div>
        <x-member-list :members="$pendingMembers" />
    @endif
    @if (count($leadershipResources))
        <div class="bg-gray-300 px-2 py-3">
            Leadership Resources
        </div>
        <x-resource-list :resources="$leadershipResources" />        
    @endif
</div>
