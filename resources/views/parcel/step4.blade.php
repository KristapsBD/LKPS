@extends('layouts.default')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Step 4 - Parcel Overview') }}
    </h2>
@endsection

@section('content')
    {{--TODO ADD TRACKING CODE TO PARCEL--}}
{{--    TODO FIX MISSING FOREIGN KEYS--}}

    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            <form method="POST" action="{{ route('parcel.storeAllData') }}">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parcel Information</label>
                        <div class="flex">
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="Size {{ $step1Data ? $step1Data['size'] : '' }}, {{ $step1Data ? $step1Data['weight'] : '' }} kg" placeholder="Parcel information here..." required disabled>
                            <a href="{{ route('parcel.step1') }}">
                                <button type="button" class="text-white ml-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Edit
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sender Information</label>
                        <div class="flex">
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $step2Data ? $step2Data['sender_name'] : '' }}, {{ $step2Data ? $step2Data['sender_email'] : '' }}, {{ $step2Data ? $step2Data['sender_phone'] : '' }}" placeholder="Sender information here..." required disabled>
                            <a href="{{ route('parcel.step2') }}">
                                <button type="button" class="text-white ml-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Edit
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sender Address</label>
                        <div class="flex">
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $step2Data ? $step2Data['sender_street'] : '' }}, {{ $step2Data ? $step2Data['sender_city'] : '' }}, {{ $step2Data ? $step2Data['sender_postal_code'] : '' }}" placeholder="Sender information here..." required disabled>
                            <a href="{{ route('parcel.step2') }}">
                                <button type="button" class="text-white ml-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Edit
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Receiver Information</label>
                        <div class="flex">
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $step3Data ? $step3Data['receiver_name'] : '' }}, {{ $step3Data ? $step3Data['receiver_phone'] : '' }}" placeholder="Receiver information here..." required disabled>
                            <a href="{{ route('parcel.step3') }}">
                                <button type="button" class="text-white ml-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Edit
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Receiver Address</label>
                        <div class="flex">
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $step3Data ? $step3Data['receiver_street'] : '' }}, {{ $step3Data ? $step3Data['receiver_city'] : '' }}, {{ $step3Data ? $step3Data['receiver_postal_code'] : '' }}" placeholder="Receiver information here..." required disabled>
                            <a href="{{ route('parcel.step3') }}">
                                <button type="button" class="text-white ml-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Edit
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Additional Notes</label>
                        <textarea id="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Parcel notes here..." disabled>{{ $step1Data ? $step1Data['notes'] : 'N/A' }}</textarea>
                    </div>
                </div>
                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Proceed To Payment</button>
            </form>
        </div>
    </section>
@endsection
