<template>
    <router-link class="inline-block bg-teal-600 text-white rounded-md text-center px-3 py-1.5" :to="url">
        <slot />
    </router-link>
</template>

<script setup>
defineProps({
    'url': {
        'required': true,
        'type': String,
    },
});
</script>
