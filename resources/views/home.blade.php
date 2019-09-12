@extends('layouts.dashboard')

@section('content')

<div class="container">
        {{-- <div>
                {!! $chart->container() !!}
            </div> --}}
    <div class="row justify-content-center">
        <div class="container">
            <v-app id="app">
                    <div class="card">
                            <div class="card-header">
                                <h1 class="text-center">Cuenta del usuario</h1>
                            </div>
                            <div class="card-body">
                                <card-account
                                id="{{ Auth::user()->id }}"
                                rol=" {{ Auth::user()->roles[0]->name }} "
                                ></card-account>
                            </div>
                        </div>
                        @hasrole('SuperGerente|Gerente')
                        <div class="card">
                            <div class="card-header text-center">
                                <h1>Estatud de los proyectos</h1>
                            </div>
                            <div class="card-body">   
                                @foreach ($projects as $project)
                                    @if ( $project->estatud === 1)
                                        <div class="card">
                                            <div class="card-header text-center">
                                                <h3>Proyecto {{ $project->name }}</h3>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($project->objective as $objectives)
                                                    @if ($objectives->goal->where('estatud', '<>' ,2)->count()  <> 0)
                                                    <div class="card">
                                                        <div class="card-header text-center">
                                                            Meta {{ $objectives->name }}
                                                        </div>
                                                        <card-estatud
                                                        id="{{ $objectives->id }}"
                                                        quantity="{{ $objectives->goal->where('estatud', '<>' ,2)->count() }}"
                                                        ></card-estatud>
                                                        @foreach ($objectives->goal as $goals)
                                                            <ul class="list-group">
                                                                <card-object
                                                                id="{{ $goals->id }}">
                                                                </card-object>
                                                            </ul>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endhasrole
            </v-app>
        </div>
    </div>
</div>
@endsection
