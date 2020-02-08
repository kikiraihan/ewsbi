@extends('layouts.app',[
'title'=>'User',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header pl-3">All User </div>
                <div class="card-body container">
                    <a href="{{ route('user.create') }}" class="btn btn-outline-primary btn-sm border border-white-50">Create +</a>
                    <hr>
                    <table class="table table-striped table-borderless border border-white-50 table-sm small">
                            <caption class="text-left ">Data setiap admin</caption>
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>No</th>
                                    @foreach ($columns as $col)
                                    <th class="text-capitalize">{{ $col }}</th>
                                    @endforeach

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php $no=0 @endphp
                                @foreach ($admin as $admin)
                                <tr>
                                    <th>{{ ++$no }}</th>
                                    @foreach ($columns as $col)

                                    @if ($col=="id_instansi")
                                        <td>{{ $admin->instansi->nama_instansi }}</td>
                                    @else
                                        <td>{{ $admin->$col }}</td>
                                    @endif


                                    @endforeach

                                    <td class="text-center dropdown dropleft">

                                            <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                                ☰
                                            </span>
                                            <div class="dropdown-menu">

                                                <a class="dropdown-item small" href="{{ route('user.edit', ['id'=>$admin->id]) }}">Edit</a>
                                                <form style="display: inline;" method="post" action="{{ route('user.destroy', ['id'=>$admin->id]) }}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        {{ csrf_field()}}
                                                    <button class="dropdown-item small text-danger" >Hapus</button>
                                                </form>


                                            </div>

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                        <table class="table table-striped table-borderless border border-white-50 table-sm small">
                                <caption class="text-left ">Data setiap Supervisor</caption>
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th>No</th>
                                        @foreach ($columns as $col)
                                        <th class="text-capitalize">{{ $col }}</th>
                                        @endforeach

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php $no=0 @endphp
                                    @foreach ($supervisor as $supervisor)
                                    <tr>
                                        <th>{{ ++$no }}</th>
                                        @foreach ($columns as $col)

                                        @if ($col=="id_instansi")
                                            <td>{{ $supervisor->instansi->nama_instansi }}</td>
                                        @else
                                            <td>{{ $supervisor->$col }}</td>
                                        @endif

                                        @endforeach

                                        <td class="text-center dropdown dropleft">

                                                <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                                    ☰
                                                </span>
                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item small" href="{{ route('user.edit', ['id'=>$supervisor->id]) }}">Edit</a>
                                                    <form style="display: inline;" method="post" action="{{ route('user.destroy', ['id'=>$supervisor->id]) }}">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            {{ csrf_field()}}
                                                        <button class="dropdown-item small text-danger" >Hapus</button>
                                                    </form>


                                                </div>

                                        </td>


                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>



                    <table class="table table-striped table-borderless border border-white-50 table-sm small">
                        <caption class="text-left ">Data setiap Surveyor</caption>
                        <thead class="thead-light text-center">
                            <tr>
                                <th>No</th>
                                @foreach ($columns as $col)
                                <th class="text-capitalize">{{ $col }}</th>
                                @endforeach

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php $no=0 @endphp
                            @foreach ($surveyor as $surveyor)
                            <tr>
                                <th>{{ ++$no }}</th>
                                @foreach ($columns as $col)

                                @if ($col=="id_instansi")
                                    <td>{{ $surveyor->instansi->nama_instansi }}</td>
                                @else
                                    <td>{{ $surveyor->$col }}</td>
                                @endif

                                @endforeach

                                <td class="text-center dropdown dropleft">

                                        <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                            ☰
                                        </span>
                                        <div class="dropdown-menu">

                                            <a class="dropdown-item small" href="{{ route('user.edit', ['id'=>$surveyor->id]) }}">Edit</a>
                                            <form style="display: inline;" method="post" action="{{ route('user.destroy', ['id'=>$surveyor->id]) }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ csrf_field()}}
                                                <button class="dropdown-item small text-danger" >Hapus</button>
                                            </form>

                                        </div>

                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>






                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css-halaman')
<style>
    table tbody tr th{
        text-align: center;
        width: 1em;
    }
</style>
@endsection

@section('script-halaman')

@endsection