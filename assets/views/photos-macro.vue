<template>
    <div>
        <PageHeader title="Macro photos" />

        <WidgetContainer class="mb-10">
            <SubHeading class="mb-4">
                I love magnifying the little things, here are some photos I took
                with a macro lens.
            </SubHeading>

            <ProjectPhotosGallery project="macro" class="mb-5" />

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
