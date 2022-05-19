<template>
    <router-link class="btn btn-primary btn-back" :to="url">
        <b-icon-arrow-left-square />
        back
    </router-link>
</template>

<script>
import { BIconArrowLeftSquare } from 'bootstrap-vue';

export default {
    components: { BIconArrowLeftSquare },
    props: {
        'url': {
            'required': true,
            'type': String,
        },
    },
};
</script>

<style lang="scss">
.btn-back {
    line-height: 1;
}
</style>
