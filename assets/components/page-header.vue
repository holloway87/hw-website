<template>
    <div class="page-header">
        <h1 class="font-(family-name:--heading-font-family) font-semibold text-text text-3xl mb-4">
            {{ title }}
        </h1>

        <p v-if="$slots.default" class="text-text mb-2">
            <slot />
        </p>
    </div>
</template>

<script setup>
defineProps({
    'title': {
        'required': true,
        'type': String,
    },
});
</script>
