<template>
    <div>
        <h1>My cat Mia</h1>

        <p>I love her.</p>

        <PhotosGallery project="mia" />
    </div>
</template>

<script>
import PhotosGallery from '../components/photos-gallery';

export default {
    components: { PhotosGallery }
};
</script>
