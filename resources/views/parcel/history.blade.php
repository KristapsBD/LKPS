<x-app-layout>
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold dark:text-white">Parcel History</h2>
        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Parcel Size
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Parcel Weight
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Additional Notes
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Create Date
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
                            <!-- Add more table cells for other parcel details -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
