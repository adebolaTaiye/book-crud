<template>
    <div class="p-5 mt-5 ">
    <div class="flex justify-between">
        <div class="text-4xl font-bold"> {{ title }}</div>
        <div v-if="showMessage" :class="flashClass($page.props.flash.message)">
            {{ $page.props.flash.message }}
        </div>
        <slot name="button"></slot>
    </div>
        <div>
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted} from 'vue'

defineProps({
    title: String,
})

const showMessage = ref(true)

     onMounted(() => {
        setTimeout(() => {
            showMessage.value = false
        }, 2000);
     })

   function flashClass(type) {
    if(type === 'record added Successfully' || type === 'record updated Successfully'){
        return 'text-white bg-green-400 rounded-md p-3 w-64'
    }else if( type === 'record deleted Successfully')
        {
            return 'text-white bg-yellow-400 rounded-md p-3 w-64'
        }
}


</script>

<style lang="scss" scoped>

</style>
