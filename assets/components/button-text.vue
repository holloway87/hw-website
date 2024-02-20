<template>
    <button
        class="inline-block bg-teal-600 text-white rounded-md text-center px-3 py-1.5"
        type="button"
        v-on:click="$emit('click', $event)"
    >
        <slot />
    </button>
</template>

<script>
export default {};
</script>
