<x-guest-layout>
    <form action="{{ route('client.check_out_process') }}" method="POST">
        @csrf

        <x-input type="text" name="username" label="Username" />
        <x-input type="password" name="password" label="Password" />

        <a href="{{ route('forgot_password.show_send_code_form') }}" id="forgotPasswordLink">Forgot password?</a>

        <x-button type="submit">Submit</x-button>
    </form>
</x-guest-layout>