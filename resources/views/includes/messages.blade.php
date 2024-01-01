<div x-data="{ showMessage: true }" x-show="showMessage">
    @if (session('success'))
        <div class="flex items-top bg-green-100 border-l-4 border-green-500 text-green-700 p-4 z-50" role="alert" id="alert-success">
            <div>
                <p class="font-bold">Success</p>
                <p>{{ session('success') }}</p>
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-green-100 dark:text-green-400 dark:hover:bg-green-50" data-dismiss-target="#alert-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
</div>
<div x-data="{ showMessage: true }" x-show="showMessage">
    @if (session('error'))
        <div class="flex items-top bg-red-100 border-l-4 border-red-500 text-red-700 p-4 z-50" role="alert" id="alert-error">
            <div>
                <p class="font-bold">Error</p>
                <p>{{ session('error') }}</p>
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-red-100 dark:text-red-400 dark:hover:bg-red-50" data-dismiss-target="#alert-error" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
</div>
<div x-data="{ showMessage: true }" x-show="showMessage">
    @if (session('importErrors'))
        <div class="flex items-top bg-red-100 border-l-4 border-red-500 text-red-700 p-4 z-50" role="alert" id="alert-import-error">
            <div>
                @if (session('importValueError'))
                    <p class="font-bold">Import Finished With Errors!</p>
                @elseif (session('importHeaderError'))
                    <p class="font-bold">Import Failed!</p>
                @else
                    <p class="font-bold">Import Failed!</p>
                @endif
                <ul>
                    @if (session('importValueError'))
                        @foreach (session('importValueError') as $importError)
                            <li><b>Errors:</b> Row {{ $importError['row'] }}:<br>{!! implode('<br>', $importError['errors']) !!}</li>
                        @endforeach
                    @elseif (session('importHeaderError'))
                        <li>{{ session('importHeaderError') }}</li>
                    @else
                        <li>Unexpected Error. Please Try Again Or Contact Developers.</li>
                    @endif
                </ul>
                <p><b>Status:</b> {{ session('importCount') }} records imported.</p>
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-red-100 dark:text-red-400 dark:hover:bg-red-50" data-dismiss-target="#alert-import-error" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
</div>
