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
        <p>If the following information is correct then press the "submit" button.</p>
        <div class="container-contact">
            <form action="{{action('ContactController@process')}}" method="POST">
                {!! csrf_field() !!}
                <label for="name">Name</label>
                {{$contact->name}}</br>
                <label for="email">E-mail</label>
                {{$contact->email}}</br>
                <label for="subject">Subject</label>
                {{$contact->subject}}</br>
                <label for="comments">Comments</label>
                {{$contact->comments}}</br>
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
