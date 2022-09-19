@extends('backend.layouts.master')
@section('title', 'Request Quotation')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/vendor_chat.css') }}">
    <style>
        ::-webkit-input-placeholder {
            /* Chrome/Opera/Safari */
            color: #F16044;
            margin-left: 10px;
        }

        ::-moz-placeholder {
            /* Firefox 19+ */
            color: #F16044;
            margin-left: 10px;
        }

        :-ms-input-placeholder {
            /* IE 10+ */
            color: #F16044;
            margin-left: 10px;
        }

        :-moz-placeholder {
            /* Firefox 18- */
            color: #F16044;
            margin-left: 10px;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <h3 class=" text-center">Messaging</h3>
        <div class="messaging">
            <div class="inbox_msg">

                {{-- <div class="inbox_people"> --}}
                {{-- <div class="headind_srch"> --}}
                {{-- <div class="recent_heading"> --}}
                {{-- <h4>Recent</h4> --}}
                {{-- </div> --}}
                {{-- <div class="srch_bar"> --}}
                {{-- <div class="stylish-input-group"> --}}
                {{-- <input type="text" class="search-bar"  placeholder="Search" > --}}
                {{-- <span class="input-group-addon"> --}}
                {{-- <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button> --}}
                {{-- </span> </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- <div class="inbox_chat"> --}}
                {{-- <div class="chat_list active_chat"> --}}
                {{-- <div class="chat_people"> --}}
                {{-- <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> --}}
                {{-- <div class="chat_ib"> --}}
                {{-- <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5> --}}
                {{-- <p>Test, which is a new approach to have all solutions --}}
                {{-- astrology under one roof.</p> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- <div class="chat_list"> --}}
                {{-- <div class="chat_people"> --}}
                {{-- <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> --}}
                {{-- <div class="chat_ib"> --}}
                {{-- <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5> --}}
                {{-- <p>Test, which is a new approach to have all solutions --}}
                {{-- astrology under one roof.</p> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- <div class="chat_list"> --}}
                {{-- <div class="chat_people"> --}}
                {{-- <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> --}}
                {{-- <div class="chat_ib"> --}}
                {{-- <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5> --}}
                {{-- <p>Test, which is a new approach to have all solutions --}}
                {{-- astrology under one roof.</p> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- <div class="chat_list"> --}}
                {{-- <div class="chat_people"> --}}
                {{-- <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> --}}
                {{-- <div class="chat_ib"> --}}
                {{-- <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5> --}}
                {{-- <p>Test, which is a new approach to have all solutions --}}
                {{-- astrology under one roof.</p> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- <div class="chat_list"> --}}
                {{-- <div class="chat_people"> --}}
                {{-- <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> --}}
                {{-- <div class="chat_ib"> --}}
                {{-- <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5> --}}
                {{-- <p>Test, which is a new approach to have all solutions --}}
                {{-- astrology under one roof.</p> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- <div class="chat_list"> --}}
                {{-- <div class="chat_people"> --}}
                {{-- <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> --}}
                {{-- <div class="chat_ib"> --}}
                {{-- <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5> --}}
                {{-- <p>Test, which is a new approach to have all solutions --}}
                {{-- astrology under one roof.</p> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- <div class="chat_list"> --}}
                {{-- <div class="chat_people"> --}}
                {{-- <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> --}}
                {{-- <div class="chat_ib"> --}}
                {{-- <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5> --}}
                {{-- <p>Test, which is a new approach to have all solutions --}}
                {{-- astrology under one roof.</p> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}

                <div class="mesgs">
                    <div class="msg_history" style="height: 400px">
                        {{-- @foreach ($vndMes['mess'] as $mes) --}}
                        {{-- @if ($mes['sender'] == Auth::id()) --}}
                        {{-- <div class="outgoing_msg mt-2"> --}}
                        {{-- <div class="sent_msg"> --}}
                        {{-- <p>{{$mes['text']}}</p> --}}
                        {{-- <span class="time_date m-0"> 11:01 AM    |    June 9</span> </div> --}}
                        {{-- </div> --}}
                        {{-- @else --}}
                        {{-- <div class="incoming_msg mt-2"> --}}
                        {{-- <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> --}}
                        {{-- <div class="received_msg"> --}}
                        {{-- <div class="received_withd_msg"> --}}
                        {{-- <p >{{$mes['text']}}</p> --}}
                        {{-- <span class="time_date m-0"> 11:01 AM    |    June 9</span></div> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                        {{-- @endif --}}
                        {{-- @endforeach --}}
                    </div>
                    <div class="type_msg" style="position: sticky">
                        <div class="input_msg_write">
                            <input type="text" class="write_msg" placeholder="Type a message" name="chat_message" />
                            <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o"
                                    aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
@push('js')
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-app.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
             https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-firestore.js"></script>
    <script>
        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        var firebaseConfig = {
            // apiKey: "AIzaSyAdc_EP4Oyio_3hxs-n5pHzJjTGpbXzl-k",
            // authDomain: "dschat-b633c.firebaseapp.com",
            // databaseURL: "https://dschat-b633c.firebaseio.com",
            // projectId: "dschat-b633c",
            // storageBucket: "dschat-b633c.appspot.com",
            // messagingSenderId: "389109485499",
            // appId: "1:389109485499:web:0beed73c86ef0436e27e9e",
            // measurementId: "G-WWYCWXZZ54"

            apiKey: "",
            authDomain: "",
            projectId: "",
            storageBucket: "",
            messagingSenderId: "",
            appId: "",
            measurementId: ""
        };
        var chat_id = "{{ $orderVendor->chat_id }}";
        console.log(chat_id);
        var masege = [];
        var vendor_id = {{ Auth::id() }};
        // Initialize Firebase
        var app = firebase.initializeApp(firebaseConfig);
        db = firebase.firestore(app);
        db.collection("conversation").doc(chat_id)
            .onSnapshot((doc) => {
                masege = doc.data().messages;
                var lastMes = masege[masege.length - 1];
                console.log(masege[masege.length - 1].text);
                console.log(masege);
                masege.map((mas) => {
                    if (mas.sender == vendor_id) {
                        $('.msg_history').append(`<div class="outgoing_msg mt-2">
                                    <div class="sent_msg">
                                        <p>${mas.text}</p>
                                        <span class="time_date m-0"> 01:01 AM    |    June 9</span> </div>
                                </div>`)
                    } else {
                        $('.msg_history').append(`<div class="incoming_msg mt-1">
                                    <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <p >${mas.text}</p>
                                            <span class="time_date m-0"> 11:01 AM    |    June 9</span></div>
                                    </div>
                                </div>`)
                    }
                });


                $(".msg_history").stop().animate({
                    scrollTop: $(".msg_history")[0].scrollHeight
                }, 0);
            });
        $('.write_msg').val("");
        $('.msg_send_btn').click(function() {
            var my_maseg = $('.write_msg').val();
            db.collection("conversation").doc(chat_id).update({
                    messages: firebase.firestore.FieldValue.arrayUnion({
                        text: my_maseg,
                        sentTime: Date.now(),
                        sender: vendor_id,
                        senderType: "vendor",
                        position: "last",
                        createdAt: Date.now()
                    })
                })
                .then(() => {
                    console.log("Document successfully written!");
                })
                .catch((error) => {
                    console.error("Error writing document: ", error);
                });
            // $('.msg_history').append(`<div class="outgoing_msg mt-2">
        //                         <div class="sent_msg">
        //                             <p>${my_maseg}</p>
        //                             <span class="time_date m-0"> 11:01 AM    |    June 9</span> </div>
        //                     </div>`)
            $(".msg_history").stop().animate({
                scrollTop: $(".msg_history")[0].scrollHeight
            }, 1000);
            $('.write_msg').val("");
        });
        $(document).on('keypress', function(e) {
            if (e.which == 13) {
                var my_maseg = $('.write_msg').val();
                db.collection("conversation").doc(chat_id).update({
                        messages: firebase.firestore.FieldValue.arrayUnion({
                            text: my_maseg,
                            sentTime: Date.now(),
                            sender: vendor_id,
                            senderType: "vendor",
                            position: "last",
                            createdAt: Date.now()
                        })
                    })
                    .then(() => {
                        console.log("Document successfully written!");
                    })
                    .catch((error) => {
                        console.error("Error writing document: ", error);
                    });
                $(".msg_history").stop().animate({
                    scrollTop: $(".msg_history")[0].scrollHeight
                }, 1000);
                $('.write_msg').val("");
            }
        });
    </script>
@endpush
