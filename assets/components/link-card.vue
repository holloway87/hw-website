<template>
    <router-link class="link-card" :to="url">
        <b-card
            class="mb-4"
            :img-src="image"
            overlay
            :title="title"
        >
            <b-card-text>{{ description }}</b-card-text>
        </b-card>
    </router-link>
</template>

<script>
export default {
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

<style lang="scss">
@import "node_modules/bootstrap/scss/functions";
@import "../styles/bootstrap/variables";

.link-card {
    .card {
        border: none;

        .card-body {
            color: $white;
        }
    }

    &:hover {
        text-decoration: none;
    }
}
</style>
