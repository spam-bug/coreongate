<div wire:poll.1000ms="checkTimer" class="codeTimer">
    @if($resendCode)
        <button wire:click="sendCode" type="button">Resend Code</button>
    @else
        <p>{{ $minutes }} : {{ ($seconds < 10) ? '0' . $seconds : $seconds }}</p>
    @endif
</div>
