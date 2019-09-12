@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            <v-app id="app">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Actividad</h1>
                    </div>
                    <div class="card-body">
                        <dt-activity
                        id="{{ $id }}"
                        task="{{ $task }}"
                        find="{{ $find }}"
                        ></dt-activity>
                    </div>
                </div>
            </v-app>
        </div>
    </div>
</div>


@endsection