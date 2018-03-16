<template>
    <div>

        <input type="file" name="profile_img" id="profile_img">
            <img src="" alt="pics">
        <a href="#" class="btn btn-success" @click.prevent="upload" > Upload </a>
        
    </div>

</template>

<script>
export default {
    methods:{
        upload(){
            console.log('yeahhhhh');
        }
    }
}
</script>

