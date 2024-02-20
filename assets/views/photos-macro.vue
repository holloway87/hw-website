<template>
    <div>
        <PageHeader title="Macro photos">
            I love magnifying the little things, here are some photos I took with a macro lens.
        </PageHeader>

        <ProjectPhotosGallery project="macro" class="mb-5" />

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
