<nav id="sidebar">

    <div class="text-center pt-3 m-0">
        <h5 class="font-weight-bold" style="font-family: 'Poppins', sans-serif;">
            {{-- <i class="fas fa-brain fa-sm mr-1"></i> --}}
            {{-- <i class="fas fa-stroopwafel mr-1"></i> --}}
            <i class="fab fa-think-peaks fa-sm"></i>
            E.W.S
        </h5>
    </div>
    <hr class="col-8 my-1">

    <ul class="list-unstyled components" >

        <li >
            <a href="{{ route('home') }}" >
                <i class="fas fa-home"></i>
                Home
            </a>
        </li>

        @if (Auth::user()->hasRole('Admin'))
        <li >
            <a href="{{ route('user') }}" >
                <i class="far fa-id-badge"></i>
                User
            </a>
        </li>
        @elseif (Auth::user()->hasRole('Supervisor'))
        <li >
            <a href="{{ route('user.surveyor') }}" >
                <i class="far fa-id-badge"></i>
                Surveyor
            </a>
        </li>
        @endif

        @if (Auth::user()->hasRole('Admin'))
        <li >
            <a href="{{ route('tugas_survey') }}" >
                <i class="fas fa-tasks small"></i>
                Penugasan
            </a>
        </li>
        @elseif (Auth::user()->hasRole('Supervisor'))
        <li >
            <a href="{{ route('tugas_survey.instansi') }}" >
                <i class="fas fa-tasks small"></i>
                Penugasan
            </a>
        </li>
        @endif





        @if (Auth::user()->hasRole('Admin'))


        <li>
            <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-boxes small"></i>
                {{-- <i class="fas fa-list small"></i> --}}
                Master
            </a>
            <ul class="collapse list-unstyled ml-3" id="pageSubmenu1">
                <li >
                    <a href="{{ route('komoditas') }}" >
                        <i class="far fa-list-alt"></i>
                        Komoditas
                    </a>
                </li>
                <li>
                    <a href="{{ route('lokasi') }}" >
                        <i class="far fa-list-alt"></i>
                        Lokasi
                    </a>
                </li>
                <li >
                    <a href="#" >
                        <i class="fas fa-store small"></i>
                        Instansi
                    </a>
                </li>

            </ul>
        </li>



        @endif



        <li>
            <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="far fa-file-alt"></i>
                Survey
            </a>
            <ul class="collapse list-unstyled ml-3" id="pageSubmenu2">
                @if (Auth::user()->hasRole('Admin'))
                <li>
                    <a href="{{ route('survey') }}" >
                        <i class="fas fa-tasks small"></i>
                        List (Mingguan)
                    </a>
                </li>
                @endif
                @if (Auth::user()->hasRole('Supervisor'))
                <li>
                    <a href="{{ route('survey.aproval') }}" >
                        <i class="fas fa-check-double small"></i>
                        Aproval
                    </a>
                </li>
                @endif
                @if (Auth::user()->hasRole('Surveyor'))
                <li>
                    <a href="{{ route('survey.mylist') }}" >
                        <i class="fas fa-list small"></i>
                        My List
                    </a>
                </li>

                @endif

                <li>
                    <a href="{{ route('survey-chart') }}" >
                        <i class="fas fa-chart-line small"></i>
                        Chart (Bulanan)
                    </a>

                </li>

            </ul>
        </li>


        <li>
            <a  href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>

</nav>