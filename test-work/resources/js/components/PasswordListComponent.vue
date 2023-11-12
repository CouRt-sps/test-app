<template>
    <div>
        <CreateGroupComponent></CreateGroupComponent>
        <CreatePasswordComponent></CreatePasswordComponent>
    </div>
    <div>
        <h2>Список паролей</h2>
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
                <template v-for="password in accessForMe">
                    <tr :class="isEdit(password.id) ? 'd-none' : ''">
                        <td scope="row">{{ password.id }}</td>
                        <td>{{ password.title }}</td>
                        <td>{{ password.password }}</td>
                        <td>{{ password.group_id }}</td>
                        <td>{{ password.user_id }}</td>
                        <td>{{ password.access }}</td>
                        <td>{{ password.created_at }}</td>
                        <td>{{ password.updated_at }}</td>
                        <td><a v-if="authUserRole === 'admin'" href="#" @click.prevent="changeEditPasswordId(password.id, password.title, password.password,)" class="btn btn-success">Edit</a></td>
                    </tr>
                    <tr :class="isEdit(password.id) ? '' : 'd-none'">
                        <td scope="row">{{ password.id }}</td>
                        <td><input type="text" v-model="title" class="form-control"></td>
                        <td><input type="text" v-model="pass" class="form-control"></td>
                        <td>
                            <select class="form-select" v-model="selectedGroup" id="selectedGroup">
                                <option value="" selected disabled>Выберите группу</option>
                                <option v-for="group in groups" :value="group.id">{{ group.name }}</option>
                            </select>
                        </td>
                        <td>{{ password.user_id }}</td>
                        <td>
                            <select class="form-select" v-model="access" id="access" required>
                                <option value="to_all">to_all</option>
                                <option value="only_me">only_me</option>
                            </select>
                        </td>
                        <td><a href="#" @click.prevent="changeEditPasswordId(null)" class="btn btn-success">Update</a></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import CreateGroupComponent from "./CreateGroupComponent.vue";
import CreatePasswordComponent from "./CreatePasswordComponent.vue";
export default {
    name: "PasswordListComponent",

    data() {
        return {
            passwords: null,
            title: '',
            pass: '',
            editPasswordId: null,
            authUserRole: window.authUserRole,
        }
    },
    mounted() {
        this.getPasswords()
        this.getGroup()
    },
    methods: {
        getPasswords() {
            axios.get('/api/passwords')
                .then( data => {
                    this.passwords = data.data
                })
                .catch( error => {

                })
                .finally( {

                })
        },

        getGroup() {
            axios.get('/api/group')
                .then( data => {
                    this.groups = data.data
                })
        },

        changeEditPasswordId(id, title, password) {
            this.editPasswordId = id
            this.title = title
            this.pass = password
        },

        isEdit(id) {
            return this.editPasswordId === id
        }

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
        CreatePasswordComponent,
    }
};
</script>

<style scoped>

</style>
