<template>
    <a :href="url" class="inline-block bg-teal-600 border-b-4 border-b-teal-700 hover:border-t-1 hover:border-t-teal-600 hover:border-b-3 active:border-t-1 active:border-t-teal-600 active:border-b-3 text-white rounded-md text-center px-3 py-1.5">
        <slot />
    </a>
</template>

<script setup>
defineProps({
    'url': {
        'required': true,
        'type': String,
    },
});
</script>
