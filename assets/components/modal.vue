<template>
    <div v-if="show" class="fixed inset-0 overflow-auto z-40">
        <div class="fixed inset-0 bg-[#1f2e2b] bg-opacity-85"></div>
        <div class="flex min-h-full items-center justify-center px-4 py-8">
            <div
                :class="{
                    'bg-widget': true,
                    'rounded-md': true,
                    'shadow-md': true,
                    'shadow-gray-900/65': true,
                    'text-text': true,
                    'w-full': true,
                    'max-w-lg': 'lg' === size,
                    'max-w-2xl': '2xl' === size,
                    'max-w-3xl': '3xl' === size,
                    'max-w-4xl': '4xl' === size,
                    'z-40': true
                }"
            >
                <div class="px-4 pt-2 pb-1">
                    <slot name="header">
                        <h3 class="text-2xl">{{ title }}</h3>
                    </slot>
                </div>
                <div class="px-4 py-2 border-t border-[#1f2e2b]">
                    <slot />
                </div>
                <div v-if="$slots.footer" class="px-4 pt-1 pb-2 border-t border-[#1f2e2b]">
                    <slot name="footer" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    'show': {
        'required': true,
        'type': Boolean,
    },
    'title': {
        'required': false,
        'type': String,
    },
    'size': {
        'default': 'lg',
        'required': false,
        'type': String,
    },
});
</script>
