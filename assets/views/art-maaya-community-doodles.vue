<template>
    <div>
        <h1>Maaya's community doodles</h1>

        <p>
            I made some stupid doodles around Maaya's community.  Go check out her amazing art streams at
            <a href="https://www.twitch.tv/maaya" target="_blank" ref="nofollow">Twitch</a>.
        </p>

        <ImagesPager
            images_data_url="/illustrations/maaya-community-doodles/get-image-files"
            no_images_message="There are currently no doodles."
            title="Maaya's community doodles"
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
