<x-layout>
    <form method="POST" action="/register">
        @csrf
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 mx-auto">
            <legend class="fieldset-legend">Create an Account</legend>

            <label class="label">Name</label>
            <input type="text" class="input" name="name" placeholder="Full Name" required autofocus />
            <x-forms.error name="name" />

            <label class="label">Email</label>
            <input type="email" class="input" name="email" placeholder="Email" required />
            <x-forms.error name="email" />

            <label class="label">Password</label>
            <input type="password" class="input" name="password" placeholder="Password" required />
            <x-forms.error name="password" />

            <label class="label">Confirm Password</label>
            <input type="password" class="input" name="password_confirmation" placeholder="Confirm Password" required />

            <button class="btn btn-neutral mt-4">Register</button>
        </fieldset>
    </form>
</x-layout>