<x-jet-action-section>
    <x-slot name="title">
        Autenticación de dos factores
    </x-slot>

    <x-slot name="description">
        Añada seguridad adicional a su cuenta utilizando la autenticación de dos factores.
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                Ha habilitado la autenticación de dos factores.
            @else
                No ha habilitado la autenticación de dos factores.
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                Cuando se habilita la autenticación de dos factores, se le pedirá un token seguro y aleatorio durante la autenticación. Puedes recuperar este token desde la aplicación Google Authenticator de tu teléfono.
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        La autenticación de dos factores está ahora activada. Escanea el siguiente código QR usando la aplicación de autenticación de tu teléfono.
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        Guarda estos códigos de recuperación en un administrador de contraseñas seguro. Pueden utilizarse para recuperar el acceso a su cuenta si se pierde su dispositivo de autenticación de dos factores.
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-button type="button" wire:click="enableTwoFactorAuthentication" wire:loading.attr="disabled">
                    Habilitar
                </x-jet-button>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-secondary-button class="mr-3" wire:click="regenerateRecoveryCodes">
                        Regenerar los códigos de recuperación
                    </x-jet-secondary-button>
                @else
                    <x-jet-secondary-button class="mr-3" wire:click="$toggle('showingRecoveryCodes')">
                        Mostrar códigos de recuperación
                    </x-jet-secondary-button>
                @endif

                <x-jet-danger-button wire:click="disableTwoFactorAuthentication" wire:loading.attr="disabled">
                    Desactivar
                </x-jet-danger-button>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
