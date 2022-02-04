<template>
    <div>
        <h1>Art</h1>

        <p>Listed below are some of my illustrations, comics or silly doodles.</p>

        <b-row>
            <b-col sm="4">
                <LinkCard
                    description="One panel comic strips about my ghost Abe."
                    image="/images/art_the_life_of_abe.png"
                    title="The Life of Abe"
                    url="/illustrations/the-life-of-abe"
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
