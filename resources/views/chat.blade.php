@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Chats</div>

                    <div class="panel-body">
                        <chat-form
                                :messages="messages"
                                v-on:messagesent="sendMessage"
                                :receiver="receiver_id"
                                :user="{{ Auth::user() }}"
                        ></chat-form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                        <chat-users @userid="getUserId"></chat-users>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection