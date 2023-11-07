@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h2 class="text-2xl mb-4">{{ __('Parcel List') }}</h2>

        <table class="w-full border-collapse">
            <!-- ... -->
        </table>
    </div>

    <!-- For Create Parcel View -->
    <div class="container mx-auto">
        <h2 class="text-2xl mb-4">{{ __('Create Parcel') }}</h2>

        <form method="POST" action="{{ route('admin.parcels.store') }}" class="space-y-4">
            @csrf

            <!-- Add form fields with Tailwind CSS classes -->
            <!-- ... -->

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Create Parcel') }}
            </button>
        </form>
    </div>
@endsection
