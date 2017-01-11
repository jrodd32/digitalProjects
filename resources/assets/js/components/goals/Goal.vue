<style scoped>
    article {
        border: 1px solid #d3e0e9;
        max-width: 25%;
        padding: 1em;
    }
</style>

<template>
    <article>
        <h2>{{ goal.name }}</h2>
        <p>{{ goal.description }}</p>
        <a class="action-link" @click="editChild(goal)">Edit</a>
        <a class="action-link" @click="deleteChild(goal.id)">Delete</a>
    </article>
</template>

<script>
export default {
    props: ['goal', 'editChild', 'deleteChild']
}
</script>