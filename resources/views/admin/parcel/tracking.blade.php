@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-semibold dark:text-gray-200 mb-4">Parcel Status History</h2>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Parcel ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Old Status
                </th>
                <th scope="col" class="px-6 py-3">
                    New Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Created At
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($parcelTrackings as $tracking)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $tracking->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $tracking->parcel_id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ mapParcelStatusToValue($tracking->old_status) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ mapParcelStatusToValue($tracking->new_status) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $tracking->created_at }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination links -->
    <div class="mt-4">
        {{ $parcelTrackings->links() }}
    </div>
@endsection

@section('scripts')
    <!-- Include any scripts needed for this view -->
@endsection
