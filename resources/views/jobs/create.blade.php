<x-layout>
    <x-slot:heading>Create job</x-slot:heading>

    <form method="POST" action="/jobs">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Create a New job listing</h2>
                <p class="mt-1 text-sm/6 text-gray-600">We just need a few details from you.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="title">
                            Title
                        </x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text"
                                          name="title"
                                          id="title"
                                          placeholder="CTO"
                                          required
                            />
                        </div>
                        <x-form-error name="title"/>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="salary">Salary</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="number"
                                          name="salary"
                                          id="salary"
                                          placeholder="Salary"
                                          required
                            />
                        </div>
                        <x-form-error name="salary"/>
                    </x-form-field>
                </div>

                {{--                this is another way of doing it--}}
                {{--                <div class="mt-10">--}}
                {{--                    @if($errors->any())--}}
                {{--                        <div class="mt-4">--}}
                {{--                            <div class="text-sm text-red-600 italic">--}}
                {{--                                <ul>--}}
                {{--                                    @foreach ($errors->all() as $error)--}}
                {{--                                        <li>{{ $error }}</li>--}}
                {{--                                    @endforeach--}}
                {{--                                </ul>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    @endif--}}
                {{--                </div>--}}
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <x-form-button>save</x-form-button>
        </div>
    </form>
</x-layout>