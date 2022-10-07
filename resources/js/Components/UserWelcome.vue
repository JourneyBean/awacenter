<script setup>
    import ApplicationLogo from '@/Components/ApplicationLogo.vue';
    import { Icon } from '@vicons/utils'
    import { UserAvatar, Application } from '@vicons/carbon';
    </script>
        
    <template>
        <div>
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div>
                    <ApplicationLogo class="block h-12 w-auto" />
                </div>
    
                <div class="mt-8 text-2xl">
                    欢迎！ {{ $page.props.user.name }}
                </div>
    
                <div class="mt-6 text-gray-500">
                    您已以{{ $page.props.user.email }}身份登录。<br />
                    从下方链接开始，开启您的Mewwoof之旅吧！
                </div>
            </div>
    
            <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                <div class="p-6">
                    <div class="flex items-center">
                        <Icon size="32">
                            <UserAvatar />
                        </Icon>
                        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                            <a href="/user/profile">账户管理</a>
                        </div>
                    </div>
    
                    <div class="ml-12">
                        <div class="mt-2 text-sm text-gray-500">
                            您可以在此管理账户。<br />
                            您拥有您的账户的完全控制权，可以管理名称、邮箱、登录设备甚至删除账户等。
                        </div>
    
                        <a href="/user/profile">
                            <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                <div>管理您的账户</div>
    
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
                            <Application />
                        </Icon>
                        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                            <a :href="route('apps')">Mewwoof APPS</a>
                        </div>
                    </div>
    
                    <div class="ml-12">
                        <div class="mt-2 text-sm text-gray-500">
                            从该链接开始，进入您在Mewwoof上的应用服务列表。<br />
                            您对服务的连接具有完全的控制权。您可以断开连接、甚至它们命令删除用户数据。
                        </div>
    
                        <a :href="route('apps')">
                            <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                <div>进入 Mewwoof APPS</div>
    
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
        