{{-- resources/views/trieur/index.blade.php --}}

@extends('layouts.trieur')

@section('title', 'TRIEUR RP - RPG TOOLKIT')

@section('content')

    @include('trieur.partials.accueil')
    @include('trieur.partials.ajout')
    @include('trieur.partials.roleplaylist')
    @include('trieur.partials.characters')
    @include('trieur.partials.forums')
    @include('trieur.partials.faq')

@endsection
