<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import moment from "moment";

const props = defineProps(['deposit'])
</script>

<template>
    <Head title="Deposit"/>

    <AuthenticatedLayout>
        <template #header>
            <span class="font-semibold text-xl text-gray-800 leading-tight ">  Transition</span>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900"><h2 class="text-2xl py-3">Deposit Transactions</h2>
                        <table class="w-full">
                            <th class="text-center border border-gray-200 py-2">Amount</th>
                            <th class="text-center border border-gray-200 py-2">Fee</th>
                            <th class="text-center border border-gray-200 py-2">Date</th>

                            <tr v-for=" transaction in props.deposit" :key="transaction.id">
                                <td class="text-center border border-gray-200 py-2">{{ transaction.amount }}</td>
                                <td class="text-center border border-gray-200 py-2">{{ transaction.fee }}</td>
                                <td class="text-center border border-gray-200 py-2">{{ moment(transaction.date).format('D-M-Y')  }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
