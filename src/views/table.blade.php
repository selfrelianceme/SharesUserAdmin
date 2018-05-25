@extends('adminamazing::teamplate')

@section('pageTitle', 'Активы пользователей')
@section('content')
    <script>
        var route = '{{ route('home') }}';
        var message = 'Вы точно хотите удалить данное сообщение?';
    </script>
    @push('display')
        
        <a href="{{route('SharesUserAdminCreate')}}" class="btn hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Создать токен</a>
    @endpush
    <div class="row">
        <!-- Column -->
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title pull-left">@yield('pageTitle')</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Вышестоящий</th>
                                    <th>Создание</th>
                                    <th>Разморозка</th>
                                    <th>Количество</th>
                                    <th>Разморожено</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($shares))
                                    @foreach($shares as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>
                                                <a href="{{route('AdminUsersEdit', $row->user_id)}}">{{$row->user->email}}</a>
                                            </td>
                                            <td>
                                                @if($row->user->upline)
                                                    <a href="{{route('AdminUsersEdit', $row->user->parent_id)}}">{{$row->user->upline->email}}</a>
                                                @endif
                                            </td>
                                            <td>{{$row->created_at}}</td>
                                            <td>{{$row->defrosted_at}}</td>
                                            <td>{{$row->stake_size}} {{$row->info_share->currency}}</td>
                                            <td>{{$row->total_defrost->sum('amount')}} {{$row->info_share->currency}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            @if(isset($shares))
                <nav aria-label="Page navigation example" class="m-t-40">
                    {{ $shares->links('vendor.pagination.bootstrap-4') }}
                </nav>
            @endif
        </div>
        <!-- Column -->    
    </div>
@endsection