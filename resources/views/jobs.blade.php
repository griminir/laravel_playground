<x-layout>
    <x-slot:heading>Jobs Listings</x-slot>

    <ul>
        @foreach( $jobs as $job )
            <li>
                <a class="text-blue-500 hover:underline" href="/jobs/{{$job['id']}}">
                    <strong>
                        {{ $job['title'] }}:</strong> pays {{ $job['salary'] }} per year</a>
            </li>
        @endforeach
    </ul>
</x-layout>