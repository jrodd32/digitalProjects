<style scoped>
</style>

<template>
    <div class="container">
        <div class="panel panel-default">
             <div class="panel-heading">
                <h1>Goals</h1>
             </div>
            <div class="panel-body">
                <goal v-for="goal in goals" :goal="goal"></goal>
            </div>
        </div>
    </div>
</template>

<script>
import Goal from './Goal.vue';
function initalState() {
    return {
        goal: {}
    }
}

export default {
    /*
     * The component's data.
     */
    data() {
        return {
            goals: initalState()
        };
    },

    /**
     * Prepare the component (Vue 2.x).
     */
    mounted() {
        this.prepareComponent();
    },

    methods: {
        /**
         * Prepare the component.
         */
        prepareComponent() {
            this.$http.get('/api/goals')
                      .then(response => {
                            this.goals = response.data;
                      });
        }
    },

    components: {
        goal: Goal
    }
}
</script>