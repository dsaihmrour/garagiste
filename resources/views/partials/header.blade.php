<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center gap-1">
                    @php
                        $selectedLanguage = session('locale', config('app.locale'));
                        $languages = [
                            'fr' => asset('assets/images/county/10.png'),
                            'en' => asset('assets/images/county/05.png'),
                            'ar' => asset('assets/images/county/11.png'),
                            'es' => asset('assets/images/county/09.png'),
                        ];
                        $selectedLanguageImage = $languages[$selectedLanguage] ?? $languages['en'];
                    @endphp
                    <li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="avascript:;"
                            data-bs-toggle="dropdown"><img src="{{ $selectedLanguageImage }}" width="22"
                                alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" id="language-menu">
                            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"
                                    data-lang="en"><img data-lang="en" src="{{ asset('assets/images/county/05.png') }}"
                                        width="20" alt=""><span data-lang="en"
                                        class="ms-2">English</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"
                                    data-lang="fr"><img data-lang="fr" src="{{ asset('assets/images/county/10.png') }}"
                                        width="20" alt=""><span data-lang="fr"
                                        class="ms-2">French</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"
                                    data-lang="es"><img data-lang="es" src="{{ asset('assets/images/county/09.png') }}"
                                        width="20" alt=""><span data-lang="es"
                                        class="ms-2">Spanish</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"
                                    data-lang="ar"><img data-lang="ar" src="{{ asset('assets/images/county/11.png') }}"
                                        width="20" alt=""><span data-lang="ar"
                                        class="ms-2">Arabic</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dark-mode d-none d-sm-flex">
                        <a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            data-bs-toggle="dropdown"><span class="alert-count" id="count">0</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">{{ __('Notifications') }}</p>
                                    <p class="msg-header-badge"><span id="new">0</span> {{ __('New') }}</p>
                                </div>
                            </a>
                            <div class="header-notifications-list" id="notifications-list">
                                {{-- <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{ asset('assets/images/avatars/avatar-1.png') }}"
                                                class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Daisy Anderson<span class="msg-time float-end">5
                                                    {{ __('sec ago') }}</span>
                                            </h6>
                                            <p class="msg-info">The standard chunk of lorem</p>
                                        </div>
                                    </div>
                                </a> --}}
                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">
                                    <button class="btn btn-primary w-100">{{ __('View All Notifications') }}</button>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-user text-primary">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <div class="user-info">
                        <p class="user-name mb-0">{{ Auth::user()->firstName }}</p>
                        <p class="designattion mb-0">{{ Auth::user()->lastName }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}"><i
                                class="bx bx-user fs-5"></i><span>{{ __('Profile') }}</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="bx bx-log-out-circle"></i><span>{{ __('Log out') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <script>
        document.getElementById('language-menu').addEventListener('click', function(event) {
            let lang = event.target.dataset.lang;
            fetch("/change-language/" + lang)
                .then(response => location.reload())
                .catch(error => {
                    console.error('Error:', error);
                });
        });
        const count = document.getElementById('count');
        const newNotif = document.getElementById('new');

        document.addEventListener('DOMContentLoaded', function() {
            setInterval(function() {
                fetch('/client/notifications')
                    .then(response => response.json())
                    .then(data => {
                        let notificationsDiv = document.getElementById('notifications-list');
                        notificationsDiv.innerHTML = '';
                        count.innerHTML = data.notifications.length;
                        newNotif.innerHTML = data.notifications.length;
                        data.notifications.forEach(notification => {
                            let div = document.createElement('div');
                            div.className = 'dropdown-item';
                            div.innerHTML = `
                                <div class="d-flex align-items-center">
                                    <div class="user-online">
                                        <img src="{{ asset('assets/images/logo-icon.png') }}"
                                            class="msg-avatar" alt="user">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="msg-name">${notification.title} <span class="msg-time float-end">${new Date(notification.created_at).toLocaleString()}</span></h6>
                                        <p class="msg-info">${notification.content.length > 20 ? notification.content.substring(0, 20) + '...' : notification.content}</p>
                                    </div>
                                </div>
                            `;
                            notificationsDiv.appendChild(div);
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }, 5000);
        });
    </script>
</header>
