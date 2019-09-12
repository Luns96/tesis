@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            <v-app id="app">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Meta</h1>
                    </div>
                    <div class="card-body">
                        {{-- <card-goal 
                        id="{{ $id }}"
                        ></card-goal> --}}
                        <dt-goals
                        id="{{ $id }}"
                        task="{{ $task }}"
                        find="{{ $find }}"
                        ></dt-goals>
                    </div>
                </div>
            </v-app>
        </div>
    </div>
</div>


@endsection