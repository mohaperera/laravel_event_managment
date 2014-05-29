@extends('layouts.base')

@section('title')
Group
@stop

@section('content')
<div class="page-title"> 
	@include('layouts.success_flash')
	<i class="icon-custom-left"></i>
	<h3>
		<span class="semi-bold">Events</span>
	</h3>
</div>

<div class="span12">
	<div class="grid-body addPD">
		<div class="row-fluid">
			<a id="chat-menu-toggle" href="#sidr" class="chat-menu-toggle" >
				<div class="">
					<button class="btn btn-primary btn-cons right"  id="chat-menu-toggle" class="chat-menu-toggle" href="#sidr" type="button">
						<i class="icon-plus"></i>
							Add New Events
					</button>
				</div>
			</a>
		</div>
	</div>
       
</div>
  
<!-- body content -->
<div class="row-fluid">
     <div class="span12">
          <div class="grid simple ">
			<div class="grid-title">
				<h4>Event <span class="semi-bold">List</span></h4>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
					<a href="#grid-config" data-toggle="modal" class="config"></a>
					<a href="javascript:;" class="reload"></a>
					<a href="javascript:;" class="remove"></a>
				</div>
			</div>
            
			<div class="grid-body postion ">
            
			<div class="download-icon">
				<ul class="nav quick-section ">
					<li class="quicklinks Seticon"> <a data-toggle="dropdown" class="dropdown-toggle  pull-right" href="#"> <i class="icon-cloud-download"></i> </a>
						<ul class="dropdown-menu  pull-right setUl" role="menu" aria-labelledby="dropdownMenu">
							<li><a href="/"> CSV </a> </li>
							<li><a href="/">Excel</a> </li>
							<li><a href="/"> PDF </a> </li>
							<li><a href="/"> Copy </a> </li>
						</ul>
					</li>
					<li class="quicklinks"> <span class="h-seperate"></span></li>
				</ul>
			</div>
              
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="example2" width="100%" >
				<thead>
					<tr>
						<th>ID  </th>
						<th> Title </th>
						<th> Description  </th>
						<th> Start Date  </th>
						<th> End Date  </th>
						<th> City  </th>
						<th> Image  </th>
						<th> Action </th>
					</tr>
				</thead>
				
				<tbody>
				
				@if(!empty($results))
					@foreach ($results as $result) 
						<tr class="odd gradeX">
							<td>{{{ $result->id }}}</td>
							<td>{{{ $result->title }}}</td>
							<td>{{{ $result->description }}}</td>
							<td>{{{ $result->start_date }}}</td>
							<td>{{{ $result->finish_date }}}</td>
							<td>{{{ $result->city }}}</td>
							<td>
								<?php
								$realPath = URL::to('uploads/events/dummy.png');
					        	if (!empty($result->image_path) && !empty($result->image)) {        		
					        		$realPath = URL::to($result->image_path."/".$result->image);        		
					        	}
					        	?>	
					          	<img height="20" width="20" src="{{ $realPath }}" alt="event" />
							</td>
							<td class="action">
								
								<a href="{{ URL::action('EventsController@edit',$result->id ) }}">
									<span class="icon-plus-sign-alt"></span>
								</a>

								&nbsp;
								

								{{ Form::open(array('route' => array('events.destroy', $result->id), 'method' => 'delete', 'style'=>'display:inline-block')) }}
									
			        				<button  class="btn btn-link" type="submit" >
			        					<a class="icon-trash"></a>
			        				</button>
			    				{{ Form::close() }}

							</td>
						</tr>
					@endforeach
				@endif 
               	</tbody>
			</table>
			</div>
		</div>
     </div>
</div>
  
  
</div>
</div>
</div>
<!-- END PAGE -->

<div id="sidr" class="sidr right rightSilder" >
	@include('layouts.error_flash')
	<h6> Add New Events </h6>

 	<div class="row-fluid">
 		{{ Form::open(array('route' => 'events.store', 'class' => 'form-horizontal', 'files'=> true)) }}
      	<div class="span12">
           	<div class="grid simple">
                <div class="grid-body no-border"> <br>
                 	<div class="row-fluid">
                      	<div class="span12">

                      		

							<div class="control-group">
								<label class="control-label"> 
									Title:   
									<span> * </span> 
								</label>
								<div class="controls">
								  	{{  Form::text('title', '', array('class'=>'span12') ) }}
								  	{{  Form::hidden('user_id', $user_id ) }}
								  	
								  	<span class="help-inline">
								  		{{ $errors->first('title','<span class="error">:message</span>'); }}
							  		</span>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"> 
									Description:   
									<span> * </span> 
								</label>
								<div class="controls">
								  	{{  Form::textarea('description', '', array('class'=>'span12', 'rows'=>6) ) }}
								  	<span class="help-inline">
								  		{{ $errors->first('description','<span class="error">:message</span>'); }}
							  		</span>
								</div>
							</div>

                           	<div class="control-group">
								<label class="control-label"> 
									Start Date:   
									<span> * </span> 
								</label>
								<div class="controls">
								  	{{  Form::text('start_date', Input::get('start_date'), array('id' => 'start_date', 'class'=>'span6') ) }}
								  	<span class="help-inline">
								  		{{ $errors->first('start_date','<span class="error">:message</span>'); }}
							  		</span>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"> 
									End Date:   
									<span> * </span> 
								</label>
								<div class="controls">
								  	{{  Form::text('finish_date', Input::get('finish_date'), array('id' => 'finish_date', 'class'=>'span6') ) }}
								  	<span class="help-inline">
								  		{{ $errors->first('finish_date','<span class="error">:message</span>'); }}
							  		</span>
								</div>
							</div>
									
							<div class="control-group">
								<label class="control-label"> 
									City:   <span> * </span> 
								</label>
								<div class="controls">
									{{  Form::text('city', '', array('class'=>'span12') ) }}
									<span class="help-inline">
								  		{{ $errors->first('city','<span class="error">:message</span>'); }}
							  		</span>
								</div>
							</div>


				            <div class="control-group">
				              {{ Form::label('image', 'Image:', array('class' => 'control-label')) }}
				              <div class="controls">
				                {{ Form::file('image') }}
				                <span class="help-inline">{{ $errors->first('image','<span class="error">:message</span>'); }}</span>
				              </div>
				            </div>
								 
						</div>
                         </div>
                    </div>
               </div>
          </div>
                    
		<div class="modal-footer">
			
			<div class="">
				<a id="chat-menu-toggle" href="#sidr" class="chat-menu-toggle" >
					<button class="btn btn-success btn-cons right"  id="chat-menu-toggle" class="chat-menu-toggle" href="#sidr" type="button">
					    Cancel
					</button>
				</a>
				<button type="submit" class="btn btn-primary btn-cons" > Save Changes  </button>
				
			</div>
			
		</div>
		{{ Form::close() }}
	</div>
	<!-- END CHAT -->

<?php $errorMsg = $errors->all(); ?>
@if(!empty($errorMsg))
<script type="text/javascript">  
	
	$(document).ready(function(){

		// console.log('hello');
		$('.bodyclass').css({ "width": "1007px", "position": "absolute", "right": "650px" });
		$('.bodyclass').addClass('breakpoint-768');
		$('#sidr').css({ "display": "block", "right": "0px" });

	});
	 
</script> 
@endif 

<script type="text/javascript">  
	
	$(document).ready(function(){

		// $('#start_date').datetimepicker({
  //     		language: 'pt-BR'
  //   	});

		$( "#start_date" ).datepicker({
	      defaultDate: "+1w",
	      changeMonth: true,
	      // numberOfMonths: 3,
	      dateFormat : "yy-mm-dd",
	      onClose: function( selectedDate ) {
	        $( "#finish_date" ).datepicker( "option", "minDate", selectedDate );
	      }
	    });
    
	    $( "#finish_date" ).datepicker({
	      defaultDate: "+1w",
	      changeMonth: true,
	      dateFormat : "yy-mm-dd",
	      // numberOfMonths: 3,
	      onClose: function( selectedDate ) {
	        $( "#start_date" ).datepicker( "option", "maxDate", selectedDate );
	      }
	    });
		
	});
	 
</script> 


@stop


