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
            <form action="{{action('ContactController@process')}}" method="POST">
                {!! csrf_field() !!}
                Name:{{$contact->name}}</br>
                E-mail:{{$contact->email}}</br>
                Subject:{{$contact->subject}}</br>
                Comments:{{$contact->comments}}</br>
                @foreach($contact->getAttributes() as $key => $value)
                <input type="hidden" name="{{$key}}" value="{{$value}}">
                @endforeach
                <button type='submit' name='action' value='back'>Back</button>
                <button type='submit' name='action' value='submit'>Submit</button>
            </form>
        </div>

    </div>

    <div class="adsence"></div>
    @include('footer')
</body>

</html>
