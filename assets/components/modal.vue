<template>
    <div v-if="show" class="fixed inset-0 overflow-auto z-40">
        <div class="fixed inset-0 bg-[#1f2e2b] bg-opacity-85"></div>
        <div class="flex min-h-full items-center justify-center px-4 py-8">
            <div class="bg-[#151f1d] rounded-md shadow-md shadow-gray-900/65 text-white w-full max-w-lg z-40">
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
    }
});
</script>
