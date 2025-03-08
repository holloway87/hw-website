<template>
    <div>
        <PageHeader title="My cat Mia">I love her.</PageHeader>

        <ProjectPhotosGallery project="mia" class="mb-5" />

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
