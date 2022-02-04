<template>
    <div class="page-home">
        <h1>Welcome</h1>

        <p>Choose a category:</p>

        <b-row>
            <b-col sm="6" md="4">
                <LinkCard
                    description="Have a look at my illustrations."
                    image="/images/home_art.png"
                    title="Art"
                    url="/illustrations"
                />
            </b-col>
            <b-col sm="6" md="4">
                <LinkCard
                    description="I sometimes like to take photos."
                    image="/images/home_photos.png"
                    title="Photos"
                    url="/photos"
                />
            </b-col>
            <b-col sm="6" md="4">
                <LinkCard
                    description="These are some of my programming projects."
                    image="/images/home_dev.png"
                    title="Programming"
                    url="/dev"
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
