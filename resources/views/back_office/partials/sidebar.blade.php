@if (auth()->user())

    @if (auth()->user()->profil->name == "users")
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('back_office.accueil') }}" class="app-brand-link">
                    <span class="app-brand-text demo menu-text fw-bolder ms-2"> Kononkoulou</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ (request()->routeIs('back_office.accueil')) ? 'active' : '' }}">
                <a href="{{ route('back_office.accueil') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Accueil</div>
                </a>
            </li>

            <li class="menu-item {{ (request()->routeIs('back_office.index')) ? 'active' : '' }}">
                <a href="{{ route('back_office.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-pie-chart-alt-2"></i>
                <div data-i18n="Analytics">Espace decouverte</div>
                </a>
            </li>

            <li class="menu-item {{ (request()->routeIs('catalogue.index')) ? 'active' : '' }}">
                <a href="{{ route('catalogue.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-customize"></i>
                <div data-i18n="Analytics">Catalogue</div>
                </a>
            </li>

            <li class="menu-item {{ (request()->routeIs('tontine.*')) ? 'active' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Extended UI">Tontines</div>
                </a>
                <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('tontine.list')) ? 'active' : '' }}">
                    <a href="{{ route('tontine.list') }}" class="menu-link">
                    <div data-i18n="Perfect Scrollbar">Listes Tontines</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('tontine.mylist')) ? 'active' : '' }}">
                    <a href="{{ route('tontine.mylist') }}" class="menu-link">
                    <div data-i18n="Text Divider">Mes tontines</div>
                    </a>
                </li>
                </ul>
            </li>


            <li class="menu-item {{ (request()->routeIs('projet.list')) ? 'active' : '' }}">
                <a href="{{ route('projet.list') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-edit-alt"></i>

                <div data-i18n="Boxicons">Mes projets</div>
                </a>
            </li>

            <li class="menu-item {{ (request()->routeIs('campagne.list')) ? 'active' : '' }}">
                <a href="{{ route('campagne.list') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-voice"></i>
                <div data-i18n="Boxicons">Mes campagnes</div>
                </a>
            </li>



            <li class="menu-item {{ (request()->routeIs('contribution.*')) ? 'active' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>

                <div data-i18n="Extended UI">Contributions</div>
                </a>
                <ul class="menu-sub">
                <li class="menu-item {{ (request()->routeIs('contribution.index')) ? 'active' : '' }}">
                    <a href="{{ route('contribution.index') }}" class="menu-link">
                    <div data-i18n="Perfect Scrollbar">Listes Contributions</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->routeIs('contribution.mine')) ? 'active' : '' }}">
                    <a href="{{ route('contribution.mine') }}" class="menu-link">
                    <div data-i18n="Text Divider">Mes contributions</div>
                    </a>
                </li>
                </ul>
            </li>

            <li class="menu-item {{ (request()->routeIs('aide.index')) ? 'active' : '' }}">
                <a href="{{ route('aide.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-help-circle"></i>
                <div data-i18n="Analytics">FAQ</div>
                </a>
            </li>


            </ul>
        </aside>
    @else
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <a href="{{ route('back_office.accueil') }}" class="app-brand-link">
                <span class="app-brand-text demo menu-text fw-bolder ms-2"> Kononkoulou</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ (request()->routeIs('back_office.admin')) ? 'active' : '' }}">
            <a href="{{ route('back_office.admin') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Tableau Board</div>
            </a>
        </li>

        <li class="menu-item {{ (request()->routeIs('user.*')) ? 'active' : '' }}">
            <a href="{{ route('user.list') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-copy"></i>
            <div data-i18n="Analytics">Utilisateurs</div>
            </a>
        </li>

        {{-- <li class="menu-item {{ (request()->routeIs('user.*')) ? 'active' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-copy"></i>
            <div data-i18n="Extended UI">Utilisateurs</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{ (request()->routeIs('user.list')) ? 'active' : '' }}">
                <a href="{{ route('user.list') }}" class="menu-link">
                <div data-i18n="Perfect Scrollbar">Validation</div>
                </a>
            </li>
            <li class="menu-item {{ (request()->routeIs('user.list')) ? 'active' : '' }}">
                <a href="{{ route('user.list') }}" class="menu-link">
                <div data-i18n="Text Divider">Listes</div>
                </a>
            </li>
            </ul>
        </li> --}}

        <li class="menu-item {{ (request()->routeIs('campagne.*')) ? 'active' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-copy"></i>
            <div data-i18n="Extended UI">Campagnes</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{ (request()->routeIs('campagne.checklist')) ? 'active' : '' }}">
                <a href="{{ route('campagne.checklist') }}" class="menu-link">
                <div data-i18n="Perfect Scrollbar">Listes Demandes</div>
                </a>
            </li>
            <li class="menu-item {{ (request()->routeIs('campagne.admin')) ? 'active' : '' }}">
                <a href="{{ route('campagne.admin') }}" class="menu-link">
                <div data-i18n="Text Divider">Listes des campagnes</div>
                </a>
            </li>
            </ul>
        </li>


        <li class="menu-item {{ (request()->routeIs('tontine.*')) ? 'active' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-copy"></i>
            <div data-i18n="Extended UI">Tontines</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{ (request()->routeIs('tontine.listdemande')) ? 'active' : '' }}">
                <a href="{{ route('tontine.listdemande') }}" class="menu-link">
                <div data-i18n="Perfect Scrollbar">Listes Demandes</div>
                </a>
            </li>
            <li class="menu-item {{ (request()->routeIs('tontine.list')) ? 'active' : '' }}">
                <a href="{{ route('tontine.list') }}" class="menu-link">
                <div data-i18n="Text Divider">Listes des Tontines</div>
                </a>
            </li>
            </ul>
        </li>

        <li class="menu-item {{ (request()->routeIs('sector.list')) ? 'active' : '' }}">
            <a href="{{ route('sector.list') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Secteur</div>
            </a>
        </li>

        </ul>
    </aside>
    @endif

@else
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('back_office.accueil') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2"> Kononkoulou</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ (request()->routeIs('back_office.accueil')) ? 'active' : '' }}">
        <a href="{{ route('back_office.accueil') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Accueil</div>
        </a>
    </li>

    <li class="menu-item {{ (request()->routeIs('back_office.index')) ? 'active' : '' }}">
        <a href="{{ route('back_office.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-pie-chart-alt-2"></i>
        <div data-i18n="Analytics">Espace decouverte</div>
        </a>
    </li>

    <li class="menu-item {{ (request()->routeIs('catalogue.index')) ? 'active' : '' }}">
        <a href="{{ route('catalogue.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-customize"></i>
        <div data-i18n="Analytics">Catalogue</div>
        </a>
    </li>


    <li class="menu-item {{ (request()->routeIs('aide.index')) ? 'active' : '' }}">
        <a href="{{ route('aide.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-help-circle"></i>
        <div data-i18n="Analytics">FAQ</div>
        </a>
    </li>


    </ul>
</aside>
@endif
