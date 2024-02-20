<template>
    <div class="page-art-the-life-of-abe">
        <PageHeader title="The Life of Abe">
            These comic strips are about my ghost character Abe, who will be depicted in various actions.
        </PageHeader>

        <ImagesPager
            images_data_url="/illustrations/the-life-of-abe/get-image-files"
            no_images_message="There are currently no comic strips."
            title="The Life of Abe"
        />

        <div class="text-center mb-4">
            <ButtonBack url="/illustrations" />
        </div>
    </div>
</template>

<script>
import ButtonBack from '../components/button-back';
import ImagesPager from '../components/images-pager';
import PageHeader from '../components/page-header';

export default {
    components: { ButtonBack, ImagesPager, PageHeader },
};
</script>
