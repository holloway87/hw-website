<template>
    <ButtonLink :url="url">
        <ChevronLeftIcon class="h-6 inline-block align-bottom" />
        back
    </ButtonLink>
</template>

<script setup>
import { ChevronLeftIcon } from '@heroicons/vue/24/outline';
import ButtonLink from './button-link';

defineProps({
    'url': {
        'required': true,
        'type': String,
    },
});
</script>
