<div class="ml-5 mt-2">
  @foreach ($resources as $resource)
    <div class="flex gap-2 mb-2">
      <div>{{ $resource->name }}</div>
      <div>{{ $resource->description }}</div>
    </div>

    <div class="ml-5">
      @foreach ($resource->files as $file)
        <div class="border-b pb-2 mb-2">
          <div class="flex gap-">
            <div class="basis-4/12">
              @role('resources')
              <a href="{{ route('files.show', $file) }}">
                {{ $file->name }}
              </a>
              @else
              {{ $file->name }}
              @endrole
            </div>
            <div class="basis-7/12">{{ $file->description }}</div>
            <div class="flex gap-2 justify-end basis-1/12">
              <div>
                <a href="{{ route('resource.view', $file->name) }}" title="View" target="_blank">
                  <x-icons.view-icon class="h-6 w-6" />
                </a>
              </div>
              <div>
                <a href="{{ route('resource.download', $file->name) }}" title="Download">
                  <x-icons.download-icon class="h-6 w-6" />
                </a>
              </div>
            </div>
          </div>
          <div class="flex gap-2 ml-5 text-xs">
            <div>File name: {{ $file->file_name }}</div>
            <div>Version: {{ $file->version }}</div>
            <div>Last Updated: {{ $file->updated_at }}</div>
            <div>Size: {{ strlen($file->data) }}</div>
          </div>
        </div>
      @endforeach
    </div>
  @endforeach
</div>
