<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <!-- メニューコンテナ -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <div class="flex">

                <!-- ロゴ -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('posts.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- ナビゲーションリンク（PC表示） -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <!-- マイページ -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('マイページ') }}
                    </x-nav-link>

                    <!-- 記事一覧（ホーム） -->
                    <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                        {{ __('ホーム（記事一覧）') }}
                    </x-nav-link>

                </div>
            </div>

            <!-- ユーザーメニュー -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <!-- ドロップダウン -->
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">

                            <!-- ユーザー名表示 -->
                            <div>{{ Auth::user()->name }}</div>

                            <!-- 矢印 -->
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4"
                                     xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </div>

                        </button>

                    </x-slot>

                    <!-- ドロップダウンメニュー内容 -->
                    <x-slot name="content">

                        <!-- プロフィール編集 -->
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- ログアウト -->
                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                         this.closest('form').submit();">

                                {{ __('Log Out') }}

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- ハンバーガーメニュー（モバイル） -->
            <div class="-me-2 flex items-center sm:hidden">

                <!-- メニュー開閉ボタン -->
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400
                               hover:text-gray-500 hover:bg-gray-100 focus:outline-none
                               focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">

                    <svg class="h-6 w-6"
                         stroke="currentColor"
                         fill="none"
                         viewBox="0 0 24 24">

                        <!-- メニューアイコン -->
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <!-- 閉じるアイコン -->
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>
    </div>

    <!-- レスポンシブナビゲーション（スマホ用メニュー） -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <!-- モバイルナビリンク -->
        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('マイページ') }}
            </x-responsive-nav-link>

        </div>

        <!-- ユーザー情報 -->
        <div class="pt-4 pb-1 border-t border-gray-200">

            <div class="px-4">

                <!-- ユーザー名 -->
                <div class="font-medium text-base text-gray-800">
                    {{ Auth::user()->name }}
                </div>

                <!-- メールアドレス -->
                <div class="font-medium text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>

            </div>

            <!-- モバイル用メニュー -->
            <div class="mt-3 space-y-1">

                <!-- プロフィール -->
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- ログアウト -->
                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                 this.closest('form').submit();">

                        {{ __('Log Out') }}

                    </x-responsive-nav-link>

                </form>

            </div>

        </div>

    </div>

</nav>