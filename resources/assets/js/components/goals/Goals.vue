<style scoped>
    .panel-body {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        align-content: flex-start;
    }
</style>

<template>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Goals</h1>
                <a class="action-link" @click="showCreateGoalForm">
                    Create New Goal
                </a>
            </div>
            <div class="panel-body">
                <goal v-for="goal in goals" :goal="goal" :edit-child="edit" :delete-child="destroy"></goal>
            </div>
        </div>

        <!-- Create goal Modal -->
        <div class="modal fade" id="modal-create-goal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Create Goal
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="createForm.errors.length > 0">
                            <p><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in createForm.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Create goal Form -->
                        <form class="form-horizontal" role="form">
                            <!-- Name -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Name</label>

                                <div class="col-md-7">
                                    <input id="create-goal-name" type="text" class="form-control" @keyup.enter="store" v-model="createForm.name">

                                    <span class="help-block">
                                        The name of your goal. Ex.) Learn HTML
                                    </span>
                                </div>
                            </div>

                            <!-- Goal Description -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description</label>

                                <div class="col-md-7">
                                    <textarea class="form-control" name="description" @keyup.enter="store" v-model="createForm.description"></textarea>

                                    <span class="help-block">
                                        Describe your goal. Ex.) Begin studying HTML5 and CSS3
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="store">
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit goal Modal -->
        <div class="modal fade" id="modal-edit-goal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Edit {{ editForm.name }}
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="editForm.errors.length > 0">
                            <p><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in editForm.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Edit goal Form -->
                        <form class="form-horizontal" role="form">
                            <!-- Name -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Name</label>

                                <div class="col-md-7">
                                    <input id="edit-goal-name" type="text" class="form-control" @keyup.enter="update" v-model="editForm.name">

                                    <span class="help-block">
                                        Goal Name
                                    </span>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description</label>

                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="redirect" @keyup.enter="update" v-model="editForm.description">

                                    <span class="help-block">
                                        Goal Description
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="update">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Goal from './Goal.vue';
function goalsInitalState() {
    return {
        goal: {
            id: '',
            name: '',
            description: '',
            type: ''
        }
    }
}

function formInitialState() {
    return {
        errors: [],
        name: '',
        description: '',
        id: ''
    }
}

export default {
    /*
     * The component's data.
     */
    data() {
        return {
            goals: goalsInitalState(),
            createForm: formInitialState(),
            editForm: formInitialState()
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
            $('#modal-create-goal').on('shown.bs.modal', () => {
                $('#create-goal-name').focus();
            });

            this.getGoals();
        },

        /**
         * Show the form for creating new goals.
         */
        showCreateGoalForm() {
            $('#modal-create-goal').modal('show');
        },

        getGoals() {
            this.$http.get('/api/goals')
                .then(response => {
                    this.goals = response.data;
                });
        },

        /**
         * Display edit form modal and set form values
         */
        edit(goal) {
            this.editForm.id = goal.id;
            this.editForm.name = goal.name;
            this.editForm.description = goal.description;

            $('#modal-edit-goal').modal('show');
        },

        /**
         * Destroy the given client.
         */
        destroy(goal_id) {
            this.$http.delete('/api/goal-delete/' + goal_id)
                    .then(response => {
                        this.getGoals();
                    });
        },

        /**
         * Create a new goal
         */
        store() {
            this.persistGoal(
                'post', '/api/goal-save', this.createForm, '#modal-create-goal'
            );
        },

        /**
         * Edit a goal
         */
        update() {
            this.persistGoal(
                'put', '/api/goal-edit/', this.editForm, '#modal-edit-goal'
            );
        },

        /**
         * Persist the goal to storage using the given form.
         */
        persistGoal(method, uri, form, modal) {
            form.errors = [];

            this.$http[method](uri, form)
                .then(response => {
                    // Fetch the updated data
                    this.getGoals();
                    // Reset the form
                    form.id = '';
                    form.name = '';
                    form.description = '';
                    form.errors = [];
                    // Close the modal
                    $(modal).modal('hide');
                })
                .catch(response => {
                    if (typeof response.data === 'object') {
                        form.errors = _.flatten(_.toArray(response.data));
                    } else {
                        form.errors = ['Something went wrong. Please try again.'];
                    }
                });
        }
    },

    components: {
        goal: Goal,
    },

    props: {
        editChild: Function,
        deleteChild: Function
    }
}
</script>