<template>
    <div>
        <PageHeader title="Cloud photos">
            I can't see enough of clouds, especially from above.
        </PageHeader>

        <ProjectPhotosGallery project="clouds" class="mb-5" />

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
