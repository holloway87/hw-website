<template>
    <VuePictureSwipe
        :items="files"
        :options="{'shareEl': false}"
    ></VuePictureSwipe>
</template>

<script setup>
import VuePictureSwipe from 'vue-picture-swipe';

defineProps({
    'files': {
        'required': true,
        'type': Array,
    },
});
</script>

<style lang="scss">
@reference "../styles/app.css"

.my-gallery {
    @apply grid grid-cols-1 gap-4;

    figure.gallery-thumbnail {
        @apply m-0;

        img {
            @apply rounded-md;
        }
    }
}

.gallery-columns-2 {
    .my-gallery {
        @apply grid grid-cols-2;
    }
}

.gallery-columns-3 {
    .my-gallery {
        @apply grid grid-cols-2 sm:grid-cols-3;
    }
}
</style>
