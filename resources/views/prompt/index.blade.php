@extends('layouts.app')
@section('content')

<div x-data='promptBuilder()' class='space-y-6'>

    {{-- HEADER --}}
    <header class='text-center pb-4'>
        <h1 class='text-4xl font-black text-transparent bg-clip-text
                   bg-gradient-to-r from-red-400 via-yellow-300 to-blue-400'>
            PromptMagico
        </h1>
        <p class='text-slate-400 mt-2'>Elige iconos y genera tu prompt sin escribir</p>
    </header>

    {{-- BARRA DE PROGRESO --}}
    <div class='bg-slate-700 rounded-full h-2'>
        <div class='h-2 rounded-full transition-all duration-500
                    bg-gradient-to-r from-red-400 to-blue-400'
             :style='`width: ${progress}%`'></div>
    </div>
    <p class='text-right text-xs text-slate-400'
       x-text='`${selectedCount} de {{ $categories->count() }} seleccionados`'></p>

    {{-- CATEGORIAS (se renderizan desde la BD, sin hardcodear) --}}
    @foreach ($categories as $category)
    <section class='bg-slate-800 rounded-2xl p-5 border border-slate-700 transition-colors'
             :class="{ 'border-slate-500': selections['{{ $category->key }}'] }">

        <div class='flex items-center gap-2 mb-4'>
            <span class='text-xl'>{{ $category->emoji }}</span>
            <h2 class='font-bold text-white'>{{ $category->label }}</h2>
            <span class='ml-auto text-xs font-semibold text-emerald-400'
                  x-show="selections['{{ $category->key }}']"
                  x-text="selectedLabel['{{ $category->key }}'] || ''"
                  x-cloak></span>
        </div>

        <div class='grid grid-cols-4 sm:grid-cols-5 gap-2'>
            @foreach ($category->options as $option)
            <button @click="toggle('{{ $category->key }}', {{ $option->id }}, '{{ $option->label }}')"
                :class="{
                    'ring-2 ring-blue-400 ring-offset-1 ring-offset-slate-800 scale-105 bg-slate-600':
                     selections['{{ $category->key }}'] === {{ $option->id }}
                }"
                class='flex flex-col items-center gap-1 bg-slate-700 rounded-xl p-3
                       hover:bg-slate-600 transition-all cursor-pointer'>
                <span class='text-2xl'>{{ $option->icon }}</span>
                <span class='text-xs text-slate-300 font-semibold'>{{ $option->label }}</span>
            </button>
            @endforeach
        </div>
    </section>
    @endforeach

    {{-- BOTON GENERAR --}}
    <button @click='generate()'
            :disabled='selectedCount === 0 || loading'
            class='w-full py-4 rounded-2xl font-black text-xl
                   bg-gradient-to-r from-red-500 to-orange-400
                   disabled:opacity-40 disabled:cursor-not-allowed
                   hover:scale-[1.02] active:scale-95 transition-all
                   shadow-lg shadow-red-500/30'>
        <span x-show='!loading'>Generar Prompt</span>
        <span x-show='loading' x-cloak>Generando...</span>
    </button>

    {{-- OUTPUT --}}
    <div x-show='prompt' x-cloak x-transition
         class='bg-slate-800 rounded-2xl border border-purple-500/30 overflow-hidden'>
        <div class='flex justify-between items-center px-5 py-3
                    bg-purple-500/10 border-b border-slate-700'>
            <span class='font-bold text-purple-300'>Tu prompt</span>
            <button @click='copy()'
                    class='text-sm px-4 py-1 rounded-full border border-purple-400/40
                           text-purple-300 hover:bg-purple-500/20 transition'
                    x-text='copied ? "Copiado!" : "Copiar"'>
            </button>
        </div>
        <p x-text='prompt' class='p-5 leading-relaxed text-slate-100 font-medium'></p>
    </div>
</div>

<script>
function promptBuilder() {
    return {
        selections:    {},   // { personaje: 3, estilo: 7, ... }
        selectedLabel: {},   // { personaje: 'Gato', ... }
        prompt:  '',
        loading: false,
        copied:  false,

        get selectedCount() {
            return Object.keys(this.selections).length;
        },
        get progress() {
            return (this.selectedCount / {{ $categories->count() }}) * 100;
        },

        // Seleccionar / deseleccionar un icono
        toggle(catKey, optionId, label) {
            if (this.selections[catKey] === optionId) {
                delete this.selections[catKey];
                delete this.selectedLabel[catKey];
            } else {
                this.selections[catKey] = optionId;
                this.selectedLabel[catKey] = label;
            }
            this.selections = { ...this.selections };
        },

        // Llamar al backend y obtener el prompt
        async generate() {
            this.loading = true;
            const res = await fetch('{{ route('prompt.generate') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('[name=csrf-token]').content
                },
                body: JSON.stringify({ selections: this.selections })
            });
            const data = await res.json();
            this.prompt  = data.prompt;
            this.loading = false;
        },

        // Copiar al portapapeles
        copy() {
            navigator.clipboard.writeText(this.prompt).then(() => {
                this.copied = true;
                setTimeout(() => this.copied = false, 2500);
            });
        }
    }
}
</script>
@endsection
