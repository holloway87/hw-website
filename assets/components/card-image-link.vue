<template>
    <router-link :to="url">
        <Card :title="title" :description="description" :image="image" />
    </router-link>
</template>

<script setup>
import Card from './card';

defineProps({
    'description': {
        'required': true,
        'type': String,
    },
    'image': {
        'required': true,
        'type': String,
    },
    'title': {
        'required': true,
        'type': String,
    },
    'url': {
        'required': true,
        'type': String,
    },
});
</script>
