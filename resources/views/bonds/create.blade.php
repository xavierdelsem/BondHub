<x-layout>
    <div class="max-w-lg mx-auto py-10 px-4">
        <div class="bg-base-100 shadow-xl rounded-2xl p-6 space-y-6">

            <!-- Header -->
            <div>
                <h1 class="text-2xl font-bold">Add New Prize Bond</h1>
                <p class="text-sm text-gray-400">
                    Enter your bond details carefully
                </p>
            </div>

            <!-- Form -->
            <form action="{{ route('Bond.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Bond Series -->
                <div>
                    <label class="label font-medium">Bond Series</label>
                    <input type="text" name="bondSeries" class="input input-bordered w-full focus:input-primary"
                        placeholder="e.g. KA" value="{{ old('bondSeries') }}" required>
                    <x-forms.error name="bondSeries" />
                </div>

                <!-- Bond Number -->
                <div>
                    <label class="label font-medium">Bond Number</label>
                    <input type="number" name="bondNumber"
                        class="input input-bordered w-full font-mono tracking-wider focus:input-primary"
                        placeholder="0000000" value="{{ old('bondNumber') }}" required>
                    <x-forms.error name="bondNumber" />
                </div>

                <!-- Buying Date -->
                <div>
                    <label class="label font-medium">Buying Date</label>
                    <input type="date" name="buying_date" class="input input-bordered w-full focus:input-primary"
                        value="{{ old('buying_date') }}">
                    <x-forms.error name="buying_date" />
                </div>

                <!-- Actions -->
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="btn btn-primary flex-1 shadow hover:scale-[1.02] transition">
                        Save Bond
                    </button>

                    <a href="{{ route('Bond.index') }}" class="btn btn-outline">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>