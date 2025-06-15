<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Télécharger un fichier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- File Upload -->
                        <div class="mb-6">
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                Sélectionner un fichier
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Télécharger un fichier</span>
                                            <input id="file" name="file" type="file" class="sr-only" accept=".pdf,.xlsx,.xls,.docx,.doc,.csv,.sps" required>
                                        </label>
                                        <p class="pl-1">ou glisser-déposer</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        Fichiers supportés: PDF, Excel (XLSX, XLS), Word (DOCX, DOC), CSV, SPS
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Taille maximum: 10MB
                                    </p>
                                </div>
                            </div>
                            @error('file')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- File Info Display (JavaScript will populate this) -->
                        <div id="file-info" class="hidden mb-6 p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <span id="file-icon" class="text-2xl mr-3"></span>
                                <div class="flex-1">
                                    <div id="file-name" class="text-sm font-medium text-gray-900"></div>
                                    <div id="file-size" class="text-sm text-gray-500"></div>
                                </div>
                                <button type="button" id="remove-file" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description (optionnel)
                            </label>
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Ajoutez une description de votre fichier...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Supported File Types Info -->
                        <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                            <h4 class="text-sm font-medium text-blue-900 mb-2">Types de fichiers supportés:</h4>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-sm text-blue-700">
                                @foreach($supportedExtensions as $ext)
                                    <div class="flex items-center">
                                        <span class="mr-2">
                                            @switch($ext)
                                                @case('pdf')
                                                    📄
                                                    @break
                                                @case('xlsx')
                                                @case('xls')
                                                    📊
                                                    @break
                                                @case('docx')
                                                @case('doc')
                                                    📝
                                                    @break
                                                @case('csv')
                                                    📋
                                                    @break
                                                @case('sps')
                                                    🔢
                                                    @break
                                                @default
                                                    📁
                                            @endswitch
                                        </span>
                                        {{ strtoupper($ext) }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between">
                            <a href="{{ route('files.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Télécharger le fichier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('file');
            const fileInfo = document.getElementById('file-info');
            const fileName = document.getElementById('file-name');
            const fileSize = document.getElementById('file-size');
            const fileIcon = document.getElementById('file-icon');
            const removeFile = document.getElementById('remove-file');

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            function getFileIcon(extension) {
                const icons = {
                    'pdf': '📄',
                    'xlsx': '📊',
                    'xls': '📊',
                    'docx': '📝',
                    'doc': '📝',
                    'csv': '📋',
                    'sps': '🔢'
                };
                return icons[extension.toLowerCase()] || '📁';
            }

            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const extension = file.name.split('.').pop();
                    fileName.textContent = file.name;
                    fileSize.textContent = formatFileSize(file.size);
                    fileIcon.textContent = getFileIcon(extension);
                    fileInfo.classList.remove('hidden');
                }
            });

            removeFile.addEventListener('click', function() {
                fileInput.value = '';
                fileInfo.classList.add('hidden');
            });
        });
    </script>
</x-app-layout> 