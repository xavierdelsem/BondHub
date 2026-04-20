<x-layout>
    <div class="max-w-lg mx-auto py-10 px-4">
        <div class="bg-base-100 shadow-xl rounded-2xl p-6 space-y-6">

            <!-- Header -->
            <div>
                <h1 class="text-2xl font-bold">Edit Prize Bond</h1>
                <p class="text-sm text-gray-400">
                    Update your bond details below {{ $bond->bondNumber }}
                </p>
            </div>

            <!-- Form -->

            <form method="POST" action="{{ route('bond.update', $bond) }}" class="space-y-5">
                @csrf
                @method('PATCH')

                <!-- Bond Series -->
                <div>
                    <label class="label font-medium">Bond Series</label>
                    <input type="text" name="bondSeries"
                        class="input input-bordered w-full focus:input-primary @error('bondSeries') input-error @enderror"
                        placeholder="e.g. KA" value="{{ old('bondSeries', $bond->bondSeries) }}"
                        oninput="this.value = this.value.toUpperCase()" required>
                    <x-forms.error name="bondSeries" />
                </div>

                <!-- Bond Number -->
                <div>
                    <label class="label font-medium">Bond Number</label>
                    <input type="text" name="bondNumber"
                        class="input input-bordered w-full font-mono tracking-wider focus:input-primary @error('bondNumber') input-error @enderror"
                        placeholder="0000000" maxlength="7" value="{{ old('bondNumber', $bond->bondNumber) }}" required>
                    <x-forms.error name="bondNumber" />
                </div>

                <!-- Buying Date -->
                <div>
                    <label class="label font-medium">Buying Date</label>
                    <input type="date" name="buying_date"
                        class="input input-bordered w-full focus:input-primary @error('buying_date') input-error @enderror"
                        value="{{ old('buying_date', optional($bond->buying_date)->format('Y-m-d')) }}">
                    <x-forms.error name="buying_date" />
                </div>

                <!-- Actions -->
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="btn btn-primary flex-1 shadow hover:scale-[1.02] transition">
                        Update Bond
                    </button>

                    <a href="{{ route('bond.index') }}" class="btn btn-outline">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>