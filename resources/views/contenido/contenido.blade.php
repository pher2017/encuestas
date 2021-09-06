@extends('layout')
@section('contenido')

<template v-if="menu==0">
    <h1>Menu 1</h1>
</template>

<template v-if="menu==1">
    <resultados></resultados>
</template>

<template v-if="menu==2">
    <h1>Menu 3</h1>
</template>

@endsection

