<template>
    <div class="w-25">
        <h3>Добавить пароль</h3>
        <div class="mb-3 d-flex">
            <input type="text" class="form-control-lg me-2" v-model="title" id="title" placeholder="Описание" required>
            <input type="text" class="form-control-lg" v-model="password" id="password" placeholder="Пароль" required>
            <input @click.prevent="getPassword" class="btn btn-primary me-2" value="Сгенерировать">
            <select class="form-select-lg me-2" v-model="selectedGroup" id="selectedGroup">
                <option value="" selected disabled>Выберите группу</option>
                <option v-for="group in groups" :value="group.id">{{ group.name }}</option>
            </select>
            <select class="form-select-lg" v-model="access" id="access" required>
                <option value="" selected disabled>Выберите доступ</option>
                <option value="to_all">to_all</option>
                <option value="only_me">only_me</option>
            </select>
        </div>
        <div class="mb-3">
            <input @click.prevent="addPassword" class="btn btn-primary" value="Добавить">
        </div>
    </div>
</template>

<script>
export default {
    name: "CreatePasswordComponent",

    data() {
        return {
            title: null,
            password: null,
            access: '',
            userId: null,
            selectedGroup: '',
            groups: null,
        }
    },

    mounted() {
        this.userId = window.authUserId;
        this.getGroup()
    },

    methods: {
        addPassword() {
            axios.post('/api/passwords', {title: this.title, password: this.password, access: this.access, userId: this.userId, selectedGroup: this.selectedGroup})
                .then( res => {
                    this.title = null
                    this.password = null
                    this.selectedGroup = ''
                    this.userId = null
                    this.access = ''
                    console.log(res);
                })
        },

        getPassword() {
            axios.get('/api/generation')
                .then( data => {
                    this.password = data.data
                })
        },

        getGroup() {
            axios.get('/api/group')
                .then( data => {
                    this.groups = data.data
                })
        },
    },
}
</script>
