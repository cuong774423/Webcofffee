@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
@endsection
@section('content')	
<div class="contacts_content">
    <div class="contacts_banner">
        <div class="contacts_img">
            <div class="overlay">
                <h3>Để Lại Thông Tin </h3>
                <h2>Liên Hệ Với Coffee Da Den</h3>
            </div>
        </div>
        @if(Session::has('success'))
    <div id="orderSuccessMessage" style="display:block; font-size:20px; font-weight: bold; background-color: #28a745; color: white; padding: 20px; position: fixed; top: 20%; left: 50%; transform: translate(-50%, -50%); border-radius: 5px; font-size: 18px; z-index: 10;">
        {{ Session::get('success') }}
    </div>

    <script>
        window.onload = function() {
            var message = document.getElementById('orderSuccessMessage');
            message.style.display = 'block';

            // Ẩn thông báo sau 3 giây
            setTimeout(function() {
                message.style.display = 'none';
            }, 3000);
        };
    </script>
@endif
    </div>
    <div class="contacts_box">
        <div class="contacts_box_item1">
            <h3>Liên Hệ</h3>
            <span>Liên hệ nếu bạn cần </span>
            <div class="contacts_infor">
                <div class="contacts_infor1">
                    <div class="contacts_infor_item">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Địa chỉ</span>
                        <span>Đông Lào</span>
                    </div>
                    <div class="contacts_infor_item">
                    <i class="fa-solid fa-phone"></i>
                        <span>Số điện thoại</span>
                        <span>012345678</span>
                        <span>Hotline: 19001000</span>
                        
                    </div>
                </div>
                <div class="contacts_infor2">
                    <div class="contacts_infor_item">
                        <i class="fa-solid fa-clock"></i>
                        <span>Giờ mở cửa</span>
                        <span>6am - 10pm</span>
                    </div> 
                    <div class="contacts_infor_item">
                        <i class="fa-solid fa-envelope-open"></i>
                        <span>Email</span>
                        <span>cuongprovjp@gmail.com</span>
                    </div>     
                </div>
            </div>
        </div>
        <div class="contacts_box_item2">
                    <div class="contacts_title">
                        <h3>LIÊN HỆ VỚI COFFEE DA DEN</h3>
                    </div>
                    <form action="{{ route('contact.store') }}" method="post" >
                    @csrf
                        <div class="contacts_item">
                            <input name="name" type="text" placeholder="Tên của bạn"  required ></input>
                        </div>
                        <div class="contacts_item">
                            <input name="email" type="email" required placeholder="Email của bạn"  required ></input>
                        </div>  
                        <div class="contacts_item">
                            <textarea name="message" type="text" rows="6" cols="80"  placeholder="Tin nhắn"  required ></textarea>
                        </div>
                        <div class="contacts_btn">
                            <button type="submit">Gửi</button>
                        </div>
                    </div>
                </div>
    </div>
    <div class="contacts_map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.673097753863!2d105.841171!3d21.028511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abb403507c57%3A0x35a0b47f1f6a4b69!2zSMOgIE7hurVuZywgSG_DoG4gSOG7sywgVOG7pW5nIENoxqE!5e0!3m2!1svi!2s!4v1656674747047!5m2!1svi!2s" width="1870" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

</div>
</div>

@endsection
