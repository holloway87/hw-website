<template>
    <div>
        <h1>B/W analog</h1>

        <p>I recently got an analog camera and want to try out black and white photos.</p>

        <PhotosGallery project="bw_analog" />

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
