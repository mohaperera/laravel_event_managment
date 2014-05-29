<?php
 if (Session::has('success')) {  
  $class = 'alert-success';
  $message = Session::get('success');
 } else {
  $class = 'hide';
  $message = '';
 }
?>
<div class="alert {{ $class }}"> 
  <span class="message">{{ $message }}</span>
  <button type="button" class="close"></button>
</div>
