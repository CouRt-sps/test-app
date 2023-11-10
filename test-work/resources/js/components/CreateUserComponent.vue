<template>
    <div class="w-25">
        <h3>Добавить пользователя</h3>
        <div class="mb-3">
            <input type="text" class="form-control" v-model="name" id="name" placeholder="Имя" required>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" v-model="email" id="name" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" v-model="password" id="name" placeholder="Пароль" required>
        </div>
        <div class="mb-3">
            <label for="role">Выберите role:</label>
            <select class="form-select" v-model="role" id="role" required>
                <option value="admin">admin</option>
                <option value="user">user</option>
            </select>
        </div>
        <div class="mb-3">
            <input @click.prevent="addUser" class="btn btn-primary" value="Добавить">
        </div>
    </div>
</template>

<script>
export default {
    name: "CreateUserComponent",

    data() {
        return {
            name: '',
            email: '',
            password: '',
            role: '',
        }
    },

    mounted() {
        this.addUser()
    },

    methods: {
        addUser() {
            axios.post('/api/users', {name: this.name, email: this.email, password: this.password, role: this.role})
                .then( res => {
                    this.name = ''
                    this.email = ''
                    this.password = ''
                    this.role = ''
                    console.log(res);
                })
        }
    },
}
</script>
