@extends('principal')

@section('contenido')

@if (Auth::check())

<template v-if= "menu==1">
    <autors></autors>
</template>


<template v-if= "menu==2">
    <categoria></categoria>
</template>

<template v-if= "menu==3">
    <editorial></editorial>
</template>

<template v-if= "menu==4">
    <idioma></idioma>
</template>

<template v-if= "menu==5">
    <pais></pais>
</template>

<template v-if= "menu==6">
    <libros></libros>
</template>

<template v-if= "menu==7">
    <prestamo></prestamo>
</template>

<template v-if= "menu==8">
    <users></users>
</template>

<template v-if= "menu==9">
    <personas></personas>
</template>


@endif


@endsection

