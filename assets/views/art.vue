<template>
    <div>
        <h1>Art</h1>

        <p>Listed below are some of my illustrations, comics or silly doodles.</p>

        <b-row>
            <b-col sm="6" md="4">
                <LinkCard
                    description="One panel comic strips about my ghost Abe."
                    image="/images/art_the_life_of_abe.png"
                    title="The Life of Abe"
                    url="/illustrations/the-life-of-abe"
                />
            </b-col>
            <b-col sm="6" md="4">
                <LinkCard
                    description="Silly doodles about Maaya's community."
                    image="/images/art_maaya_community_doodles.png"
                    title="Maaya's community doodles"
                    url="/illustrations/maaya-community-doodles"
                />
            </b-col>
        </b-row>

        <div class="text-center mb-4">
            <ButtonBack url="/" />
        </div>
    </div>
</template>

<script>
import ButtonBack from '../components/button-back';
import LinkCard from '../components/link-card';

export default {
    components: { ButtonBack, LinkCard },
};
</script>
