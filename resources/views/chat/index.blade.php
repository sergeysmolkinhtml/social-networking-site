@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Chats</div>
            <div class="card-body">
                <chat-messages :messages="messages"></chat-messages>
                @include('chat.includes.chat-messages')
            </div>
            @include('chat.includes.chat-form')
            <div class="card-footer">
                <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></chat-form>
            </div>
        </div>
    </div>
@endsection


