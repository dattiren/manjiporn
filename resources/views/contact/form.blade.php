<?php
    $admin_flag = False;
    $title = 'CONTACT FORM';
?>
<!DOCTYPE html>
<html lang="ja">

@include('head')

<body>
@include('header')

    <div class="container">
        <h1 class="container-singletitle">Contact form</h1>
        <div class="container-contact">
            <form action="{{action('ContactController@confirm')}}" method="POST">
                {!! csrf_field() !!}
                <label for="name">Name</label>
                <input type="text" name="name" value="{{old('name')}}">
                <label for="email">E-mail</label>
                <input type="text" name="email" value="{{old('email')}}">
                <label for="subject">Subject</label>
                <input type="text" name="subject" value="{{old('subject')}}">
                <label for="comments">Comments</label>
                <textarea name="comments" rows="4">{{old('comments')}}</textarea>
                <button type='submit' name='action' value='Confirm'>Submit</button>
            </form>
        </div>
    </div>

    <div class="adsence"></div>
    @include('footer')
</body>

</html>
