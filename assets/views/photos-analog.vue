<template>
    <div class="page-photos-analog">
        <PageHeader title="Analog">
            Color photos I created with my analog camera.
        </PageHeader>

        <ProjectPhotosGallery project="analog" class="mb-5" />

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
import useDefaultStore from '../store';

const store = useDefaultStore();

onMounted(() => {
    store.setBackUrl('/photo-projects');
});
</script>
