<template>
    <router-link :class="buttonClasses" :to="url">
        <slot />
    </router-link>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    'url': {
        'required': true,
        'type': String,
    },
    'variant': {
        'default': 'primary',
        'required': false,
        'type': String,
    },
});

const buttonClasses = computed(() => {
    const classes = {
        'inline-block': true,
        'border-b-4': true,
        'hover:border-t-1': true,
        'hover:border-b-3': true,
        'active:border-t-1': true,
        'active:border-b-3': true,
        'text-text': true,
        'rounded-md': true,
        'text-center': true,
        'px-3': true,
        'py-1.5': true,
        'cursor-pointer': true,
    };

    switch (props.variant) {
        case 'error':
            classes['bg-error'] = true;
            classes['border-b-error-shadow'] = true;
            classes['hover:border-t-error'] = true;
            classes['active:border-t-error'] = true;
            break;
        default:
            classes['bg-primary'] = true;
            classes['border-b-primary-shadow'] = true;
            classes['hover:border-t-primary'] = true;
            classes['active:border-t-primary'] = true;
            break;
    }

    return classes;
});
</script>
