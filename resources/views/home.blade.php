@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ChatApp</div>

                <div class="card-body">


                <chatapp user="{{auth()->user()->id}}"></chatApp>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
