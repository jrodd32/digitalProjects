<style scoped>

</style>

<template>
    <div class="container">
        <div class="panel panel-defaul">
            <div class="panel-heading">
                <h1>{{ profile.name }}</h1>
            </div>

            <div class="panel-body">
                <ul>
                    <li>email: {{ profile.email }}</li>
                    <li>avatar: <img :src="profile.avatar" ></li>
                </ul>

                <ul>
                    <li v-for="error in profile.errors">
                        {{ error }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
function initialState() {
    return {
        name: '',
        email: '',
        avatar: '',
        errors: []

    }
}

export default {
    /*
     * The component's data.
     */
    data() {
        return {
            profile: initialState()
        };
    },
    /**
     * Prepare the component (Vue 2.x).
     */
    mounted() {
        this.prepareComponent();
    },

    methods: {
        prepareComponent() {
            this.getProfile();
        },

        getProfile() {
            this.$http.get('/api/profile')
                .then(response => {
                    console.log(response.data);
                    this.profile = response.data
                })
                .catch(response => {
                    this.errors = response.data
                });
            // this.profile = {
            //     name: 'Jerrod Long',
            //     email: 'jlong@doeanderson.com',
            //     avatar: 'https://3.basecamp-static.com/3437920/people/7891964/avatars/avatar-17a65bd14265f52d89290fd17578b797-128-x1'
            // };
        }
    }
}
</script>