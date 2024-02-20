<template>
    <div>
        <PageHeader title="Macro photos">
            I love magnifying the little things, here are some photos I took with a macro lens.
        </PageHeader>

        <PhotosGallery project="macro" />

        <div class="text-center mb-4">
            <ButtonBack url="/photo-projects" />
        </div>
    </div>
</template>

<script>
import ButtonBack from '../components/button-back';
import PageHeader from '../components/page-header';
import PhotosGallery from '../components/photos-gallery';

export default {
    components: { ButtonBack, PageHeader, PhotosGallery }
};
</script>
