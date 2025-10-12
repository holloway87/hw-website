<template>
    <div :class="{
        'relative': image,
        'bg-widget': !image,
        'rounded-md': !image,
        'shadow-md': true
    }">
        <img v-if="image" :src="image" class="rounded-md" :alt="title">
        <div :class="{
            'absolute': image,
            'top-0': image,
            'left-0': image,
            'p-5': true,
        }">
            <h3 class="font-(family-name:--heading-font-family) font-semibold text-text text-2xl mb-3">{{ title }}</h3>
            <p class="text-text mb-4">{{ description }}</p>
            <slot />
        </div>
    </div>
</template>

<script setup>
defineProps({
    'description': {
        'required': true,
        'type': String,
    },
    'image': {
        'required': false,
        'type': String,
    },
    'title': {
        'required': true,
        'type': String,
    },
});
</script>
