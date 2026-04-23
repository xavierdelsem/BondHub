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
            <form action="{{ route('draws.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Bond Number -->
                <div>
                    <label class="label font-medium">Bond Number</label>
                    <input type="number" name="drawNumber"
                        class="input input-bordered w-full font-mono tracking-wider focus:input-primary"
                        placeholder="1200700" value="{{ old('drawNumber') }}" required>
                    <x-forms.error name="drawNumber" />
                </div>

                <div>
                    <label class="label font-medium">Prize Position</label>
                    <select name="prizePosition" class="select select-bordered w-full">
                        <option value="" disabled {{ !old('prizePosition') ? 'selected' : '' }}>Select Position</option>
                        <option value="1" {{ old('prizePosition') == 1 ? 'selected' : '' }}>1st Prize</option>
                        <option value="2" {{ old('prizePosition') == 2 ? 'selected' : '' }}>2nd Prize</option>
                        <option value="3" {{ old('prizePosition') == 3 ? 'selected' : '' }}>3rd Prize</option>
                        <option value="4" {{ old('prizePosition') == 4 ? 'selected' : '' }}>4th Prize</option>
                        <option value="5" {{ old('prizePosition') == 5 ? 'selected' : '' }}>5th Prize</option>
                    </select>
                    <x-forms.error name="prizePosition" />
                </div>

                <!-- Buying Date -->
                <div>
                    <label class="label font-medium">Draw Date</label>
                    <input type="date" name="drawDate" class="input input-bordered w-full focus:input-primary"
                        value="{{ now()->format('Y-m-d') }}" readonly>
                    <x-forms.error name="drawDate" />
                </div>

                <!-- Actions -->
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="btn btn-secondary flex-1 shadow hover:scale-[1.02] transition">
                        Publish Result
                    </button>

                    <a href="{{ route('bonds.index') }}" class="btn btn-outline">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Published Prize Draw</h1>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mb-4">
            <span>{{ $message }}</span>
        </div>
    @endif




    <div class="overflow-x-auto bg-base-200 rounded-box shadow mt-6">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Number</th>
                    <th class="text-center">Prize Position</th>
                    <th class="text-center">Publish Date</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($draws as $draw)
                    <tr class="hover">
                        <td class="text-center">{{ ++$i }}</td>
                        <td class="text-center font-mono font-bold">{{ $draw->drawNumber }}</td>
                        <td class="text-center font-mono font-bold">{{ $draw->prizePosition }}</td>
                        <td class="text-center">{{ $draw->drawDate?->format('d M, Y') ?? 'N/A'}}</td>
                        <td class="text-right">
                            <div class="flex justify-end">
                                <form action="{{ route('draw.destroy', $draw) }}" method="POST"
                                    onsubmit="return confirm('Delete this Draw Record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm btn-outline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-gray-500">No Results found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $draws->links() }}</div>
</x-layout>