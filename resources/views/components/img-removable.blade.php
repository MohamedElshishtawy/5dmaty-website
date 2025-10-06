@props(['src', 'alt' => '5dmaty', 'mediaId' => null])

<div class="position-relative d-inline-block">
    @if($mediaId)
        <button type="button" 
                class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle p-1 m-1"
                style="z-index: 10; width: 25px; height: 25px; line-height: 1;"
                wire:click="deleteMedia({{ $mediaId }})"
                wire:confirm="{{ __('general.confirm_delete') }}"
                title="{{ __('general.delete') }}">
            <i class="fa-solid fa-xmark" style="font-size: 12px;"></i>
        </button>
    @endif
    
    @php
        $extension = pathinfo($src, PATHINFO_EXTENSION);
        $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'ogg', 'avi', 'mov']);
    @endphp
    
    @if($isVideo)
        <video width="70" height="70" class="rounded border" controls>
            <source src="{{ $src }}" type="video/{{ $extension }}">
            {{ __('general.video_not_supported') }}
        </video>
    @else
        <img src="{{ $src }}" 
             alt="{{ $alt }}" 
             width="70" 
             height="70" 
             class="rounded border object-fit-cover">
    @endif
</div>
