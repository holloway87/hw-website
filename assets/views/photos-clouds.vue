<template>
    <div>
        <h1>Cloud photos</h1>

        <p>I can't see enough of clouds, especially from above.</p>

        <PhotosGallery project="clouds" />

        <div class="text-center mb-4">
            <ButtonBack url="/photo-projects" />
        </div>
    </div>
</template>

<script>
import ButtonBack from '../components/button-back';
import PhotosGallery from '../components/photos-gallery';

export default {
    components: { ButtonBack, PhotosGallery }
};
</script>
