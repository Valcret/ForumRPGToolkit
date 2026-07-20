@if($showFlash)
<div x-data x-init="setTimeout(() => $wire.dismissFlash(), 3000)"
     class="flash-message">
    {{ $flashMessage }}
</div>
@endif
