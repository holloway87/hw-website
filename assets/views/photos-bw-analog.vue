<template>
    <div class="page-photos-bw-analog">
        <PageHeader title="B/W analog" />

        <WidgetContainer class="mb-10">
            <SubHeading class="mb-4">
                I recently got an analog camera and want to try out black and
                white photos.
            </SubHeading>

            <ProjectPhotosGallery project="bw_analog" class="mb-5" />

            <div class="text-center">
                <ButtonBack :url="store.back_url" />
            </div>
        </WidgetContainer>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import ButtonBack from '../components/button-back';
import PageHeader from '../components/page-header';
import ProjectPhotosGallery from '../components/project-photos-gallery';
import SubHeading from '../components/sub-heading';
import WidgetContainer from '../components/widget-container';
import useDefaultStore from '../stores/default';

const store = useDefaultStore();

onMounted(() => {
    store.setBackUrl('/photo-projects');
});
</script>
