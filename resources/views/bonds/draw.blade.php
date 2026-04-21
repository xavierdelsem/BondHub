<x-layout>
    <div class="max-w-lg mx-auto py-10 px-4">
        <div class="bg-base-100 shadow-xl rounded-2xl p-6 space-y-6">

            <!-- Header -->
            <div>
                <h1 class="text-2xl font-bold">Admin Panel</h1>
                <p class="text-sm text-gray-400">
                    Enter Draw Results Carefully
                </p>
            </div>

            <!-- Form -->
            <form action="{{ route('bonds.store') }}" method="POST" class="space-y-5">
                @csrf

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
                    <label class="label font-medium">Draw Date</label>
                    <input type="date" name="drawDate" class="input input-bordered w-full focus:input-primary"
                        value="{{ now()->format('Y-m-d') }}" disabled>
                    <x-forms.error name="drawDate" />
                </div>

                <!-- Actions -->
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="btn btn-primary flex-1 shadow hover:scale-[1.02] transition">
                        Save Bond
                    </button>

                    <a href="{{ route('bonds.index') }}" class="btn btn-outline">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>