@extends('layouts.base')

@section('title')
Group
@stop

@section('content')
<div class="page-title"> 
	@include('layouts.success_flash')
	<i class="icon-custom-left"></i>
	<h3>
		<span class="semi-bold">Managers</span>
	</h3>
</div>

<!-- body content -->
<div class="row-fluid">
     <div class="span12">
          <div class="grid simple ">
			<div class="grid-title">
				<h4>Manager <span class="semi-bold">List</span></h4>
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
						<th> Username </th>
						<th> Email  </th>
						<th> Action </th>
					</tr>
				</thead>
				
				<tbody>
				
				@if(!empty($results))
					@foreach ($results as $result) 
						<tr class="odd gradeX">
							<td>{{{ $result->id }}}</td>
							<td>{{{ $result->username }}}</td>
							<td>{{{ $result->email }}}</td>
							<td class="center">
								
								<a href="{{ URL::action('ManagersController@edit',$result->id ) }}">
									<span class="icon-plus-sign-alt"></span>
								</a>

								&nbsp;
								

								{{ Form::open(array('route' => array('managers.destroy', $result->id), 'method' => 'delete')) }}
									
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




<div id="sidr" class="sidr right rightSilder" style="display: block; right: 0px;" >
	@include('layouts.error_flash')
	<h6> Edit Managers </h6>

 	<div class="row-fluid">
 		
 		{{ Form::model($data, array( 'route' => array('managers.update', $id), 'method' => 'patch') ) }}
      	<div class="span12">
           	<div class="grid simple">
                <div class="grid-body no-border"> <br>
                 	<div class="row-fluid">
                      	<div class="span12">
                           	
                           	<div class="control-group">
								<label class="control-label"> 
									Email:   
									<span> * </span> 
								</label>
								<div class="controls">
								  	{{  Form::text('email', null, array('class'=>'span12') ) }}
								  	{{  Form::hidden('group_id', '2' ) }}
								  	<span class="help-inline">
								  		{{ $errors->first('email','<span class="error">:message</span>'); }}
							  		</span>
								</div>
							</div>
									
							<div class="control-group">
								<label class="control-label"> 
									Username:   
									<span> * </span> 
								</label>
								<div class="controls">
								  	{{  Form::text('username', null, array('class'=>'span12') ) }}
								  	<span class="help-inline">
								  		{{ $errors->first('username','<span class="error">:message</span>'); }}
							  		</span>
								</div>
							</div>

							<?php /*

							<div class="control-group">
								<label class="control-label"> 
									Password:   <span> * </span> 
								</label>
								<div class="controls">
									{{  Form::password('password', null, array('class'=>'span12') ) }}
									<span class="help-inline">
								  		{{ $errors->first('password','<span class="error">:message</span>'); }}
							  		</span>
								</div>
							</div>
							*/
							?>
								 
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
				<button type="submit" class="btn btn-primary btn-cons" > Update  </button>
			</div>
			
		</div>
		{{ Form::close() }}
	</div>
	<!-- END CHAT -->

<script type="text/javascript">  
	
	$(document).ready(function(){
		$('.bodyclass').css({ "width": "1007px", "position": "absolute", "right": "650px" });
		$('.bodyclass').addClass('breakpoint-768');
	});
	 
</script> 




@stop
