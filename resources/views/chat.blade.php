@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div>
                        <chat-users @userid="getUserId"></chat-users>
                    </div>

                </div>
            </div>

            <chat-form
                    :messages="messages"
                    v-on:messagesent="sendMessage"
                    :receiver="receiver_id"
                    :errors="{{ $errors }}"
                    :user="{{ Auth::user() }}"
            ></chat-form>
        </div>
    </div>
@endsection