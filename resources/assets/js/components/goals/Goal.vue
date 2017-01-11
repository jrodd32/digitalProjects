<style scoped>
</style>

<template>
    <article>
        <h2>{{ goal.name }}</h2>
        <p>{{ goal.description }}</p>
        <a class="action-link" @click="editChild(goal)">Edit</a>
    </article>
</template>

<script>
export default {
    props: ['goal', 'editChild'],
}
</script>