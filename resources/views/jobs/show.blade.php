<x-layout>
    <x-slot:heading>Job</x-slot:heading>

    <h2 class="font-bold text-lg">{{ $job->title }}</h2>
    <p>this job pays ${{ $job->salary }} per year</p>

    @can('edit-job', $job)
        <p class="mt-6">
            <x-button href="/jobs/{{ $job->id }}/edit"
                      class="text-sm/6 font-semibold text-gray-900">Edit
            </x-button>
        </p>
    @endcan
</x-layout>