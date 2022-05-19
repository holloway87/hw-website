<template>
    <div>
        <h1>Macro photos</h1>

        <p>I love magnifying the little things, here are some photos I took with a macro lens.</p>

        <PhotosGallery project="macro" />

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
