<template>
    <div class="w-25">
        <div class="mb-3">
            <input type="text" class="form-control" v-model="name" id="name" placeholder="Название группы">
        </div>
        <div class="mb-3">
            <input @click.prevent="addGroup" class="btn btn-primary" value="Добавить">
        </div>
    </div>
</template>

<script>
export default {
    name: "CreateGroupComponent",

    data() {
        return {
            name: null,
        }
    },

    mounted() {
        this.addGroup()
    },

    methods: {
        addGroup() {
            axios.post('/api/group', {name: this.name})
                .then( res => {
                    this.name = null
                    console.log(res);
                })
        }
    },
}
</script>
