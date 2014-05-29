<?php
 if (Session::has('error')) {
  $class = 'alert-error';
  $message = Session::get('error');
 } else {
  $class = 'hide';
  $message = '';
 }
?>
<div class="alert {{ $class }}"> 
  <span class="message">{{ $message }}</span>
  <button type="button" class="close"></button>
</div>
