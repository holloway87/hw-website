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
        </b-row>
    </div>
</template>

<script>
import LinkCard from '../components/link-card';

export default {
    components: { LinkCard },
};
</script>
