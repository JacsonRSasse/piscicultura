@extends('base.corpo_pagina')
@section('titulo_navbar', 'Índice')
@section('nome_usuario', auth()->user()->getPessoaFromUsuario->getNomeRazao())