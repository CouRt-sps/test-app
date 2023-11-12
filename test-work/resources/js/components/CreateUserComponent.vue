<template>
    <div class="w-25">
        <h3>Добавить пользователя</h3>
        <div class="mb-12 d-flex">
            <input type="text" class="form-control-lg me-2" v-model="name" id="name" placeholder="Имя" required>
            <input type="email" class="form-control-lg me-2" v-model="email" id="name" placeholder="Email" required>
            <input type="text" class="form-control-lg me-2" v-model="password" id="name" placeholder="Пароль" required>
            <select class="form-select-lg" v-model="role" id="role" required>
                <option value="" selected disabled>Выберите role</option>
                <option value="admin">admin</option>
                <option value="user">user</option>
            </select>
        </div>
        <div class="mb-3">
            <input @click.prevent="addUser" class="btn btn-primary mt-2" value="Добавить">
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
