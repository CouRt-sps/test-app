<template>
    <div>
        <h2>Users list</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">role</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="user in users">
                <tr>
                    <td scope="row">{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.role }}</td>
                    <td>{{ user.created_at }}</td>
                    <td>{{ user.updated_at }}</td>
                    <td><a href="#" @click.prevent="changeEditUserId(user.id)" class="btn btn-success">Edit</a></td>
                </tr>
                <tr :class="isEdit(user.id) ? '' : 'd-none'">
                    <td scope="row">{{ user.id }}</td>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="email" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><a href="#" @click.prevent="changeEditUserId(null)" class="btn btn-success">Update</a></td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import CreateGroupComponent from "./CreateGroupComponent.vue";
export default {
    data() {
        return {
            users: null,
            editUserId: null,
        };
    },
    mounted() {
        this.getUsers();
    },
    methods: {
        getUsers() {
            axios.get('/users')
                .then( data => {
                    this.users = data.data
                })
                .catch( error => {

                })
                .finally( {

                })
        },

        changeEditUserId(id) {
            this.editUserId = id
        },

        isEdit(id) {
            return this.editUserId === id
        }

    },
};
</script>
