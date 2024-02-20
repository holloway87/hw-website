<template>
    <ButtonLink :url="url">
        <b-icon-arrow-left-square class="inline-block align-text-top text-xl mr-1" />
        back
    </ButtonLink>
</template>

<script>
import { BIconArrowLeftSquare } from 'bootstrap-vue';
import ButtonLink from './button-link';

export default {
    components: { BIconArrowLeftSquare, ButtonLink },
    props: {
        'url': {
            'required': true,
            'type': String,
        },
    },
};
</script>
