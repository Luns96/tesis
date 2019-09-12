@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            <v-app id="app">
                <div class="card">
                    <div class="card-header text-center">
                    <h1>Proyecto {{ $project->name }}</h1>
                    </div>
                    <div class="card-body">
                            <card-project 
                            id="{{ $id }}"
                            ></card-project>
                            <dt-objective
                            id2="{{ $id }}"
                            ></dt-objective>
                    </div>
                </div>
            </v-app>
        </div>
    </div>
</div>


@endsection