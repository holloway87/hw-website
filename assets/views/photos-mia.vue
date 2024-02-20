<template>
    <div>
        <PageHeader title="My cat Mia">I love her.</PageHeader>

        <PhotosGallery project="mia" />

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
