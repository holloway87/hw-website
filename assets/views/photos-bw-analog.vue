<template>
    <div class="page-photos-bw-analog">
        <PageHeader title="B/W analog">
            I recently got an analog camera and want to try out black and white photos.
        </PageHeader>

        <ProjectPhotosGallery project="bw_analog" class="mb-5" />

        <div class="text-center mb-4">
            <ButtonBack :url="store.back_url" />
        </div>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import ButtonBack from '../components/button-back';
import PageHeader from '../components/page-header';
import ProjectPhotosGallery from '../components/project-photos-gallery';
import useDefaultStore from '../stores/default';

const store = useDefaultStore();

onMounted(() => {
    store.setBackUrl('/photo-projects');
});
</script>
