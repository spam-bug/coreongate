<form action="{{ route('client.sign_up_store') }}" method="POST" class="{{ ($errors->any()) ? 'active' : '' }}" id="signupForm" >
    @csrf

    <section id="left">
        <header>BASIC INFO</header>

        <x-input type="text" name="first_name" label="First Name"/>
        <x-input type="text" name="last_name" label="Last Name"/>
        <x-input type="text" name="address" label="Address"/>
        <x-input type="number" name="contact_number" label="Contact Number"/>
        <x-input type="date" name="birthday" label="Birthday"/>

    </section>
    <section id="right">
        <header>ACCOUNT INFO</header>

        <x-input type="text" name="username" label="Username"/>
        <x-input type="text" name="email" label="Email"/>
        <x-input type="password" name="password" label="Password"/>
        <x-input type="password" name="password_confirmation" label="Confirm Password"/>

        <div class="button-group">
            <x-button type="danger" id="cancel">Cancel</x-button>
            <x-button type="submit">Submit</x-button>
        </div>
    </section>
</form>