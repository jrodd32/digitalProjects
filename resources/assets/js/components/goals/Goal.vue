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
        <p>{{ goal.type }}</p>
        <a class="action-link" @click="editChild(goal)">Edit</a>
        <a class="action-link" @click="deleteChild(goal.id)">Delete</a>
    </article>
</template>

<script>
export default {
    props: ['goal', 'editChild', 'deleteChild'],
    mounted() {
        this.prepareComponent();
    },
    methods: {
        /**
         * Prepare the component (Vue 2.x).
        */
        prepareComponent() {
            this.goal.type = this.humanize(this.goal.type);
        },
        /*
            Make Enums Human readable
        */
        humanize(goal_type) {
            console.log(goal_type);
            if (goal_type === 'short_term') {
                return 'Short Term';
            }

            if (goal_type === 'medium_term') {
                return 'Medium Term';
            }

            if (goal_type === 'long_term') {
                return 'Long Term';
            }
        }
    }
}
</script>