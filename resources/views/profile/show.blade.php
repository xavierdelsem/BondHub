<x-layout>
    <div class="max-w-5xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-8">User Profile</h1>

        @if (session('success'))
            <div class="alert alert-success shadow mb-6">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Basic Info -->
            <div class="bg-base-100 shadow rounded-xl p-6 space-y-6">
                <h2 class="text-xl font-semibold border-b pb-2">Basic Information</h2>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="label font-medium">Full Name</label>
                        <input type="text" name="name" class="input input-bordered w-full"
                            value="{{ old('name', $user->name) }}" />
                        <x-forms.error name="name" />
                    </div>

                    <div>
                        <label class="label font-medium">Email</label>
                        <input type="email" class="input input-bordered w-full bg-gray-700 cursor-not-allowed"
                            value="{{ $user->email }}" disabled />
                        <span class="text-xs text-gray-400">Email cannot be changed</span>
                    </div>

                    <!-- ✅ UPDATED RELATION -->
                    <div>
                        <label class="label font-medium">Care Of</label>
                        <select name="relation" id="relationSelect" class="select select-bordered w-full">
                            <option value="">Select</option>
                            <option value="father" {{ old('relation', $user->relation) == 'father' ? 'selected' : '' }}>
                                Father
                            </option>
                            <option value="husband" {{ old('relation', $user->relation) == 'husband' ? 'selected' : '' }}>
                                Husband
                            </option>
                        </select>
                        <x-forms.error name="relation" />
                    </div>

                    <div>
                        <label class="label font-medium">Age</label>
                        <input type="number" name="age" class="input input-bordered w-full"
                            value="{{ old('age', $user->age) }}" />
                        <x-forms.error name="age" />
                    </div>
                </div>
            </div>

            <!-- Address -->
            <div class="bg-base-100 shadow rounded-xl p-6 space-y-6">
                <h2 class="text-xl font-semibold border-b pb-2">Address & Details</h2>

                <div class="grid md:grid-cols-3 gap-5">

                    <!-- ✅ DYNAMIC CARE OF -->
                    <div class="md:col-span-2">
                        <label id="relationLabel" class="label font-medium">
                            Care Of Name
                        </label>
                        <input type="text" name="relation_name" id="relationInput" class="input input-bordered w-full"
                            value="{{ old('relation_name', $user->relation_name) }}" />
                        <x-forms.error name="relation_name" />
                    </div>

                    <div>
                        <label class="label font-medium">Occupation</label>
                        <input type="text" name="occupation" class="input input-bordered w-full"
                            value="{{ old('occupation', $user->occupation) }}" />
                        <x-forms.error name="occupation" />
                    </div>

                    <div>
                        <label class="label font-medium">Village</label>
                        <input type="text" name="village" class="input input-bordered w-full"
                            value="{{ old('village', $user->village) }}" />
                        <x-forms.error name="village" />
                    </div>

                    <div>
                        <label class="label font-medium">Post Office</label>
                        <input type="text" name="post" class="input input-bordered w-full"
                            value="{{ old('post', $user->post) }}" />
                        <x-forms.error name="post" />
                    </div>

                    <div>
                        <label class="label font-medium">District</label>
                        <input type="text" name="zilla" class="input input-bordered w-full"
                            value="{{ old('zilla', $user->zilla) }}" />
                        <x-forms.error name="zilla" />
                    </div>
                </div>
            </div>

            <!-- Bank -->
            <div class="bg-base-100 shadow rounded-xl p-6 space-y-6">
                <h2 class="text-xl font-semibold border-b pb-2 text-primary">
                    Banking Details
                </h2>

                <div class="grid md:grid-cols-3 gap-5">
                    <div>
                        <label class="label font-medium">Bank Name</label>
                        <input type="text" name="bankName" class="input input-bordered w-full"
                            value="{{ old('bankName', $user->bankName) }}" />
                        <x-forms.error name="bankName" />
                    </div>

                    <div>
                        <label class="label font-medium">Branch</label>
                        <input type="text" name="bankBranch" class="input input-bordered w-full"
                            value="{{ old('bankBranch', $user->bankBranch) }}" />
                        <x-forms.error name="bankBranch" />
                    </div>

                    <div>
                        <label class="label font-medium">Account Number</label>
                        <input type="text" name="bankAccountNumber" class="input input-bordered w-full font-mono"
                            value="{{ old('bankAccountNumber', $user->bankAccountNumber) }}" />
                        <x-forms.error name="bankAccountNumber" />
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="sticky bottom-0 bg-base-100 pt-4 pb-2 border-t flex justify-end">
                <button type="submit" class="btn btn-primary px-10 shadow-md hover:scale-[1.02] transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- ✅ JS FOR DYNAMIC LABEL -->
    <script>
        const relationSelect = document.getElementById('relationSelect');
        const relationLabel = document.getElementById('relationLabel');

        const labels = {
            father: "Father's Name",
            husband: "Husband's Name"
        };

        function updateLabel() {
            const value = relationSelect.value;
            relationLabel.textContent = labels[value] ?? "Care Of Name";
        }

        relationSelect.addEventListener('change', updateLabel);

        // run on page load
        window.addEventListener('DOMContentLoaded', updateLabel);
    </script>
</x-layout>