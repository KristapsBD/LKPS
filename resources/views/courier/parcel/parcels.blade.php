@extends('layouts.courier')
@section('content')
    @if ($parcels->isEmpty())
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("No parcels have been found.") }}
            </div>
        </div>
    @else
        <form id="parcel-select-form" action="" method="POST">
            @csrf
            <h2 class="text-2xl font-semibold dark:text-gray-200 mb-4">Parcel Management</h2>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Size
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Weight
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Notes
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Sender
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Sender Phone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Receiver
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Receiver Phone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($parcels as $parcel)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input value="{{ $parcel->id }}" id="checkbox-table-search-{{ $parcel->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-search-{{ $parcel->id }}" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $parcel->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $parcel->size }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $parcel->weight }}
                            </td>
                            <td class="px-6 py-4">
                                {{ Str::words($parcel->notes, 5) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ mapParcelStatusToValue($parcel->status) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $parcel->sender->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $parcel->sender->phone }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $parcel->receiver->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $parcel->receiver->phone }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <a href="{{ route('courier.editParcelForm', $parcel->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Hidden input field to store selected parcel IDs -->
            <input type="hidden" id="selected-parcels" name="selected_parcels" value="">
        </form>
    @endif
    <!-- Pagination links -->
    <div class="mt-4">
        {{ $parcels->links() }}
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/checkAllFormCheckboxes.js') }}" defer></script>
@endsection
