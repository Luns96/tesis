@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            <v-app id="app">
                <div class="card">
                    <div class="card-header">
                        <h1>Proyectos</h1>
                    </div>
                    <div class="card-body">
                        <dt-project></dt-project>
                    </div>
                </div>
            </v-app>
        </div>
    </div>
</div>


@endsection