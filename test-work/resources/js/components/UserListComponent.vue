<template>
    <div>
        <CreateUserComponent></CreateUserComponent>
    </div>
    <div>
        <h2>Список пользователей</h2>
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
                    <tr :class="isEdit(user.id) ? 'd-none' : ''">
                        <td scope="row">{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.role }}</td>
                        <td>{{ user.created_at }}</td>
                        <td>{{ user.updated_at }}</td>
                        <td><a href="#" @click.prevent="changeEditUserId(user.id, user.name, user.email, user.role)" class="btn btn-success">Edit</a></td>
                        <td><a href="#" @click.prevent="deleteUser(user.id)" class="btn btn-danger">Delete</a></td>
                    </tr>
                    <tr :class="isEdit(user.id) ? '' : 'd-none'">
                        <td scope="row">{{ user.id }}</td>
                        <td><input type="text" v-model="name" class="form-control"></td>
                        <td><input type="email" v-model="email" class="form-control"></td>
                        <td>
                            <select class="form-select" v-model="role" id="role" required>
                                <option value="admin">admin</option>
                                <option value="user">user</option>
                            </select>
                        </td>
                        <td><a href="#" @click.prevent="updateUser(user.id)" class="btn btn-success">Update</a></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>

import CreateUserComponent from "./CreateUserComponent.vue";

export default {
    name: "UserListComponent",

    data() {
        return {
            users: null,
            editUserId: null,
            name: '',
            email: '',
            role: '',
        };
    },
    mounted() {
        this.getUsers()
    },
    methods: {
        getUsers() {
            axios.get('/api/users')
                .then( data => {
                    this.users = data.data
                })
        },

        updateUser(id) {
            this.editUserId = null
            axios.patch(`/api/users/${id}`, {id: this.editUserId, name: this.name, email: this.email, role: this.role})
                .then( res => {
                    this.getUsers()
                })
        },

        deleteUser(id) {
            axios.delete(`/api/users/${id}`)
                .then( res => {
                    this.getUsers()
                })
        },

        changeEditUserId(id, name, email, role) {
            this.editUserId = id
            this.name = name
            this.email = email
            this.role = role
        },

        isEdit(id) {
            return this.editUserId === id
        }

    },

    components: {
        CreateUserComponent,
    }
};
</script>
