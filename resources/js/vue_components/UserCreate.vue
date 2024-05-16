<script setup lang="ts">
    import { ref, toRaw } from 'vue'
    import Axios from 'axios'

    const props = defineProps({
        endPointUrl: { type: String, required: true }       
    });

    const isShowMessage = ref(false); 
    const isError = ref(false);
    const messageText = ref('');
    let errors:string[];

    const userObject = ref({
        firstName: '',
        lastName: '',
        username: '',
        dob: ''
    });

    const axios = Axios.create({
        method: 'post',
        timeout: 10000
    })

    // Get list of users from API endpoint
    async function createUser() {

        errors = [];

        if(userObject.value.firstName.trim() === '') {
            errors.push('First Name is required');
        }

        if(userObject.value.lastName.trim() === '') {
            errors.push('First Name is required');
        }
        
        if(userObject.value.username.trim() === '') {
            errors.push('Username is required');
        }

        if(userObject.value.dob.trim() === '') {
            errors.push('Date of Birth is required');
        } else {            
            const regex = /^\d{4}-\d{2}-\d{2}$/g;
            const found = userObject.value.dob.match(regex);
            if(found === null) {
                errors.push('Invalid Date of Birth');
            }            
        }

        if(errors.length > 0) {
            isError.value = true;
            messageText.value = errors.join("\n");
            isShowMessage.value = true;
            return false;
        }

        let postData = {
            firstName: userObject.value.firstName,
            lastName: userObject.value.lastName,
            username: userObject.value.username,
            dob: userObject.value.dob,
        }

        
        await axios.post(props.endPointUrl, postData).then(response => {
            if(201 === response.status) {
                messageText.value = 'User created successfully';
                for (const property in userObject) {
                    userObject[property] = '';
                }
            } else {
                isError.value = true;
                messageText.value = 'Failed to create user';
            }
        });  

        isShowMessage.value = true;
    }

    function clearMessages() {
        isShowMessage.value = false;
        messageText.value = '';
        isError.value = false;
    }

</script>

<template>
    
<h1 class="flex ml-6 mb-8 text-lg font-bold">Create User</h1>
  
<div v-if="isShowMessage" class="max-w-2xl flex items-start justify-between p-2 ml-6 rounded-sm text-white " :class="{ 'bg-red-700' : isError, 'bg-green-500' : !isError }">
    <div class="whitespace-pre">{{ messageText }}</div>
    <div class="cursor-pointer" @click="clearMessages()">[close]</div>
  </div>

  <form id="product-form" method="POST"  enctype="multipart/form-data" class="max-w-2xl ml-6 mt-6 ">    
    <div class="flex flex-col items-left mb-6 gap-3">
        <div>
            <label for="first_name" class="block font-bold text-sm text-gray-700 dark:text-gray-300">First Name</label>
            <input 
                v-model="userObject.firstName"
                id="first_name"                 
                class="mt-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" 
                type="text" 
                name="first_name"
                required />            
        </div>
        <div>
            <label for="last_name" class="block font-bold text-sm text-gray-700 dark:text-gray-300">Last Name</label>
            <input 
                v-model="userObject.lastName"
                id="last_name"                 
                class="mt-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" 
                type="text"
                name="last_name"
                required
                />            
        </div>
        <div>
            <label for="username" class="block font-bold text-sm text-gray-700 dark:text-gray-300">Username</label>
            <input
                v-model="userObject.username"
                id="username"                 
                class="mt-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" 
                type="text"
                name="last_name"                
                required
                />            
        </div>
        <div>
            <label for="dob" class="block font-bold text-sm text-gray-700 dark:text-gray-300">Date of Birth</label>
            <input 
                v-model="userObject.dob"
                id="dob"                 
                class="mt-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" 
                type="date" 
                name="dob"
                required
                />
        </div>
        
    </div>    
    <button type="button" 
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        @click="createUser">
        Create User
    </button>
    </form>
</template>