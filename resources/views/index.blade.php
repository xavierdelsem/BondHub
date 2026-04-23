<x-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">My Prize Bonds</h1>
        <a href="{{ route('bond.create') }}" class="btn btn-primary">Add New Bond</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mb-4">
            <span>{{ $message }}</span>
        </div>
    @endif

    <div class="overflow-x-auto bg-base-200 rounded-box shadow">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Series</th>
                    <th class="text-center">Number</th>
                    <th class="text-center">Buying Date</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Claim Prize</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bonds as $bond)
                    <tr class="hover">
                        <td class="text-center">{{ ++$i }}</td>
                        <td class="text-center"><span class="badge badge-ghost">{{ $bond->bondSeries }}</span></td>
                        <td class="text-center font-mono font-bold">{{ $bond->bondNumber }}</td>
                        <td class="text-center">{{ $bond->buying_date?->format('d M, Y') ?? 'N/A' }}</td>
                        <td class="text-center">
                            <span class="badge {{ $bond->isPrizeWon ? 'badge-success' : 'badge-ghost' }}">
                                {{ $bond->isPrizeWon ? 'Winner' : 'No Prize' }}
                            </span>
                        </td>
                        <td class="text-center"><button type="button" class="btn btn-xs btn-outline" {{ $bond->isPrizeWon ? '' : 'disabled'}}>Claim</button>
                        </td>
                        <td class="text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('bond.edit', $bond) }}" class="btn btn-square btn-sm btn-ghost">Edit</a>
                                <form action="{{ route('bond.destroy', $bond) }}" method="POST"
                                    onsubmit="return confirm('Delete this bond?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-square btn-sm btn-error btn-outline">Del</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-gray-500">No bonds found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $bonds->links() }}</div>
</x-layout>