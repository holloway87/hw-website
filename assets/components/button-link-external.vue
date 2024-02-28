<template>
    <a :href="url" class="inline-block bg-teal-600 text-white rounded-md text-center px-3 py-1.5">
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
