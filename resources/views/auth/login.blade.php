<x-layout>
    <form method="POST" action="/login">
        @csrf
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 mx-auto">
            <legend class="fieldset-legend">Login to BondHub</legend>

            <label class="label">Email</label>
            <input type="email" class="input" name="email" placeholder="Email" />
            <x-forms.error name="email" />

            <label class="label">Password</label>
            <input type="password" class="input" name="password" placeholder="Password" />
            <x-forms.error name="password" />

            <button class="btn btn-neutral mt-4">Login</button>
        </fieldset>
    </form>
</x-layout>