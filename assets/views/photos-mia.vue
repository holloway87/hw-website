<template>
    <div>
        <h1>My cat Mia</h1>

        <p>I love her.</p>

        <PhotosGallery project="mia" />

        <div class="text-center mb-4">
            <ButtonBack url="/photo-projects" />
        </div>
    </div>
</template>

<script>
import PhotosGallery from '../components/photos-gallery';
import ButtonBack from '../components/button-back';

export default {
    components: { ButtonBack, PhotosGallery }
};
</script>
