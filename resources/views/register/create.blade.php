<x-layout>

    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel class="bg-blue-100">
                <h1 class="text-center font-bold text-xl">REGISTER</h1>
                <form method="POST" action="/register" class="mt-10">
                    @csrf


                    <x-form.field>
                        <x-form.input name="name" />
                        <x-form.error name="name" />
                    </x-form.field>
                    <x-form.field>
                        <x-form.input name="username" />
                        <x-form.error name="username" />
                    </x-form.field>
                    <x-form.field>
                        <x-form.input name="email" type="email" />
                        <x-form.error name="email" />
                    </x-form.field>
                    <x-form.field>
                        <x-form.input name="password" type="password" />
                        <x-form.error name="password" />
                    </x-form.field>

                    <x-form.button>Register</x-form.button>


                </form>
            </x-panel>
        </main>
    </section>
</x-layout>