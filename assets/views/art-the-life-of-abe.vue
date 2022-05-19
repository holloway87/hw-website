<template>
    <div>
        <h1>The Life of Abe</h1>

        <p>These comic strips are about my ghost character Abe, who will be depicted in various actions.</p>

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

export default {
    components: { ButtonBack, ImagesPager },
};
</script>
