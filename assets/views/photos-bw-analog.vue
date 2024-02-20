<template>
    <div class="page-photos-bw-analog">
        <PageHeader title="B/W analog">
            I recently got an analog camera and want to try out black and white photos.
        </PageHeader>

        <PhotosGallery project="bw_analog" />

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
