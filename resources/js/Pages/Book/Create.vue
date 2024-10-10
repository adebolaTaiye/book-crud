<template>
   <Layout title="Create Book">
        <form @submit.prevent="form.post('/store')" class="bg-white rounded-md p-3 mt-4">
            <div>
                <label>Title</label>
                <input type="text"  placeholder="title" v-model="form.title" class="rounded w-full p-2 border border-2 border-grey-300 "/>
                <div v-if="form.errors.title" class="text-rose-400">{{ form.errors.title }}</div>
            </div>
            <div class="mt-2">
                <label>Author</label>
                <input type="text" placeholder="author" v-model="form.author" class="rounded w-full p-2 border border-2 border-grey-300 "/>
                <div v-if="form.errors.title" class="text-rose-400">{{ form.errors.author }}</div>
            </div>
            <div class="mt-2">
                <label>Description</label>
                <textarea placeholder="description" v-model="form.description" class="rounded w-full p-2 border border-2 border-grey-300 "></textarea>
                <div v-if="form.errors.description" class="text-rose-400">{{ form.errors.description }}</div>
            </div>
            <div class="mt-2">
                <label>Published year</label>
                <input type="number" placeholder="published_year" v-model.number="form.published_year" class="rounded w-full p-2 border border-2 border-grey-300 "/>
                <div v-if="form.errors.published_year" class="text-rose-400">{{ form.errors.published_year }}</div>
            </div>
            <div class="mt-2">
                <label>Status</label>
                <select v-model="form.status" class="w-48 rounded p-2 bg-white  border border-2 border-grey-600 ">
                <option value="available">available</option>
                <option value="borrowed">borrowed</option>
                <option value="reserved">reserved</option>
                </select>
                <div v-if="form.errors.status" class="text-rose-400">{{ form.errors.status }}</div>
            </div>
            <button type="submit" class="mt-2 bg-blue-400 text-white border rounded p-2" :disabled="form.processing">Submit</button>
        </form>

        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
        {{ form.progress.percentage }}
        </progress>
   </Layout>
</template>

<script setup>
import Layout from './Layout.vue'
import { ref } from 'vue'
import { router, useForm } from '@inertiajs/vue3'

const form = useForm({
    title: null,
    author: null,
    description: null,
    published_year: null,
    status: null
})

function submit() {
    router.post('/store', form)
}
</script>

<style lang="scss" scoped>

</style>
