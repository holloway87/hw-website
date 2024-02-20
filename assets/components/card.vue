<template>
    <div :class="{
        'relative': image,
        'bg-[#151f1d]': !image,
        'rounded-md': !image,
    }">
        <img v-if="image" :src="image" class="rounded-md" :alt="title">
        <div :class="{
            'absolute': image,
            'top-0': image,
            'left-0': image,
            'p-5': true,
        }">
            <h3 class="text-white text-2xl mb-3">{{ title }}</h3>
            <p class="text-white mb-4">{{ description }}</p>
            <slot />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        'description': {
            'required': true,
            'type': String,
        },
        'image': {
            'required': false,
            'type': String,
        },
        'title': {
            'required': true,
            'type': String,
        },
    }
};
</script>
