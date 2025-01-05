<div class="mx-auto flex flex-col items-center justify-center h-screen bg-gradient-to-tr from-blue-600 to-blue-200">
    <div class="w-full max-w-sm border border-gray-300 rounded-lg p-8 bg-white shadow-lg">
        <div class="text-2xl font-semibold text-blue-700 mb-6">
            <i class="fa fa-user me-2"></i>
            Sign In to BackOffice
        </div>

        <form class="space-y-6" wire:submit="signin">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" wire:model="username" placeholder="Enter your username"
                    class="form-control mt-1">
                @if (isset($errorUsername))
                    <div class="text-red-500 text-xs mt-2">
                        <i class="fa fa-exclamation-triangle me-1"></i>
                        {{ $errorUsername }}
                    </div>
                @endif
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" wire:model="password" placeholder="Enter your password"
                    class="form-control mt-1">
                @if (isset($errorPassword))
                    <div class="text-red-500 text-xs mt-2">
                        <i class="fa fa-exclamation-triangle me-1"></i>
                        {{ $errorPassword }}
                    </div>
                @endif
            </div>

            <button type="submit"
                class="btn bg-blue-600 hover:bg-blue-700 text-white w-full py-3 rounded-md font-medium">
                Sign In
            </button>
        </form>

        @if (isset($error))
            <div class="text-red-500 text-sm mt-6">
                <i class="fa fa-exclamation-triangle me-1"></i>
                {{ $error }}
            </div>
        @endif
    </div>
</div>
