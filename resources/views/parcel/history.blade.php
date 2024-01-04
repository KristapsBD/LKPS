@extends('layouts.default')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Parcel History') }}
    </h2>
@endsection

@section('content')
    @if ($parcels->isEmpty())
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("No parcels have been found.") }}
            </div>
        </div>
    @else
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Receiver
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Size
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Weight
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($parcels as $parcel)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $parcel->receiver->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ mapParcelSizeToValue($parcel->size) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $parcel->weight . " kg" }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $parcel->created_at }}
                        </td>
                        <td class="px-6 py-4">
                            {{ mapParcelStatusToValue($parcel->status) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <!-- Pagination links -->
    <div class="mt-4">
        {{ $parcels->links() }}
    </div>
@endsection
