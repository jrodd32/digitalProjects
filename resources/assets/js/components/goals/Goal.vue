<style scoped>
</style>

<template>
    <article>
        <h2>{{ goal.name }}</h2>
        <p>{{ goal.description }}</p>
    </article>
</template>

<script>
export default {
    props: ['goal']
}
</script>