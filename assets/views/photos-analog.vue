<template>
    <div class="page-photos-analog">
        <PageHeader title="Analog">
            Color photos I created with my analog camera.
        </PageHeader>

        <ProjectPhotosGallery project="analog" class="mb-5" />

        <div class="text-center mb-4">
            <ButtonBack url="/photo-projects" />
        </div>
    </div>
</template>

<script>
import ButtonBack from '../components/button-back';
import PageHeader from '../components/page-header';
import ProjectPhotosGallery from '../components/project-photos-gallery';

export default {
    components: { ButtonBack, PageHeader, ProjectPhotosGallery }
};
</script>
