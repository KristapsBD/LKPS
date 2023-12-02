@extends('layouts.default')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Parcel History') }}
    </h2>
@endsection

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mt-5">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Size
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Weight
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Notes
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <!-- Add more table headers for other parcel details -->
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($parcels as $parcel)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $parcel->size }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $parcel->weight }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $parcel->notes }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $parcel->created_at }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ mapParcelStatusToValue($parcel->status) }}
                            </td>
                            <!-- Add more table cells for other parcel details -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
