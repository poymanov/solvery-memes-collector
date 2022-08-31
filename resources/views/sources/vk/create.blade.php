<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create new VK Source
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form>
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="title" class="block text-sm font-medium text-gray-700">
                                        Title
                                    </label>
                                    <div class="mt-1 rounded-md shadow-sm">
                                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" required>
                                        @error('title') <span class="text-red-500 text-xs">{{ $errors->first('title') }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="url" class="block text-sm font-medium text-gray-700">
                                        URL
                                    </label>
                                    <div class="mt-1 rounded-md shadow-sm">
                                        <input type="text" name="url" id="url" placeholder="https://vk.com/test" value="{{ old('url') }}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" required>
                                        @error('url') <span class="text-red-500 text-xs">{{ $errors->first('url') }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
