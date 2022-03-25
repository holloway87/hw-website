<template>
    <div>
        <h1>Photos</h1>

        <p>These are some of my photo projects:</p>

        <b-row>
            <b-col sm="6" md="4">
                <LinkCard
                    description="Photos I took with a macro lens."
                    image="/images/photos_macro.png"
                    title="Macro photos"
                    url="/photo-projects/macro"
                />
            </b-col>
            <b-col sm="6" md="4">
                <LinkCard
                    description="Photos of those squishy things in the sky."
                    image="/images/home_photos.png"
                    title="Cloud photos"
                    url="/photo-projects/clouds"
                />
            </b-col>
            <b-col sm="6" md="4">
                <LinkCard
                    description="Photos of my cat Mia."
                    image="/images/photos_mia.png"
                    title="My cat Mia"
                    url="/photo-projects/mia"
                />
            </b-col>
        </b-row>
    </div>
</template>

<script>
import LinkCard from '../components/link-card';

export default {
    components: { LinkCard },
};
</script>
