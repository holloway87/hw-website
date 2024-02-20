<template>
    <router-link :to="url">
        <Card :title="title" :description="description" :image="image" />
    </router-link>
</template>

<script>
import Card from './card';

export default {
    components: { Card },
    props: {
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
    },
};
</script>
