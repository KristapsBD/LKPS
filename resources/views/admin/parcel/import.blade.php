@extends('layouts.admin')
@section('content')
    <h2 class="text-2xl font-semibold dark:text-gray-200">Import Parcels</h2>
    <!-- Import Form -->
    <form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data" id="import-form">
        @csrf
        <div class="flex items-center justify-center w-full mt-4">
            <label id="dropzone" for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-blue-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p id="file-name" class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">XLSX, CSV, ODS or XML</p>
                </div>
                <input id="dropzone-file" type="file" name="file" class="hidden" accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" onchange="updateFileName(this)"/>
            </label>
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-red-600 text-xs">{{$error}}</div>
            @endforeach
        @endif
        <button type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Import</button>
    </form>
@endsection

@section('scripts')
    <script>
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('dropzone-file');

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-blue-500');
            dropzone.classList.add('dark:border-blue-500');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-blue-500');
            dropzone.classList.remove('dark:border-blue-500');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-blue-500');
            dropzone.classList.add('dark:border-blue-500');

            fileInput.files = e.dataTransfer.files;
            updateFileName(fileInput);
        });

        function updateFileName(input) {
            const fileNameDisplay = document.getElementById('file-name');
            const fileName = input.files[0]?.name || 'No file selected';
            fileNameDisplay.innerText = `File: ${fileName}`;
        }
    </script>
@endsection
