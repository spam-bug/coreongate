<x-app-layout>
    <x-slot name="header">Clients</x-slot>

    <form action="{{ route('employee.client_edit_process', ['id' => $client->id]) }}" method="POST" id="clientEditForm" >
    @csrf
    @method("PATCH")

    <div id="section">
        <section id="left">
            <header>BASIC INFO</header>

            <x-input type="text" name="first_name" value="{{ $client->first_name }}" label="First Name"/>
            <x-input type="text" name="last_name" value="{{ $client->last_name }}" label="Last Name"/>
            <x-input type="text" name="address" value="{{ $client->address }}" label="Address"/>
            <x-input type="number" name="contact_number" value="{{ $client->contact_number }}" label="Contact Number"/>
            <x-input type="date" name="birthday" value="{{ $client->birthday }}" label="Birthday"/>

        </section>
        <section id="right">
            <header>ACCOUNT INFO</header>

            <x-input type="text" name="username" value="{{ $client->username }}"  label="Username"/>
            <x-input type="text" name="email" value="{{ $client->email }}" label="Email"/>
            <x-input type="password" name="password" value="" label="Password"/>
            <x-input type="password" name="password_confirmation" label="Confirm Password"/>
        </section>
    </div>

    <x-button type="submit">Update</x-button>
</form>

</x-app-layout>