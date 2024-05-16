<script setup lang="ts">
import { ref } from 'vue'
import { onMounted } from 'vue'
import Axios from 'axios'

const props = defineProps({
    endPointUrl: { type: String, required: true },
    editUserRoute: { type: String, required: true } // When edit for a user is clicked, go to edit page
});

const userList = ref([]);

const isShowMessage = ref(false); 
const isError = ref(false);
const messageText = ref('');

type userObject = {
        id: null,
        firstName: '',
        lastName: '',
        username: '',
        dob: '',
        createdAt: '',        
    };

const axios = Axios.create({
    timeout: 10000,
    headers: {
        Accept: "application/json",
    }
})

 // Get list of users from API endpoint
 async function getUserList() {
    axios.get(props.endPointUrl).then(response => {
        if(200 === response.status) {
            userList.value = response.data; 
        } else {
            console.log('Failed to fetch users');
        }
    });  
}

// Delete user via API
async function deleteUser(id:number, userFullName:string) {
    clearMessages();
    await axios.delete(props.endPointUrl+'/'+id).then(response => {
        console.log(response);
        if(200 === response.status) {
            userList.value = userList.value.filter(function(object:userObject) { return object.id !== id });
            messageText.value = "User '"+userFullName+"' deleted successfully";
            
        } else {
            isError.value = true;
            messageText.value = "Failed to delete user '"+userFullName+"'";
        }
    }).catch(function (error) {
        isError.value = true;
        messageText.value = "Failed to delete user '"+userFullName+"'";
    });
    isShowMessage.value = true;  
}

onMounted(() => {
   getUserList(); 
});


function timestampToLocaleDate(timestamp:string): string {
    const date = new Date(timestamp);
    return date.toLocaleDateString('en-AU');
}

function timestampToDateTime(timestamp:number): string {
    const date = new Date(timestamp * 1000);
    return date.toLocaleDateString('en-AU') + ' ' + date.toLocaleTimeString('en-AU');
}

// Open new browser tab to edit user
function goToEditUser(id:number) {
    const url = props.editUserRoute+'/'+id;
    window.open(url, '_blank');
}

function clearMessages() {
    isShowMessage.value = false;
    messageText.value = '';
    isError.value = false;
}

</script>


<template>
    

<h1 class="p-4 text-xl font-bold ">User List</h1>
<h2 class="p-4 text-md font-bold">{{ userList.length  }} users retrieved <span @click="getUserList()" class="cursor-pointer text-blue-500 underline">[Refresh]</span></h2>

<div v-if="isShowMessage" class="max-w-2xl flex items-start justify-between p-2 ml-6 rounded-sm text-white " :class="{ 'bg-red-700' : isError, 'bg-green-500' : !isError }">
    <div class="">{{ messageText }}</div>
    <div class="cursor-pointer" @click="clearMessages()">[close]</div>
  </div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
    <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <th scope="col" class="px-6 py-3">ID</th>
            <th scope="col" class="px-6 py-3">Username</th>
            <th scope="col" class="px-6 py-3">First Name</th>
            <th scope="col" class="px-6 py-3">Last Name</th>
            <th scope="col" class="px-6 py-3">Date of Birth</th>
            <th scope="col" class="px-6 py-3">Created</th>
            <th scope="col" class="px-6 py-3">Actions</th>
        </thead>
        <tbody>
            <tr v-for="user in userList" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">           
                <td class="px-6 py-4">{{ user['id'] }}</td>
                <td class="px-6 py-4">{{ user['username'] }}</td>
                <td class="px-6 py-4">{{ user['firstName'] }}</td>
                <td class="px-6 py-4">{{ user['lastName'] }}</td>
                <td class="px-6 py-4">{{ timestampToLocaleDate(user['dob']) }}</td>
                <td class="px-6 py-4">{{ timestampToDateTime(user['createdAt']) }}</td>
                <td>
                    <button 
                     @click="goToEditUser(user['id'])"
                     type="button"  
                     class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                     Edit</button>
                    
                    <button type="button" 
                    @click="deleteUser(user['id'],user['firstName'] + ' ' + user['lastName'])"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    Delete</button>
                </td>
            </tr>
        </tbody>           
    </table>
</div>


</template>