<template lang="pug">
.page
    .cont
        input(type="file" @change="changedImage" accept="image/*")
        button(@click="sendImage") Send
</template>

<script>
export default {
    name: "ImageUpload",
    data() {
        return {
            image: null
        }
    },
    methods: {
        changedImage(e) {
            // let fileReader = new FileReader();
            // fileReader.readAsDataURL(e.target.files[0]);
            // fileReader.onload = (e) => {
            //     this.image = e.target.result;
            // }
            this.image = e.target.files[0];
        },
        sendImage() {
            const data = new FormData();
            data.append('image', this.image);
            data.append('name', 'saxeli');


            // console.log(this.data);

            // const config = {
            //     headers: { 'content-type': 'multipart/form-data' }
            // }

            axios.post('/api/image/',data)
                .then((response) => {
                    alert("აიტვირთა!")
                    console.log(response.data);
                })
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
