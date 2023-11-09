<template>
    <div>
        <create-group-component></create-group-component>
        <h2>Password List</h2>
        <table class="table" v-if="passwords">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Password</th>
                <th scope="col">Group ID</th>
                <th scope="col">User ID</th>
                <th scope="col">Access</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="password in accessForMe">
                <td scope="row">{{ password.id }}</td>
                <td>{{ password.title }}</td>
                <td>{{ password.password }}</td>
                <td>{{ password.group_id }}</td>
                <td>{{ password.user_id }}</td>
                <td>{{ password.access }}</td>
                <td>{{ password.created_at }}</td>
                <td>{{ password.updated_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import CreateGroupComponent from "./CreateGroupComponent.vue";
export default {
    data() {
        return {
            passwords: null,
        };
    },
    mounted() {
        this.getPasswords();
      //  this.doSomething();
    },
    methods: {
        getPasswords() {
            axios.get('/passwords')
                .then( data => {
                    this.passwords = data.data
                })
                .catch( error => {

                })
                .finally( {

                })
        },

    },
    computed: {
        accessForMe() {
            return this.passwords.filter(function (password) {
                return password.access === 'to_all' || password.user_id === authUserId;
            })
        }
    },

    components: {
        CreateGroupComponent,
    }
};
</script>
