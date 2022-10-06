<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Icon } from '@vicons/utils'
import { UserAvatar, Login } from '@vicons/carbon';
</script>
    
<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div>
                <ApplicationLogo class="block h-12 w-auto" />
            </div>

            <div class="mt-8 text-2xl">
                欢迎！管理员 {{ $page.props.user.name }}
            </div>

            <div class="mt-6 text-gray-500">
                您已以{{ $page.props.user.email }}身份登录。<br />
                下方显示了当前的用户数量和OAuth客户端数量。<br />
                要管理，请点击相应的磁块。
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <div class="flex items-center">
                    <Icon size="32">
                        <UserAvatar />
                    </Icon>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                        <a :href="route('dashboard_admin_users')">用户管理</a>
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        您可以在此处增加、删除、修改、注销用户。<br />
                        当前一共有{{ $page.props.users.length }}位用户。
                    </div>

                    <a :href="route('dashboard_admin_users')">
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                            <div>管理用户</div>

                            <div class="ml-1 text-indigo-500">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                <div class="flex items-center">
                    <Icon size="32">
                        <Login />
                    </Icon>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                        <a :href="route('dashboard_admin_oauth')">OAuth客户端管理</a>
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        您可以在此处增加、删除、注销客户端。<br />
                        当前一共有{{ $page.props.clients.length }}个客户端。
                    </div>

                    <a :href="route('dashboard_admin_oauth')">
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                            <div>管理OAuth客户端</div>

                            <div class="ml-1 text-indigo-500">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</template>
    