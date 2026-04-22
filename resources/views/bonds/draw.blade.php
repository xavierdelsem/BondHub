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




    <div class="overflow-x-auto bg-base-200 rounded-box shadow">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Number</th>
                    <th>Publish Date</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($draws as $draw)
                    <tr class="hover">
                        <td>{{ ++$i }}</td>
                        <td class="font-mono font-bold">{{ $draw->drawNumber }}</td>
                        <td>{{ $draw->drawDate?->format('d M, Y') ?? 'N/A'}}</td>
                        <td class="text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('bond.edit', $draw) }}" class="btn btn-square btn-sm btn-ghost">Edit</a>
                                <form action="{{ route('bond.destroy', $draw) }}" method="POST"
                                    onsubmit="return confirm('Delete this bond?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-square btn-sm btn-error btn-outline">Del</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @forelse($draws ?? [] as $draw)
                    {{ $draw->name }}
                @empty
                    <p class="">No bonds found.</p>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $draws->links() }}</div>
</x-layout>